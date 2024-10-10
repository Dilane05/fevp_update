<div>
    <div class="my-2">

        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="/" wire:navigate>{{ __('Accueil') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Statistique') }}</li>
            </ol>
        </nav>

        <!-- Titre de la page -->
        <div class="card mb-4 p-4">
            <h1 class="display-4 font-weight-bold">{{ __('Statistique de la session d\'évaluation') }}</h1>
        </div>

        <!-- Filtres -->
        {{-- <div class="mb-4">
            <div class="row">
                <!-- Champ de recherche -->
                <div class="col-md-4">
                    <label for="manager" class="filter-label">Manager :</label>
                    <select id="manager" class="form-select">
                        <option value="">Tous</option>
                        <option value="manager1">Manager 1</option>
                        <option value="manager2">Manager 2</option>
                    </select>
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

            </div>
        </div> --}}

        <!-- Row for Cards -->
        <div class="row g-4 my-1">

            <!-- Card Template -->
            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-people-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Nombre total de participants</h5>
                        </div>
                    </div>
                    <h3 class="text-primary"> {{ $total_participants_count }} </h3>
                    <p>Employés attendus pour cette session ou campagne d'évaluation.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-check-circle-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Taux de participation</h5>
                        </div>
                    </div>
                    <h3 class="text-success">{{ number_format($percent_participate, 2) }} % </h3>
                    <div class="progress my-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $percent_participate }}%;"
                            aria-valuenow="{{ $percent_participate }}" aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($percent_participate, 2) }} </div>
                    </div>
                    <p>Employés ayant soumis leurs évaluations.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-exclamation-circle-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Évaluations en retard</h5>
                        </div>
                    </div>
                    <h3 class="text-danger">{{ number_format($eval_late_percent, 2) }}%</h3>
                    <div class="progress my-3" style="height: 10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $eval_late_percent }}%;"
                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                            {{ $eval_late_percent }}
                        </div>
                    </div>
                    <p>Évaluations soumises après la date limite.</p>
                </div>
            </div>
        </div>

        {{-- <div class="row g-4 my-1">

            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-clock-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Délai moyen de remplissage</h5>
                        </div>
                    </div>
                    <h3 class="text-secondary">{{ $average_time_formatted }}</h3>
                    <p>Temps moyen pris pour remplir les évaluations.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-person-badge-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Évaluations par les managers</h5>
                        </div>
                    </div>
                    <h3 class="text-warning">75%</h3>
                    <div class="progress my-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p>Évaluations validées par les managers.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-emoji-smile-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Satisfaction des employés</h5>
                        </div>
                    </div>
                    <h3 class="text-info">90%</h3>
                    <div class="progress my-3" style="height: 10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 90%;" aria-valuenow="90"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p>Taux de satisfaction des employés.</p>
                </div>
            </div>
        </div> --}}

        <div class="row g-4 my-1">

            <!-- Card Template -->
            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-people-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Nombre d'évaluations à l'étape 1</h5>
                        </div>
                    </div>
                    <h3 class="text-primary"> {{ $participants_count }} </h3>
                    <p>Evaluations ayant atteint le niveau 1.</p>
                </div>
            </div>

            <!-- Card Template -->
            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-people-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Nombre d'évaluations à l'étape 2</h5>
                        </div>
                    </div>
                    <h3 class="text-primary"> {{ $eval_second_step }} </h3>
                    <p>Evaluations ayant atteint le niveau 2.</p>
                </div>
            </div>

            <!-- Card Template -->
            <div class="col-md-4">
                <div class="card p-4 text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <i class="bi bi-people-fill stat-icon"></i>
                        <div>
                            <h5 class="card-title">Nombre d'évaluations à l'étape 3</h5>
                        </div>
                    </div>
                    <h3 class="text-primary"> {{ $eval_third_step }} </h3>
                    <p>Evaluations ayant atteint le niveau 3.</p>
                </div>
            </div>

        </div>

    </div>

    <div class="my-1">

        <div class="d-flex justify-content-end">
            <div class="my-3" wire:loading.remove>
                <a wire:click.prevent="export()"
                    class="btn btn-primary btn-lg d-inline-flex align-items-center {{ $participants_count > 0 ? '' : 'disabled' }}">

                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    {{ __('Exporter') }} {{ $participants_count }}
                </a>
            </div>
            <div class="text-center mx-2" wire:loading wire:target="export">
                <div class="text-center">
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status">
                    </div>
                </div>
            </div>
        </div>
        @php
            use Carbon\Carbon;
        @endphp

        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Occupation</th>
                    <th>Site</th>
                    <th>Direction</th>
                    <th>Étape 1</th>
                    <th>Étape 2</th>
                    <th>Étape 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($responses as $evaluation)
                    <tr>
                        <td>{{ $evaluation->user->matricule }}</td>
                        <td>{{ $evaluation->user->name }}</td>
                        <td>{{ $evaluation->user->occupation }}</td>
                        <td>{{ $evaluation->user->site->name }}</td>
                        <td>{{ $evaluation->user->direction->name }}</td>

                        <!-- Étape 1: Conversion en Carbon pour formater la date -->
                        <td>
                            @if ($evaluation->is_send && $evaluation->date)
                                {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>

                        <!-- Étape 2: Conversion en Carbon pour formater la date -->
                        <td>
                            @if ($evaluation->is_n1 && $evaluation->date_n1)
                                {{ \Carbon\Carbon::parse($evaluation->date_n1)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>

                        <!-- Étape 3: Conversion en Carbon pour formater la date -->
                        <td>
                            @if ($evaluation->is_n2 && $evaluation->date_n2)
                                {{ \Carbon\Carbon::parse($evaluation->date_n2)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
