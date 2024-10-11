<div>
    @include('livewire.portal.evaluation.response.print')
    <div class='p-0'>
        <div class="d-flex justify-content-between w-100 flex-wrap align-items-center">
            <div class="mb-lg-0">
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
                        <li class="breadcrumb-item"><a href="{{ route('portal.evaluation.index') }}"
                                wire:navigate>{{ __('Evaluation') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Réponse') }}</li>
                    </ol>
                </nav>
                <h1 class="h3 d-flex justify-content-start align-items-end">
                    <svg class="icon me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    {{ __('Réponse de L\'évaluation : ') }} {{ $evaluation->title }}
                </h1>
            </div>

        </div>
    </div>

    <x-alert />

    <div class="row pt-2 pb-3">
        <div class="col-md-3">
            <label for="search">{{ __('Search') }}: </label>
            <input wire:model.live="query" id="search" type="text" placeholder="{{ __('Search...') }}"
                class="form-control">
            <p class="badge badge-info" wire:model.live="resultCount">{{ $resultCount }}</p>
        </div>
        <div class="col-md-3">
            <label for="orderBy">{{ __('Order By') }}: </label>
            <select wire:model.live="orderBy" id="orderBy" class="form-select">
                {{-- <option value="first_name">{{ __('First Name') }}</option>
                <option value="last_name">{{ __('Last Name') }}</option> --}}
                <option value="status">{{ __('Status') }}</option>
                <option value="created_at">{{ __('Created Date') }}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="direction">{{ __('Order direction') }}: </label>
            <select wire:model.live="orderAsc" id="direction" class="form-select">
                <option value="asc">{{ __('Ascending') }}</option>
                <option value="desc">{{ __('Descending') }}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="perPage">{{ __('Items Per Page') }}: </label>
            <select wire:model.live="perPage" id="perPage" class="form-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div class="my-3" wire:loading.remove>
            <a data-bs-toggle="modal" data-bs-target="#printResponseModal"
                class="btn btn-primary btn-lg d-inline-flex align-items-center {{ $responses->count() > 0 ? '' : 'disabled' }}">

                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                {{ __('Imprimer Pdf') }} {{ $responses->count() }}
            </a>
        </div>
        {{-- <div class="text-center mx-2" wire:loading wire:target="export">
            <div class="text-center">
                <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status">
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">
        @forelse ($responses as $responseEvaluation)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <p class="card-text">
                            <span class="fw-bold">Matricule de l'évalué : </span>
                            <span class="text-muted">{{ $responseEvaluation->user->matricule }}</span>
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Nom de l'évalué : </span>
                            <span class="text-muted">{{ $responseEvaluation->user->name }}</span>
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Poste de l'évalué : </span>
                            <span class="text-muted">{{ $responseEvaluation->user->occupation }}</span>
                        </p>
                        <p class="card-text {{ $responseEvaluation->status && $responseEvaluation->is_send ? 'text-success' : 'text-muted' }}">
                            Statut : {{ $responseEvaluation->status ? 'Terminé' : 'Brouillon' }} |
                            Envoi : {{ $responseEvaluation->is_send ? 'Envoyé le ' . \Carbon\Carbon::parse($responseEvaluation->date)->translatedFormat('j F Y') : 'Non Envoyé' }}
                        </p>

                        @if (!$responseEvaluation->evaluation->is_active)
                            <div class="d-flex">
                                <button class="btn btn-secondary mx-1" disabled>Évaluation Clôturée</button>
                                <button class="btn btn-primary" wire:click="startEvaluation({{ $responseEvaluation->id }})">Voir les Détails</button>
                            </div>
                        @else
                            <a href="{{ route('portal.calibrage.index', $responseEvaluation->id) }}" class="btn btn-primary w-100">Calibrer</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    <h3>{{ __('Aucune Réponse Trouvée !!!') }}</h3>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-4 d-flex justify-content-center">
        {{-- {{ $evaluation->responses->links() }} --}}
    </div>


</div>
