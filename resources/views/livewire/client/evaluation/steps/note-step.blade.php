<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4">Moyenne Globale</h1>
                <h2 class="display-2 text-primary">{{ number_format($global_average, 2) }}/20</h2>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Moyenne par Rubrique</h4>
                <ul class="list-group">
                    <li class="list-group-item">Bilan Résultat:
                        {{ number_format($note_bilan_resultat, 2) }}/{{ $total_bilan_resultat }}</li>
                    <li class="list-group-item">Tenue globale du poste:
                        {{ number_format($note_tenue_global_poste, 2) }}/{{ $total_tenue_global_poste }}</li>
                    <li class="list-group-item">Qualité Managériale:
                        {{ number_format($note_quality_managerial, 2) }}/{{ $total_quality_managerial }}</li>
                    <li class="list-group-item">Conformité à la culture d'entreprise:
                        {{ number_format($note_compliance_corporate, 2) }}/{{ $total_compliance_corporate }}</li>
                    <li class="list-group-item">Bonus Malus:
                        {{ number_format($note_bonus_malus, 2) }}</li>
                    <li class="list-group-item">Sanctions:
                        {{ number_format($note_sanction, 2) }}</li>
                </ul>
            </div>

            <div class="col-md-6">
                <canvas id="evaluationChart"></canvas>
            </div>
        </div>
    </div>

    @if (auth()->user()->id == $response->user->responsable_n1 || auth()->user()->id == $response->user->responsable_n2)
        @include('livewire.client.evaluation.control-navigation')
    @else
        <div class="d-flex my-2 justify-content-end">
            <a class="btn btn-secondary rounded-pill" wire:click="previousStep">{{__('Précédent')}}</a>
            <button class="btn btn-primary mx-2" wire:click="save"> {{ __('Sauvegarder') }} </button>
        </div>
    @endif

</div>
