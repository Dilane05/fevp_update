<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')


    <h4 class="text-primary fw-bold mb-3">VIII - Appréciations et Commentaires du N+1</h4>

    @php
        $action = '';
        if (auth()->user()->id === $response->user_id && $response->is_send) {
            $action = 'disabled';
        } elseif (auth()->user()->id === $response->responsable_n1 && $response->in_n1) {
            $action = 'disabled';
        } elseif ($response->is_n2) {
            $action = 'disabled';
        } elseif (auth()->user()->id === $response->user_id && $response->my_comment) {
            $action = 'disabled';
        }
    @endphp

    <div class="container">
        <textarea {{ $editable }} {{ $action }}  class="form-control" wire:model.live="comment" name="" id="" cols="30"
            rows="10"></textarea>
    </div>

    @if (auth()->user()->id == $response->user->responsable_n2)
        @include('livewire.client.evaluation.control-navigation')
    @else
        <div class="d-flex justify-content-end mx-2 my-3">
            <a class="btn btn-secondary rounded-pill mx-2" wire:click.prevent="previousStep">{{ __('Précédent') }}</a>
            <a class="btn btn-primary rounded-pill mx-2" wire:click="nextStep">
                {{ __('Suivant') }}
            </a>
            <button class="btn btn-primary" @if (auth()->user()->id != $this->response->user->responsable_n1) disabled @endif wire:click.prevent="save">
                {{ __('Sauvegarder') }} </button>
        </div>
    @endif

</div>
