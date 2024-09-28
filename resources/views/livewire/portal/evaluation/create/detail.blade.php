<div wire:ignore.self class="modal side-layout-modal fade" id="DetailEvaluationModal" tabindex="-1"
    aria-labelledby="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetailEvaluationModalLabel">{{ __('Détails de l\'évaluation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($is_view == 1)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('Informations Générales') }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <td>{{ $comiteeDetails->code ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Titre') }}</th>
                                        <td>{{ $comiteeDetails->title ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Date') }}</th>
                                        <td>{{ $comiteeDetails->date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Lieu') }}</th>
                                        <td>{{ $comiteeDetails->location ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('Membres') }}</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($comiteeDetails->members as $member)
                                        <li class="list-group-item">{{ $member->user->name ?? '' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('Population Cible') }}</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($comiteeDetails->populations as $population)
                                        <li class="list-group-item">{{ $population->occupation->name ?? '' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Fermer') }}</button>
            </div>
        </div>
    </div>
</div>
