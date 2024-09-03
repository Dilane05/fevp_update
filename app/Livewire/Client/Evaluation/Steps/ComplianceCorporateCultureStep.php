<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class ComplianceCorporateCultureStep extends StepComponent
{
    public $total = 15;

    public $editable;

    public $performanceCriteria = [
        [
            'criteria' => 'Le respect des règles: travaille selon les règles de l\'art du métier (normes, procédures, instructions de travail…)',
            'selectedScore' => null
        ],
        [
            'criteria' => 'Le respect des engagements: (Ex: Tâche à faire, Délais convenus…)',
            'selectedScore' => null
        ],
        [
            'criteria' => 'Un travail de qualité au 1er coup: (rigueur, exactitude, précision)',
            'selectedScore' => null
        ],
        [
            'criteria' => 'Propreté/Hygiène: (Environnement de travail propre, EPI, Vêtements, Véhicules…)',
            'selectedScore' => null
        ],
    ];

    public $errorMessages = [];
    public $globalScore;
    public $errorsModalVisible = false;
    public $response;

    public function mount()
    {
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        $this->editable = $this->state()->forStep('create-evaluation-personal_info')['editable_user'];

        if ($this->response->compliance_corporate) {
            $this->performanceCriteria = $this->response->compliance_corporate;
        }

        $this->globalScore = $this->response->note_compliance_resultat ?? 0;
    }

    public function updatedPerformanceCriteria()
    {
        $this->validateCriteria();
    }

    public function submit()
    {
        $validationResult = $this->validateCriteria();
        if ($validationResult !== true) {
            $this->errorMessages = $validationResult;
            $this->errorsModalVisible = true;
            return;
        }

        if ($this->editable == "disabled") {
            $this->nextStep();
        } else {
            $this->response->compliance_corporate = $this->performanceCriteria;
            $this->response->note_compliance_resultat = $this->globalScore;
            $this->response->save();
            $this->nextStep();
        }

    }

    private function validateCriteria()
    {
        $errors = [];
        $allChecked = true;

        foreach ($this->performanceCriteria as $criteria) {
            if (is_null($criteria['selectedScore'])) {
                $allChecked = false;
                $errors[] = "Tous les critères doivent être évalués.";
                break;
            }
        }

        // Calculer la note globale seulement si toutes les cases sont cochées
        if ($allChecked) {
            $totalPossibleScore = 12; // La somme maximale des valeurs des cases sélectionnées
            $this->globalScore = (array_sum(array_column($this->performanceCriteria, 'selectedScore')) / $totalPossibleScore) * $this->total;
        } else {
            $this->globalScore = 0; // Valeur par défaut si validation échoue
        }

        return $allChecked ? true : $errors;
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
