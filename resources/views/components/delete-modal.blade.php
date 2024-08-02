<div wire:ignore.self class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="createPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-2 p-lg-3">
                    <div class="mb-2 mt-md-0 text-center">
                        <svg class="icon icon-xxl text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h1 class="mb-0 h2 fw-bolder">{{__('Êtes vous sûre?')}}</h1>
                        <p class="pt-2">{{__('Vous ne pourrez pas revenir en arrière.!')}}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" wire:click="delete" class="btn btn-danger mx-3" data-dismiss="modal">{{__('Confirmer')}}</button>
                        <button type="button" class="btn btn-gray-300 text-white " data-bs-dismiss="modal">{{__('Annuler')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>