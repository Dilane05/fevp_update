<div wire:ignore.self class="modal side-layout-modal fade" id="CreateEvaluationModal" tabindex="-1"
    aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:40%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-2 p-lg-4">
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{ __('Création d\'une évaluation') }}</h1>
                        <p>{{ __('Créer une nouvelle évaluation') }} &#128522;</p>
                    </div>
                    <x-form-items.form wire:submit="store" class="form-modal">
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" wire:model="code">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Ajout de l'upload d'image -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Image de l\'évaluation') }}</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" accept="image/*" wire:model="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Prévisualisation de l'image sélectionnée -->
                            <div class="mt-3" wire:loading wire:target="image">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            @if ($image)
                                <div class="mt-3">
                                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Image Preview"
                                        style="max-width: 100%; height: auto;">
                                </div>
                            @endif
                        </div>
                        <!-- Fin de l'upload d'image -->

                        <div class="mb-3">
                            <label class="form-label">Date de début</label>
                            <input type="date" class="form-control" wire:model="start_date">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date de fin</label>
                            <input type="date" class="form-control" wire:model="end_date">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" wire:model="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Actif</label>
                            <select class="form-select" wire:model="is_active">
                                <option value="">{{ __('Sélectionnez un statut') }}</option>
                                <option value="1">{{ __('Oui') }}</option>
                                <option value="0">{{ __('Non') }}</option>
                            </select>
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-gray-200 text-gray-600 ms-auto mx-3"
                                wire:click="resetFields" data-bs-dismiss="modal">{{ __('Fermé') }}</button>
                            <button type="submit" wire:click.prevent="store" class="btn btn-success"
                                wire:loading.attr="disabled">{{ __('Créer') }}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>
