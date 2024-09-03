<div>

    <nav aria-label="breadcrumb" class="py-3">
        <ol class="breadcrumb bg-white px-3 py-2 rounded-pill shadow-lg">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary d-flex align-items-center">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="fw-semibold">Accueil</span>
                </a>
            </li>
            <li class="breadcrumb-item active text-primary d-flex align-items-center" aria-current="page">
                <i class="bi bi-journal-text me-2"></i>
                <span class="fw-bold">Évaluations</span>
            </li>
        </ol>
    </nav>

    <!-- Search and Pagination Controls -->
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Rechercher des évaluations..."
                wire:model.live.debounce.300ms="search">
        </div>
        <div class="col-md-2">
            <select class="form-select" wire:model.live="perPage">
                <option value="5">5 par page</option>
                <option value="10">10 par page</option>
                <option value="25">25 par page</option>
                <option value="50">50 par page</option>
                <option value="10">100 par page</option>
                <option value="250">250 par page</option>
            </select>
        </div>
    </div>

    <!-- Afficher les messages d'erreur -->
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($responseEvaluations as $responseEvaluation)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm rounded overflow-hidden">
                        <img src="https://via.placeholder.com/600x200" class="card-img-top" alt="Evaluation Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $responseEvaluation->evaluation->title }} : <span
                                    class="fw-bold">{{ $responseEvaluation->evaluation->code }}</span> </h5>
                            <p class="card-text text-muted">
                                {{ $responseEvaluation->user->name }} | {{ $responseEvaluation->date }}
                            </p>
                            <p class="card-text text-muted">
                                {{ $responseEvaluation->status ? 'Terminer' : 'Brouillon' }} |
                                {{ $responseEvaluation->is_send ? 'Envoyé' : 'Non Envoyé' }}
                            </p>

                            {{-- <p class="text-muted">Du {{ $evaluation->start_date->format('d M Y') }} au
                                {{ $evaluation->end_date->format('d M Y') }}</p> --}}
                            @if (!$responseEvaluation->evaluation->is_active)
                                <div class="d-flex">
                                    <button class="btn btn-secondary mx-1" disabled>Évaluation Clôturée</button>
                                    <button class="btn btn-primary"
                                        wire:click="startEvaluation({{ $responseEvaluation->id }})">Voir les
                                        Détails</button>
                                @else
                                    <button wire:click="startEvaluation({{ $responseEvaluation->id }})"
                                        class="btn btn-primary w-100"> Evaluer </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $responseEvaluations->links() }}
    </div>

    @if (request()->is('my/evaluations'))
        <style>
            .card {
                border-radius: 15px;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            }

            .btn-primary {
                background-color: #7c83fd;
                border: none;
                border-radius: 25px;
                padding: 12px;
                transition: background-color 0.3s, transform 0.2s;
            }

            .btn-primary:hover {
                background-color: #6a73d4;
                transform: scale(1.05);
            }

            .btn-secondary {
                background-color: #e0e0e0;
                border: none;
                color: #6c757d;
                border-radius: 25px;
                padding: 12px;
            }

            .btn-secondary:disabled {
                cursor: not-allowed;
                opacity: 0.6;
            }

            .alert {
                border-radius: 10px;
                background-color: #f8d7da;
                color: #721c24;
            }

            .alert .btn-close {
                filter: invert(0.5);
            }
        </style>
    @endif
</div>
