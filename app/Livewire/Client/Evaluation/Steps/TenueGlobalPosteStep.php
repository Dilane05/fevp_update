<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class TenueGlobalPosteStep extends StepComponent
{
    public $keyResults = [
        ['domain' => '', 'note' => '', 'observations' => ''],
        ['domain' => '', 'note' => '', 'observations' => ''],
        ['domain' => '', 'note' => '', 'observations' => ''],
        ['domain' => '', 'note' => '', 'observations' => ''],
    ];

    public $errorsModalVisible = false;
    public $errorMessages = [];
    public $globalScore;
    public $error_fill;
    public $error_note;
    public $error_max;
    public $response;

    public $editable;

    public function mount()
    {
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        $this->editable = $this->state()->forStep('create-evaluation-personal_info')['editable_user'];

        if ($this->response->tenue_global) {
            $this->keyResults = $this->response->tenue_global;
        } else {
            $this->error_fill = "Veuillez remplir au moins une ligne du tableau.";
            $this->error_note = "La note doit être entre 0 et 1.25.";
            $this->error_max = "La note globale ne peut pas dépasser 5.";
        }

        $this->globalScore = $this->response->note_tenue_global ?? 0;

        $this->calculateGlobalScore();
    }

    public function updatedKeyResults($propertyName)
    {
        // Vérifiez si la mise à jour concerne un champ 'note'
        if (strpos($propertyName, 'keyResults.') !== false && strpos($propertyName, 'note') !== false) {
            // dd('ok');
            $this->validateNoteRange();
        }

        // Calculer la note globale après chaque mise à jour
        $this->calculateGlobalScore();
    }

    public function submit()
    {
        $validationResult = $this->validateKeyResults();

        if ($validationResult !== true) {
            $this->errorMessages = $validationResult;
            $this->errorsModalVisible = true;
            return;
        }

        if ($this->editable == "disabled") {
            $this->nextStep();
        } else {
            $this->response->tenue_global = $this->keyResults;
            $this->response->note_tenue_global = $this->globalScore;
            $this->response->save();
            $this->nextStep();
        }
    }

    private function validateKeyResults()
    {
        $errors = [];
        $hasValidLine = false;

        foreach ($this->keyResults as $result) {
            // Vérifiez les notes pour chaque ligne remplie
            if (!empty($result['domain']) && isset($result['note'])) {
                if ($result['note'] < 0 || $result['note'] > 1.25) {
                    $errors[] = $this->error_note;
                }
                $hasValidLine = true;
            }
        }

        if (!$hasValidLine) {
            $errors[] = $this->error_fill;
        }

        $this->calculateGlobalScore();

        // Vérifier si la note globale dépasse 5 après calcul
        if ($this->globalScore > 5) {
            $errors[] = $this->error_max;
        }

        return empty($errors) ? true : $errors;
    }

    private function calculateGlobalScore()
    {
        $totalScore = 0;
        $maxPossibleScore = 0;

        foreach ($this->keyResults as $result) {
            if (!empty($result['domain']) && isset($result['note'])) {
                $totalScore += (float) $result['note'];
                $maxPossibleScore += 1.25;
            }
        }

        // Vérifier la division par zéro
        if ($maxPossibleScore > 0) {
            $this->globalScore = ($totalScore / $maxPossibleScore) * 5;
        } else {
            $this->globalScore = 0; // Ou une autre valeur par défaut
        }
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Tenue globale du poste'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.tenue-global-poste-step', [
            'errorsModalVisible' => $this->errorsModalVisible,
            'errorMessages' => $this->errorMessages,
        ]);
    }
}
