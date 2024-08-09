<div wire:ignore.self class="modal fade" id="CloseOrDeactivateModal" tabindex="-1" role="dialog" aria-labelledby="closeOrDeactivatePost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 30%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-3 p-lg-3">
                    <div class="mb-1 mt-md-0 text-center">
                        <svg class="icon icon-xl text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h1 class="mb-0 h3 fw-bolder">{{ __('Confirmation') }}</h1>
                        <p class="pt-1">{{ __('Êtes-vous sûr de vouloir') }} <strong>{{ $actionType }}</strong> {{ __('cette évaluation ? Cette action est irréversible.') }}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" wire:click="confirmAction" class="btn btn-warning mx-2" data-dismiss="modal">{{ __('Confirmer') }}</button>
                        <button type="button" class="btn btn-gray-300 text-white" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
