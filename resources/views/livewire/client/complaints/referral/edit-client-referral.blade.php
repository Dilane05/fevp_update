<div>
    <x-alert />
    <div class='container pt-3 pt-lg-4 pb-2 pb-lg-2'>
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
        <div class='row mt-2'>
            <div class='col-md-8 col-sm-12 '>
                <div class="accordion accordion-flush border bg-white rounded-2 mb-3" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <h6>{{__('Complaint Details')}}</h6>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse px-4 pb-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            {!! $complaint->complaint_description !!}
                        </div>
                    </div>
                </div>
                @if($complaint->referral)
                <div class='card'>
                    <div class='card-body '>
                        <h5>{{__('Referral Details')}}</h5>
                        <div class="form-group mb-4">
                            {!! $referral->referral_description !!}
                        </div>
                        <div class='form-group mb-2'>
                            <label for="client_feedback">{{__('Client Feedabck')}}</label>
                            <livewire:portal.trix :value="$client_feedback">
                                @error('client_feedback')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                        </div>
                        <div class='for-group mb-4'>
                            <label for="referral_results_file" class="form-label">{{__('Referral Result File')}}</label>
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->
                                <input class="form-control  @error('referral_results_file') is-invalid @enderror" type="file" wire:model.live="referral_results_file" id="referral_results_file">
                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                        @can('referral_complaint-update')
                        <div class="d-flex justify-content-end">
                            <a wire:click="updateReferral" class="btn btn-sm btn-success  py-2 d-inline-flex align-items-center " wire:loading.attr="disabled">
                                <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>

                                {{__('Update')}}
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
                @endif
            </div>
            <div class='col-md-4 col-sm-12'>
                <div class='card mb-2'>
                    <div class='card-body p-3 '>
                        <div class=''>
                            <span class="fw-normal d-flex justify-content-between gap-3 ">
                                <span class="fw-bold">{{__('Referral Status')}} </span>
                                <span class="fw-normal badge super-badge badge-lg bg-{{$complaint->referral->referral_status_style}} rounded-1 align-items-end">{{$complaint->referral->referral_status_text}}</span>
                            </span>
                            <span class="fw-normal d-flex justify-content-between gap-3 mt-2 ">
                                <span class="fw-bold">{{__('Deadline ')}} </span>
                                <span class="fw-normal align-items-end">{{$complaint->referral->referral_deadline->toDateString()}}</span>
                            </span>

                        </div>
                    </div>
                </div>
                <div class='card mb-2'>
                    <div class='card-body '>
                        <div class="">
                            <h6>{{__('Expert Details')}}</h6>
                            <a href="#" class="d-flex align-items-center">
                                <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold  rounded bg-primary text-white  me-2"><span class="text-dark">{{$complaint->expert->initials}}</span></div>
                                <div class="d-block"><span class="fw-bolder">{{ucwords($complaint->expert->name)}}</span>
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
                        <div class='px-2'>
                            <span class="fw-normal"> <span class="fw-bold small">{{__('Date')}}</span> : {{$complaint->consultation->date->format('y-m-d')}}</span> <br>
                            <span class="fw-normal"> <span class="fw-bold small">{{__('Start time')}}</span> : {{$complaint->consultation->start_time->format('H:i')}}</span> <br>
                            <span class="fw-normal"> <span class="fw-bold small">{{__('End time')}}</span> : {{$complaint->consultation->end_time->format('H:i')}}</span><br>
                            <span class="fw-normal"> <span class="fw-bold small">{{__('Duration')}}</span> : {{!empty($complaint->consultation) ? $complaint->consultation->duration : ''}} {{__('Minutes')}}</span>
                            <hr class="my-1 p-0">
                            <span class="fw-normal"> <span class="fw-bold small">{{__('Type')}}</span> : {{!empty($complaint->consultation) ? $complaint->consultation->consultation_option : ''}}</span> <br>
                            <span class="fw-normal"> <span class="fw-bold small">{{__('Location')}}</span> :
                                @if($complaint->consultation->consultation_option === 'online')
                                <a href='{{$complaint->consultation_location_or_online_details}}' target="_blank" class="text-info small"> {{__('Consultation link')}}</a>
                                @else {{$complaint->consultation->consultation_location_or_online_details}}
                                @endif
                            </span> <br>
                        </div>
                    </div>
                </div>
                <div class='card mb-2'>
                    <div class='card-body '>
                        <h6>{{__('Payment Details')}}</h6>
                        <div class='px-2'>
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
                @if(!empty($referral) && !empty($referral->referral_results_file))
                <div class='card mb-2'>
                    <div class='card-body '>
                        <h6>{{__('Client Referral File ')}}</h6>
                        <div class='px-1'>
                            <a href="{{asset('content/'.$referral->referral_results_file)}}" target="_blank" class="small text-info">{{__('Download Result File')}}</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>