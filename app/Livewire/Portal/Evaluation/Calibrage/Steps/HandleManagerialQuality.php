<?php

namespace App\Livewire\Portal\Evaluation\Calibrage\Steps;

use App\Models\User;

trait HandleManagerialQuality
{

    public $qualities = [
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        // Vous pouvez ajouter plus de lignes par défaut si nécessaire
    ];

    public $response;
    public $is_manager = '';
    public $totalNoteMgr = 0;
    public $globalScoreMgr = 0;
    public $editable;

    public function firstManagerialQuality()
    {

        $user = User::findOrFail($this->response->user_id);
        if ($user->type_fiche->value_manageriale <= 0) {
            $this->is_manager = "disabled";
        }else{
            $this->totalNoteMgr = $user->type_fiche->value_manageriale;
        }

        $this->qualities = $this->response->manegerial_quality;
        $this->globalScoreMgr = $this->response->note_mangeriale_quality ?? 0;
        $this->calculateglobalScoreMgr();

    }

    public function updatedQualities()
    {
        $this->calculateglobalScoreMgr();
        // dd('dd');
    }

    private function validateQualities()
    {
        $errors = [];
        $hasObservation = false;
        $cible = 0;

        foreach ($this->qualities as $result) {
            // Vérifiez que tous les détails sont remplis sauf les observations
            if (!empty($result['quality']) && !empty($result['target']) && !empty($result['realization'])) {
                if (!empty($result['observations'])) {
                    $hasObservation = true;
                }
            } else {
                $errors[] = $this->error_fill;
                break; // Afficher une seule erreur si une ligne est mal remplie
            }

            $cible += $result['target'];

            if ($result['realization'] > 100) {
                $errors[] = "Le pourcentage de réalisation ne doit pas etre supérieur à 100";
            }
        }

        if ($cible > 10) {
            $errors[] = "La cible ne doit pas etre supérieur à 10";
        }

        // Vérifiez s'il y a au moins une observation remplie
        if (!$hasObservation) {
            $errors[] = $this->error_observation;
        }

        return empty($errors) ? true : $errors;
    }

    private function calculateglobalScoreMgr()
    {
        $totalScore = 0;

        foreach ($this->qualities as $result) {
            if (!empty($result['target']) && !empty($result['realization'])) {
                $totalScore += (float) $result['target'] * ((float) $result['realization'] / 100);
            }
        }

        $this->globalScoreMgr = $totalScore;
    }
}
