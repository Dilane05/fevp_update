<div>
    @include('livewire.portal.evaluation.calibrage.error-modal')
    <!-- Wizard Header -->
    <nav class="nav my-2 shadow rounded" aria-label="Tabs">
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 1 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(1)">
            {{ __('BILAN DES RESULTATS >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 2 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(2)">
            {{ __('TENUE GLOBALE DU POSTE >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 3 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(3)">
            {{ __('QUALITE MANAGERIALES >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 4 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(4)">
            {{ __('CONFORMITE A LA CULTURE D\'ENTREPRISE >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 5 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(5)">
            {{ __('BONUS ET MALUS >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 6 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(6)">
            {{ __('SANCTIONS >') }}
        </div>
        <div class="nav-link border-0 mx-2 text-primary d-inline-flex align-items-center py-2 px-1 fw-bold text-sm {{ $step == 7 ? 'text-info fw-bold' : 'text-gray-500' }}"
            style="font-size: 13px; cursor: pointer;" wire:click="setStep(7)">
            {{ __('Notes') }}
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
            @include('livewire.portal.evaluation.calibrage.steps.bilan-result')
        @elseif($step == 2)
            @include('livewire.portal.evaluation.calibrage.steps.tenue-global')
        @elseif($step == 3)
            @include('livewire.portal.evaluation.calibrage.steps.managerial-quality')
        @elseif($step == 4)
            @include('livewire.portal.evaluation.calibrage.steps.compliance-corporate')
        @elseif($step == 5)
            @include('livewire.portal.evaluation.calibrage.steps.bonus-malus')
        @elseif($step == 6)
            @include('livewire.portal.evaluation.calibrage.steps.sanction')
        @elseif($step == 7)
            @include('livewire.portal.evaluation.calibrage.steps.note')
        @endif

        <div class="d-flex justify-content-end my-2">
            @if ($step !== 1)
                <button type="button" class="btn btn-secondary mx-2"
                    wire:click="prevStep">{{ __('Précédent') }}</button>
            @endif

            @if ($step === 1)
                <button type="button" class="btn btn-info mx-2"
                    wire:click="submitBilanResultat">{{ __('Sauvegarder') }}</button>
            @elseif ($step === 2)
                <button type="button" class="btn btn-info mx-2"
                    wire:click="submitTenueGlobal">{{ __('Sauvegarder') }}</button>
            @elseif ($step === 3)
                <button type="button" class="btn btn-info mx-2"
                    wire:click="submitManagerialQuality">{{ __('Sauvegarder') }}</button>
            @elseif ($step === 4)
                <button type="button" class="btn btn-info mx-2"
                    wire:click="submitComplianceCorporate">{{ __('Sauvegarder') }}</button>
            @elseif ($step === 5)
                <button type="button" class="btn btn-info mx-2"
                    wire:click="submitBonusMalus">{{ __('Sauvegarder') }}</button>
            @elseif ($step === 6)
                <button type="button" class="btn btn-info mx-2"
                    wire:click="submitSanction">{{ __('Sauvegarder') }}</button>
            @endif

            <button type="button" class="btn btn-primary" wire:click="nextStep">{{ __('Suivant') }}</button>
        </div>

        <div class="chart-container">
            <!-- Canvas pour le diagramme radar -->
            <canvas id="notesRadarChart"></canvas>
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

        .chart-container {
            width: 55%;  /* Réduire la largeur du conteneur */
            margin: 20px auto;
            /* background-color: #fff; */
            /* padding: 10px;  Moins de padding */
            border-radius: 10px;  /* Angles légèrement plus arrondis */
        }

        canvas {
            max-width: 100%;  /* S'assurer que le canvas occupe moins de place */
            height: 400px;  /* Hauteur plus réduite pour un affichage compact */
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

    <script>
        // Quand le document est chargé, on crée le diagramme radar

        var percentages = [
            ({{ $note_bilan_resultat }} / {{ $total_bilan_resultat }}) * 100,
            ({{ $note_tenue_global_poste }} / {{ $total_tenue_global_poste }}) * 100,
            ({{ $note_quality_managerial }} / {{ $total_quality_managerial }}) * 100,
            ({{ $note_compliance_corporate }} / {{ $total_compliance_corporate }}) * 100,
        ];

        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('notesRadarChart').getContext('2d');
            var radarChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: [
                        'Bilan Résultat',
                        'Tenue globale du poste',
                        'Qualité Managériale',
                        'Conformité à la culture d\'entreprise',
                    ],
                    datasets: [{
                        label: 'Forces et Faiblesses',
                        data: percentages, // Les pourcentages calculés
                        backgroundColor: 'rgba(173, 216, 230, 0.15)', // Bleu très doux et transparent
                        borderColor: 'rgba(0, 123, 255, 0.5)', // Douce couleur bleue
                        borderWidth: 1.5,
                        pointBackgroundColor: 'rgba(0, 123, 255, 0.7)', // Points plus subtils
                        pointBorderColor: '#ffffff',
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: 'rgba(0, 123, 255, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        r: {
                            angleLines: {
                                color: 'rgba(0, 0, 0, 0.05)' // Lignes douces
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)', // Grille très légère
                            },
                            suggestedMin: 0,
                            suggestedMax: 100 // Les pourcentages vont de 0 à 100
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Masquer la légende pour un design épuré
                        }
                    }
                }
            });
        });

    </script>

</div>
