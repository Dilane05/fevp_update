<?php

namespace App\Livewire\Portal\Evaluation\Calibrage\Steps;

trait HandleBonusMalus
{

    public $projects = [
        ['description' => '', 'note' => ''],
        ['description' => '', 'note' => ''],
    ];

    public $totalBonusMalus = 0;

    public function firstBonusMalus()
    {
        $this->projects = $this->response->bonus_malus;
        $this->totalBonusMalus = $this->response->note_bonus_malus ?? 0;
    }

    public function updatedProjects($propertyName)
    {
        // Validate each project to ensure if a note is provided, a description is also provided
        $this->validateProjects();
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

}
