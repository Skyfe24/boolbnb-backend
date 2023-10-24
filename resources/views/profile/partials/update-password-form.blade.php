<section>
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Aggiorna Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assicurati che il tuo account stia usando una password lunga e casuale, per essere sicuro.') }}
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-2">
            <label for="current_password">{{ __('Password attuale') }}</label>
            <input class="mt-1 form-control" type="password" name="current_password" id="current_password"
                autocomplete="current-password">
            @error('current_password')
                <span class="invalid-feedback mt-2" role="alert">
                    <strong>{{ $errors->updatePassword->get('current_password') }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="password">{{ __('Nuova Password') }}</label>
            <input class="mt-1 form-control" type="password" name="password" id="password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback mt-2" role="alert">
                    <strong>{{ $errors->updatePassword->get('password') }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">

            <label for="password_confirmation">{{ __('Conferma Password') }}</label>
            <input class="mt-2 form-control" type="password" name="password_confirmation" id="password_confirmation"
                autocomplete="new-password">
            @error('password_confirmation')
                <span class="invalid-feedback mt-2" role="alert">
                    <strong>{{ $errors->updatePassword->get('password_confirmation') }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="bt bt-blue">{{ __('Salva') }}</button>

            @if (session('status') === 'password-updated')
                <script>
                    const show = true;
                    setTimeout(() => show = false, 2000)
                    const el = document.getElementById('status')
                    if (show) {
                        el.style.display = 'block';
                    }
                </script>
                <p id='status' class="fs-5 text-muted mb-0">{{ __('Salvata.') }}</p>
            @endif
        </div>
    </form>
</section>
