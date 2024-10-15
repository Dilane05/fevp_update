<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class MyCommentStep extends StepComponent
{
    public $comment;

    public $editable;

    public $response;


    public function mount()
    {
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        $this->editable = $this->state()->forStep('create-evaluation-personal_info')['editable_user'];

        if ($this->response->my_comment) {
            $this->comment = $this->response->my_comment;
        }

    }

    public function submit()
    {

        if ($this->editable == "disabled") {
            $this->nextStep();
        } else {
            $this->response->my_comment = $this->comment;
            $this->response->save();
            $this->nextStep();
        }

    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Commentaire de l\'évaluer'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.my-comment-step');
    }
}
