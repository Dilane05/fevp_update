<div wire:ignore.self class="modal side-layout-modal fade" id="CreateUserModal" tabindex="-1" aria-labelledby="modal-form"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:60%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-2 p-lg-4">
                    <!-- Header -->
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{ __('Création d\'utilisateurs') }}</h1>
                        <p>{{ __('Créer un nouvel utilisateur') }} &#128522;</p>
                    </div>

                    <x-form-items.form wire:submit="store" class="form-modal">
                        <input type="hidden" name="user_id" value="" id="userId">

                        <div class='form-group mb-3'>
                            <label for="role_name">{{ __('Role') }} <span class="text-danger">*</span></label>
                            <select wire:model.change="role_name" name="role_name"
                                class="form-select  @error('role_name') is-invalid @enderror">
                                <option value="">{{ __('Select Role') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Matricule -->
                        <div class="row form-group mb-3">
                            <div class="col-md-6">
                                <label for="matricule">{{ __('Matricule') }} <span class="text-danger">*</span></label>
                                <input wire:model="matricule" type="text"
                                    class="form-control @error('matricule') is-invalid @enderror"
                                    placeholder="Matricule" required name="matricule">
                                @error('matricule')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class='col-md-6'>
                                <label for="status">{{ __('Statut') }}</label>
                                <select wire:model="status" name="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option value="">{{ __('Sélectionner le statut') }}</option>
                                    <option value="1">{{ __('Actif') }}</option>
                                    <option value="0">{{ __('Inactif') }}</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Informations Personnelles -->
                        <h5 class="text-muted mb-3">{{ __('Informations personnelles') }}</h5>
                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="first_name">{{ __('Prénom') }} <span class="text-danger">*</span></label>
                                <input wire:model="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" placeholder="John"
                                    required name="first_name">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="last_name">{{ __('Nom') }} <span class="text-danger">*</span></label>
                                <input wire:model="last_name" type="text"
                                    class="form-control @error('last_name') is-invalid @enderror" placeholder="Doe"
                                    required name="last_name">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="phone_number">{{ __('Téléphone') }}</label>
                                <input wire:model="phone_number" type="text"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    placeholder="2376XXXXXXXX" name="phone_number">
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input wire:model="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="example@company.com" required name="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="date_of_birth">{{ __('Date de naissance') }}</label>
                                <input wire:model="date_of_birth" type="date"
                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="gender">{{ __('Sexe') }}</label>
                                <select wire:model="gender" name="gender"
                                    class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">{{ __('Sélectionner le sexe') }}</option>
                                    <option value="male">{{ __('Homme') }}</option>
                                    <option value="female">{{ __('Femme') }}</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Détails de l'emploi -->
                        <h5 class="text-muted mb-3">{{ __('Détails de l\'emploi') }}</h5>
                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="occupation">{{ __('Occupation') }}</label>
                                <select id="occupation" wire:model.live="occupation" class="form-select">
                                    <option value="">{{ __('Sélectionner une occupation') }}</option>
                                    @foreach ($occupations as $occ)
                                        <option value="{{ $occ }}">{{ $occ }}</option>
                                    @endforeach
                                </select>
                                @error('occupation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="hiring_date">{{ __('Date d\'embauche') }}</label>
                                <input wire:model="hiring_date" type="date"
                                    class="form-control @error('hiring_date') is-invalid @enderror"
                                    name="hiring_date">
                                @error('hiring_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="length_of_service">{{ __('Durée de service (années)') }}</label>
                                <input wire:model="length_of_service" type="number"
                                    class="form-control @error('length_of_service') is-invalid @enderror"
                                    placeholder="Durée en années" name="length_of_service">
                                @error('length_of_service')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="is_manager">{{ __('Est un responsable ?') }}</label>
                                <select wire:model="is_manager" name="is_manager"
                                    class="form-select @error('is_manager') is-invalid @enderror">
                                    <option value="">{{ __('Sélectionner') }}</option>
                                    <option value="1">{{ __('Oui') }}</option>
                                    <option value="0">{{ __('Non') }}</option>
                                </select>
                                @error('is_manager')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Évaluateurs -->
                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="main_evaluator">{{ __('Évaluateur Principal') }}</label>
                                <x-input.select-search wire:model="main_evaluator" prettyname="main_evaluator" :options="$userss->pluck('last_name','id','first_name')->toArray()" />
                                @error('main_evaluator')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="second_evaluator">{{ __('Deuxième Évaluateur') }}</label>
                                <x-input.select-search wire:model="second_evaluator" prettyname="second_evaluator" :options="$userss->pluck('last_name','id','first_name')->toArray()" />
                                @error('second_evaluator')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Détails de l'Entreprise -->
                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="direction_id">{{ __('Direction') }}</label>
                                <select id="direction_id" wire:model.live="direction_id" class="form-select">
                                    <option value="">{{ __('Sélectionner une direction') }}</option>
                                    @foreach ($directions as $direction)
                                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                    @endforeach
                                </select>
                                @error('direction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="enterprise_id">{{ __('Entreprise') }}</label>
                                <select id="enterprise_id" wire:model.live="enterprise_id" class="form-select">
                                    <option value="">{{ __('Sélectionner une entreprise') }}</option>
                                    @foreach ($enterprises as $enterprise)
                                        <option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>
                                    @endforeach
                                </select>
                                @error('enterprise_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="site_id">{{ __('Site') }}</label>
                                <select id="site_id" wire:model.live="site_id" class="form-select">
                                    <option value="">{{ __('Sélectionner un site') }}</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                                    @endforeach
                                </select>
                                @error('site_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="responsable_n1">{{ __('Responsable N1') }}</label>
                                <x-input.select-search wire:model="responsable_n1" prettyname="responsable_n1" :options="$userss->pluck('last_name','id','first_name')->toArray()" />
                                @error('responsable_n1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="responsable_n2">{{ __('Responsable N2') }}</label>
                                <x-input.select-search wire:model="responsable_n2" prettyname="responsable_n2" :options="$userss->pluck('last_name','id','first_name')->toArray()" />
                                @error('responsable_n2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="statut_category">{{ __('Catégorie Statut') }}</label>
                                <input wire:model="statut_category" type="text"
                                    class="form-control @error('statut_category') is-invalid @enderror"
                                    placeholder="Catégorie Statut" name="statut_category">
                                @error('statut_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contacts d'urgence -->
                        <h5 class="text-muted mb-3">{{ __('Contact d\'urgence') }}</h5>
                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="emergency_contact_name">{{ __('Nom du contact d\'urgence') }}</label>
                                <input wire:model="emergency_contact_name" type="text"
                                    class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                    placeholder="Nom" name="emergency_contact_name">
                                @error('emergency_contact_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label
                                    for="emergency_contact_phone">{{ __('Téléphone du contact d\'urgence') }}</label>
                                <input wire:model="emergency_contact_phone" type="text"
                                    class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                    placeholder="Téléphone" name="emergency_contact_phone">
                                @error('emergency_contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Statut et mot de passe -->
                        <div class="form-group mb-3 row">
                            <div class='col-md-6'>
                                <label for="password">{{ __('Mot de passe') }} <span
                                        class="text-danger">*</span></label>
                                <input wire:model="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" required
                                    name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='col-md-6'>
                                <label for="confirm_password">{{ __('Mot de passe de confirmation') }} <span
                                        class="text-danger">*</span></label>
                                <input wire:model="confirm_password" type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror" required
                                    name="password_confirmation">
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

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
