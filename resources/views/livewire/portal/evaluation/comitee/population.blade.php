<div class="shadow rounded p-2">
    <div class="mb-4">
        <div class="row">
            <!-- Champ de recherche -->
            <div class="col-md-4 mb-3">
                <label for="search" class="form-label">{{ __('Rechercher') }}</label>
                <input type="text" id="search" wire:model.live.debounce.500ms="search" class="form-control"
                    placeholder="Nom, matricule...">
            </div>

            <!-- Sélection d'occupation -->
            <div class="col-md-4 mb-3">
                <label for="occupation" class="form-label">{{ __('Occupation') }}</label>
                <select id="occupation" wire:model.live="occupation" class="form-select">
                    <option value="">{{ __('Sélectionner une occupation') }}</option>
                    @foreach ($occupations as $occ)
                        <option value="{{ $occ }}">{{ $occ }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection Pemp Temp -->
            <div class="col-md-4 mb-3">
                <label for="pemp_temp" class="form-label">{{ __('Pemp Temp') }}</label>
                <select id="pemp_temp" wire:model.live="pemp_temp" class="form-select">
                    <option value="">{{ __('Sélectionner le statut Permanent/Temporaire') }}</option>
                    @foreach ($pemp_temps as $temp)
                        <option value="{{ $temp }}">{{ $temp }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection Direction -->
            <div class="col-md-4 mb-3">
                <label for="direction_id" class="form-label">{{ __('Direction') }}</label>
                <select id="direction_id" wire:model.live="direction_id" class="form-select">
                    <option value="">{{ __('Sélectionner une direction') }}</option>
                    @foreach ($directions as $direction)
                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection Enterprise -->
            <div class="col-md-4 mb-3">
                <label for="enterprise_id" class="form-label">{{ __('Enterprise') }}</label>
                <select id="enterprise_id" wire:model.live="enterprise_id" class="form-select">
                    <option value="">{{ __('Sélectionner une entreprise') }}</option>
                    @foreach ($enterprises as $enterprise)
                        <option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection Site -->
            <div class="col-md-4 mb-3">
                <label for="site_id" class="form-label">{{ __('Site') }}</label>
                <select id="site_id" wire:model.live="site_id" class="form-select">
                    <option value="">{{ __('Sélectionner un site') }}</option>
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date de recrutement de -->
            <div class="col-md-6 mb-3">
                <label for="hiring_date_from" class="form-label">{{ __('Date de recrutement de') }}</label>
                <input type="date" id="hiring_date_from" wire:model.live="hiring_date_from" class="form-control">
            </div>

            <!-- Date de recrutement à -->
            <div class="col-md-6 mb-3">
                <label for="hiring_date_to" class="form-label">{{ __('Date de recrutement à') }}</label>
                <input type="date" id="hiring_date_to" wire:model.live="hiring_date_to" class="form-control">
            </div>

            <!-- Durée de service de -->
            <div class="col-md-6 mb-3">
                <label for="length_of_service_from" class="form-label">{{ __('Durée de service de (années)') }}</label>
                <input type="number" id="length_of_service_from" wire:model.live="length_of_service_from"
                    class="form-control">
            </div>

            <!-- Durée de service à -->
            <div class="col-md-6 mb-3">
                <label for="length_of_service_to" class="form-label">{{ __('Durée de service à (années)') }}</label>
                <input type="number" id="length_of_service_to" wire:model.live="length_of_service_to"
                    class="form-control">
            </div>
        </div>
    </div>

    <div class="mb-4 d-flex justify-content-end">
        <div class="d-flex align-items-center">
            <label for="perPage" class="me-2">{{ __('Éléments par page') }}:</label>
            <select wire:model.live="perPage" id="perPage" class="form-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="150">150</option>
                <option value="250">250</option>
                <option value="500">500</option>
                <option value="750">750</option>
                <option value="900">900</option>
                <option value="1000">1000</option>
            </select>
        </div>
        <div class="mx-2">
            <button type="button" wire:click="saveParticipants" class="btn btn-primary">
                {{ __('Enregistrer les la popluation') }}
            </button>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle">
                    <x-alert />
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <input type="checkbox" wire:model.live="selectAll" class="form-check-input">
                            </th>
                            <th>{{ __('Matricule') }}</th>
                            <th>{{ __('Nom') }}</th>
                            <th>{{ __('Occupation') }}</th>
                            <th>{{ __('Email') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" wire:model.live="selectedUsers"
                                        value="{{ $user->id }}" class="form-check-input">
                                </td>
                                <td>{{ $user->matricule }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->occupation }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
