<!-- Import Users Modal -->
<div wire:ignore.self class="modal fade" id="importUsersModal" tabindex="-1" role="dialog" aria-labelledby="importUsersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-2 p-lg-3">
                    <div class="mb-2 mt-md-0 text-center">
                        <svg class="icon icon-xxl text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z"></path>
                        </svg>
                        <h1 class="mb-0 h2 fw-bolder">{{ __('Importez les Utilisateurs') }}</h1>
                        <p class="pt-2">{{ __('Téléchargez un fichier Excel pour importer les utilisateurs.') }}</p>
                    </div>
                    <x-form-items.form wire:submit.prevent="import" class="form-modal">
                        <div class="mb-3">
                            <label for="file" class="form-label">{{ __('Choisir un fichier Excel') }}</label>
                            <input type="file" name="file" wire:model="user_file" id="file" class="form-control @error('user_file') is-invalid @enderror" required>
                            @error('user_file')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mx-3" {{empty($user_file) ? "disabled" : '' }}>
                                {{ __('Importer') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                        </div>
                    </x-form-items.form>
                </div>
                <div wire:loading wire:target="import" class="text-center my-2">
                    <div class="text-center">
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    </div>
                    <div class="mt-2 text-center">{{ __('Importation en cours, veuillez patienter...') }}</div>
                    <div class="mt-2">
                        <span>{{ __('Temps restant : ') }}</span><span wire:poll.1s="countdown">{{ $countdown }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('startCountdown', function () {
            let countdownInterval = setInterval(() => {
                Livewire.emit('decrementCountdown');
            }, 1000);

            Livewire.on('stopCountdown', function () {
                clearInterval(countdownInterval);
            });
        });
    });
</script>
