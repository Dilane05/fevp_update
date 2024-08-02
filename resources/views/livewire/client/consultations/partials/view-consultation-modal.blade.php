<div wire:ignore.self class="modal side-layout-modal fade" id="ViewConsultationModal" tabindex="-1" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width:90%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-3 p-lg-4">
                    <div class="mt-md-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="mb-0 h4">{{__('View Consultation Details')}}</h1>
                                <p>{{__('view details of given consultation')}} &#128522;</p>
                            </div>
                            <div>
                                <button type="button" class="btn btn-gray-200 text-gray-600" wire:click="clearFields" data-bs-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(!empty($consultation))
                        <div class='row mt-2'>
                            <div class='col-md-8 col-sm-12 '>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Expert Details')}}</h6>
                                        <a href="#" class="d-flex align-items-center">
                                            <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-primary text-white  me-2"><span class="text-dark">{{$consultation->expert->initials}}</span></div>
                                            <div class="d-block"><span class="fw-bolder fs-6">{{ucwords($consultation->expert->name)}}</span>
                                                <div class="small text-gray">
                                                    <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                    </svg> {{$consultation->expert->email}}
                                                </div>
                                                <div class="small text-gray d-flex align-items-bottom">
                                                    <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg> {{$consultation->expert->phone_number}} | {{$consultation->expert->gender}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @if($consultation->notes)
                                <div class='card'>
                                    <div class='card-body pt-3 '>
                                        <h5>{{__('Complaint Details')}}</h5>
                                        <div class="form-group mb-3">
                                            {!! $consultation->notes !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class='col-md-4 col-sm-12'>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Consultation Details')}}</h6>
                                        <div class='px-1'>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Consultation Type')}}</span> : {{$consultation->consultation_type->name}}</span> <br>
                                            <span class="fw-normal d-flex gap-1 ">
                                                <span class="fw-bold small">{{__('Consultation Status')}}</span> :
                                                <span class="fw-normal badge super-badge badge-lg bg-{{$consultation->complaint->complaint_status_style}} rounded-1 align-items-end">{{$consultation->complaint->complaint_status_text}}</span>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Schedule Details')}}</h6>
                                        <div class='px-1'>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Date')}}</span> : {{$consultation->date->format('y-m-d')}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Start time')}}</span> : {{$consultation->start_time->format('H:i')}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('End time')}}</span> : {{$consultation->end_time->format('H:i')}}</span><br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Duration')}}</span> : {{!empty($consultation) ? $consultation->duration : ''}} {{__('Minutes')}}</span>
                                            <hr class="my-1 p-0">
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Type')}}</span> : {{!empty($consultation) ? $consultation->consultation_option : ''}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Location')}}</span> :
                                                @if($consultation->consultation_option === 'online')
                                                <a href='{{$consultation->consultation_location_or_online_details}}' target="_blank" class="text-info"> {{__('Consultation link')}}</a>
                                                @else {{$consultation->consultation_location_or_online_details}}
                                                @endif
                                            </span> <br>
                                        </div>
                                    </div>
                                </div>
                                <div class='card mb-2'>
                                    <div class='card-body '>
                                        <h6>{{__('Payment Details')}}</h6>
                                        <div class='px-1'>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Payment Method')}}</span> : {{$consultation->payment_method}}</span> <br>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Payment Number')}}</span> : {{$consultation->payment_number}}</span> <br>
                                            <span class="fw-normal d-flex gap-1 ">
                                                <span class="fw-bold small">{{__('Payment Status')}}</span> :
                                                <span class="fw-normal badge super-badge badge-lg bg-{{$consultation->payment_status_style}} rounded-1 align-items-end">{{$consultation->payment_status_text}}</span>
                                            </span>
                                            <span class="fw-normal"> <span class="fw-bold small">{{__('Payment Date')}}</span> : {{$consultation->payment_date}}</span> <br>
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