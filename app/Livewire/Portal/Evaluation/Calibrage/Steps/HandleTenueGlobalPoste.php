<?php

namespace App\Livewire\Portal\Evaluation\Calibrage\Steps;

use App\Models\User;


trait HandleTenueGlobalPoste
{

    public $keyResults = [
        ['domain' => '', 'note' => '', 'observations' => ''],
        // ['domain' => '', 'note' => '', 'observations' => ''],
        // ['domain' => '', 'note' => '', 'observations' => ''],
        // ['domain' => '', 'note' => '', 'observations' => ''],
    ];

    public $keyResultsRes = [
        ['domain' => '', 'note' => '', 'observations' => ''],
        // ['domain' => '', 'note' => '', 'observations' => ''],
        // ['domain' => '', 'note' => '', 'observations' => ''],
        // ['domain' => '', 'note' => '', 'observations' => ''],
    ];

    public $globalScore;
    public $error_fill;
    public $error_note;
    public $error_max;

    public function firstTenueGlobalBilan()
    {
        $this->keyResults = $this->response->tenue_global;

        $this->globalScore = $this->response->note_tenue_global ?? 0;

        $this->calculateGlobalScore();
    }

    public function checkTenueGlobal()
    {
        if ($this->calibrage->tenue_global) {
            $this->calibrageMountingTenueGlobal();
        } else {
            $this->firstTenueGlobalBilan();
        }
    }

    public function calibrageMountingTenueGlobal()
    {
        $this->keyResults = $this->calibrage->tenue_global;
        $this->keyResultsRes = $this->response->tenue_global;
        $this->globalScore = $tzhis->calibrage->note_tenue_global ?? 0;
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

    public function submitTenueGlobal()
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
            $this->calibrage->tenue_global = $this->keyResults;
            $this->calibrage->note_tenue_global = $this->globalScore;
            $this->calibrage->save();
            $this->nextStep();
        }

    }

}
