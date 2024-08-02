<div>
    <x-alert />
    <div class='container pt-3 pt-lg-4 pb-4 pb-lg-3'>
        <div class='d-flex flex-wrap align-items-center  justify-content-between '>
            <div class="d-flex justify-content-start align-items-center gap-3">
                <a href="{{route('client.consultations.index')}}" wire:navigate class="">
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
        <div class='d-flex flex-wrap justify-content-between align-items-center mt-2'>
            <div class=''>
                <h1 class='fw-bold display-5 text-gray-600 d-inline-flex align-items-start'>
                    <svg class="icon icon-md me-1 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>

                    <span>
                        @if($consultation)
                        {{__('Update your Consultation')}}
                        @else
                        {{__('Book for a new  Consultation')}}
                        @endif
                    </span>
                </h1>
                <p class="text-gray-800 px-5 mt-n5 pt-3 mx-1">
                    @if($consultation)
                    {{__('Update your Consultation')}} {{$consultation->token}}
                    @else
                    {{__('Book for a new  Consultation')}}
                    @endif

                    &#128523;
                </p>
            </div>
            <div class=''>
                <div class="d-flex justify-content-end ">
                    @if($consultation)
                    <div class="">
                        <a wire:click="saveOnly" class="btn btn-sm btn-success  py-2 d-inline-flex align-items-center " wire:loading.attr="disabled">
                            <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>

                            {{__('Update Consultation')}}
                        </a>
                    </div>
                    @else
                    <div class="">
                        <a wire:click="saveOnly" class="btn btn-sm btn-success  py-2 d-inline-flex align-items-center " wire:loading.attr="disabled">
                            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            {{__('Save Consultation')}}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class='row mt-2'>
            <div class='col-md-8 col-sm-12'>
                @if($is_edit)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="mb-3 {{ !$experts->count() ? '' : '' }}">
                            <label for="state.expert" class="form-label text-muted">{{__('Select Expert')}} <span class="text-danger">*</span></label>
                            <select name="state.expert" id="state.expert" wire:model.live="state.expert" class="form-select  @error('state.expert') is-invalid @enderror">
                                <option value="">{{__('Select an Expert')}}</option>
                                @foreach($experts as $expert)
                                <option value="{{$expert->id}}">{{$expert->name}}</option>
                                @endforeach
                            </select>
                            @error('state.expert')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        @if($this->selectedConsultationType && $this->selectedExpert)
                        <div class="mb-3 {{ !$this->selectedConsultationType || !$this->selectedExpert ? 'special-card' : '' }}">
                            <label for="expert_availability" class="form-label text-muted">{{__('Select Time for Consultation')}}</label>
                            <livewire:portal.consultations.partials.expert-calendar :consultation_type="$this->selectedConsultationType" :expert="$this->selectedExpert" />
                        </div>
                        @endif
                    </div>
                </div>
                @else
                <div class='card mb-2'>
                    <div class='card-body '>
                        <div class="d-flex align-items-top justify-content-between">
                            <div>
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
                            <div>
                                <a href='' wire:click.prevent="showEditExpertForm()">
                                    {{__('Edit')}}
                                </a>
                            </div>
                        </div>
                        <hr>
                        <h6>{{__('Schedule Details')}}</h6>
                        <div class='px-3'>
                            <span class="fw-normal"> <span class="fw-bold">{{__('Date')}}</span> : {{$consultation->date->format('y-m-d')}}</span> <br>
                            <span class="fw-normal"> <span class="fw-bold">{{__('Start time')}}</span> : {{$consultation->start_time->format('H:i')}}</span> <br>
                            <span class="fw-normal"> <span class="fw-bold">{{__('End time')}}</span> : {{$consultation->end_time->format('H:i')}}</span><br>
                            <span class="fw-normal"> <span class="fw-bold">{{__('Duration')}}</span> : {{!empty($consultation) ? $consultation->duration : ''}} {{__('Minutes')}}</span>
                            <hr class="my-1 p-0">
                            <span class="fw-normal"> <span class="fw-bold">{{__('Type')}}</span> : {{!empty($consultation) ? $consultation->consultation_option : ''}}</span> <br>
                            <span class="fw-normal"> <span class="fw-bold">{{__('Location')}}</span> :
                                @if($consultation->consultation_option === 'online')
                                <a href='{{$consultation->consultation_location_or_online_details}}' target="_blank" class="text-info"> {{__('Consultation link')}}</a>
                                @else {{$consultation->consultation_location_or_online_details}}
                                @endif
                            </span> <br>
                        </div>
                    </div>
                </div>

                @endif
                <div class='card'>
                    <div class='card-body'>
                        <div class="form-group mb-3">
                            <label for="notes" class="form-label text-muted">{{__('What is yours complaint?')}} <span class="text-danger">*</span></label>
                            <livewire:portal.trix :value="$notes">
                                @error('notes')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-4 col-sm-12'>
                <div class='card mb-2'>
                    <div class='card-body'>
                        @if($this->hasDetailsToBook)
                        <div class="mb-1">
                            <div class="fw-bold mb-1">
                                @if($consultation)
                                {{__("You have booked for a")}}
                                @else
                                {{__("You're ready to book")}}
                                @endif
                            </div>
                            <div class=" py-1">
                                {{ $this->selectedConsultationType->name }} - {{__('Consultation')}} ({{ $this->selectedConsultationType->duration }} minutes)
                                with {{ $this->selectedExpert->name }} on {{ $this->timeObject->format('D jS M Y') }}
                                at {{ $this->timeObject->format('g:i A') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class='card mb-2'>
                    <div class='card-body'>
                        <div class="form-group mb-1">
                            <label for="state.payment_method">{{__('Payment Option')}}</label>
                            <select class="form-select  @error('state.payment_method') is-invalid @enderror" class="w-100" wire:model.live="state.payment_method">
                                <option value="">{{ (" -- Select --")}}</option>
                                <option value="mobile_money" selected>{{__('Mobile Money')}}</option>
                            </select>
                            @error('state.payment_method')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="state.payment_number">{{__('Payment Number')}}</label>
                            <input type="text" class="form-control  @error('state.payment_number') is-invalid @enderror" name="state.payment_number" wire:model.blur="state.payment_number">
                            @error('state.payment_number')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class='card mb-2'>
                    <div class='card-body'>
                        <div class="form-group mb-2">
                            <label for="state.consultation_option">{{__('Consultation Delivery')}}</label>
                            <select class="form-control  @error('state.consultation_option') is-invalid @enderror" class="w-100" wire:model.live="state.consultation_option">
                                <option value="">{{ (" -- Select --")}}</option>
                                <option value="in_person">{{__('In person')}}</option>
                                <option value="online">{{__('Online')}}</option>
                            </select>
                            @error('state.consultation_option')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        @if($state['consultation_option'] == 'online')

                        @else

                        @endif
                    </div>
                </div>

            </div>
            @push('script')
            <script>

            </script>
            @endpush
        </div>


    </div>
</div>