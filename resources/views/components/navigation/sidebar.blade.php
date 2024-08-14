@inject('request', 'Illuminate\Http\Request')
<nav id="sidebarMenu" class="sidebar d-lg-block bg-primary text-white collapse" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: auto; overflow: auto;">
                    <div class="simplebar-content" style="padding: 0px;">
                        <div class="sidebar-inner px-4 pt-3">
                            <div class="user-card d-flex d-md-none justify-content-between justify-content-md-center pb-4">
                                @auth
                                <div class="d-flex align-items-center">
                                    <a class="d-flex align-items-center text-white  me-3" href="{{route('portal.profile-setting')}}" wire:nagivate>
                                        <svg class="icon icon-sm me-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{auth()->user()->first_name}}
                                    </a>
                                    <div class="d-block ">
                                        <a class="d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <svg class="icon icon-xs  text-danger " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf

                                        </form>

                                    </div>
                                </div>
                                @endauth
                                <div class="collapse-close d-md-none">
                                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex-row justify-content-center align-items-center text-center">
                                <div class="mb-0 ">
                                    <span class="ml-0">
                                        <!-- <span class="bg-success mb-1 px-2 rounded-1 text-primary display-4">{{ __('Admin') }}</span> -->
                                        {{-- <img src='/img/logo.jpeg' class="h-auto" style="width: 02em;" alt=''> --}}
                                        <span class="display-4 text-info fw-bolder"> {{ __('fevp')}}</span>
                                    </span>
                                    <!-- <span class="display-4">{{ __('Admin') }}</span></span> -->
                                    <!-- <img src="{{ asset('img/logo.png') }}" class="rounded" id="fullLogo" alt="SofiCam"> -->
                                    <!-- <img src="{{ asset('img/fav.jpeg') }}" class="rounded d-none" id="smallLogo" alt="SofiCam"> -->

                                </div>
                            </div>
                            <ul class="nav flex-column pt-md-0">
                                <!-- <li role="separator" class="dropdown-divider border-gray-600"></li> -->
                                <li class="nav-item mt-3 {{ $request->routeIs('portal.dashboard') ? 'active' : '' }}">
                                    <a href="{{route('portal.dashboard')}}" wire:navigate class="nav-link d-flex align-items-center justify-content-between">
                                        <span>
                                            <span class="sidebar-icon  text-gary-50">
                                                <svg class="icon icon-sm " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                                </svg>
                                            </span>
                                            <span class="sidebar-text">{{__('Tableau de bord')}}</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ $request->routeIs('portal.test.index') ? 'active' : '' }}">
                                    <a href="{{route('portal.test.index')}}" wire:navigate class="nav-link d-flex align-items-center justify-content-between">
                                        <span>
                                            <span class="sidebar-icon text-gray-50">
                                                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2a2 2 0 00-2 2H4a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2h-6a2 2 0 00-2-2zm0 2h8v14H4V6h8V4zm-1 7h2v5h-2v-5zm0-4h2v2h-2V7z"/>
                                                </svg>
                                            </span>
                                            <span class="sidebar-text">{{__('Fiche d\'évaluation')}}</span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{ $request->routeIs('portal.evaluation.*') ? 'active' : '' }}">
                                    <a href="{{route('portal.evaluation.create')}}" wire:navigate class="nav-link d-flex align-items-center justify-content-between">
                                        <span>
                                            <span class="sidebar-icon text-gray-50">
                                                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 1 0 0-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                                </svg>
                                            </span>
                                            <span class="sidebar-text">{{__('Création Évaluation')}}</span>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{ $request->routeIs('portal.indicator.index') ? 'active' : '' }}">
                                    <a href="{{route('portal.indicator.index')}}" wire:navigate class="nav-link d-flex align-items-center justify-content-between">
                                        <span>
                                            <span class="sidebar-icon text-gray-50">
                                                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11 2v4H3v14h18V6h-8V2h-2zm2 2v2h4V4h-4zm-6 6h2v6H7v-6zm4 0h2v6h-2v-6zm4 0h2v6h-2v-6z"/>
                                                </svg>
                                            </span>
                                            <span class="sidebar-text">{{__('Indicateur')}}</span>
                                        </span>
                                    </a>
                                </li>
                                @can('message-read')
                                <li class="nav-item  {{ $request->routeIs('portal.recommendations.messages.index') ? 'active' : '' }}">
                                    <a href="{{route('portal.recommendations.messages.index')}}" wire:navigate class="nav-link">
                                        <span class="sidebar-icon">
                                            <svg class="icon icon-sm " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                            </svg>

                                        </span>
                                        <span class="sidebar-text">{{__('Messages')}}</span>
                                    </a>
                                </li>
                                @endcan


                                <li role="separator" class="dropdown-divider mt-2 mb-2 border-gray-600"></li>

                                @can('user-read')
                                <li class="nav-item {{ $request->routeIs('portal.users.index') ? 'active' : '' }}">
                                    <a href="{{route('portal.users.index')}}" wire:navigate class="nav-link">
                                        <span class="sidebar-icon">
                                            <svg class="icon icon-sm " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                            </svg>
                                        </span>
                                        <span class="sidebar-text">{{__('Gestion utilisateurs')}}</span>
                                    </a>
                                </li>
                                @endcan

                                <li class="nav-item ">
                                    <a href="{{route('portal.auditlogs.index')}}" wire:navigate class="nav-link">
                                        <span class="sidebar-icon">
                                            <svg class="icon icon-sm " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z"></path>
                                            </svg>
                                        </span>
                                        <span class="sidebar-text">{{__('Roles & Permissions')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{route('portal.auditlogs.index')}}" wire:navigate class="nav-link">
                                        <span class="sidebar-icon">
                                            <svg class="icon icon-sm " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                        </span>
                                        <span class="sidebar-text">{{__('Parametres')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ $request->routeIs('portal.auditlogs.*') ? 'active' : '' }}">
                                    <a href="{{route('portal.auditlogs.index')}}" wire:navigate class="nav-link">
                                        <span class="sidebar-icon">
                                            <svg class="icon icon-sm " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </span>
                                        <span class="sidebar-text">{{__('Journaux D\'Audits')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
    </div>
</nav>
