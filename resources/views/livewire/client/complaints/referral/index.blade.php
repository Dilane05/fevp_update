<div>
    @include('livewire.client.complaints.referral.partials.view-client-referral-modal')
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
                        {{__('My Referrals')}}
                    </span>
                </h1>
                <p class="text-gray-800  px-5 mt-n5 pt-3 mx-1">{{__('View all my referrals')}} &#129297; </p>
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
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($referrals_count)}} {{ __(\Str::plural('Referral', $referrals_count)) }} </h5>
                                    <div class=" text-gray-500 ">{{__('all referrals!')}} &#128516;</div>
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
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($completed_referrals)}} {{ __('Completed') }} </h5>
                                    <div class=" text-gray-500 ">{{__('completed referrals!')}} &#128516;</div>
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
                                    <h5 class="text-gray-700 fw-bold mb-0">{{numberFormat($pending_referrals)}} {{ __('Pending') }}</h5>
                                    <div class="text-gray-500 ">{{__('pending referrals!')}} &#128560;</div>
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

        @if(count($referrals) > 0)
        <div class="card">
            <div class="table-responsive text-gray-700">
                <table class="table employee-table table-hover table-bordered align-items-center ">
                    <thead>
                        <tr>
                            <th class="border-bottom"><span class=" p-1 px-2 rounded bg-primary text-white mx-2">{{__('Expert')}}</span></th>
                            <th class="border-bottom">{{__('Referral Action')}}</th>
                            <th class="border-bottom">{{__('Referral Status')}}</th>
                            <th class="border-bottom">{{__('Feedbacks')}}</th>
                            <th class="border-bottom">{{__('Date created')}}</th>
                            @canany(['referral_complaint-delete','referral_complaint-update'])
                            <th class="border-bottom">{{__('Action')}}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($referrals as $referral)
                        <tr>
                            <td>
                                <!-- <div class="fw-bold">{{__('Expert Details')}}</div> -->
                                <a href="#" class="d-flex align-items-center">
                                    <div class="avatar d-flex align-items-center justify-content-center fw-bold  rounded bg-primary text-white  me-2"><span class="text-dark">{{$referral->expert->initials}}</span></div>
                                    <div class="d-block"><span class="fw-bolder ">{{ucwords($referral->expert->name)}}</span>
                                        <!-- <div class="small text-gray">
                                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg> {{$referral->expert->email}}
                                    </div> -->
                                        <div class="small text-gray d-flex align-items-bottom">
                                            <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg> {{$referral->expert->phone_number}} | {{$referral->expert->gender}}
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td class="text-wrap" style="width: 100%;">
                                <span class="small">{!! \Str::limit($referral->referral_description, 100) !!}</span>
                            </td>
                            <td>
                                <span class="fw-normal badge super-badge badge-lg bg-{{$referral->referral_status_style}} rounded-1 align-items-end">{{$referral->referral_status_text}}</span>
                            </td>
                            <td>
                                @if(!empty($referral->client_feedback))
                                <div class='d-flex justify-content-between align-items-center gap-1'>
                                    <span class="fw-bold ">{{__('Client Feedback')}}</span>
                                    <span>{{$referral->client_feedback_date->toDateString()}}</span>
                                </div>
                                <p class="small">{!! Str::limit($referral->client_feedback, 50) !!}</p>
                                @if($referral->referral_results_file)
                                <a href="{{asset('content/'.$referral->referral_results_file)}}" target="_blank" class="small text-info">{{__('Download Result File')}}</a>
                                @endif
                                @endif
                                @if(!empty($referral->expert_feedback))
                                <hr class="my-1">
                                <div class='d-flex justify-content-between align-items-center gap-1'>
                                    <span class="fw-bold ">{{__('Expert Feedback')}}</span>
                                    <span>{{$referral->expert_feedback_date->toDateString()}}</span>
                                </div>
                                <p class="small">{{ Str::limit($referral->expert_feedback, 50)}}</p>

                                @endif
                            </td>
                            <td>
                                <span class="fw-normal">{{$referral->created_at->diffForHumans()}}</span>
                            </td>
                            @canany(['referral_complaint-delete','referral_complaint-update'])
                            <td>
                                @can('referral_complaint-read')
                                <a href='#' wire:click.prevent="initData({{$referral->id}})" data-bs-toggle="modal" data-bs-target="#ViewClientReferralModal">
                                    <svg class="icon icon-xs text-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                @endcan
                                @can('referral_complaint-update')
                                <a href="{{route('client.complaints.referrals.edit-client-referral',['complaint'=>$referral->complaint])}}">
                                    <svg class="icon icon-xs text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @endcan
                                @can('referral_complaint-delete')
                                <a href='#' wire:click.prevent="initData({{$referral->id}})" data-bs-toggle="modal" data-bs-target="#DeleteModal">
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
                                    <h4 class="fs-5 fw-bold">{{__('No referrals')}} &#128540;</h4>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $referrals->links() }}
            </div>
        </div>
        @else
        <div class='border-prim rounded p-4 d-flex justify-content-center align-items-center flex-column'>
            <img src="{{asset('/img/empty.svg')}}" alt='{{__("Empty")}}' class="text-center  w-25 h-25">
            <div class="text-center text-gray-800 mt-2">
                <h4 class="fs-4 fw-bold">{{__('Opps nothing here')}} &#128540;</h4>
                <p>{{__('No Referrals found!')}}</p>
            </div>
        </div>
        @endif
    </div>
</div>