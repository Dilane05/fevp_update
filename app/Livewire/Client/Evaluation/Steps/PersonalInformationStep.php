<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class PersonalInformationStep extends StepComponent
{

    // public $name = "dilane";
    public $evaluation_id;
    public $response;

    public function mount($evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;
    }

    public function submit()
    {

        // Vérifier si l'utilisateur a déjà répondu à l'évaluation
        $existingResponse = ResponseEvaluation::where('evaluation_id', $this->evaluation_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingResponse) {
            // Si une réponse existe déjà, assigner l'ID à la variable response
            $this->response = $existingResponse->id;
        } else {
            // Sinon, créer une nouvelle réponse avec le statut de brouillon
            $newResponse = ResponseEvaluation::create([
                'evaluation_id' => $this->evaluation_id,
                'user_id' => auth()->id(),
                'status' => 0, // Brouillon
                // 'date' => now(),
            ]);

            // Assigner l'ID de la nouvelle réponse à la variable response
            $this->response = $newResponse->id;
        }

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Informations Personnelles'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.personal-information-step');
    }
}
