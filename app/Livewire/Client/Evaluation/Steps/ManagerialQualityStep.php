<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class ManagerialQualityStep extends StepComponent
{

    public $qualities = [
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
    ];

    public function submit()
    {
        // $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Qualité Managériale'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.managerial-quality-step');
    }
}
