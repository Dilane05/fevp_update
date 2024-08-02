<div>
    <div class="contact-one__form-box  text-center">
        <div x-data="{ show: @entangle('message_sent') }" x-show="!show" x-init="setTimeout(() => show = false, 3000)">
            <form wire:submit="sendMessage" class="contact-one__form contact-form-validated" novalidate="novalidate">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-one__input-box">
                            <input type="text" placeholder="{{__('Full Name')}}" class="form-control @error('full_name') is-invalid @enderror" wire:model.live="full_name">
                            @error('full_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-one__input-box">
                            <input type="email" placeholder="{{__('Email Address')}}" class="form-control @error('email') is-invalid @enderror" wire:model.live="email">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-one__input-box">
                            <input type="text" placeholder="{{__('Phone Number')}}" class="form-control @error('phone_number') is-invalid @enderror" wire:model.live="phone_number">
                            @error('phone_number')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-one__input-box">
                            <input type="text" placeholder="{{__('Subject')}}" class="form-control @error('subject') is-invalid @enderror" wire:model.live="subject">
                            @error('subject')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="contact-one__input-box text-message-box">
                            <textarea placeholder="{{__('Write a Message')}}" class="form-control @error('message') is-invalid @enderror" wire:model.live="message"></textarea>
                            @error('message')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="contact-one__btn-box">
                            <button type="submit" wire:click="sendMessage" class="eduact-btn eduact-btn-second">
                                <span class="eduact-btn__curve"></span>{{__('Send a Message')}}<i class="icon-arrow"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="result">
            @if($message_sent)
            <div class='alert'>
             {{__('Thanks for reaching out!')}}
            </div>
            @endif
        </div>
    </div>
</div>