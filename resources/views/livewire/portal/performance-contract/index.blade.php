<div>
    @include('livewire.portal.performance-contract.create')
    @include('livewire.portal.performance-contract.edit')
    @include('livewire.partials.delete-modal')
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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Contrat de Performance') }}</li>
                    </ol>
                </nav>
                <h1 class="h3 d-flex justify-content-start align-items-end">
                    <svg class="icon me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    {{ __('Gestion des Contrats de Performance') }}
                </h1>
            </div>

            <div class="d-flex justify-content-between mb-2">
                {{-- @can('') --}}
                <a href="#" data-bs-toggle="modal" data-bs-target="#CreateContractModal"
                    class="btn btn-sm btn-primary py-2 d-inline-flex align-items-center mx-2">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg> {{ __('Nouveau') }}
                </a>
                {{-- @endcan --}}
                {{-- @can('client-import') --}}
                <a href="#" data-bs-toggle="modal" data-bs-target="#importContractodal"
                    class="btn btn-sm btn-tertiary py-2 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg> {{ __('Importer') }}
                </a>
                {{-- @endcan --}}
                @can('client-export')
                    <div class="mx-2" wire:loading.remove>
                        <a wire:click="export()"
                            class="btn btn-sm btn-gray-500  py-2 d-inline-flex align-items-center  {{ count($contracts) > 0 ? '' : 'disabled' }}">

                            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            {{ __('Exporter') }}
                        </a>
                    </div>
                    <div class="text-center mx-2" wire:loading wire:target="export">
                        <div class="text-center">
                            <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status">
                            </div>
                            <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status">
                            </div>
                            <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status">
                            </div>
                            <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status">
                            </div>
                        </div>
                    </div>
                @endcan
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
                <option value="first_name">{{ __('First Name') }}</option>
                <option value="last_name">{{ __('Last Name') }}</option>
                <option value="created_at">{{ __('Created Date') }}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="direction">{{ __('Order direction') }}: </label>
            <select wire:model.live="orderAsc" id="direction" class="form-select">
                <option value="asc">{{ __('Ascendant') }}</option>
                <option value="desc">{{ __('Descendant') }}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="perPage">{{ __('Elements par Page') }}: </label>
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
    <div class="card">
        <div class="table-responsive  text-gray-700">
            @php
                use Carbon\Carbon;
            @endphp

            <table class="table client-table table-hover table-bordered align-items-center">
                <thead>
                    <tr>
                        <th class="border-bottom">{{ __('Code') }}</th>
                        <th class="border-bottom">{{ __('Titre') }}</th>
                        <th class="border-bottom">{{ __('Année') }}</th>
                        <th class="border-bottom">{{ __('Employé') }}</th>
                        <th class="border-bottom">{{ __('Créer Par') }}</th>
                        <th class="border-bottom text-end">{{ __('Date Création') }}</th>\
                        <th class="border-bottom text-center">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contracts as $contract)
                        <tr>
                            <td>{{ $contract->code }}</td>
                            <td>{{ $contract->title }}</td>
                            <td>
                                {{ $contract->created_at? Carbon::parse($contract->date)->locale('fr')->isoFormat('LL'): '' }}
                            </td>
                            <td>
                                {{ $contract->user->name }}
                            </td>
                            <td>{{ $contract->creator->name }}</td>
                            <td class="text-end">
                                {{ $contract->created_at? Carbon::parse($contract->created_at)->locale('fr')->isoFormat('LL'): '' }}
                            </td>
                            {{-- @canany(['client-delete', 'client-update']) --}}
                            <td class="text-center">
                                {{-- @can('client-update') --}}
                                <a href='#' wire:click.prevent="initData({{ $contract->id }})"
                                    data-bs-toggle="modal" data-bs-target="#EditPerformanceContract">
                                    <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                {{-- @can('client-delete') --}}
                                <a href='#' wire:click.prevent="initData({{ $contract->id }})"
                                    data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                    <svg class="icon icon-xs text-danger" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </a>
                                {{-- @endcan --}}
                            </td>
                            {{-- @endcanany --}}
                        </tr>
                    @empty
                        <tr id="emptytr">
                            <td colspan="17">
                                <div class="text-center text-gray-800 mt-2">
                                    <svg class="icon icon-xl text-gray-400 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h4 class="fs-5 fw-bold">{{ __('Aucun Contrat de performance') }} &#128540;</h4>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $contracts->links() }}
        </div>
    </div>
    @push('scripts')
    @endpush
</div>
