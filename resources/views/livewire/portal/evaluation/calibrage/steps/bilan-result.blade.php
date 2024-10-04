<div class="mb-4">
    <h4 class="text-primary fw-bold mb-3">I - BILAN DES RÉSULTATS</h4>
    <p class="text-secondary">Suivi des réalisations de la période d’évaluation (rendement et efficacité)</p>
    <div class="table-responsive">
        {{-- <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-outline-primary btn-sm rounded-pill" wire:click="addRow" {{ $editable }}>Ajouter une ligne</button>
        </div> --}}

        <table class="table table-borderless rounded-3 shadow-sm align-middle">
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
                @foreach ($rows as $index => $row)
                    <tr>
                        <td class="fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <input type="text" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.objectif" {{ $editable }} disabled>
                            <span
                                style="color: {{ $row['objectif'] != $rowsRes[$index]['objectif'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['objectif'] }}
                            </span>
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
                            <span
                                style="color: {{ $row['indicateur'] != $rowsRes[$index]['indicateur'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['indicateur'] }}
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.coef" {{ $editable }} disabled>
                            <span style="color: {{ $row['coef'] != $rowsRes[$index]['coef'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['coef'] }}
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.cible_pct" {{ $editable }} disabled>
                            <span
                                style="color: {{ $row['cible_pct'] != $rowsRes[$index]['cible_pct'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['cible_pct'] }}
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.cible_nb" {{ $editable }} disabled>
                            <span
                                style="color: {{ $row['cible_nb'] != $rowsRes[$index]['cible_nb'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['cible_nb'] }}
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.resultat_pct" {{ $editable }}>
                            <span
                                style="color: {{ $row['resultat_pct'] != $rowsRes[$index]['resultat_pct'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['resultat_pct'] }}
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.resultat_nb" {{ $editable }}>
                            <span
                                style="color: {{ $row['resultat_nb'] != $rowsRes[$index]['resultat_nb'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['resultat_nb'] }}
                            </span>
                        </td>
                        <td>
                            <input type="number" class="form-control rounded-pill" disabled
                                wire:model.live="rows.{{ $index }}.note" {{ $editable }}>
                            <span style="color: {{ $row['note'] != $rowsRes[$index]['note'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['note'] }}
                            </span>
                        </td>
                        <td>
                            <input type="text" class="form-control rounded-pill"
                                wire:model.live="rows.{{ $index }}.observations" {{ $editable }}>
                            <span
                                style="color: {{ $row['observations'] != $rowsRes[$index]['observations'] ? 'orange' : 'gray' }}">
                                Mention Initiale: {{ $rowsRes[$index]['observations'] }}
                            </span>
                        </td>
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

        {{-- <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-outline-primary btn-sm rounded-pill" wire:click="addRow" {{ $editable }}>Ajouter une ligne</button>
        </div> --}}

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
