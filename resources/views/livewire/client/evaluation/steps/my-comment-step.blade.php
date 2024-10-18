<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')


    <h4 class="text-primary fw-bold mb-3">VII - Commentaire de l'évaluer</h4>

    <div class="container">
        <textarea {{ $editable }} class="form-control" wire:model.live="comment" name="" id="" cols="30"
            rows="10"></textarea>
    </div>

    <div class="d-flex justify-content-end mx-2 my-3">
        <a class="btn btn-secondary rounded-pill mx-2" wire:click.prevent="previousStep">{{__('Précédent')}}</a>
        <a class="btn btn-primary rounded-pill mx-2" wire:click.prevent="submit">
            {{__('Suivant')}}
        </a>
        {{-- <button class="btn btn-primary"
        @if (auth()->user()->id != $this->response->user_id)
            disabled
        @endif
        wire:click.prevent="save"> {{ __('Sauvegarder') }} </button> --}}
    </div>

</div>
