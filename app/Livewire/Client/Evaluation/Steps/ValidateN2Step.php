<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class ValidateN2Step extends StepComponent
{

    public $totalBonusMalus = 0;
    public $response, $comment;

    public $editable;

    public function mount()
    {
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        $this->comment = $this->response->comment_n2 ? $this->response->comment_n2 : '';

        if (auth()->user()->id != $this->response->user->responsable_n2) {
            $this->editable = 'disabled';
        }

    }

    public function submit()
    {

        $this->nextStep();
    }

    public function save()
    {

        if ($this->response->user->responsable_n1 == auth()->user()->id) {
            if (!$this->response->is_n2) {
                $this->response->is_n2 = 1;
                $this->response->date_n2 = now();
                $this->response->comment_n2 = $this->comment;
                $this->response->is_editable = 0;

                $this->response->save();

                session()->flash('success', 'Commentaire et Appréciation Soumis avec succès.');
            }
        }
    }


    public function stepInfo(): array
    {
        return [
            'label' => __('Section N+2'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.validation-n2-step');
    }
}
