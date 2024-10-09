<div>

    @include('livewire.client.performance-contract.create')
    @include('livewire.client.performance-contract.edit')
    @include('livewire.partials.delete-client')

    <x-alert />

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
                <span class="fw-bold">Contrat de Performance </span>
            </li>
        </ol>
    </nav>

    <!-- Search and Pagination Controls -->
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Rechercher des myPerformances..."
                wire:model.live.debounce.300ms="search">
        </div>
        <div class="col-md-4">
            <select class="form-select" wire:model.live="perPage">
                <option value="5">5 par page</option>
                <option value="10">10 par page</option>
                <option value="25">25 par page</option>
                <option value="50">50 par page</option>
                <option value="10">100 par page</option>
                <option value="250">250 par page</option>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreatePerformanceContract">
                {{ __('Créer Un Nouveau Contrat') }} </button>
        </div>
    </div>

    <!-- Afficher les messages d'erreur -->
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="my-2">
                <h3 class="text-center">{{ __('Contrat de performances des n-1') }}</h3>

                <div class="shadow p-2 rounded bg-white">
                    <table class="table table-hover table-bordered table-striped text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Titre') }}</th>
                                <th>{{ __('Année') }}</th>
                                <th>{{ __('Employé') }}</th>
                                <th>{{ __('Créer le') }}</th>
                                {{-- <th>{{ __('Date de création') }}</th> --}}
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($performances as $performance)
                                <tr>
                                    <td>{{ $performance->code }}</td>
                                    <td>{{ $performance->title ?? '-' }}</td>
                                    <td>{{ $performance->year }}</td>
                                    <td>{{ $performance->user->name }}</td>
                                    {{-- <td>{{ $myPerformance->creator->name }}</td> --}}
                                    <td>{{ $performance->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <button wire:click="initData({{ $performance->id }})" data-bs-toggle="modal" data-bs-target="#EditPerformanceContract"
                                            class="btn btn-sm btn-info rounded-pill">
                                            <i class="fas fa-edit"></i> <!-- Icône pour modifier -->
                                        </button>
                                        <button wire:click="initData({{ $performance->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            class="btn btn-sm btn-danger rounded-pill">
                                            <i class="fas fa-trash-alt"></i> <!-- Icône pour supprimer -->
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        {{ __('Aucun tableau de bord trouvé') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                    <!-- Pagination Links -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $performances->links() }}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="my-2 me-4">
                <h3 class="text-center">{{ __('Mes Contrats de performances') }}</h3>

                <div class="shadow p-2 rounded bg-white">
                    <table class="table table-hover table-bordered table-striped text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Titre') }}</th>
                                <th>{{ __('Année') }}</th>
                                <th>{{ __('Date de création') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myPerformances as $myPerformance)
                                <tr>
                                    <td>{{ $myPerformance->code }}</td>
                                    <td>{{ $myPerformance->title ?? '-' }}</td>
                                    <td>{{ $myPerformance->year }}</td>
                                    <td>{{ $myPerformance->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        {{-- <a href="{{ route('client.myPerformances.find' , ['code' => $myPerformance->code]) }}" class="btn btn-sm btn-warning rounded-pill">
                                            <i class="fas fa-pen"></i> <!-- Icône pour saisir des informations -->
                                        </a> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        {{ __('Aucun tableau de bord trouvé') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                    <!-- Pagination Links -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $myPerformances->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
