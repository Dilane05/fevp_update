<?php

namespace App\Livewire\Client\Evaluator;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ResponseEvaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Index extends Component
{

    public $search = '';
    public $perPage = 9;

    public function startEvaluation($responseId)
    {
        $response = ResponseEvaluation::findOrFail($responseId);
        $evaluation = Evaluation::findOrFail($response->evaluation->id);

        $user = Auth::user();

        $userIsEvaluator = ResponseEvaluation::whereHas('user', function ($query) use ($user) {
            $query->where('responsable_n1', $user->id)
                ->orWhere('responsable_n2', $user->id);
        })->exists();

        if (!$userIsEvaluator) {
            session()->flash('error', 'Vous ne faites pas partie de cette évaluation.');
            return;
        }

        if (!$evaluation->is_active) {
            session()->flash('error', 'Cette évaluation est soit clôturée, soit inactive.');
            return;
        }

        // Rediriger avec le code de l'évaluation et l'ID de la réponse (optionnel)
        return Redirect::route('client.evaluation.index', ['code' => $evaluation->code, 'responseId' => $responseId]);
    }

    public function render()
    {

        $user = Auth::user();
        $responseEvaluations = ResponseEvaluation::whereHas('user', function ($query) use ($user) {
            $query->where('responsable_n1', $user->id)
                ->orWhere('responsable_n2', $user->id);
        })
            ->paginate($this->perPage);

        $response = ResponseEvaluation::find(1);

        // dd($evaluations);

        // dd($evaluations);

        return view('livewire.client.evaluator.index', compact('responseEvaluations'))->layout('components.layouts.client.dashboard');
    }
}
