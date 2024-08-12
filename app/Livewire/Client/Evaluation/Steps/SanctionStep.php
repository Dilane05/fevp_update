<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class SanctionStep extends StepComponent
{

    public $sanctions = [
        ['type' => 'Nombre d\'avertissement (s)', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de blâme (s)', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de mise à pied de 1 à 3 jours', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de mise à pied de 4 à 5 jours', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de mise à pied de 6 à 8 jours', 'number' => '', 'sanction' => ''],
    ];

    public function submit()
    {
        // $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Sanctions'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.sanction-step');
    }
}
