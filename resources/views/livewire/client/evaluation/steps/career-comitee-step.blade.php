<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')

    <!-- Modal d'erreurs -->
    <div class="modal fade {{ $errorsModalVisible ? 'show' : '' }}" id="errorModal" tabindex="-1"
        aria-labelledby="errorModalLabel" aria-hidden="{{ $errorsModalVisible ? 'false' : 'true' }}"
        style="display: {{ $errorsModalVisible ? 'block' : 'none' }};">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-lg">
                <div class="modal-header bg-danger text-white rounded-top">
                    <h5 class="modal-title" id="errorModalLabel">
                        <i class="bi bi-exclamation-circle me-2"></i> Erreurs de Validation
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="$set('errorsModalVisible', false)"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errorMessages as $error)
                                <li class="d-flex align-items-center mb-2">
                                    <i class="bi bi-x-circle me-2"></i>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end">
                    <button type="button" class="btn btn-light shadow-sm" data-bs-dismiss="modal"
                        wire:click="$set('errorsModalVisible', false)">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-primary fw-bold mb-3"> {{ __('ENTRETIEN COMITÉ CARRIÈRE') }} </h4>

    <div class="container my-2">
        <h3>1. DÉCISION DU MANAGER</h3>

        <table class="table table-bordered my-2">
            <thead class="thead-light">
                <tr>
                    <th>Décisions</th>
                    <th>Commentaires (Remplir uniquement la case commentaire de la décision choisie)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="radio" wire:click="selectDecision('aucun_changement')" name="decision"
                            value="aucun_changement">
                        <label for="aucun_changement"><strong>Aucun Changement :</strong> Aucun changement de poste, ni
                            de grade, ni de salaire</label>
                    </td>
                    <td>
                        @if ($selectedDecision === 'aucun_changement')
                            <textarea wire:model="decisions.aucun_changement" class="form-control"></textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" wire:click="selectDecision('promotion')" name="decision"
                            value="promotion">
                        <label for="promotion"><strong>Promotion :</strong> Promotion vers une autre fonction</label>
                    </td>
                    <td>
                        @if ($selectedDecision === 'promotion')
                            <textarea wire:model="decisions.promotion" class="form-control"></textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" wire:click="selectDecision('evolution_salaire')" name="decision"
                            value="evolution_salaire">
                        <label for="evolution_salaire"><strong>Évolution de salaire :</strong> Augmentation salariale
                            sans changement de poste</label>
                    </td>
                    <td>
                        @if ($selectedDecision === 'evolution_salaire')
                            <textarea wire:model="decisions.evolution_salaire" class="form-control"></textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" wire:click="selectDecision('evolution_grade')" name="decision"
                            value="evolution_grade">
                        <label for="evolution_grade"><strong>Évolution de grade :</strong> Changement de grade</label>
                    </td>
                    <td>
                        @if ($selectedDecision === 'evolution_grade')
                            <textarea wire:model="decisions.evolution_grade" class="form-control"></textarea>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" wire:click="selectDecision('affectation_autre_poste')" name="decision"
                            value="affectation_autre_poste">
                        <label for="affectation_autre_poste"><strong>Affectation vers un autre poste :</strong>
                            Affectation vers un autre poste sans augmentation salariale</label>
                    </td>
                    <td>
                        @if ($selectedDecision === 'affectation_autre_poste')
                            <textarea wire:model="decisions.affectation_autre_poste" class="form-control"></textarea>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="my-2">
            <h3>2. ÉVOLUTIONS PROPOSÉES À COURT TERME</h3>
            <textarea class="form-control" wire:model="short_term_evolution" name="" id="" cols="30"
                rows="10"></textarea>
        </div>

        <div class="my-2">
            <h3>3. PERSPECTIVE DE CARRIÈRE À MOYEN TERME</h3>
            <textarea class="form-control" wire:model="perspective_career" name="" id="" cols="30"
                rows="10"></textarea>
        </div>

        <div class="my-2">
            <h3>4. PROFIL DE TALENT</h3>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Profils de talent</th>
                        <th>Commentaires (Remplir uniquement la case commentaire du Profil de Talent choisi)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="radio" wire:click="selectProfile('key_talent')" name="profile"
                                value="key_talent">
                            <label for="key_talent"><strong>Key Talent (KT) :</strong> Un salarié qui démontre très
                                régulièrement de très bonnes performances...</label>
                            <br><small><strong>Performance annuelle :</strong> deux ans consécutifs de "Très bonne
                                performance" ou "Performance exceptionnelle"</small>
                        </td>
                        <td>
                            @if ($selectedProfile === 'key_talent')
                                <textarea wire:model="profiles.key_talent" class="form-control"></textarea>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" wire:click="selectProfile('expert')" name="profile" value="expert">
                            <label for="expert"><strong>Expert (E) :</strong> Salarié ayant des compétences techniques
                                rares ou très demandées...</label>
                            <br><small><strong>Performance annuelle :</strong> au moins "Bonne performance"</small>
                        </td>
                        <td>
                            @if ($selectedProfile === 'expert')
                                <textarea wire:model="profiles.expert" class="form-control"></textarea>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" wire:click="selectProfile('potentiel')" name="profile"
                                value="potentiel">
                            <label for="potentiel"><strong>Potentiel (P) :</strong> Nouveau dans le groupe ou dans le
                                poste, dynamique, avec du potentiel...</label>
                            <br><small><strong>Performance annuelle :</strong> minimum "Bonne performance" dans ses
                                fonctions précédentes</small>
                        </td>
                        <td>
                            @if ($selectedProfile === 'potentiel')
                                <textarea wire:model="profiles.potentiel" class="form-control"></textarea>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" wire:click="selectProfile('bon_contributeur')" name="profile"
                                value="bon_contributeur">
                            <label for="bon_contributeur"><strong>Bon Contributeur (BC) :</strong> Un salarié avec une
                                bonne expertise mais sans souhait d'évolution...</label>
                            <br><small><strong>Performance annuelle :</strong> minimum "Bonne performance"</small>
                        </td>
                        <td>
                            @if ($selectedProfile === 'bon_contributeur')
                                <textarea wire:model="profiles.bon_contributeur" class="form-control"></textarea>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" wire:click="selectProfile('sous_performeur')" name="profile"
                                value="sous_performeur">
                            <label for="sous_performeur"><strong>Sous Performeur (SP) :</strong> Un salarié qui montre
                                une baisse de motivation ou des compétences inadaptées...</label>
                            <br><small><strong>Performance annuelle :</strong> "Performance moyenne" ou
                                "Sous-performance"</small>
                        </td>
                        <td>
                            @if ($selectedProfile === 'sous_performeur')
                                <textarea wire:model="profiles.sous_performeur" class="form-control"></textarea>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="my-2">
            <h3>5. COMMENTAIRE DU MANAGER N+1</h3>
            <textarea @if ($this->response->user->responsable_n1 != auth()->user()->id) disabled @endif class="form-control" wire:model="comment_n1"
                name="" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="my-2">
            <h3>6. COMMENTAIRE DU MANAGER N+2</h3>
            <textarea @if ($this->response->user->responsable_n2 != auth()->user()->id) disabled @endif class="form-control" wire:model="comment_n2"
                name="" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="my-2">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Signature du supérieur hiérarchique (n + 1)</th>
                        <th>Signature du supérieur hiérarchique (n + 2)</th>
                        <th>Signature RRDCH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if ($this->response->careerComitee ? $this->response->careerComitee->signature_n1_date : '' )
                                <div class="my-1">
                                    Signature du supérieur hiérarchique (n + 1)
                                    <br>
                                    <strong>Date : </strong> Le ………/ …… / ………
                                </div>
                            @else
                                @if ($this->response->user->responsable_n1 === auth()->user()->id)
                                    <div class="my-1">
                                        <button class="btn btn-primary" wire:click="sign_n1"> Cliquez pour signer </button>
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($this->response->careerComitee ? $this->response->careerComitee->signature_n2_date : '')
                                <div class="my-1">
                                    Signature du supérieur hiérarchique (n + 2)
                                    <br>
                                    <strong>Date : </strong> Le ………/ …… / ………
                                </div>
                            @else
                                @if ($this->response->user_id == auth()->user()->id)
                                    <div class="my-1">
                                        <button class="btn btn-primary" wire:click="sign_n2"> Cliquez pour signer </button>
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($this->response->careerComitee ? $this->response->careerComitee->signature_rrdch_date : '')
                                <div class="my-1">
                                    Signature RRDCH
                                    <br>
                                    <strong>Date : </strong> Le ………/ …… / ………
                                </div>
                            @else
                                @if (auth()->user()->occupation === "rrdch")
                                    <div class="my-1">
                                        <button class="btn btn-primary" wire:click="sign_rrdch"> Cliquez pour signer </button>
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


    <div class="d-flex justify-content-end mx-2 my-3">
        <a class="btn btn-secondary rounded-pill" wire:click="previousStep">{{ __('Précédent') }}</a>
        <button class="btn btn-primary mx-2" wire:click="save"> {{ __('Sauvegarder') }} </button>
        {{-- <button class="btn btn-primary mx-2" wire:click="submit">
            {{ __('Suivant') }}
        </button> --}}
    </div>

</div>
