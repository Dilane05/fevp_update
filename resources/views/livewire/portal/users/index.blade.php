<div>
    @include('livewire.portal.users.partials.create-user')
    @include('livewire.portal.users.partials.create-contract')
    @include('livewire.portal.users.partials.edit-user')
    @include('livewire.portal.users.partials.import-users')
    @include('livewire.partials.delete-modal')
    <div class='p-0'>
        <div class="d-flex justify-content-between w-100 flex-wrap align-items-center">
            <div class="mb-lg-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/" wire:navigate>{{ __('Accueil') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Utilisateurs')}}</li>
                    </ol>
                </nav>
                <h1 class="h3 d-flex justify-content-start align-items-end">
                    <svg class="icon me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    {{__('Gestion des utlisateurs')}}
                </h1>
            </div>

            <div class="d-flex justify-content-between mb-2">
                @can('user-create')
                <a href="#" data-bs-toggle="modal" data-bs-target="#CreateUserModal" class="btn btn-sm btn-primary py-2 d-inline-flex align-items-center mx-2">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg> {{__('Nouveau')}}
                </a>
                @endcan
                @can('user-import')
                <a href="#" data-bs-toggle="modal" data-bs-target="#importUsersModal" class="btn btn-sm btn-tertiary py-2 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg> {{__('Importer')}}
                </a>
                @endcan
                @can('user-export')
                <div class="mx-2" wire:loading.remove>
                    <a wire:click="export()" class="btn btn-sm btn-gray-500  py-2 d-inline-flex align-items-center  {{count($users) > 0 ? '' :'disabled'}}">

                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        {{__('Exporter')}}
                    </a>
                </div>
                <div class="text-center mx-2" wire:loading wire:target="export">
                    <div class="text-center">
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    </div>
                </div>
                @endcan
            </div>

        </div>
    </div>

    <div class=''>
        <div class='row'>
            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-tertiary rounded me-2 me-sm-0">
                                    <svg class="icon icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <!-- <h2 class="fw-extrabold h5">{{__('Total Users')}}</h2> -->
                                    <h3 class="mb-1">{{numberFormat($users_count)}}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-8 px-xl-0">
                                <a href="#" class="d-none d-sm-block">
                                    <!-- <h2 class="h5">{{__('Total Users')}}</h2> -->
                                    <h3 class="fw-extrabold mb-1">{{numberFormat($users_count)}}</h3>
                                </a>
                                <div class="small d-flex mt-1">
                                    <div>{{ __('Tous les utlisateurs') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-success rounded me-2 me-sm-0">
                                    <svg class="icon icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <!-- <h2 class="fw-extrabold h5">{{ __('All Active Admin Users')}}</h2> -->
                                    <h3 class="mb-1">{{numberFormat($active_users)}}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-8 px-xl-0">
                                <a href="#" class="d-none d-sm-block">
                                    <!-- <h2 class="h5">{{ __('All Active Admin Users')}}</h2> -->
                                    <h3 class="fw-extrabold mb-1">{{numberFormat($active_users)}}</h3>
                                </a>
                                <div class="small d-flex mt-1">
                                    <div>{{ __('Tous les utilisateurs actifs')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-danger rounded me-2 me-sm-0">
                                    <svg class="icon icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <!-- <h2 class="fw-extrabold h5">{{ __('All banned Admin User') }}</h2> -->
                                    <h3 class="mb-1">{{numberFormat($inactive_users)}} </h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-8 px-xl-0">
                                <a href="#" class="d-none d-sm-block">
                                    <!-- <h2 class="h5">{{ __('All banned Admin Usesr') }}</h2> -->
                                    <h3 class="fw-extrabold mb-1">{{numberFormat($inactive_users)}} </h3>
                                </a>
                                <div class="small d-flex mt-1">
                                    <div>{{ __('Tous les utilisateurs Inactifs') }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-alert />

    <div class="row pt-2 pb-3">
        <div class="col-md-3">
            <label for="search">{{__('Recherche')}}: </label>
            <input wire:model.live="query" id="search" type="text" placeholder="{{__('Search...')}}" class="form-control">
            <p class="badge badge-info" wire:model.live="resultCount">{{$resultCount}}</p>
        </div>
        <div class="col-md-3">
            <label for="orderBy">{{__('Trier par')}}: </label>
            <select wire:model.live="orderBy" id="orderBy" class="form-select">
                <option value="first_name">{{__('Prénom')}}</option>
                <option value="last_name">{{__('Nom')}}</option>
                <option value="created_at">{{__('Date de création')}}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="direction">{{__('sens de tri')}}: </label>
            <select wire:model.live="orderAsc" id="direction" class="form-select">
                <option value="asc">{{__('Ascendnat')}}</option>
                <option value="desc">{{__('Descendant')}}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="perPage">{{__('Elements par page')}}: </label>
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
            <table class="table user-table table-hover table-bordered align-items-center " id="">
                <thead>
                    <tr>
                        <th class="border-bottom">{{__('Mat.')}}</th>
                        <th class="border-bottom">{{__('Utilisateurs')}}</th>
                        <th class="border-bottom">{{__('Contacts')}}</th>
                        <th class="border-bottom">{{__('Sexe')}}</th>
                        <th class="border-bottom">{{__('Role')}}</th>
                        <th class="border-bottom">{{__('Status')}}</th>
                        <th class="border-bottom">{{__('Date de création')}}</th>
                        @canany(['user-delete','user-update'])
                        <th class="border-bottom">{{__('Action')}}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <span class="fs-normal"> <span class="fw-bolder"> {{ $user->matricule }} </span><br>
                        </td>
                        <td>
                            <a href="#" class="d-flex align-items-center">
                                <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-success  me-2"><span class="text-dark">{{$user->initials}}</span></div>
                                <div class="d-block"><span class="fw-bolder fs-6">{{ucwords($user->name)}}</span>
                                    <div class="small text-gray">
                                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg> <span class="fw-bolder"> {{$user->occupation}} </span>
                                    </div>
                                    <div class="small text-gray d-flex align-items-end">
                                        <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg> {{$user->pemp_temp}} | {{$user->enterprise}}
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="fs-normal"> <span class="fw-bolder">{{__('Phone Number')}} : </span> <a href='tel:{{ $user->phone_number }}' target="_blank">{{ $user->phone_number }}</a></span><br>
                            <span class="fs-normal"> <span class="fw-bolder">{{__('Email')}} :</span> <a href='mailto:{{ $user->email }}' target="_blank">{{ $user->email }}</a></span>
                            @if($user->getRoleNames()->first() ==="expert")
                            @if($user->default_consultation_location || $user->default_consultation_meeting_link)
                            <hr class="p-0 my-2">
                            <span class="fs-normal"><span class="fw-bolder">{{__('Location')}} :</span> <a href='https://www.google.com/maps/place/{{ $user->default_consultation_location }}' target="_blank">{{ $user->default_consultation_location }}</a></span><br>
                            <span class="fs-normal"><span class="fw-bolder">{{__('Meeting Url')}} :</span> <a href='{{ $user->default_consultation_meeting_link }}' target="_blank">{{ $user->default_consultation_meeting_link }}</a></span>
                            @endif
                            @endif

                        </td>
                        <td>
                            <span class="fw-normal badge super-badge badge-lg bg-{{$user->gender_style}} rounded">{{$user->gender}}</span>
                        </td>
                        <td>
                            <span class="fw-normal badge super-badge badge-lg bg-{{$user->role_style}} rounded">{{$user->getRoleNames()->first()}}</span>
                        </td>
                        <td>
                            <span class="fw-normal badge super-badge badge-lg bg-{{$user->status_style}} rounded">{{$user->status_text}}</span>
                        </td>
                        <td>
                            <span class="fw-normal">{{$user->created_at->format('Y-m-d')}}</span>
                        </td>
                        @canany(['user-delete','user-update'])
                        <td>
                            @can('user-update')
                            <a href='#' data-bs-toggle="modal" data-bs-target="#CreateContractModal">
                                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </a>
                            <a href='#' wire:click.prevent="initData({{$user->id}})" data-bs-toggle="modal" data-bs-target="#EditUserModal">
                                <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            @endcan

                            @can('user-delete')
                            <a href='#' wire:click.prevent="initData({{$user->id}})" data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                <svg class="icon icon-xs text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </a>
                            @endcan
                        </td>
                        @endcanany
                    </tr>
                    @empty
                    <tr id="emptytr">
                        <td colspan="10">
                            <div class="text-center text-gray-800 mt-2">
                                <svg class="icon icon-xl text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h4 class="fs-5 fw-bold">{{__('No users')}} &#128540;</h4>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('livewire:navigated', function() {
            var country = document.getElementById('country');
            var state_option = document.getElementById('state_select');
            state_option.innerHTML = '<option value="" disabled selected>{{__("-- Select State --")}}</option>';
            var states_choices = new Choices(state_option)
            let options = {
                method: 'GET',
                headers: {}
            };
            country.addEventListener('change', function() {
                fetch('/api/countries?fields=phone_code,states&filters[iso2]=' + country.value, options)
                    .then(response => response.json())
                    .then(res => {
                        if (res.success) {
                            console.log(res.data[0].states);

                            states_choices.clearChoices()
                            states_choices.clearStore()

                            states_choices.setChoices(
                                res.data[0].states, 'id', 'name', false
                            )

                        }
                    })
            });
        });
    </script>

    @endpush
</div>
