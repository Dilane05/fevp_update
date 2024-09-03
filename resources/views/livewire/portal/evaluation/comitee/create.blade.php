<div wire:ignore.self class="modal side-layout-modal fade" id="CreateComiteeModal" tabindex="-1"
    aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:50%;">
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

                        <div class="form-group my-3 row">
                            <div class='col'>
                                <label class="px-2" for="user_ids">{{ __('Membres') }}</label>
                                <x-input.selectmultipleusers wire:model.live="user_ids" prettyname="user_ids"
                                    :options="$users" selected="('user_ids')" multiple="multiple" />
                                @error('user_ids')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group my-3 row">
                            <div class='form-group mb-3'>
                                <label for="selected_cibles">{{__('Selectionner la cible')}} <span class="text-danger">*</span></label>
                                <x-input.selectmultiple wire:model.live="postes" prettyname="postes" :options="$occupations->pluck('name','id')" :selected="$occupations->pluck('name','id')" />
                                @error('postes')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <p>
                        </p>

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

    </script>

</div>
