<div wire:ignore.self class="modal side-layout-modal fade" id="CreateComiteeModal" tabindex="-1"
    aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:80%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-2 p-lg-4">
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{ __('Création d\'un comité de calibrage') }}</h1>
                        <p>{{ __('Créer un nouveau comité de calibrage') }} &#128522;</p>
                    </div>
                    <x-form-items.form wire:submit="store" class="form-modal">
                        <div class="row my-2">
                            <div class="col">
                                <label class="form-label">Code</label>
                                <input type="text" class="form-control" wire:model="code">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <label class="form-label">Titre</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <label class="form-label">Date </label>
                                <input type="date" class="form-control" wire:model="date">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <label class="form-label">Lieux</label>
                                <input type="text" class="form-control" wire:model="location">
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="user-select">Sélectionnez des utilisateurs :</label>
                            <select id="user-select" wire:model.live="selectedUsers" multiple class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                            <div class="mt-3">
                                <h5>Utilisateurs sélectionnés :</h5>
                                <ul>
                                    @foreach ($selectedUsers as $selectedUserId)
                                        <li>{{ $users->find($selectedUserId)->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @include('livewire.portal.evaluation.comitee.population')

                        <div class="mb-3">
                            <label class="form-label">Etat</label>
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

    <script>
        document.addEventListener('livewire:load', function() {
            $('#user-select').select2({
                placeholder: 'Sélectionnez des utilisateurs',
                allowClear: true
            });

            $('#user-select').on('change', function(e) {
                @this.set('selectedUsers', $(this).val());
            });

            Livewire.hook('message.processed', (message, component) => {
                $('#user-select').select2({
                    placeholder: 'Sélectionnez des utilisateurs',
                    allowClear: true
                });
            });
        });
    </script>

</div>
