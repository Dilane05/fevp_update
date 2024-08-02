<div>
    <x-alert />
    <!-- Wizard Header -->
    <nav class="nav my-2 shadow rounded" aria-label="Tabs">
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 1 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(1)">
            {{ __('BILAN DES RESULTATS >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 2 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(2)">
            {{ __('TENUE GLOBALE DU POSTE >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 3 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(3)">
            {{ __('QUALITE MANAGERIALES >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 4 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(4)">
            {{ __('CONFORMITE A LA CULTURE D\'ENTREPRISE >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 5 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(5)">
            {{ __('BONUS ET MALUS >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 6 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(6)">
            {{ __('SANCTIONS >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 7 ? 'text-info fw-bold' : 'text-gray-500' }}" style="font-size: 13px; cursor: pointer;" wire:click="setStep(7)">
            {{ __('AUTRES') }}
        </div>
    </nav>


    {{-- <div class="wizard-header d-flex justify-content-around mb-4">
        <button type="button" class="btn btn-link rounded" wire:click="setStep(1)">
            <h6 class="{{ $step == 1 ? 'active-step' : 'inactive-step' }}">{{ __('BILAN DES RESULTATS') }}</h6>
        </button>
        <button type="button" class="btn btn-link" wire:click="setStep(2)">
            <h6 class="{{ $step == 2 ? 'active-step' : 'inactive-step' }}">{{ __('TENUE GLOBALE DU POSTE') }}</h6>
        </button>
        <button type="button" class="btn btn-link" wire:click="setStep(3)">
            <h6 class="{{ $step == 3 ? 'active-step' : 'inactive-step' }}">{{ __('QUALITE MANAGERIALES') }}</h6>
        </button>
        <button type="button" class="btn btn-link" wire:click="setStep(4)">
            <h6 class="{{ $step == 4 ? 'active-step' : 'inactive-step' }}">
                {{ __('CONFORMITE A LA CULTURE D\'ENTREPRISE') }}</h6>
        </button>
        <button type="button" class="btn btn-link" wire:click="setStep(5)">
            <h6 class="{{ $step == 5 ? 'active-step' : 'inactive-step' }}">{{ __('BONUS ET MALUS') }}</h6>
        </button>
        <button type="button" class="btn btn-link" wire:click="setStep(6)">
            <h6 class="{{ $step == 6 ? 'active-step' : 'inactive-step' }}">{{ __('SANCTIONS') }}</h6>
        </button>
        <button type="button" class="btn btn-link" wire:click="setStep(7)">
            <h6 class="{{ $step == 7 ? 'active-step' : 'inactive-step' }}">{{ __('AUTRES') }}</h6>
        </button>
    </div> --}}

    <div class="shadow p-2 rounded">
        @if ($step == 1)
            <div class="">

                <h4> I-BILAN DES RESULTATS </h4>

                <p>Sur Suivi des réalisations de la période d’évaluation (rendement et efficacité)</p>
                <div class="table-container">
                    {{-- <div class="d-flex justify-content-end my-2">
                <button class="btn btn-primary btn-add-row" wire:click="addRow">Ajouter une ligne</button>
            </div> --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">N°</th>
                                <th rowspan="2">Objectifs fixés</th>
                                <th rowspan="2">Indicateurs</th>
                                <th rowspan="2">Coef</th>
                                <th colspan="2">Cible</th>
                                <th colspan="2">Résultats</th>
                                <th rowspan="2">Note</th>
                                <th rowspan="2">Observations</th>
                                {{-- <th rowspan="2">Actions</th> --}}
                            </tr>
                            <tr>
                                <th>%</th>
                                <th>nb</th>
                                <th>%</th>
                                <th>nb</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.objectif"></td>
                                    <td>
                                        <select class="form-select" wire:model="rows.{{ $index }}.indicateur">
                                            <option value="">Selectionner un  Indicateur</option>
                                            @foreach ($indicators as $indicator)
                                                <option value="{{ $indicator }}"> {{ __('Indicateur') }} {{ $indicator }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.coef">
                                    </td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.cible_pct"></td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.cible_nb"></td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.resultat_pct"></td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.resultat_nb"></td>
                                    <td>
                                        <input type="text" class="form-control" disabled
                                            wire:model="rows.{{ $index }}.note">
                                    </td>
                                    <td><input type="text" class="form-control"
                                            wire:model="rows.{{ $index }}.observations"></td>
                                    {{-- <td class="text-center">
                                <a href='#' wire:click.prevent="removeRow({{ $index }})" data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                    <svg class="icon icon-xs text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12" class="text-center fs-4 fw-bold">
                                    @if (empty($rows))
                                        Veuillez remplir le tableau
                                    @endif
                                </td>
                            </tr>
                            @if (!empty($errorMessages))
                                <tr>
                                    <td colspan="12" class="text-center text-danger">
                                        @foreach ($errorMessages as $message)
                                            <p>{{ $message }}</p>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                    {{-- <div class="d-flex justify-content-end my-2">
                <button class="btn btn-primary btn-add-row" wire:click="addRow">Ajouter une ligne</button>
            </div> --}}
                    <p><strong>NB:</strong> - Si la cible d'un objectif est en pourcentage mettre dans la 1ère colonne,
                        si
                        elle
                        est en chiffre mettre dans la 2ème colonne.<br>
                        - Idem pour les résultats.</p>
                </div>

                <button class="btn btn-danger" wire:click="validateData">CLICK</button>
            </div>
        @elseif($step == 2)
            <div class="">
                <h4> II- TENUE GLOBALE DU POSTE </h4>

                <p class="mb-4">
                    Veuillez choisir au minimum 02 DCR dans la liste déroulante et leur attribuer une note comprise
                    entre 0
                    et
                    1,25.
                    (La rubrique permet d’apprécier les autres Domaines Clés de Résultat (DCR) non pris en compte dans
                    les
                    objectifs.
                    Les DCR à évaluer dans ce cas doivent inclure des aspects sur lesquels les performances ont été
                    bonnes
                    et
                    des aspects sur lesquels les performances n’ont pas été satisfaisantes pour des soucis d’équilibre.)
                </p>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Domaines Clés de Resultats</th>
                            <th scope="col">Note</th>
                            <th scope="col">Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keyResults as $index => $result)
                            <tr>
                                <td>
                                    <input type="text" wire:model="keyResults.{{ $index }}.domain"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="text" wire:model="keyResults.{{ $index }}.note"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="text" wire:model="keyResults.{{ $index }}.observations"
                                        class="form-control">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center fw-bold fs-3">Veuillez remplir le tableau</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        @elseif($step == 3)
            <div class="">

                <h4> III- QUALITE MANAGERIALES </h4>
                <p>
                    Veuillez renseigner la cible et le taux de réalisation à chaque rubrique, Uniquement pour les "Chefs
                    Service" et les "Fonctions spécifiques"
                </p>

                <div class="container mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2" class="align-middle">Qualités Managériales</th>
                                <th scope="col" colspan="3" class="text-center">Niveau de performance (3)</th>
                            </tr>
                            <tr>
                                <th scope="col">Cible</th>
                                <th scope="col">%Réal</th>
                                <th scope="col">Observations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qualities as $index => $quality)
                                <tr>
                                    <td>
                                        <input type="text" wire:model="qualities.{{ $index }}.quality"
                                            class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model="qualities.{{ $index }}.target"
                                            class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model="qualities.{{ $index }}.realization"
                                            class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model="qualities.{{ $index }}.observations"
                                            class="form-control">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center fs-4 fw-bold">Veuillez remplir le tableau</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        @elseif($step == 4)
            <div class="">
                <h4> IV- CONFORMITE A LA CULTURE D'ENTREPRISE (sur 15) / </h4>

                <p>Mettre une croix dans la case correspondante pour chaque élément </p>

                <div class="mt-4" style="overflow-x: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">Les éléments essentiels qui traduisent l'ADN
                                    Cadyst:
                                    Excellence Performance Reputation</th>
                            </tr>
                            <tr>
                                <th rowspan="3" class="text-center mt-5" class="align-middle">"Les éléments
                                    essentiels
                                    qui
                                    traduisent l'ADN Cadyst:
                                    Excellence Performance Reputation"
                                </th>
                                <th colspan="5" class="text-center">Niveau d'atteinte</th>
                            </tr>
                            <tr>
                                <th>a- Jamais 0%</th>
                                <th>b- Rarement 25%</th>
                                <th>c- Souvent 50%</th>
                                <th>d- Très souvent 75%</th>
                                <th>e- Toujours 100%</th>
                            </tr>
                            <tr>
                                <th>0</th>
                                <th>0.75</th>
                                <th>1.5</th>
                                <th>2.25</th>
                                <th>3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($performanceCriteria as $index => $criteria)
                                <tr>
                                    <td class="criteria-cell">{{ $criteria['criteria'] }}</td>
                                    @foreach ($criteria['scores'] as $scoreIndex => $score)
                                        <td>
                                            <input type="text"
                                                wire:model="performanceCriteria.{{ $index }}.scores.{{ $scoreIndex }}"
                                                class="form-control">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-center">Veuillez remplir le tableau 0/15</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        @elseif($step == 5)
            <div class="">
                <h4> V- BONUS ET MALUS </h4>

                <div class=" mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Mentionner tout fait marquant/ tout projet mené
                                    au
                                    cours
                                    de la période évaluée et leur attribuer une note comprise entre -2,5 et 2,5</th>
                                <th class="text-center">[-2,5;2,5]</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $index => $project)
                                <tr>
                                    <td colspan="2">
                                        <input type="text" wire:model="projects.{{ $index }}.description"
                                            class="form-control" placeholder="Description ">
                                    </td>
                                    <td>
                                        <input type="number" wire:model="projects.{{ $index }}.note"
                                            class="form-control" min="-2.5" max="2.5" step="0.1"
                                            placeholder="">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center">Le Total Bonus et Malus est 0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        @elseif($step == 6)
            <div class="">
                <h4> VI. SANCTIONS </h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">En cas de sanction, veuillez saisir le nombre
                                correspondant
                            </th>
                        </tr>
                        <tr>
                            <th>Type de Sanction</th>
                            <th>Nbre(s)</th>
                            <th>Sanction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sanctions as $index => $sanction)
                            <tr>
                                <td>{{ $sanction['type'] }}</td>
                                <td>
                                    <input type="number" wire:model="sanctions.{{ $index }}.number"
                                        class="form-control" min="0">
                                </td>
                                <td>
                                    <input type="text" wire:model="sanctions.{{ $index }}.sanction"
                                        class="form-control">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">Veuillez remplir le tableau</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        @endif

        <div class="d-flex justify-content-end my-2">
            @if ($step !==1)
                <button type="button" class="btn btn-secondary mx-2" wire:click="prevStep">{{ __('Précédent') }}</button>
            @endif
            <button type="button" class="btn btn-primary" wire:click="nextStep">{{ __('Suivant') }}</button>
        </div>

    </div>
    <style>
        /* .criteria-cell {
            max-width: 80px;
            word-wrap: break-word;
        } */

        .wizard-header {
            position: relative;
            align-items: center;
        }

        .wizard-header button {
            flex: 1;
            height: 100%;
        }

        .wizard-header h6 {
            margin: 0;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .active-step {
            background-color: #0d6efd;
            color: white;
        }

        .inactive-step {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .wizard-header h6:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('validation-errors', event => {
                let errors = event.detail.errors.join('\n');
                Swal.fire({
                    title: 'Erreurs de validation',
                    text: errors,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
</div>
