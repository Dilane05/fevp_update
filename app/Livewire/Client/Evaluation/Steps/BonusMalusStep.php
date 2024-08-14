<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class BonusMalusStep extends StepComponent
{
    public $projects = [
        ['description' => '', 'note' => ''],
        ['description' => '', 'note' => ''],
    ];

    public $errorMessages = [];
    public $totalBonusMalus = 0;
    public $errorsModalVisible = false;
    public$response;

    public function mount()
    {
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        if ($this->response->bonus_malus) {
            $this->projects = $this->response->bonus_malus;
        }

        $this->totalBonusMalus = $this->response->note_bonus_malus ?? 0;

    }

    public function updatedProjects($propertyName)
    {
        // Validate each project to ensure if a note is provided, a description is also provided
        $this->validateProjects();
    }

    public function submit()
    {
        $validationResult = $this->validateProjects();
        if ($validationResult !== true) {
            $this->errorMessages = $validationResult;
            $this->errorsModalVisible = true;
            return;
        }

        $this->response->bonus_malus = $this->projects;
        $this->response->note_bonus_malus = $this->totalBonusMalus;
        $this->response->save();

        // Proceed to the next step
        $this->nextStep();
    }

    private function validateProjects()
    {
        $errors = [];
        $isValid = true;

        foreach ($this->projects as $index => $project) {
            // Check if a note is provided and if the corresponding description is missing
            if (!empty($project['note']) && empty($project['description'])) {
                $isValid = false;
                $errors[] = "La description pour le projet " . ($index + 1) . " est obligatoire si une note est fournie.";
            }

            // Check if the note is out of range
            if (!empty($project['note']) && ($project['note'] < -2.5 || $project['note'] > 2.5)) {
                $isValid = false;
                $errors[] = "La note pour le projet " . ($index + 1) . " doit être entre -2,5 et 2,5.";
            }
        }

        // Calculate the total score
        $this->totalBonusMalus = array_sum(array_column($this->projects, 'note'));

        return $isValid ? true : $errors;
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
