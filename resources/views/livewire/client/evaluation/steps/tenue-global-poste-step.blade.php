<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')
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
    <h4 class="text-primary fw-bold mb-3">II - TENUE GLOBALE DU POSTE</h4>

    <p class="text-secondary mb-4">
        Veuillez choisir au minimum 02 DCR dans la liste déroulante et leur attribuer une note comprise
        entre 0 et 1,25.
        (La rubrique permet d’apprécier les autres Domaines Clés de Résultat (DCR) non pris en compte dans
        les objectifs.
        Les DCR à évaluer dans ce cas doivent inclure des aspects sur lesquels les performances ont été
        bonnes et des aspects sur lesquels les performances n’ont pas été satisfaisantes pour des soucis d’équilibre.)
    </p>

    <div class="table-responsive">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th scope="col" class="py-3">Domaines Clés de Résultats</th>
                    <th scope="col" class="py-3">Note</th>
                    <th scope="col" class="py-3">Observations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keyResults as $index => $result)
                    <tr>
                        <td>
                            <input type="text" wire:model.live="keyResults.{{ $index }}.domain"
                                class="form-control rounded-pill" {{ $editable }} >
                        </td>
                        <td>
                            <input type="text" wire:model.live="keyResults.{{ $index }}.note"
                                class="form-control rounded-pill" {{ $editable }} >
                        </td>
                        <td>
                            <input type="text" wire:model.live="keyResults.{{ $index }}.observations"
                                class="form-control rounded-pill" {{ $editable }} >
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center text-muted fw-bold fs-5">
                        Note globale: {{ number_format($globalScore ?? 0, 2) }} /5
                </tr>
            </tfoot>
        </table>
    </div>
    @include('livewire.client.evaluation.control-navigation')
</div>
