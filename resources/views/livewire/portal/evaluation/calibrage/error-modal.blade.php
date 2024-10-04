<div class="modal fade {{ $errorsModalVisible ? 'show' : '' }}" id="errorModal" tabindex="-1"
    aria-labelledby="errorModalLabel" aria-hidden="{{ $errorsModalVisible ? 'false' : 'true' }}"
    style="display: {{ $errorsModalVisible ? 'block' : 'none' }};">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header bg-danger text-white rounded-top">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="bi bi-exclamation-circle me-2"></i> Erreurs de Validation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="$set('errorsModalVisible', false)"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errorMessages as $error)
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-x-circle me-2"></i>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-end">
                <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal"
                    wire:click="$set('errorsModalVisible', false)">Fermer</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header bg-danger text-white rounded-top">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="bi bi-exclamation-circle me-2"></i> Erreurs de Validation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errorMessages as $error)
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-x-circle me-2"></i>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-end">
                <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
