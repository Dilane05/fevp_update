<div>
    @include('livewire.client.dashboard.partials.client-feedback-modal')
    <div class='container pt-3 pt-lg-4 pb-7 pb-lg-9 text-white'>
        <div class='d-flex flex-wrap-reverse align-items-top  justify-content-md-between '>
            <div class='d-flex flex-wrap align-items-center gap-3'>
                <div class='d-none d-md-block d-lg-block'>
                    <div class="avatar-xl d-flex align-items-center justify-content-center fw-bold rounded border-warn  mr-5">
                        <span class="p-2 display-2 text-success">{{auth()->user()->initials}}</span>
                    </div>
                </div>
                <div class=''>
                    <div class='fw-bold display-4 text-gray-600'>{{__('Hi')}}, {{auth()->user()->first_name}}</div>
                    <div class='d-flex align-items-center justify-content-start '>
                        <div class='leading text-gray-400 '>{{ auth()->user()->occupation }} | {{ auth()->user()->location}}</div>
                    </div>
                    <div class='mt-4 d-flex flex-wrap   align-items-center gap-2'>
                        @if(auth()->user()->consultations)
                        <a href="{{route('client.consultations.index')}}" wire:navigate class="btn btn-success mr-lg-2 ">
                            <svg class="icon icon-sm me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            {{__('Consultations')}}
                        </a>
                        @else
                        <a href="{{route('client.consultations.index')}}" wire:navigate class="btn btn-success mr-lg-2 ">
                            <svg class="icon icon-sm me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            {{__('Consultations')}}
                        </a>
                        @endif
                        <a href="{{route('client.complaints.index')}}" wire:navigate class="btn btn-primary mr-lg-2 ">
                            <svg class="icon icon-sm me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                            </svg>

                            {{__('Complaints')}}
                        </a>
                        <a href="{{route('client.complaints.referrals.index')}}" wire:navigate class="btn btn-tertiary mr-lg-2 ">
                            <svg class="icon icon-sm me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v8.25A2.25 2.25 0 0 0 6 16.5h2.25m8.25-8.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-7.5A2.25 2.25 0 0 1 8.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 0 0-2.25 2.25v6" />
                            </svg>

                            {{__('Referrals')}}
                        </a>
                        <a href="" wire:navigate class="btn btn-info mr-lg-2 ">
                            <svg class="icon icon-sm me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                            </svg>

                            {{__('Surveys')}}
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#CreateClientFeedbackModal" class="btn btn-secondary mr-lg-2 ">
                            <svg class="icon icon-sm me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                            </svg>

                            {{__('Feedback')}}
                        </a>

                    </div>
                </div>
            </div>
            <div>
                <x-navigation.client-nav />
            </div>
        </div>

        <div class='my-5'>
            <div class=''>
                <x-alert />
                @include('flash::message')
            </div>

        </div>
        <div class='mt-5'>
            <div class='d-flex justify-content-between align-items-end mx-2'>
                <h5 class="h5 text-gray-600">{{__("Lastest Audit logs")}}</h5>
                <div>
                    <a href='{{route("client.auditlogs")}}' wire:navigate class='btn btn-success'>{{__("View all")}}</a>
                </div>
            </div>
            <div class="card mt-2">
                <div class="table-responsive text-gray-700">
                    <table class="table client-table table-hover align-items-center ">
                        <thead>
                            <tr>
                                <!-- <th class="border-bottom">{{__('client')}}</th> -->
                                <th class="border-bottom">{{__('Action Type')}}</th>
                                <th class="border-bottom">{{__('Action Performed')}}</th>
                                <th class="border-bottom">{{__('Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <!-- <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="avatar d-flex align-items-center justify-content-center fw-bold rounded bg-success me-3"><span class="text-white">{{initials($log->user)}}</span></div>
                                        <div class="d-block"><span class="fw-bold">{{$log->user}}</span>
                                            <div class="small text-gray">{{$log->user}}</div>
                                        </div>
                                    </a>
                                </td> -->
                                <td>
                                    <span class="fw-normal badge super-badge badge-lg bg-{{$log->style}} rounded">{{$log->action_type}}</span>
                                </td>
                                <td>
                                    <span class="fs-normal">{!! $log->action_perform !!}</span>
                                </td>
                                <td>
                                    <span class="fw-normal">{{$log->created_at}}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="text-center text-gray-800 mt-2">
                                        <h4 class="fs-4 fw-bold">{{__('Opps nothing here')}} &#128540;</h4>
                                        <p>{{__('No Record Found..!')}}</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>