<?php

namespace App\Livewire\Client\Evaluation;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ResponseEvaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Index extends Component
{

    // public $evaluations = [];
    public $search = '';
    public $perPage = 9;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // Charger les évaluations disponibles
        // $this->evaluations = Evaluation::all();
    }

    public function startEvaluation($evaluationId)
    {
        $evaluation = Evaluation::findOrFail($evaluationId);
        $userIsPartOfEvaluation = $evaluation->participants()->where('user_id', Auth::id())->exists();

        if (!$userIsPartOfEvaluation) {
            session()->flash('error', 'Vous ne faites pas partie de cette évaluation.');
            return;
        }

        if (!$evaluation->is_active) {
            session()->flash('error', 'Cette évaluation est soit clôturée, soit inactive.');
            return;
        }

        $response = ResponseEvaluation::where('evaluation_id', $evaluationId)
            ->where('user_id', Auth::id())
            ->first();

        if ($response) {
            return Redirect::route('client.evaluation.index', $evaluation->code);
        }

        return Redirect::route('client.evaluation.index', $evaluation->code);

    }

    public function render()
    {

        $evaluations = Evaluation::query()
            ->where('code', 'like', '%' . $this->search . '%')
            ->orWhere('title', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy('start_date', 'desc')
            ->paginate($this->perPage);
        return view('livewire.client.evaluation.index', compact('evaluations'))->layout('components.layouts.client.dashboard');
    }
}
