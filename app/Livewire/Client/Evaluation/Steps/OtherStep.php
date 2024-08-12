<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class OtherStep extends StepComponent
{

    public function submit()
    {
        // $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Autres'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.other-step');
    }
}
