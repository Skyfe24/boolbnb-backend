<section>
    <div>
        <h2 class="text-secondary">
            {{ __('Informazioni del profilo') }}
        </h2>

        <p class="mt-1 text-muted">
            {{ __('Aggiorna le informazioni relative al profilo del tuo account ed il tuo indirizzo email.') }}
        </p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-2">
            <label for="name">{{ __('Nome') }}</label>
            <input class="form-control" type="text" name="name" id="name" autocomplete="name"
                value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->get('name') }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="email">
                {{ __('Email') }}
            </label>

            <input id="email" name="email" type="email" class="form-control"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />

            @error('email')
                <span class="alert alert-danger mt-2" role="alert">
                    <strong>{{ $errors->get('email') }}</strong>
                </span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-muted">
                        {{ __('Il tuo indirizzo e-mail non è verificato.') }}

                        <button form="send-verification" class="bt bt-dark-g">
                            {{ __('Clicka qui per inviare nuovamente e-mail di verifica.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success">
                            {{ __('Un nuovo link di verifica è stato inviato al tuo indirizzo e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4">
            <button class="bt bt-blue" type="submit">{{ __('Salva') }}</button>

            @if (session('status') === 'profile-updated')
                <script>
                    const show = true;
                    setTimeout(() => show = false, 2000)
                    const el = document.getElementById('profile-status')
                    if (show) {
                        el.style.display = 'block';
                    }
                </script>
                <p id='profile-status' class="fs-5 text-muted mb-0">{{ __('Salvato.') }}</p>
            @endif
        </div>
    </form>
</section>
