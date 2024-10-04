<?php

namespace App\Livewire\Portal\Evaluation\Calibrage\Steps;

use App\Models\User;

trait HandleComplianceCorporateCulture
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

    public $performanceCriteriaRes = [
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

    public $globalScoreCpl;

    public function firstComplianceCorporate()
    {

        $this->performanceCriteria = $this->response->compliance_corporate;

        $this->globalScoreCpl = $this->response->note_compliance_resultat ?? 0;

    }

    public function checkComplianceCorporate()
    {
        // dd('ok');
        if ($this->calibrage->compliance_corporate) {
            $this->calibrageMountingComplianceCorporate();
        } else {
            $this->firstComplianceCorporate();
        }
    }

    public function calibrageMountingComplianceCorporate()
    {
        $this->performanceCriteria = $this->calibrage->compliance_corporate;
        $this->performanceCriteriaRes = $this->response->compliance_corporate;
        $this->globalScoreMgr = $this->calibrage->compliance_corporate ?? 0;
        // dd($this->performanceCriteria);
        $this->calculateGlobalScore();
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
            $this->globalScoreCpl = (array_sum(array_column($this->performanceCriteria, 'selectedScore')) / $totalPossibleScore) * $this->total;
        } else {
            $this->globalScoreCpl = 0; // Valeur par défaut si validation échoue
        }

        return $allChecked ? true : $errors;
    }

    public function updatedPerformanceCriteria()
    {
        $this->validateCriteria();
    }

    public function submitComplianceCorporate()
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
            $this->calibrage->compliance_corporate = $this->performanceCriteria;
            $this->calibrage->note_compliance_resultat = $this->globalScoreCpl;
            $this->calibrage->save();
            $this->nextStep();
        }
    }
}
