<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => config('braintree.environment'),
                'merchantId' => config('braintree.merchant_id'),
                'publicKey' => config('braintree.public_key'),
                'privateKey' => config('braintree.private_key')
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
