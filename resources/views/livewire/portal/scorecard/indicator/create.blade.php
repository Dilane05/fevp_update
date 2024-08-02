<div wire:ignore.self class="modal side-layout-modal fade" id="CreateIndicatorModal" tabindex="-1"
    aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document" style="max-width:40%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-2 p-lg-4">
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{ __('Création des formules sur les indicateurs') }}</h1>
                        <p>{{ __('Créer un nouvelle indicateur') }} &#128522;</p>
                    </div>
                    <x-form-items.form wire:submit="store" class="form-modal">
                        <input type="hidden" wire:model="indicatorId">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <select class="form-select" wire:model="name">
                                <option value="">{{ __('Sélectionnez un indicateur') }}</option>
                                <option value="performance">Performance</option>
                                <option value="reputation">Réputation</option>
                                <option value="execution">Exécution</option>
                                <option value="budget">Budget</option>
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valeur Minimale</label>
                            <input type="number" class="form-control" wire:model="min_value">
                            @error('min_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valeur Maximale</label>
                            <input type="number" class="form-control" wire:model="max_value">
                            @error('max_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Score de Minimal</label>
                            <input type="number" class="form-control" wire:model="min_score">
                            @error('min_score')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Score Maximal</label>
                            <input type="number" class="form-control" wire:model="max_score">
                            @error('max_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type de Condition</label>
                            {{-- <input type="text" class="form-control" wire:model="condition_type"> --}}
                            <select class="form-select" wire:model="condition_type">
                                <option value="">{{ __('Sélectionnez une condition') }}</option>
                                <option value="range">Interval</option>
                            </select>
                            @error('condition_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-gray-200 text-gray-600 ms-auto mx-3"
                                wire:click="clearFields" data-bs-dismiss="modal">{{ __('Fermé') }}</button>
                            <button type="submit" wire:click.prevent="store" class="btn btn-success "
                                wire:loading.attr="disabled">{{ __('Créer') }}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>
