<div wire:ignore.self class="modal side-layout-modal fade" id="CreateUserModal" tabindex="-1" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document" style="max-width:50%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-2 p-lg-4">
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{__('Création d\'utilisateurs')}}</h1>
                        <p>{{__('Créer un nouvel utilisateur')}} &#128522;</p>
                    </div>
                    <x-form-items.form wire:submit="store" class="form-modal">
                        <input type='hidden' name='user_id' value="" id="userId">
                        <div class='form-group mb-3'>
                            <label for="role_name">{{__('Role')}} <span class="text-danger">*</span></label>
                            <select wire:model.change="role_name" name="role_name" class="form-select  @error('role_name') is-invalid @enderror">
                                <option value="">{{__("Select Role")}}</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3 row">
                            <div class='col-md-6 col-xs-12'>
                                <label for="first_name">{{__('Prénom')}} <span class="text-danger">*</span></label>
                                <input wire:model="first_name" type="text" class="form-control  @error('first_name') is-invalid @enderror" placeholder="John" required="" name="first_name">
                                @error('first_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class='col-md-6 col-xs-12'>
                                <label for="last_name">{{__('Nom')}} <span class="text-danger">*</span></label>
                                <input wire:model="last_name" type="text" class="form-control  @error('last_name') is-invalid @enderror" placeholder="Doe" required="" name="last_name">
                                @error('last_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <div class='col-md-6 col-xs-12'>
                                <label for="phone_number">{{__('Télephone')}} <span class="text-danger">*</span></label>
                                <input wire:model="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder="2376XXXXXXXX" required="" name="phone_number">
                                @error('phone_number')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class='col-md-6 col-xs-12'>
                                <label for="email">{{__('Email')}} <span class="text-danger">*</span></label>
                                <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@company.com" required="" name="email">
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class='col-md-6 col-xs-12'>
                                <label for="gender">{{__('Sexe')}} <span class="text-danger">*</span></label>
                                <select wire:model="gender" name="gender" class="form-select  @error('gender') is-invalid @enderror">
                                    <option value="">{{__("Selectionner le sexe")}}</option>
                                    <option value="Male">{{__('Homme')}}</option>
                                    <option value="female">{{__('Femme')}}</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class='col-md-6 col-xs-12'>
                                <label for="status">{{__('Status')}} <span class="text-danger">*</span></label>
                                <select wire:model="status" name="status" class="form-select  @error('status') is-invalid @enderror">
                                    <option value="">{{__("Selectionner le status")}}</option>
                                    <option value="true">{{__('Active')}}</option>
                                    <option value="false">{{__('Banned')}}</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4 ">
                            <label for="password">{{__('Mot de passe')}} <span class="text-danger">*</span></label>
                            <input wire:model="password" type="text" class="form-control  @error('password') is-invalid @enderror" autofocus="" name="password">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-gray-200 text-gray-600 ms-auto mx-3" wire:click="clearFields" data-bs-dismiss="modal">{{__('Fermé')}}</button>
                            <button type="submit" wire:click.prevent="store" class="btn btn-success " wire:loading.attr="disabled">{{__('Créer')}}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>
