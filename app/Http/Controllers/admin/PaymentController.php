<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Sponsorship;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => config('braintree.environment'),
            'merchantId' => config('braintree.merchant_id'),
            'publicKey' => config('braintree.public_key'),
            'privateKey' => config('braintree.private_key')
        ]);
    }

    public function validateCreditCard(string $estate_id, string $sponsorship_id)
    {
        $token = $this->gateway->clientToken()->generate();
        $estate = Estate::findOrFail($estate_id);
        $sponsorship = Sponsorship::findOrFail($sponsorship_id);
        $data = compact('token', 'estate', 'sponsorship');
        return view('admin.estates.sponsorship', $data);
    }

    public function sponsorship(string $estate_id, string $sponsorship_id)
    {
        $estate = Estate::findOrFail($estate_id);
        $sponsorship = Sponsorship::findOrFail($sponsorship_id);

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV', 'sandbox'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true,
            ]
        ]);

        if ($result->success) {

            // Controlla se l'estate ha sponsorizzazioni
            if ($estate->sponsorships->isNotEmpty()) {
                // Trova l'ultima non scaduta
                $latestSponsorship = $estate->sponsorships()
                    ->where('stop', '>', now())
                    ->orderBy('stop', 'desc')
                    ->withPivot('start', 'stop') // Include i dati della tabella ponte
                    ->first();

                if ($latestSponsorship) {
                    $start = Carbon::parse($latestSponsorship->pivot->stop);
                    $stop = $start->clone()->addHours($sponsorship->duration);
                } else {
                    $start = now();
                    $stop = now()->addHours($sponsorship->duration);
                }
            } else {
                $start = now();
                $stop = now()->addHours($sponsorship->duration);
            }

            $estate->sponsorships()->attach([
                $sponsorship->id => [
                    'start' => $start,
                    'stop' => $stop,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);

            return to_route('admin.estates.show', $estate->id)
                ->with('success', "Il pagamento è andato a buon fine: sponsor acquistato correttamente!");
        } else {
            return to_route('admin.estates.show', $estate->id)
                ->with('error', 'Pagamento fallito: ' . $result->message);
        }
    }
}
