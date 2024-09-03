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
    public $response_out;
    public $response;
    public $editable_user;
    public $editable_all;

    public function mount($evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;

        $this->response = request()->query('responseId');
        // dd($this->response);

        if ($this->response) {
            $this->response_out = ResponseEvaluation::find($this->response);
            if (!$this->response_out) {
                session()->flash('error', 'Réponse introuvable.');
                return redirect()->route('client.evaluation.index', $evaluation_id);
            }
        } else {

            $this->response_out = null;
        }
    }


    public function submit()
    {

        // Vérifier si l'utilisateur a déjà répondu à l'évaluation
        if ($this->response_out) {
            $this->nextStep();
        } else {
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

            $response = ResponseEvaluation::findOrFail($this->response);
            // dd($this->response);
            if($response->is_editable == 0)
            {
                $this->editable_user = "disabled";
            }

            $this->nextStep();
        }
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
        if ($this->response_out) {
            $user = $this->response_out->user;
        } else {
            $user = auth()->user();
        }
        return view('livewire.client.evaluation.steps.personal-information-step', compact('user'));
    }
}
