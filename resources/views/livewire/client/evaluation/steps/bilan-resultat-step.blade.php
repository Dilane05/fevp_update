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

    <div class="mb-4">
        <h4 class="text-primary fw-bold mb-3">I - BILAN DES RÉSULTATS</h4>
        <p class="text-secondary">Suivi des réalisations de la période d’évaluation (rendement et efficacité)</p>
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table table-borderless rounded-3 shadow-sm align-middle" style="min-width: 2000px;">
                <thead class="bg-primary text-white rounded-top">
                    <tr>
                        <th rowspan="2" class="py-3">N°</th>
                        <th rowspan="2" class="py-3">Objectifs fixés</th>
                        <th rowspan="2" class="py-3">Indicateurs</th>
                        <th rowspan="2" class="py-3">Coef</th>
                        <th colspan="2" class="py-3">Cible</th>
                        <th colspan="2" class="py-3">Résultats</th>
                        <th rowspan="2" class="py-3">Note</th>
                        <th rowspan="2" class="py-3">Observations</th>
                    </tr>
                    <tr>
                        <th>%</th>
                        <th>nb</th>
                        <th>%</th>
                        <th>nb</th>
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

                    @foreach ($rows as $index => $row)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.objectif" {{ $editable }} disabled>
                            </td>
                            <td {{ $editable }}>
                                <select class="form-select rounded-pill"
                                    wire:model.live="rows.{{ $index }}.indicateur" disabled>
                                    <option value="">Sélectionner un Indicateur</option>
                                    @foreach ($indicators as $indicator)
                                        <option value="{{ $indicator }}">{{ __('Indicateur') }} {{ $indicator }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.coef" {{ $editable }} disabled></td>
                            <td><input type="number" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.cible_pct" {{ $editable }} disabled>
                            </td>
                            <td><input type="number" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.cible_nb" {{ $editable }} disabled>
                            </td>
                            <td><input type="number" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.resultat_pct" {{ $editable }}
                                    {{ $action }}></td>
                            <td><input type="number" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.resultat_nb" {{ $editable }}
                                    {{ $action }}></td>
                            <td><input type="number" class="form-control rounded-pill" disabled
                                    wire:model.live="rows.{{ $index }}.note" {{ $editable }}
                                    {{ $action }}></td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.observations" {{ $editable }}
                                    {{ $action }}> </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="12" class="text-center text-muted fw-bold fs-5">
                            @if (!empty($tfootErrorMessages))
                                @foreach ($tfootErrorMessages as $errorMessage)
                                    <div>{{ $errorMessage }}</div>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-4 p-3 bg-light border rounded" style="border-left: 4px solid #17a2b8;">
            <p class="mb-0 text-primary fw-bold">
                <strong class="fw-bold">NB:</strong> - Si la cible d'un objectif est en pourcentage, mettez-la dans la
                1ère colonne.
                Si elle est en chiffre, mettez-la dans la 2ème colonne.<br>
                - Idem pour les résultats.
            </p>
        </div>

    </div>

    @include('livewire.client.evaluation.control-navigation')

</div>
