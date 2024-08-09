<?php

namespace App\Livewire\Client\Dashboard;

use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Evaluation;
use App\Livewire\Portal\Trix;
use App\Models\ClientFeedback;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Traits\WithDataTable;

class Dashboard extends Component
{
    use WithDataTable;

    public $evaluation;

    #[Validate('required', message: 'Feedback is required')]
    public $client_feedback;

    public function mount()
    {
        $this->evaluation = Evaluation::orderBy('start_date', 'desc')->first();
    }

    protected $listeners = [
        Trix::EVENT_VALUE_UPDATED,
    ];

    public function trix_value_updated($value)
    {
        $this->client_feedback = $value;
    }

    public function saveFeedback()
    {
        if (!Gate::allows('survey-read')) {
            return abort(401);
        }

        $this->validate([
            'client_feedback' => 'required|min:10'
        ]);

        ClientFeedback::create([
            'feedback'=> $this->client_feedback,
            'client_id' => auth()->user()->id
        ]);

        $this->closeModalAndFlashMessage(__('Thanks for the feedback!'), 'CreateClientFeedbackModal');

        return $this->redirect(route('client.dashboard'), navigate: true);
    }

    public function clearFeedbackFields()
    {
        $this->reset([
            'client_feedback'
        ]);
    }

    public function render()
    {
        $user = auth()->user();

        $logs = AuditLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->take(10);

        return view('livewire.client.dashboard.dashboard', compact('user', 'logs'))->layout('components.layouts.client.master');
    }
}
