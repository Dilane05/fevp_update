<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class BonusMalusStep extends StepComponent
{

    public $projects = [
        ['description' => '', 'note' => ''],
        ['description' => '', 'note' => ''],
    ];

    public function submit()
    {
        // $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Bonus Malus'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.bonus-malus-step');
    }
}
