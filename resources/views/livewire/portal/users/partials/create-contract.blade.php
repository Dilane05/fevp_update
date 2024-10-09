<div wire:ignore.self class="modal side-layout-modal fade" id="CreateContractModal" tabindex="-1" aria-labelledby="modal-form"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:60%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-2 p-lg-4">
                    <!-- Header -->
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{ __('Création un contrat de performance') }}</h1>
                        <p>{{ __('Créer un nouveau contrat de performance') }} &#128522;</p>
                    </div>

                    <x-form-items.form wire:submit="contract" class="form-modal">


                    <div class="shadow p-2 my-2">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Title') }}</label>
                                <input type="text" class="form-control rounded-pill" wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="annee" class="form-label fw-bold">{{ __('Entrer l\'année') }}</label>
                                <select wire:model="year" class="form-control rounded-pill" id="annee" name="annee" required>
                                    <option value="" disabled>Sélectionner l'année</option>
                                    @foreach ($years as $yearOption)
                                        <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group my-3 row">
                            <div class='col'>
                                <label class="px-2" for="user_ids">{{ __('Membres') }}</label>
                                <x-input.selectmultipleusers wire:model.live="user_ids" prettyname="user_ids"
                                    :options="$userss" selected="('user_ids')" multiple="multiple" />
                                @error('user_ids')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <h2 class="mb-4">Tableau des Objectifs</h2>

                    <div class="table-responsive me-3 rounded">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th>Objectifs</th>
                                    <th>Indicateurs</th>
                                    <th>Type D'Indicateur</th>
                                    <th>Cible</th>
                                    <th>Coef</th>
                                    <th>Fréq évaluation</th>
                                    <th>Mode calcul</th>
                                    <th>Observations</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($objectifs as $index => $objectif)
                                    @foreach ($objectif['indicateurs'] as $indicateurIndex => $indicateur)
                                        <tr>
                                            @if ($indicateurIndex === 0)
                                                <td rowspan="{{ count($objectif['indicateurs']) }}">
                                                    <input type="text" class="form-control rounded-pill"
                                                        wire:model="objectifs.{{ $index }}.valeur"
                                                        placeholder="Valeur de l'objectif">
                                                    <br>
                                                    <button class="btn btn-sm btn-primary mt-2"
                                                        wire:click.prevent="addIndicateur({{ $index }})">
                                                        Ajouter indicateur
                                                    </button>
                                                </td>
                                            @endif
                                            <td>
                                                <input type="text" class="form-control rounded-pill"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.nom"
                                                    placeholder="Nom de l'indicateur">
                                            </td>
                                            <td>
                                                <select class="form-control rounded-pill" wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.type">
                                                    <option value="">{{ __('Selectionner le Type D\'Indicateur') }}</option>
                                                    @foreach ($indicators as $indicator)
                                                        <option value="{{ $indicator }}">{{ $indicator }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" class="form-control rounded-pill"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.type"
                                                    placeholder="Nom de l'indicateur"> --}}
                                            </td>
                                            <td><input type="text" class="form-control rounded-pill"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.cible"
                                                    placeholder="Cible"></td>
                                            <td><input type="text" class="form-control rounded-pill"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.coef"
                                                    placeholder="Coef"></td>
                                            <td><input type="text" class="form-control rounded-pill"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.frequence"
                                                    placeholder="Fréq évaluation"></td>
                                            <td><input type="text" class="form-control rounded-pill"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.mode_calcul"
                                                    placeholder="Mode calcul"></td>
                                            <td>
                                                <textarea class="form-control rounded"
                                                    wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.observations" cols="30"
                                                    rows="05"></textarea>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger rounded-pill"
                                                    wire:click="removeIndicateur({{ $index }}, {{ $indicateurIndex }})">
                                                    Supprimer
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bouton pour ajouter un objectif -->
                    <button wire:click.prevent="addObjectif" class="btn btn-success mt-3 rounded-pill">Ajouter un
                        objectif</button>

                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-outline-secondary" wire:click="clearFields"
                                data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Créer') }}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>
