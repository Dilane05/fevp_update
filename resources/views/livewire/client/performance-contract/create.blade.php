<div wire:ignore.self class="modal fade" id="CreatePerformanceContract" tabindex="-1" aria-labelledby="CreatePerformanceContract" aria-hidden="true">
<div class="modal-dialog modal-lg" style="max-width:85%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="objectifsModalLabel">Création d'un contrat de performance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-3 me-3">
                    <x-alert />

                    <div class="shadow p-2 my-2">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">{{ __('Title') }}</label>
                                <input type="text" class="form-control rounded-pill" wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <label for="user_id" class="form-label fw-bold">{{ __('Employé') }}</label>
                                <select wire:model="user_id" class="form-control rounded-pill" id="user_id" required>
                                    <option value="">{{ __('Selectionner L\'Employé') }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
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
                                                        wire:click="addIndicateur({{ $index }})">
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
                                            <td><input type="number" class="form-control rounded-pill"
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
                    <button wire:click="addObjectif" class="btn btn-success mt-3 rounded-pill">Ajouter un
                        objectif</button>

                    <!-- Bouton pour sauvegarder les changements -->
                    <button wire:click="store" class="btn btn-primary mt-3">Enregistrer</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
