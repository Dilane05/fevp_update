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

    <h4 class="text-primary fw-bold mb-3">IV - CONFORMITÉ À LA CULTURE D'ENTREPRISE (sur 15)</h4>
    <p class="text-secondary">
        Mettre une croix dans la case correspondante pour chaque élément.
    </p>

    <div class="table-responsive mt-4">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th colspan="6" class="text-center py-3">
                        Les éléments essentiels qui traduisent l'ADN Cadyst: Excellence, Performance, Reputation
                    </th>
                </tr>
                <tr>
                    <th rowspan="3" class="align-middle text-center py-4">
                        "Les éléments essentiels qui traduisent l'ADN Cadyst: Excellence, Performance, Reputation"
                    </th>
                    <th colspan="5" class="text-center py-3">Niveau d'atteinte</th>
                </tr>
                <tr class="text-center">
                    <th class="py-2">a- Jamais 0%</th>
                    <th class="py-2">b- Rarement 25%</th>
                    <th class="py-2">c- Souvent 50%</th>
                    <th class="py-2">d- Très souvent 75%</th>
                    <th class="py-2">e- Toujours 100%</th>
                </tr>
                <tr class="text-center">
                    <th class="py-2">0</th>
                    <th class="py-2">0.75</th>
                    <th class="py-2">1.5</th>
                    <th class="py-2">2.25</th>
                    <th class="py-2">3</th>
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

                @foreach ($performanceCriteria as $index => $criteria)
                    <tr>
                        <td class="align-middle text-start py-3">{{ $criteria['criteria'] }}</td>
                        @foreach ([0, 0.75, 1.5, 2.25, 3] as $scoreIndex => $value)
                            <td class="text-center align-middle">
                                <input type="radio"
                                    wire:model.live="performanceCriteria.{{ $index }}.selectedScore"
                                    value="{{ $value }}" class="form-check-input" {{ $editable }} {{ $action }} >
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-center text-muted fw-bold fs-5">
                        Note Globale: <span class="text-primary">{{ number_format($globalScore, 2) }} / {{ $total }}</span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    @include('livewire.client.evaluation.control-navigation')
</div>
