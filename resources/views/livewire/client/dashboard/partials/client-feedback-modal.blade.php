<div wire:ignore.self class="modal side-layout-modal fade" id="CreateClientFeedbackModal" tabindex="-1" aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered " role="document" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-3 p-lg-4">
                    <div class="mb-4 mt-md-0">
                        <h1 class="mb-0 h4">{{__('Share your feedback')}}</h1>
                        <p>{{__('Tell us how you are doing')}} &#128522;</p>
                    </div>
                    <x-form-items.form wire:submit="saveFeedback">
                        
                        <div class="form-group mb-2">
                            <label for="client_feedback">{{__('Your feedback')}}</label>
                            <livewire:portal.trix :value="$client_feedback">
                                @error('client_feedback')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-gray-200 text-gray-600 ms-auto mx-3" wire:click="clearFeedbackFields" data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" wire:click.prevent="saveFeedback" class="btn btn-success" wire:loading.attr="disabled">{{ __('Share')}}</button>
                        </div>
                    </x-form-items.form>
                </div>
            </div>
        </div>
    </div>
</div>