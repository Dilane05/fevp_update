<?php

namespace App\Livewire\Client\Evaluation\Steps;

use App\Models\User;
use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class ManagerialQualityStep extends StepComponent
{
    public $qualities = [
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        // Vous pouvez ajouter plus de lignes par défaut si nécessaire
    ];

    public $errorsModalVisible = false;
    public $errorMessages = [];
    public $globalScore;
    public $error_fill;
    public $error_observation;
    public $response;
    public $is_manager = '';
    public $totalNote = 0;

    public $editable;

    public function mount()
    {

        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        $this->editable = $this->state()->forStep('create-evaluation-personal_info')['editable_user'];

        $user = User::findOrFail($this->response->user_id);
        if ($user->type_fiche->value_manageriale <= 0) {
            $this->is_manager = "disabled";
        }else{
            $this->totalNote = $user->type_fiche->value_manageriale;
        }

        if ($this->response->manegerial_quality) {
            // dd('ok');
            $this->qualities = $this->response->manegerial_quality;
            $this->globalScore = $this->response->note_mangeriale_quality ?? 0;
            $this->calculateGlobalScore();
        } else {
            $this->error_fill = "Veuillez remplir tous les détails d'une ligne.";
            $this->error_observation = "Veuillez remplir au moins une observation.";
        }
    }

    public function addRow()
    {
        $this->qualities[] = ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''];
    }

    public function updatedQualities()
    {
        $this->calculateGlobalScore();
    }

    public function submit()
    {
        if($this->response->user->type_fiche->value_manageriale <= 0){
            // Passer à l'étape suivante
            $this->nextStep();
        }else{
            $validationResult = $this->validateQualities();

            if ($validationResult !== true) {
                $this->errorMessages = $validationResult;
                $this->errorsModalVisible = true;
                return;
            }

            // Calculer la note globale avant de passer à l'étape suivante
            $this->calculateGlobalScore();
            // dd($this->qualities);

            if ($this->editable == "disabled") {
                $this->nextStep();
            } else {
                $this->response->manegerial_quality = $this->qualities;
                $this->response->note_mangeriale_quality = $this->globalScore;
                $this->response->save();
                $this->nextStep();
            }

        }
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
            $errors[] = "La somme des cibles ne doit pas etre supérieur à 10";
        }

        // Vérifiez s'il y a au moins une observation remplie
        if (!$hasObservation) {
            $errors[] = $this->error_observation;
        }

        return empty($errors) ? true : $errors;
    }

    private function calculateGlobalScore()
    {
        $totalScore = 0;

        foreach ($this->qualities as $result) {
            if (!empty($result['target']) && !empty($result['realization'])) {
                $totalScore += (float) $result['target'] * ((float) $result['realization'] / 100);
            }
        }

        $this->globalScore = $totalScore;
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
        return view('livewire.client.evaluation.steps.managerial-quality-step', [
            'errorsModalVisible' => $this->errorsModalVisible,
            'errorMessages' => $this->errorMessages,
        ]);
    }
}
