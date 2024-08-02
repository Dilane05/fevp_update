<div>
    @include('livewire.client.complaints.partials.view-complaint-modal')
    @include('livewire.client.complaints.partials.view-recommendation-modal')
    @include('livewire.partials.delete-modal')
    <div class='container pt-3 pt-lg-4 pb-2 pb-lg-2 text-white'>
        <div class='d-flex flex-wrap align-items-center  justify-content-between '>
            <div class="d-flex justify-content-start align-items-center gap-3">
                <a href="{{route('client.dashboard')}}" wire:navigate class="">
                    <svg class="icon me-1 text-gray-500 bg-gray-300 rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div class='fw-bold display-5 text-gray-600'>{{__('Hi')}}, {{auth()->user()->first_name}}</div>
            </div>
            <div>
                <x-navigation.client-nav />
            </div>
        </div>
        <div class='d-flex flex-wrap justify-content-between align-items-center pt-1'>
            <div class=''>
                <h1 class='fw-bold display-5 text-gray-600 d-inline-flex align-items-start'>
                    <svg class="icon icon-md me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>

                    <span>
                        {{__('My complaints')}}
                    </span>
                </h1>
                <p class="text-gray-800  px-5 mt-n5 pt-3 mx-1">{{__('View all my complaints')}} &#129297; </p>
            </div>
            <div class=''>

            </div>
        </div>
        <div class=' mt-1'>
            <div class='row'>
                <div class='col-md-4 col-sm-12'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex  justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon me-1 text-gray-50 bg-success shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($complaints_count)}} {{ __(\Str::plural('Consultation', $complaints_count)) }} </h5>
                                    <div class=" text-gray-500 ">{{__('all complaints!')}} &#128516;</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-12 mt-3 mt-md-0'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex  justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon icon-md me-1 text-gray-50 bg-warning shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($paid_complaints)}} {{ __(\Str::plural('Paid', $paid_complaints)) }} </h5>
                                    <div class=" text-gray-500 ">{{__('paid complaints!')}} &#128516;</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-12 mt-3 mt-md-0'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex  justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon icon-md me-1 text-gray-50 bg-danger shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($pending_complaints)}} {{ __(\Str::plural('Pending', $pending_complaints)) }}</h5>
                                    <div class="text-gray-500 ">{{__('pending payments!')}} &#128560;</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4 pb-2 text-gray-600 ">
            <div class="col-md-3">
                <label for="search">{{__('Search')}}: </label>
                <input wire:model.live="query" id="search" type="text" placeholder="{{__('Search...')}}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="orderBy">{{__('Order By')}}: </label>
                <select wire:model.live="orderBy" id="orderBy" class="form-select">
                    <option value="client_id">{{__('Client')}}</option>
                    <option value="last_name">{{__('Last Name')}}</option>
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
        <x-alert />

        @if(count($complaints) > 0)
        <div class="card">
            <div class="table-responsive text-gray-700">
                <table class="table employee-table table-hover table-bordered align-items-center ">
                    <thead>
                        <tr>
                            <th class="border-bottom">{{__('Expert')}}</th>
                            <th class="border-bottom">{{__('Schedule/Payment Details')}}</th>
                            <th class="border-bottom">{{__('Complaint')}}</th>
                            <th class="border-bottom">{{__('Complaint Status')}}</th>
                            <th class="border-bottom">{{__('Date created')}}</th>
                            @canany(['complaint-delete','complaint-update'])
                            <th class="border-bottom">{{__('Action')}}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                        <tr>
                            <td>
                                <!-- <h6>{{__('Expert Details')}}</h6> -->
                                <a href="#" class="d-flex align-items-center">
                                    <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-primary text-white  me-2"><span class="text-dark">{{$complaint->expert->initials}}</span></div>
                                    <div class="d-block"><span class="fw-bolder fs-6">{{ucwords($complaint->expert->name)}}</span>
                                        <div class="small text-gray d-flex align-items-bottom">
                                            <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg> {{$complaint->expert->phone_number}} | {{$complaint->expert->gender}}
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Date')}}</span> : {{$complaint->consultation->date->format('y-m-d')}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Start time')}}</span> : {{$complaint->consultation->start_time->format('H:i')}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('End time')}}</span> : {{$complaint->consultation->end_time->format('H:i')}}</span><br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Duration')}}</span> : {{!empty($complaint->consultation) ? $complaint->consultation->duration : ''}} {{__('Minutes')}}</span>
                                <hr class="my-1 p-0">
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Type')}}</span> : {{!empty($complaint->consultation) ? $complaint->consultation->consultation_option : ''}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Location')}}</span> :
                                    @if($complaint->consultation->consultation_option === 'online')
                                    <a href='{{$complaint->consultation_location_or_online_details}}' target="_blank" class="text-info"> {{__('Link')}}</a>
                                    @else {{$complaint->consultation->consultation_location_or_online_details}}
                                    @endif
                                </span> <br>
                                <hr class="my-2">
                                <!-- <h6>{{__('Payment Details')}}</h6> -->
                                <span class="fw-normal"> <span class="fw-bolder">{{__('P. Method')}}</span> : {{$complaint->consultation->payment_method}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('P. Number')}}</span> : {{$complaint->consultation->payment_number}}</span> <br>
                                <span class="fw-normal d-flex gap-1 ">
                                    <span class="fw-bolder">{{__('P. Status')}}</span> :
                                    <span class="fw-normal badge super-badge badge-lg bg-{{$complaint->consultation->payment_status_style}} rounded-1 align-items-end">{{$complaint->consultation->payment_status_text}}</span>
                                </span>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('P. Date')}}</span> : {{$complaint->consultation->payment_date}}</span> <br>
                            </td>
                            <td class="text-wrap" style="width: 30rem;">
                                <span style="word-wrap: break-word; ">{!! \Str::limit($complaint->complaint_description, 150) !!}</span>
                            </td>
                            <td>
                                <span class="fw-normal badge super-badge badge-lg bg-{{$complaint->complaint_status_style}} rounded-1 align-items-end">{{$complaint->complaint_status_text}}</span>
                            </td>
                            <td>
                                <span class="fw-normal">{{$complaint->created_at->diffForHumans()}}</span>
                            </td>

                            @canany(['complaint-read','complaint-update','complaint-delete'])
                            <td>
                                <div class="d-inline-flex align-items-center gap-1">
                                    @can('complaint-read')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('View Compliant Details')}}">
                                        <a href='#' wire:click.prevent="initData({{$complaint->id}})" data-bs-toggle="modal" data-bs-target="#ViewComplaintModal" data-bs-placement="bottom" title="{{__('View Compliant Details')}}">
                                            <svg class="icon icon-xs text-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </div>
                                    @endcan
                                    @if($complaint->recommendation)
                                    @can('recommendation-read')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('View Recommendations')}}">
                                        <a href='#' wire:click.prevent="initData({{$complaint->id}})" data-bs-toggle="modal" data-bs-target="#ViewRecommendationModal">
                                            <svg class="icon icon-xs text-info" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                            </svg>
                                        </a>
                                    </div>
                                    @endcan
                                    @endif
                                    @can('complaint-update')
                                    <a href="{{route('portal.complaints.edit',['complaint_uuid' => $complaint->uuid])}}" wire:navigate>
                                        <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('complaint-delete')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('Delete Complaint')}}">
                                        <a href='#' wire:click.prevent="initData({{$complaint->id}})" data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                            <svg class="icon icon-xs text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    @endcan
                                </div>
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
                                    <h4 class="fs-5 fw-bold">{{__('No complaints')}} &#128540;</h4>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $complaints->links() }}
            </div>
        </div>
        @else
        <div class='border-prim rounded p-4 d-flex justify-content-center align-items-center flex-column'>
            <img src="{{asset('/img/empty.svg')}}" alt='{{__("Empty")}}' class="text-center  w-25 h-25">
            <div class="text-center text-gray-800 mt-2">
                <h4 class="fs-4 fw-bold">{{__('Opps nothing here')}} &#128540;</h4>
                <p>{{__('No complaints found!')}}</p>
            </div>
        </div>
        @endif
    </div>
</div>