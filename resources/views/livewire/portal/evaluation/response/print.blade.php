<div wire:ignore.self class="modal fade" id="printResponseModal" tabindex="-1" role="dialog"
    aria-labelledby="importUsersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:70%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-2 p-lg-3">
                    <div class="mb-2 mt-md-0 text-center">
                        <svg class="icon icon-xxl text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z">
                            </path>
                        </svg>
                        <h1 class="mb-0 h2 fw-bolder">{{ __('Imprimer les reponses') }}</h1>
                        <p class="pt-2">{{ __('Imprimez les évaluations au format pdf.') }}</p>
                    </div>

                    <x-form-items.form wire:submit.prevent="exportMultiple" class="form-modal">

                        <!-- Table avec le checkbox maître -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <!-- Checkbox maître -->
                                            <input type="checkbox" wire:model="selectAlls"
                                                wire:click="toggleselectAlls">
                                        </th>
                                        <th>Matricule</th>
                                        <th>Nom de l'évaluer</th>
                                        <th>Poste</th>
                                        <th>Site</th>
                                        <th>Direction</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($responses as $responseEvaluation)
                                        <tr>
                                            <td>
                                                <input type="checkbox" wire:model="selectedResponses"
                                                    value="{{ $responseEvaluation->id }}">
                                            </td>
                                            <td>{{ $responseEvaluation->user->matricule }}</td>
                                            <td>{{ $responseEvaluation->user->name }}</td>
                                            <td>{{ $responseEvaluation->user->occupation }}</td>
                                            <td>{{ $responseEvaluation->user->site->name }}</td>
                                            <td>{{ $responseEvaluation->user->direction->name }}</td>
                                            <td class="{{ $responseEvaluation->status ? 'text-success' : 'text-muted' }}">
                                                {{ $responseEvaluation->status ? 'Terminé' : 'Brouillon' }}
                                            </td>
                                            <td>
                                                {{ $responseEvaluation->is_send
                                                    ? 'Envoyé le ' . \Carbon\Carbon::parse($responseEvaluation->date)->translatedFormat('j F Y')
                                                    : 'Non envoyé' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-warning">Aucune Réponse Trouvée !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary mx-3">
                                {{ __('Imprimer') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                        </div>

                    </x-form-items.form>
                </div>

                <div wire:loading wire:target="exportMultiple" class="text-center my-2">
                    <div class="text-center">
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                        <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    </div>
                    <div class="mt-2 text-center">{{ __('Opération en cours, veuillez patienter...') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
