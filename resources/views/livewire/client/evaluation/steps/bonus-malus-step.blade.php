<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')

    <!-- Modal d'erreurs -->
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
    <h4 class="text-primary fw-bold mb-3">V - BONUS ET MALUS</h4>

    <div class="table-responsive mt-4">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th colspan="2" class="text-center py-3">
                        Mentionner tout fait marquant/tout projet mené au cours de la période évaluée et leur attribuer
                        une note comprise entre -2,5 et 2,5
                    </th>
                    <th class="text-center py-3">[-2,5; 2,5]</th>
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

                @foreach ($projects as $index => $project)
                    <tr>
                        <td colspan="2" class="align-middle">
                            <input type="text" wire:model.live="projects.{{ $index }}.description"
                                class="form-control rounded-pill" placeholder="Description" {{ $editable }} {{ $action }} >
                        </td>
                        <td class="align-middle">
                            <input type="number" wire:model="projects.{{ $index }}.note"
                                class="form-control rounded-pill" min="-2.5" max="2.5" step="0.1"
                                placeholder="" {{ $editable }} {{ $action }} >
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center text-muted fw-bold fs-5">
                        Le Total Bonus et Malus est <span class="text-primary"> {{ number_format($totalBonusMalus, 2) }}
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    @include('livewire.client.evaluation.control-navigation')
</div>
