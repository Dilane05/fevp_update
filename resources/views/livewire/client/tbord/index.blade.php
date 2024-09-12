<div>

    @include('livewire.client.tbord.create')
    @include('livewire.client.tbord.edit')
    @include('livewire.client.tbord.delete')

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
                <span class="fw-bold">Tbord </span>
            </li>
        </ol>
    </nav>

    <!-- Search and Pagination Controls -->
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Rechercher des Tbords..."
                wire:model.live.debounce.300ms="search">
        </div>
        <div class="col-md-3">
            <select class="form-select" wire:model.live="perPage">
                <option value="5">5 par page</option>
                <option value="10">10 par page</option>
                <option value="25">25 par page</option>
                <option value="50">50 par page</option>
                <option value="10">100 par page</option>
                <option value="250">250 par page</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateTbordModal">
                {{ __('Créer Un Nouveau Tbord') }} </button>
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
                <h2 class="text-center">{{ __('Tbords des employés n-1') }}</h2>

                <div class="shadow p-2 rounded bg-white">
                    <table class="table table-hover table-bordered table-striped text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Titre') }}</th>
                                <th>{{ __('Année') }}</th>
                                <th>{{ __('Employé') }}</th>
                                <th>{{ __('Créer par') }}</th>
                                {{-- <th>{{ __('Date de création') }}</th> --}}
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tbords as $tbord)
                                <tr>
                                    <td>{{ $tbord->code }}</td>
                                    <td>{{ $tbord->title ?? '-' }}</td>
                                    <td>{{ $tbord->year }}</td>
                                    <td>{{ $tbord->user->name }}</td>
                                    {{-- <td>{{ $tbord->creator->name }}</td> --}}
                                    <td>{{ $tbord->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <button wire:click="initData({{ $tbord->id }})" data-bs-toggle="modal" data-bs-target="#EditTbordModal"
                                            class="btn btn-sm btn-info rounded-pill">
                                            <i class="fas fa-edit"></i> <!-- Icône pour modifier -->
                                        </button>
                                        <button wire:click="initData({{ $tbord->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
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
                        {{ $tbords->links() }}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="my-2 me-4">
                <h2 class="text-center">{{ __('Mes Tbords') }}</h2>

                <div class="shadow p-2 rounded bg-white">
                    <table class="table table-hover table-bordered table-striped text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Titre') }}</th>
                                <th>{{ __('Année') }}</th>
                                {{-- <th>{{ __('Employé') }}</th> --}}
                                {{-- <th>{{ __('Créer par') }}</th> --}}
                                <th>{{ __('Date de création') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myTbords as $tbord)
                                <tr>
                                    <td>{{ $tbord->code }}</td>
                                    <td>{{ $tbord->title ?? '-' }}</td>
                                    <td>{{ $tbord->year }}</td>
                                    {{-- <td>{{ $tbord->user->name }}</td> --}}
                                    {{-- <td>{{ $tbord->creator->name }}</td> --}}
                                    <td>{{ $tbord->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('client.tbords.find' , ['code' => $tbord->code]) }}" class="btn btn-sm btn-warning rounded-pill">
                                            <i class="fas fa-pen"></i> <!-- Icône pour saisir des informations -->
                                        </a>
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
                        {{ $tbords->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
