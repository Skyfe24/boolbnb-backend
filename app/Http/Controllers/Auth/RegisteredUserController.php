<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['max:50'],
                'email' => ['required', 'string', 'email:filter', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'name.max' => 'Il nome inserito supera 50 caratteri',
                'email.required' => 'L\'email è obbligatoria',
                'email.string' => 'L\'email deve essere una stringa',
                'email.email' => 'L\'email inserita non è valida',
                'email.max' => 'L\'email inserita supera i 255 caratteri',
                'email.unique' => 'L\'email inserita è già utilizzata da un altro utente',
                'password.required' => 'La password è obbligatoria',
                'password.confirmed' => 'La conferma della password non coincide'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
