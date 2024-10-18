<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')

    <!-- Modal d'erreurs -->
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

    <h4 class="text-primary fw-bold mb-3">III - QUALITÉS MANAGÉRIALES</h4>
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
    <p class="text-secondary">
        Veuillez renseigner la cible et le taux de réalisation à chaque rubrique. Uniquement pour les "Chefs Service" et
        les "Fonctions spécifiques".
    </p>

    <div class="table-responsive mt-4">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-outline-primary btn-sm rounded-pill" wire:click="addRow" {{ $editable }}>Ajouter
                une ligne</button>
        </div>
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th scope="col" rowspan="2" class="align-middle py-3">Qualités Managériales</th>
                    <th scope="col" colspan="3" class="text-center py-3">Niveau de performance (3)</th>
                </tr>
                <tr>
                    <th scope="col" class="py-2">Cible</th>
                    <th scope="col" class="py-2">% Réal</th>
                    <th scope="col" class="py-2">Observations</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $action = '';
                    if (auth()->user()->id === $response->user_id && $response->is_send) {
                        $action = 'disabled';
                    } elseif (auth()->user()->id === $response->responsable_n1 && $response->in_n1) {
                        $action = 'disabled';
                    } elseif ($response->is_n2) {
                        $action = 'disabled';
                    } elseif (auth()->user()->id === $response->user_id && $response->my_comment) {
                        $action = 'disabled';
                    }
                @endphp

                @foreach ($qualities as $index => $quality)
                    <tr>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.quality"
                                class="form-control rounded-pill" {{ $is_manager }} {{ $editable }} {{ $action }}>
                        </td>
                        <td>
                            <input type="number" step="0.01" wire:model.live="qualities.{{ $index }}.target"
                                class="form-control rounded-pill" {{ $is_manager }} {{ $editable }} {{ $action }}>
                        </td>
                        <td>
                            <input type="number" step="0.01"
                                wire:model.live="qualities.{{ $index }}.realization"
                                class="form-control rounded-pill" {{ $is_manager }} {{ $editable }} {{ $action }}>
                        </td>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.observations"
                                class="form-control rounded-pill " {{ $editable }} {{ $action }} >
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center text-muted fw-bold fs-5">
                        Note Globale: <span class="text-primary">{{ number_format($globalScore, 2) }} /
                            {{ $totalNote }} </span>
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="4" class="text-center text-danger fw-bold fs-6">
                        @if ($errorsModalVisible)
                            @foreach ($errorMessages as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endif
                    </td>
                </tr> --}}
            </tfoot>
        </table>

        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-outline-primary btn-sm rounded-pill" wire:click="addRow" {{ $editable }}>Ajouter
                une ligne</button>
        </div>
    </div>

    @include('livewire.client.evaluation.control-navigation')
</div>
