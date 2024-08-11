<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class PersonalInformationStep extends StepComponent
{

    public $name = "dilane";

    public function submit()
    {
        // $this->validate();

        // dd('ok');

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Personnal Information'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.personal-information-step');
    }
}
