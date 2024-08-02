<div>
    @include('livewire.client.consultations.partials.make-payment-modal')
    @include('livewire.client.consultations.partials.view-consultation-modal')
    @include('livewire.partials.delete-modal')
    <div class='container pt-3 pt-lg-4 pb-4 pb-lg-3 text-white'>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>

                    <span>
                        {{__('My Consultations')}}
                    </span>
                </h1>
                <p class="text-gray-800 px-5 mt-n5 pt-3 mx-1">{{__('View all my consultations')}} &#129297; </p>
            </div>
            <div class=''>
                @if(auth()->user()->consultations)
                <a href="{{route('client.consultations.make-edit-follow-up',['consultation_uuid' => ''])}}" wire:navigate class="btn btn-sm btn-success mr-lg-2 ">
                    <svg class="icon icon-sm me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    {{__('Create Consultation')}}
                </a>
                @else
                <a href="{{route('client.consultations.index')}}" wire:navigate class="btn btn-sm btn-success mr-lg-2 ">
                    <svg class="icon icon-sm me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    {{__('Consultations')}}
                </a>
                @endif
            </div>
        </div>
        <div class='mt-2'>
            <div class='row'>
                <div class='col-md-4 col-sm-12'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex  justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon me-1 text-gray-50 bg-success shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($consultations_count)}} {{ __(\Str::plural('Consultation', $consultations_count)) }} </h5>
                                    <div class=" text-gray-500 ">{{__('all consultations!')}} &#128516;</div>
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
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($paid_consultations)}} {{ __(\Str::plural('Paid', $paid_consultations)) }} </h5>
                                    <div class=" text-gray-500 ">{{__('paid consultations!')}} &#128516;</div>
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
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($pending_consultations)}} {{ __(\Str::plural('Pending', $pending_consultations)) }}</h5>
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

        @if(count($consultations) > 0)
        <div class="card">

            <div class="table-responsive text-gray-700">
                <table class="table employee-table table-hover  table-bordered align-items-center ">
                    <thead>
                        <tr>
                            <th class="border-bottom">{{__('Expert')}}</th>
                            <th class="border-bottom">{{__('Schedule')}}</th>
                            <th class="border-bottom">{{__('Payment Details')}}</th>
                            <th class="border-bottom">{{__('Status')}}</th>
                            <th class="border-bottom">{{__('Date created')}}</th>
                            @canany(['consultation-delete','consultation-update'])
                            <th class="border-bottom">{{__('Action')}}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultations as $consultation)
                        <tr>
                            <td>
                                <a href="#" class="d-flex align-items-center">
                                    <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-primary text-white  me-2"><span class="text-dark">{{$consultation->expert->initials}}</span></div>
                                    <div class="d-block"><span class="fw-bolder fs-6">{{ucwords($consultation->expert->name)}}</span>
                                        <div class="small text-gray">
                                            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                            </svg> {{$consultation->expert->email}}
                                        </div>
                                        <div class="small text-gray d-flex align-items-end">
                                            <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg> {{$consultation->expert->phone_number}} | {{$consultation->expert->gender}}
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Date')}}</span> : {{$consultation->date->format('y-m-d')}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Start time')}}</span> : {{$consultation->start_time->format('H:i')}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('End time')}}</span> : {{$consultation->end_time->format('H:i')}}</span><br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Duration')}}</span> : {{$consultation->consultation_type->duration}} {{__('Minutes')}}</span>
                                <hr class="m-0 p-0">
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Type')}}</span> : {{$consultation->consultation_option}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Location')}}</span> :
                                    @if($consultation->consultation_option === 'online')
                                    <a href='{{$consultation->consultation_location_or_online_details}}' target="_blank" class="text-info"> {{__('Consultation link')}}</a>
                                    @else {{$consultation->consultation_location_or_online_details}}
                                    @endif
                                </span> <br>
                            </td>

                            <td>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Payment Method')}}</span> : {{$consultation->payment_method}}</span> <br>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Payment Number')}}</span> : {{$consultation->payment_number}}</span> <br>
                                <span class="fw-normal d-flex gap-1 ">
                                    <span class="fw-bolder">{{__('Payment Status')}}</span> :
                                    <span class="fw-normal badge super-badge badge-lg bg-{{$consultation->payment_status_style}} rounded-1 align-items-end">{{$consultation->payment_status_text}}</span>
                                </span>
                                <span class="fw-normal"> <span class="fw-bolder">{{__('Payment Date')}}</span> : {{$consultation->payment_date}}</span> <br>
                            </td>
                            <td>
                                <span class="fw-normal badge super-badge badge-lg bg-{{$consultation->complaint->complaint_status_style}} rounded">{{$consultation->complaint->complaint_status_text}}</span>
                            </td>
                            <td>
                                <span class="fw-normal">{{$consultation->created_at->diffForHumans()}}</span>
                            </td>
                            @canany(['consultation-delete','consultation-update'])
                            <td>
                                <div class="d-inline-flex align-items-center gap-1">
                                    @can('consultation-update')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('Make Consultation Payment')}}">
                                        <a href='#' wire:click.prevent="initData({{$consultation->id}})" data-bs-toggle="modal" data-bs-target="#MakePaymentModal">
                                            <svg class="icon icon-xs text-info" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                            </svg>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('consultation-read')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('View consultation Details')}}">
                                        <a href='#' wire:click.prevent="initData({{$consultation->id}})" data-bs-toggle="modal" data-bs-target="#ViewConsultationModal">
                                            <svg class="icon icon-xs text-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('consultation-update')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('Edit Consultation')}}">
                                        <a href="{{route('client.consultations.make-edit-follow-up',['consultation_uuid' => $consultation->uuid])}}">
                                            <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    @endcan

                                    @can('consultation-delete')
                                    <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('Delete consultation')}}">
                                        <a href='#' wire:click.prevent="initData({{$consultation->id}})" data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                            <svg class="icon icon-xs text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                    </div>
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
                                    <h4 class="fs-5 fw-bold">{{__('No Consultations')}} &#128540;</h4>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $consultations->links() }}
            </div>
        </div>
        @else
        <div class='border-prim rounded p-4 d-flex justify-content-center align-items-center flex-column'>
            <img src="{{asset('/img/empty.svg')}}" alt='{{__("Empty")}}' class="text-center  w-25 h-25">
            <div class="text-center text-gray-800 mt-2">
                <h4 class="fs-4 fw-bold">{{__('Opps...')}} &#128540;</h4>
                <p>{{__('No Consultations found!')}}</p>
            </div>
        </div>
        @endif
    </div>
</div>