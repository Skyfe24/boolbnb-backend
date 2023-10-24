<section class="space-y-6">
    <div>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Cancella Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una volta che il tuo account sarà cancellato, tutti i suoi dati e risorse verrano cancellati permanentemente. Prima di cancellare il tuo account, per favore scarica qualsiasi informazione o dato che vorresti conservare.') }}
        </p>
    </div>

    <!-- Modal trigger button -->
    <button type="button" class="bt bt-red" data-bs-toggle="modal" data-bs-target="#delete-account">
        {{ __('Cancella Account') }}
    </button>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="delete-account" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="delete-account" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-account">Cancella Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Sei sicuro di voler cancellare il tuo account?') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Una volta che il tuo account sarà cancellato, tutti i suoi dati e risorse verrano cancellati permanentemente. Per favore inserisci la tua password per confermare la tua volontà di cancellare permanentemente il tuo account.') }}
                    </p>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="bt bt-dark-g" data-bs-dismiss="modal">Annulla</button>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                        <div class="input-group">
                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="{{ __('Password') }}" />

                            @error('password')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $errors->userDeletion->get('password') }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="bt bt-red">
                                {{ __('Cancella Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
