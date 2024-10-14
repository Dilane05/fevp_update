<div class="container-fluid">

    <nav aria-label="breadcrumb" class="py-3">
        <ol class="breadcrumb bg-white px-3 py-2 rounded-pill shadow-lg">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary d-flex align-items-center">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="fw-semibold">Accueil</span>
                </a>
            </li>
            <li class="breadcrumb-item active text-primary d-flex align-items-center" aria-current="page">
                <i class="bi bi-bar-chart-fill me-2"></i>
                <span class="fw-bold">Tableau de Bord</span>
            </li>
        </ol>
    </nav>

    <!-- Afficher les messages d'erreur -->
    <x-alert />

    {{-- !-- Bootstrap Modal --> --}}
    <div class="modal fade" id="evaluationReminderModal" tabindex="-1" aria-labelledby="reminderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="reminderModalLabel">Reminder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="p-4">
                        <i class="bi bi-exclamation-triangle-fill text-warning display-1 mb-3"></i>
                        <p class="fs-5">Il semble que vous n'avez pas encore commencé votre évaluation en cours. Nous
                            vous invitons à compléter votre évaluation pour nous aider à améliorer nos services.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <a href="#" wire:click="startEvaluation({{ $evaluation->id }})" class="btn btn-primary w-100"
                        data-bs-dismiss="modal">Commencer
                        l'Évaluation</a>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}

    <div class="row">
        <!-- Welcome Column -->
        <div class="col-md-6 mb-4">
            <div class="d-flex flex-column justify-content-center h-100">
                <h3 class="text-primary display-6 fw-bold mb-3" data-translate="greeting">
                    👋 Bienvenue sur FEVP, {{ auth()->user()->name }}!
                </h3>
                <p class="lead text-muted mb-4" data-translate="description" style="font-size: 1rem; line-height: 1.6;">
                    Chers Cadystien(e), nous sommes ravis de vous accueillir sur <strong>FEVP</strong>, notre nouvelle
                    plateforme dédiée à la gestion des évaluations des employés. Cette solution innovante simplifie le
                    suivi des évaluations, facilite l'accès aux informations essentielles, et optimise nos processus de
                    feedback. Explorez ses fonctionnalités pour tirer pleinement parti de cette nouvelle ère
                    d'évaluation au sein de notre entreprise.
                </p>
                @if ($evaluation)

                    @if (!$evaluation->is_active)
                        <div class="d-flex">
                            <button class="btn btn-secondary mx-1" disabled>Évaluation Clôturée</button>
                            <button class="btn btn-primary" wire:click="startEvaluation({{ $evaluation->id }})">Voir les
                                Détails
                            </button>
                        </div>
                    @else
                        @if ($evaluation->participants()->where('user_id', Auth::id())->exists())
                            @php
                                $response = App\Models\ResponseEvaluation::where('evaluation_id', $evaluation->id)
                                    ->where('user_id', Auth::id())
                                    ->first();
                            @endphp
                            @if ($response && !now()->lt($evaluation->start_date))
                                <button wire:click="startEvaluation({{ $evaluation->id }})"
                                    class="btn btn-primary w-100">Continuer l'évaluation</button>
                            @elseif (!now()->lt($evaluation->start_date))
                                <button wire:click="startEvaluation({{ $evaluation->id }})"
                                    class="btn btn-primary w-100">Commencer l'évaluation</button>
                            @else
                                <button class="btn btn-secondary w-100" disabled>Veuillez atendre la date de
                                    lancement</button>
                            @endif
                        @else
                            <button class="btn btn-secondary w-100" disabled>Pas autorisé à participer à la dernière
                                évaluation : {{ $evaluation->title }}</button>
                        @endif
                    @endif
                @endif
            </div>
        </div>

        <!-- User Information Column -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">
                        Informations Personnelles
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-person-circle text-primary me-2"></i>
                            <span class="fw-bold">Nom complet :</span>
                            <span class="ms-2">{{ auth()->user()->name }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-card-list text-info me-2"></i>
                            <span class="fw-bold">Matricule :</span>
                            <span class="ms-2">{{ auth()->user()->matricule }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-briefcase text-success me-2"></i>
                            <span class="fw-bold">Poste :</span>
                            <span class="ms-2">{{ auth()->user()->occupation }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-award text-warning me-2"></i>
                            <span class="fw-bold">Statut Catégoriel :</span>
                            <span
                                class="ms-2">{{ auth()->user()->statut_category ? auth()->user()->statut_category : 'Non Attribué' }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-clock text-danger me-2"></i>
                            <span class="fw-bold">Ancienneté au poste :</span>
                            <span
                                class="ms-2">{{ auth()->user()->length_of_service ? auth()->user()->length_of_service : 'Non Connu' }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-check2-circle text-secondary me-2"></i>
                            <span class="fw-bold">Temporaire/Permanent :</span>
                            <span
                                class="ms-2">{{ auth()->user()->pemp_temp ? auth()->user()->pemp_temp : '' }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-calendar-date text-muted me-2"></i>
                            <span class="fw-bold">Date d'embauche :</span>
                            <span class="ms-2">{{ auth()->user()->hiring_date }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-person-badge text-dark me-2"></i>
                            <span class="fw-bold">Responsable N1 :</span>
                            <span
                                class="ms-2">{{ auth()->user()->responsable_n1 ? auth()->user()->responsableN1->name : 'Non attribué' }}</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="bi bi-person-badge-fill text-primary me-2"></i>
                            <span class="fw-bold">Responsable N2 :</span>
                            <span
                                class="ms-2">{{ auth()->user()->responsable_n2 ? auth()->user()->responsableN2->name : 'Non attribué' }}</span>
                        </li>
                    </ul>
                    <hr class="my-3">
                    <p class="text-muted">
                        <i class="bi bi-building text-success me-2"></i>
                        <span class="fw-bold">Entreprise :</span> {{ auth()->user()->enterprise->name }} |
                        <span class="fw-bold">Direction :</span> {{ auth()->user()->direction->name }} |
                        <span class="fw-bold">Site :</span> {{ auth()->user()->site->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($evaluation)
        <div class="row mb-5">
            <div class="col-12">
                <div class="border-bottom border-secondary pb-5 shadow py-4 bg-light rounded-3">
                    <div class="row">
                        <!-- Image de l'évaluation -->
                        <div class="col-md-6 mb-4 mb-md-0">
                            <a href="#" class="text-decoration-none">
                                <img class="img-fluid rounded img-star" src="{{ asset('img/evaluation.jpg') }}"
                                    alt="{{ $evaluation->title }}">
                            </a>
                        </div>

                        <!-- Détails de l'évaluation -->
                        <div class="col-md-6">
                            <h3 class="mb-2 text-dark">{{ $evaluation->title }}</h3>
                            <p class="card-text my-2 text-secondary">
                                {{ \Illuminate\Support\Str::limit($evaluation->description, 520) }}
                            </p>
                            <p class="text-dark mb-2">
                                <span>
                                    Lancement Le:
                                    <strong>{{ \Carbon\Carbon::parse($evaluation->start_date)->format('d/m/Y') }}</strong>
                                </span>
                                <span>
                                    et Fin Le:
                                    <strong>{{ \Carbon\Carbon::parse($evaluation->end_date)->format('d/m/Y') }}</strong>
                                </span>
                            </p>

                            <!-- Message de lancement et compte à rebours -->
                            <div id="countdown-message" class="alert alert-info mb-4">
                                <h4 class="alert-heading">Compte à rebours</h4>
                                <p id="countdown-message-text">Le lancement officiel de l'évaluation est prévu dans :
                                </p>
                            </div>

                            <div id="countdown" class="d-flex justify-content-start mt-3">
                                <div class="countdown-block me-2">
                                    <span id="days" class="countdown-time"></span>
                                    <div class="countdown-label">Jours</div>
                                </div>
                                <div class="countdown-block me-2">
                                    <span id="hours" class="countdown-time"></span>
                                    <div class="countdown-label">Heures</div>
                                </div>
                                <div class="countdown-block me-2">
                                    <span id="minutes" class="countdown-time"></span>
                                    <div class="countdown-label">Minutes</div>
                                </div>
                                <div class="countdown-block me-2">
                                    <span id="seconds" class="countdown-time"></span>
                                    <div class="countdown-label">Secondes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (request()->is('my/dashboard'))
        <style>
            .event-card {
                border: none;
                border-radius: 8px;
                overflow: hidden;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .event-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            .event-card .card-img-top {
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
                transition: transform 0.3s;
                height: 15em;
            }

            .img-star {
                width: 100%;
                height: 21em;
            }

            .event-card:hover .card-img-top {
                transform: scale(1.1);
            }

            .card-title {
                font-size: 1.25rem;
                font-weight: 600;
            }

            .card-subtitle {
                font-size: 1rem;
                color: #6c757d;
            }

            .card-text {
                font-size: 0.875rem;
                color: #6c757d;
            }

            .shadow-sm {
                box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            }

            .text-decoration-none {
                text-decoration: none;
            }

            .countdown-block {
                text-align: center;
                padding: 15px;
                border: 2px solid #007bff;
                border-radius: 8px;
                min-width: 50px;
                background-color: #f8f9fa;
                box-shadow: 0 0 15px rgba(0, 123, 255, 0.3);
                transition: all 0.3s ease;
            }

            .countdown-time {
                font-size: 32px;
                font-weight: bold;
                color: #007bff;
                display: block;
                margin-bottom: 5px;
            }

            .countdown-label {
                font-size: 14px;
                color: #007bff;
            }

            .countdown-block:hover {
                transform: scale(1.05);
                box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
            }
        </style>

        <style>
            .modal-content {
                border-radius: 15px;
                background-color: #f8f9fa;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .modal-title {
                color: #495057;
                font-weight: bold;
            }

            .btn-primary {
                background-color: #7c83fd;
                border: none;
                border-radius: 20px;
                padding: 10px;
                transition: background-color 0.3s;
            }

            .btn-primary:hover {
                background-color: #6a73d4;
            }

            .bi-exclamation-triangle-fill {
                color: #ffc107;
            }

            .modal-footer {
                border-top: none;
            }

            .card {
                border-radius: 10px;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .btn-primary {
                background-color: #7c83fd;
                border: none;
                border-radius: 20px;
                padding: 10px;
                transition: background-color 0.3s;
            }

            .btn-primary:hover {
                background-color: #6a73d4;
            }
        </style>

        @if ($evaluation)
            <script>
                // Set the start and end dates
                var startDate = new Date("{{ \Carbon\Carbon::parse($evaluation->start_date)->format('Y-m-d H:i:s') }}").getTime();
                var endDate = new Date("{{ \Carbon\Carbon::parse($evaluation->end_date)->format('Y-m-d H:i:s') }}").getTime();

                function updateCountdown() {
                    // Get today's date and time
                    var now = new Date().getTime();
                    var distance;

                    // Determine which countdown to show
                    if (now < startDate) {
                        distance = startDate - now;
                        document.getElementById("countdown-message-text").innerHTML =
                            "Le lancement officiel de l'évaluation est prévu dans :";
                    } else if (now < endDate) {
                        distance = endDate - now;
                        document.getElementById("countdown-message-text").innerHTML =
                            "Le temps restant avant la fin de l'évaluation est :";
                    } else {
                        document.getElementById("countdown").innerHTML = "L'évaluation est terminée!";
                        return; // Stop the countdown
                    }

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the elements with corresponding IDs
                    document.getElementById("days").innerHTML = days;
                    document.getElementById("hours").innerHTML = hours;
                    document.getElementById("minutes").innerHTML = minutes;
                    document.getElementById("seconds").innerHTML = seconds;
                }

                // Update the count down every 1 second
                var countdownFunction = setInterval(updateCountdown, 1000);
            </script>
        @endif


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.addEventListener('show-evaluation-reminder', event => {
                    var evaluationReminderModal = new bootstrap.Modal(document.getElementById(
                        'evaluationReminderModal'));
                    evaluationReminderModal.show();
                });
            });
        </script>

        <script>
            document.addEventListener('livewire:load', function() {
                var searchInput = document.getElementById('searchInput');

                searchInput.addEventListener('input', function() {
                    Livewire.emit('searchUpdated', searchInput.value);
                });
            });
        </script>
    @endif
</div>
