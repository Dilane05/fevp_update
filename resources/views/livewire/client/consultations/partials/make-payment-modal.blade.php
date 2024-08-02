<div wire:ignore.self class="modal fade" id="MakePaymentModal" tabindex="-1" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-4 p-lg-4">
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{__('Pay for Consultation')}}</h1>
                        <p>{{__('Pay your consultation fee to secure the reservation')}} &#128522;</p>
                    </div>
                    <x-form-items.form wire:submit="store">
                        <div class="form-group mb-2">
                            <label for="payment_method">{{__('Payment Option')}}</label>
                            <select class="form-select  @error('payment_method') is-invalid @enderror" class="w-100" wire:model.live="payment_method">
                                <option value="">{{ (" -- Select --")}}</option>
                                <option value="mobile_money" selected>{{__('Mobile Money')}}</option>
                            </select>
                            @error('payment_method')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="payment_number">{{__('Payment Number')}}</label>
                            <input type="text" class="form-control  @error('payment_number') is-invalid @enderror" name="payment_number" wire:model.blur="payment_number" value="{{auth()->user()->phone_number}}">
                            @error('payment_number')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-gray-200 text-gray-600 ms-auto mx-3" wire:click="clearFields" data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" wire:click.prevent="store" class="btn btn-success" wire:loading.attr="disabled">{{__('Make Pay')}}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>