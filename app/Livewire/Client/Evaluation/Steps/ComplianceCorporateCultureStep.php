<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class ComplianceCorporateCultureStep extends StepComponent
{


    public $performanceCriteria = [
        [
            'criteria' => 'Le respect des règles: travaille selon les règles de l\'art du métier (normes, procédures, instructions de travail…)',
            'scores' => ['', '', '', '', '']
        ],
        [
            'criteria' => 'Le respect des engagements: (Ex: Tâche à faire, Délais convenus…)',
            'scores' => ['', '', '', '', '']
        ],
        [
            'criteria' => 'Un travail de qualité au 1er coup: (rigueur, exactitude, précision)',
            'scores' => ['', '', '', '', '']
        ],
        [
            'criteria' => 'Propreté/Hygiène: (Environnement de travail propre, EPI, Vêtements, Véhicules…)',
            'scores' => ['', '', '', '', '']
        ],
    ];

    public function submit()
    {
        // $this->validate();

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Conformité à la culture d\'entreprise'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.compliance-corporate-culture-step');
    }
}
