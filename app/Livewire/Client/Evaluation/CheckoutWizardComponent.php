<?php

namespace App\Livewire\Client\Evaluation;

use App\Livewire\Client\Evaluation\Steps\BilanResultatStep;
use Livewire\Component;
use Spatie\LivewireWizard\Components\WizardComponent;
use App\Livewire\Client\Evaluation\Steps\PersonalInformationStep;

class CheckoutWizardComponent extends WizardComponent
{

    public function steps(): array
    {
        return [
            PersonalInformationStep::class,
            BilanResultatStep::class,

        ];
    }

    // public function render()
    // {
    //     return view('livewire.client.evaluation.check-wizard-component');
    // }
}
