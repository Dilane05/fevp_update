<?php

namespace App\Livewire\Client\Dashboard;

use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Evaluation;
use App\Livewire\Portal\Trix;
use App\Models\ClientFeedback;
use App\Models\ResponseEvaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Traits\WithDataTable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class Dashboard extends Component
{
    use WithDataTable;

    public $evaluation;
    public $evaluations;


    public function mount()
    {
        $this->evaluation = Evaluation::orderBy('start_date', 'desc')->first();
        $this->evaluations = Evaluation::where('is_active', true)->get();

        $this->checkIfUserHasResponded();

    }

    public function checkIfUserHasResponded()
    {
        $userId = Auth::id();
        $evaluationIds = $this->evaluations->pluck('id');

        $response = ResponseEvaluation::whereIn('evaluation_id', $evaluationIds)
            ->where('user_id', $userId)
            // ->where('status', false)
            ->exists();

            if (!$response) {
                $this->dispatch('show-evaluation-reminder');
            }

    }


    public function checkEvaluation()
    {
        // Récupérer la dernière évaluation
        $latestEvaluation = Evaluation::latest()->first();

        if (!$latestEvaluation) {
            // Aucun évaluation trouvée
            session()->flash('error', 'Aucune évaluation disponible.');
            return;
        }

        // Vérifier si l'utilisateur fait partie des utilisateurs associés à la dernière évaluation
        $userIsPartOfEvaluation = $latestEvaluation->participants()->where('user_id', Auth::id())->exists();

        if ($userIsPartOfEvaluation) {
            // Rediriger l'utilisateur vers la page d'évaluation
            return Redirect::route('evaluations.show', $latestEvaluation->id);
        } else {
            // Afficher un message d'erreur
            session()->flash('error', 'Désole Vous ne faites pas partie de la population cible de cette évaluation.');
        }
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
        $user = auth()->user();

        $logs = AuditLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->take(10);

        return view('livewire.client.dashboard.dashboard', compact('user', 'logs'))->layout('components.layouts.client.dashboard');
    }
}
