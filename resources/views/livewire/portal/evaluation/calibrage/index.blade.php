<div>
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
            @include('livewire.portal.evaluation.calibrage.steps.bilan-result')
        @elseif($step == 2)
            @include('livewire.portal.evaluation.calibrage.steps.tenue-global')
        @elseif($step == 3)

        @elseif($step == 4)

        @elseif($step == 5)

        @elseif($step == 6)
        @endif

        <div class="d-flex justify-content-end my-2">
            @if ($step !== 1)
                <button type="button" class="btn btn-secondary mx-2"
                    wire:click="prevStep">{{ __('Précédent') }}</button>
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
</div>
