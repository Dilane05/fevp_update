<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')


    <h4 class="text-primary fw-bold mb-3">V - Appréciations et Commentaires du N+2</h4>

    <div class="container">
        <textarea {{ $editable }} class="form-control" wire:model.live="comment" name="" id="" cols="30"
            rows="10"></textarea>
    </div>

    <div class="d-flex justify-content-between mx-2 my-3">
        <a class="btn btn-secondary rounded-pill" wire:click="previousStep">{{ __('Précédent') }}</a>
        <button class="btn btn-primary" wire:click="save"> {{ __('Sauvegarder') }} </button>
    </div>

</div>
