<div>
    @include('livewire.portal.feedback.view-feedback')
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
                        <li class="breadcrumb-item"><a href="/" wire:navigate>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Client Feedback')}}</li>
                    </ol>
                </nav>
                <h1 class="h3 d-flex justify-content-start align-items-end">
                    <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>
                    {{__('Client Feedbacks')}}
                </h1>
            </div>
            <div>
                <div class="d-flex justify-content-between">
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-2 pb-3">
        <div class="col-md-3">
            <label for="search">{{__('Search')}}: </label>
            <input wire:model.live="query" id="search" type="text" placeholder="{{__('Search...')}}" class="form-control">
            <p class="badge badge-info" wire:model.live="resultCount">{{$resultCount}}</p>
        </div>
        <div class="col-md-3">
            <label for="orderBy">{{__('Order By')}}: </label>
            <select wire:model.live="orderBy" id="orderBy" class="form-select">
                <option value="client_id">{{__('Client')}}</option>
                <option value="created_at">{{__('Created Date')}}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="direction">{{__('Order direction')}}: </label>
            <select wire:model.live="orderAsc" id="direction" class="form-select">
                <option value="asc">{{__('Ascending')}}</option>
                <option value="desc">{{__('Descending')}}</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="perPage">{{__('Items Per Page')}}: </label>
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
        <div class="table-responsive text-gray-700">
            <table class="table employee-table table-hover align-items-center " id="">
                <thead>
                    <tr>
                        <th class="border-bottom">{{__('Client')}}</th>
                        <th class="border-bottom">{{__('Feedback')}}</th>
                        <th class="border-bottom">{{__('Date created')}}</th>
                        @canany(['survey-update','survey-delete'])
                        <th class="border-bottom">{{__('Action')}}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                    <tr>
                        <td>
                            <a href="#" class="d-flex align-items-center">
                                <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-success  me-2"><span class="text-dark">{{$feedback->client->initials}}</span></div>
                                <div class="d-block"><span class="fw-bolder fs-6">{{ucwords($feedback->client->name)}}</span>
                                    <div class="small text-gray d-flex align-items-bottom">
                                        <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg> {{$feedback->client->phone_number}} | {{$feedback->client->gender}}
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="fw-normal">{!! Str::limit($feedback->feedback, 100) !!}</span>
                        </td>
                        <td>
                            <span class="fw-normal">{{$feedback->created_at->format('Y-m-d')}}</span>
                        </td>
                        @canany(['survey-update','survey-delete'])
                        <td>
                            @can('survey-read')
                            <a href='#' wire:click.prevent="initData({{$feedback->id}})" data-bs-toggle="modal" data-bs-target="#ViewFeedbackModal">
                                <svg class="icon icon-xs" xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                            </a>
                            @endcan
                            @can('survey-delete')
                            <a href='#' wire:click.prevent="initData({{$feedback->id}})" data-bs-toggle="modal" data-bs-target="#DeleteModal">
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
                                <h4 class="fs-5 fw-bold">{{__('No Feedbacks')}} &#128540;</h4>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>