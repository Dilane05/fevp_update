<div>

    <!-- Modal -->
    <div  wire:ignore.self class="modal fade" id="CreateTbordModal" tabindex="-1" aria-labelledby="tbordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width:60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tbordModalLabel">{{ __('Créer un Tableau de Bord') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-form-items.form wire:submit="store" class="form-modal">
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

                        <div class="shadow p-2 my-2" style="overflow-x: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Objectifs</th>
                                        <th>Indicateurs</th>
                                        <th>Type D'indicateur</th>
                                        <th>Cible</th>
                                        <th>Coef</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($performances as $index => $performance)
                                        <tr>
                                            <td><input class="form-control rounded-pill" type="text" wire:model="performances.{{ $index }}.objectif"></td>
                                            <td><input class="form-control rounded-pill" type="text" wire:model="performances.{{ $index }}.indicateur"></td>
                                            <td>
                                                <select class="form-control rounded-pill" wire:model="performances.{{ $index }}.type_indicator">
                                                    <option value="">{{ __('Selectionner le Type D\'Indicateur') }}</option>
                                                    @foreach ($indicators as $indicator)
                                                        <option value="{{ $indicator }}">{{ $indicator }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input class="form-control rounded-pill" type="number" wire:model="performances.{{ $index }}.cible"></td>
                                            <td><input class="form-control rounded-pill" type="number" wire:model="performances.{{ $index }}.coef"></td>
                                            <td>
                                                <button wire:click.prevent="removeRow({{ $index }})" class="btn btn-danger rounded-pill">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mx-4">
                            <button wire:click.prevent="addRow" class="btn btn-primary">{{ __('Ajouter une ligne') }}</button>
                            <button type="submit" class="btn btn-success rounded-pill mx-2">{{ __('Sauvegarder') }}</button>
                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">{{ __('Fermer') }}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>
