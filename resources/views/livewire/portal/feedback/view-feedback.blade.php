<div wire:ignore.self class="modal side-layout-modal fade" id="ViewFeedbackModal" tabindex="-1" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-3 p-lg-4">
                    <div class=" mt-md-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="mb-0 h4">{{__('View Client Details')}}</h1>
                            </div>
                            <div>
                                <button type="button" class="btn btn-gray-200 text-gray-600" wire:click="clearFields" data-bs-dismiss="modal">{{__('Close')}}</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(!empty($feedback))
                        <div class="py-3">
                            <h6>{{__('Client Details')}}</h6>
                            <a href="#" class="d-flex align-items-center">
                                <div class="avatar avatar-md d-flex align-items-center justify-content-center fw-bold fs-6 rounded bg-success  me-2"><span class="text-dark">{{$feedback->client->initials}}</span></div>
                                <div class="d-block">
                                    <span class="fw-bolder fs-6 ">{{ucwords($feedback->client->name)}}</span>
                                    <div class="small text-gray">
                                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg> {{Str::limit($feedback->client->email,20)}}
                                    </div>
                                    <div class="small text-gray d-flex align-items-bottom">
                                        <svg class="icon icon-xxs me-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg> {{$feedback->client->phone_number}} | {{$feedback->client->gender}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <h6>{{__('Feedback')}}</h6>
                                <span>{{$feedback->created_at}}</span>
                            </div>
                            {!! $feedback->feedback !!}
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