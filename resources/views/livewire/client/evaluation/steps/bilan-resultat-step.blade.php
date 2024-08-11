<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')

    <div class="mb-4">
        <h4 class="text-primary fw-bold mb-3">I - BILAN DES RÉSULTATS</h4>
        <p class="text-secondary">Suivi des réalisations de la période d’évaluation (rendement et efficacité)</p>
        <div class="table-responsive">
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
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.objectif"></td>
                            <td>
                                <select class="form-select rounded-pill" wire:model.live="rows.{{ $index }}.indicateur">
                                    <option value="">Sélectionner un Indicateur</option>
                                    @foreach ($indicators as $indicator)
                                        <option value="{{ $indicator }}">{{ __('Indicateur') }} {{ $indicator }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.coef">
                            </td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.cible_pct"></td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.cible_nb"></td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.resultat_pct"></td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.resultat_nb"></td>
                            <td><input type="text" class="form-control rounded-pill" disabled
                                    wire:model.live="rows.{{ $index }}.note">
                            </td>
                            <td><input type="text" class="form-control rounded-pill"
                                    wire:model.live="rows.{{ $index }}.observations"></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10" class="text-center fs-5 text-muted">
                            @if (empty($rows))
                                Veuillez remplir le tableau
                            @endif
                        </td>
                    </tr>
                    @if (!empty($errorMessages))
                        <tr>
                            <td colspan="10" class="text-center text-danger">
                                @foreach ($errorMessages as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                </tfoot>
            </table>
        </div>
        <p class="text-muted mt-4"><strong>NB:</strong> - Si la cible d'un objectif est en pourcentage, mettez-la dans la 1ère colonne. Si elle est en chiffre, mettez-la dans la 2ème colonne.<br>
        - Idem pour les résultats.</p>
    </div>

    <button class="btn btn-danger rounded-pill px-4" wire:click="validateData">VALIDER</button>
</div>
