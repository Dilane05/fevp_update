<?php

namespace App\Livewire\Client\Evaluation;

use Livewire\Component;
use App\Livewire\Client\Evaluation\Steps\NoteStep;
use App\Livewire\Client\Evaluation\Steps\OtherStep;
use Spatie\LivewireWizard\Components\WizardComponent;
use App\Livewire\Client\Evaluation\Steps\SanctionStep;
use App\Livewire\Client\Evaluation\Steps\BonusMalusStep;
use App\Livewire\Client\Evaluation\Steps\ValidateN1Step;
use App\Livewire\Client\Evaluation\Steps\ValidateN2Step;
use App\Livewire\Client\Evaluation\Steps\BilanResultatStep;
use App\Livewire\Client\Evaluation\Steps\TenueGlobalPosteStep;
use App\Livewire\Client\Evaluation\Steps\ManagerialQualityStep;
use App\Livewire\Client\Evaluation\Steps\PersonalInformationStep;
use App\Livewire\Client\Evaluation\Steps\ComplianceCorporateCultureStep;

class CheckoutWizardComponent extends WizardComponent
{

    public $evaluation_id;

    public function mount(string $evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;
        // dd($this->evaluation_id);
    }

    public function initialState(): array
    {
        $components = [
            'create-evaluation-personal_info',
            'create-evaluation-bilan_resultat',
            'create-evaluation-mangerial_quality',
            'create-evaluation-compliance_corporate_culture',
            'create-evaluation-bonus_malus',
            'create-evaluation-sanctions',
            'create-evaluation-others',
            'calculate-validate-n1',
            'calculate-validate-n2'
        ];

        return collect($components)->mapWithKeys(function ($component) {
            return [$component => ['evaluation_id' => $this->evaluation_id]];
        })->toArray();
    }

    public function steps(): array
    {
        return [
            PersonalInformationStep::class,
            BilanResultatStep::class,
            TenueGlobalPosteStep::class,
            ManagerialQualityStep::class,
            ComplianceCorporateCultureStep::class,
            BonusMalusStep::class,
            SanctionStep::class,
            NoteStep::class,
            OtherStep::class,
            ValidateN1Step::class,
            ValidateN2Step::class,

        ];
    }

    // public function render()
    // {
    //     return view('livewire.client.evaluation.check-wizard-component');
    // }
}
