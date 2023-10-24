@extends('layouts.app')
@section('title', 'Registrazione')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h2 class="text-center py-3">Pagina di registrazione</h2>
                        <div class="note">
                            <span><u>Nota:</u></span>
                            <span>i campi contrassegnati da '</span>
                            <span class="text-danger"><strong>*</strong></span>
                            <span>' sono obbligatori</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="registrationForm" method="POST" action="{{ route('register') }}" novalidate>
                            @csrf

                            {{-- Email --}}
                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    <span>Email</span>
                                    <span class="text-danger"><strong><sup>*</sup></strong></span>
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    <div class="invalidField text-danger">
                                        <ul id="emailUl"></ul>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    <span>Password</span>
                                    <span class="text-danger"><strong><sup>*</sup></strong></span>
                                </label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    <div class="invalidField text-danger">
                                        <ul id="passwordUl"></ul>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Conferma Password --}}
                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    <span>Conferma Password</span>
                                    <span class="text-danger"><strong><sup>*</sup></strong></span>
                                </label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- Nome --}}
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name">
                                    <div class="invalidField text-danger">
                                        <ul id="nameUl"></ul>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Cognome --}}
                            <div class="mb-4 row">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right">Cognome</label>
                                <div class="col-md-6">
                                    <input id="lastName" type="text"
                                        class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                                        value="{{ old('lastName') }}" autocomplete="lastName">

                                    @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Data di nascita --}}
                            <div class="mb-4 row">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-right">Data di
                                    nascita</label>

                                <div class="col-md-6">
                                    <input id="birth_date" type="date"
                                        class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                        value="{{ old('birth_date') }}" required autocomplete="birth_date">

                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Bottone Registrati --}}
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="bt bt-blue">Registrati</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/validateRegistration.js'])
@endsection
