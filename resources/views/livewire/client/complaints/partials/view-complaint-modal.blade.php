<div wire:ignore.self class="modal side-layout-modal fade" id="ViewComplaintModal" tabindex="-1" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width:90%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-3 p-lg-4">
                    <div class=" mt-md-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="mb-0 h4">{{__('View Complaint Details')}}</h1>
                                <p>{{__('view details of given Complaint')}} &#128522;</p>
                            </div>
                            <div>
                                <button type="button" class="btn btn-gray-200 text-gray-600" wire:click="clearFields" data-bs-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(!empty($complaint->consultation))
                        <div class='row mt-2'>
                            <div class='col-md-8 col-sm-12 '>
                                <div class='card mb-2'>
                                    <div class='card-body pt-3 '>
                                        <h5>{{__('Complaint Details')}}</h5>
                                        <div class="form-group mb-3">
                                            <div class="form-group mb-3">
                                                {!! $complaint->complaint_description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($complaint->referral)
                                <div class='card mb-2'>
                                    <div class='card-body pt-3 '>
                                        <h5>{{__('Referral Details')}}</h5>
                                        <div class="form-group mb-3">
                                            {!! $complaint->referral->referral_description !!}
                                        </div>
                                        <div class='d-flex justify-content-between align-items-center mb-2'>
                                            <div>
                                                {{__('Due Date')}} : {{$complaint->referral->referral_deadline->format('y-m-d')}}
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                {{__('Referral Status')}} : <span class="fw-normal badge super-badge badge-lg bg-{{$complaint->referral->referral_status_style}} rounded-1 align-items-end">{{$complaint->referral->referral_status_text}}</span>
                                            </div>
                                        </div>
                                        <div>
                                            @if(!empty($complaint->referral->client_feedback) || !empty($complaint->referral->expert_feedback))
                                            <div class='border px-4 pt-3 pb-2 rounded-2'>
                                                @if(!empty($complaint->referral->client_feedback))
                                                <div class='d-flex justify-content-between align-items-center'>
                                                    <span class="fw-bold ">{{__('Client Feedback')}}</span>
                                                    <span>{{$complaint->referral->client_feedback_date}}</span>
                                                </div>
                                                <p class="py-2">{!! $complaint->referral->client_feedback !!}</p>
                                                @if($complaint->referral->referral_results_file)
                                                <a href="{{asset('content/'.$complaint->referral->referral_results_file)}}" target="_blank" class="small mb-2 text-info">{{__('Download Result File')}}</a>
                                                @endif
                                                @endif
                                                @if(!empty($complaint->referral->expert_feedback))
                                                <hr class="my-2">
                                                <div class='d-flex justify-content-between align-items-center'>
                                                    <span class="fw-bold ">{{__('Expert Feedback')}}</span>
                                                    <span>{{$complaint->referral->expert_feedback_date}}</span>
                                                </div>
                                                <p class="py-2">{!! $complaint->referral->expert_feedback !!}</p>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class='col-md-4 col-sm-12'>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Complaints Details')}}</h6>
                                        <div class='px-1'>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Consultation Type')}}</span> : {{$complaint->consultation->consultation_type->name}}</span> <br>
                                            <span class="fw-normal d-flex gap-1 ">
                                                <span class="fw-bold small">{{__('Complaint Status')}}</span> :
                                                <span class="fw-normal badge super-badge badge-lg bg-{{$complaint->complaint_status_style}} rounded-1 align-items-end">{{$complaint->complaint_status_text}}</span>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <div class="">
                                            <h6>{{__('Expert Details')}}</h6>
                                            <a href="#" class="d-flex align-items-center">
                                                <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-primary text-white  me-2"><span class="text-dark">{{$complaint->expert->initials}}</span></div>
                                                <div class="d-block"><span class="fw-bolder fs-6">{{ucwords($complaint->expert->name)}}</span>
                                                    <div class="small text-gray">
                                                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                        </svg> {{$complaint->expert->email}}
                                                    </div>
                                                    <div class="small text-gray d-flex align-items-bottom">
                                                        <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg> {{$complaint->expert->phone_number}} | {{$complaint->expert->gender}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Schedule Details')}}</h6>
                                        <div class='px-1'>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Date')}}</span> : {{$complaint->consultation->date->format('y-m-d')}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Start time')}}</span> : {{$complaint->consultation->start_time->format('H:i')}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('End time')}}</span> : {{$complaint->consultation->end_time->format('H:i')}}</span><br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Duration')}}</span> : {{!empty($complaint->consultation) ? $complaint->consultation->duration : ''}} {{__('Minutes')}}</span>
                                            <hr class="my-1 p-0">
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Type')}}</span> : {{!empty($complaint->consultation) ? $complaint->consultation->consultation_option : ''}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Location')}}</span> :
                                                @if($complaint->consultation->consultation_option === 'online')
                                                <a href='{{$complaint->consultation_location_or_online_details}}' target="_blank" class="text-info"> {{__('Consultation link')}}</a>
                                                @else {{$complaint->consultation->consultation_location_or_online_details}}
                                                @endif
                                            </span> <br>
                                        </div>
                                    </div>
                                </div>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Payment Details')}}</h6>
                                        <div class='px-1'>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Payment Method')}}</span> : {{$complaint->consultation->payment_method}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Payment Number')}}</span> : {{$complaint->consultation->payment_number}}</span> <br>
                                            <span class="fw-normal d-flex gap-1 ">
                                                <span class="fw-bold small">{{__('Payment Status')}}</span> :
                                                <span class="fw-normal badge super-badge badge-lg bg-{{$complaint->consultation->payment_status_style}} rounded-1 align-items-end">{{$complaint->consultation->payment_status_text}}</span>
                                            </span>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Payment Date')}}</span> : {{$complaint->consultation->payment_date}}</span> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('livewire.partials.modal-skeleton')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>