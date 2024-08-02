<?php

namespace App\Livewire\Portal\Feedback;

use App\Livewire\Traits\WithDataTable;
use App\Models\ClientFeedback;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithDataTable;

    public $feedback;

    public function initData($feedback_id)
    {
        $this->feedback = ClientFeedback::findOrFail($feedback_id);
    }

    public function delete()
    {
        if (!Gate::allows('survey-delete')) {
            return abort(401);
        }

        if (!empty($this->feedback)) {

            $this->feedback->delete();
        }

        $this->clearFields();
        $this->closeModalAndFlashMessage(__('client Feedback successfully deleted!'), 'DeleteModal');
    }

    public function clearFields()
    {
        $this->reset([
            'feedback',
        ]);
    }

    public function render()
    {
        if (!Gate::allows('survey-read')) {
            return abort(401);
        }

        $feedbacks =  ClientFeedback::search($this->query)->with(['client'])->paginate($this->perPage);

        return view('livewire.portal.feedback.index', compact('feedbacks'))->layout('components.layouts.dashboard');
    }
}
