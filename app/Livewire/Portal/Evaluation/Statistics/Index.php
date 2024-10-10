<?php

namespace App\Livewire\Portal\Evaluation\Statistics;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Evaluation;
use App\Exports\EvaluationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $occupation = '';
    public $pemp_temp = '';
    public $direction_id = '';
    public $enterprise_id = '';
    public $site_id = '';

    public $perPage = 10;
    public $selectedUsers = [];
    public $selectAll = false;

    public $evaluation;

    public function mount($code)
    {
        // dd($code)
        $this->evaluation = Evaluation::where('code', $code)->first();
        // dd($this->evaluation->responses->count());
    }

    public function render()
    {

        $total_participants_count =  $this->evaluation->participants->count();
        $participants_count = $this->evaluation->responses->count();
        $percent_participate = ($participants_count / $total_participants_count) * 100;
        $eval_late_count = $this->evaluation->responses->where('date', '>=', $this->evaluation->end_date)->count();
        $eval_late_percent = ($eval_late_count / $total_participants_count) * 100;
        $eval_first_step =  $this->evaluation->responses->where('is_send', 1)->count();
        $eval_second_step =  $this->evaluation->responses->where('is_n1', 1)->count();
        $eval_third_step =  $this->evaluation->responses->where('is_n2', 1)->count();

        $responses = $this->evaluation->responses;

        // dd($eval_late_count);

        return view('livewire.portal.evaluation.statistics.index', [
            'occupations' => User::distinct()->pluck('occupation'),
            'pemp_temps' => User::distinct()->pluck('pemp_temp'),
            'directions' => \App\Models\Direction::all(),
            'enterprises' => \App\Models\Enterprise::all(),
            'sites' => \App\Models\Site::all(),
            'total_participants_count' => $total_participants_count,
            'participants_count' => $participants_count,
            'percent_participate' => $percent_participate,
            'eval_late_percent' => $eval_late_percent,
            'average_time_formatted' => $this->timeMoyen(),
            'eval_first_step' => $eval_first_step,
            'eval_second_step' => $eval_second_step,
            'eval_third_step' => $eval_third_step,
            'responses' => $responses
        ])->layout('components.layouts.dashboard');
    }

    public function export()
    {
        return Excel::download(new EvaluationsExport, 'evaluations'.$this->evaluation->code.'.xlsx');
    }

    public function timeMoyen()
    {
        // Récupérer toutes les réponses de l'évaluation
        $responses = $this->evaluation->responses;

        // Initialiser une variable pour stocker la somme des différences de temps en jours
        $total_time_diff_days = 0;

        // Parcourir chaque réponse pour calculer la différence de temps en jours
        foreach ($responses as $response) {
            $start_time = Carbon::parse($response->created_at); // Le moment où la réponse a commencé
            $end_time = Carbon::parse($response->date);         // Le moment où la réponse a été soumise

            // Calculer la différence en jours entre le début et la fin de la réponse
            $time_diff_days = $start_time->diffInDays($end_time);

            // Ajouter la différence au total
            $total_time_diff_days += $time_diff_days;
        }

        // Calculer la moyenne de temps de réponse en jours
        $average_days = $responses->count() > 0 ? $total_time_diff_days / $responses->count() : 0;

        // Adaptation automatique du format : jours, semaines ou mois
        if ($average_days < 7) {
            // Afficher en jours si c'est moins de 7 jours
            $average_time_formatted = $average_days . ' jour' . ($average_days > 1 ? 's' : '');
        } elseif ($average_days < 30) {
            // Afficher en semaines si c'est entre 7 et 30 jours
            $average_weeks = floor($average_days / 7);
            $average_days_remainder = $average_days % 7; // Jours restants après division en semaines
            $average_time_formatted = $average_weeks . ' semaine' . ($average_weeks > 1 ? 's' : '');
            if ($average_days_remainder > 0) {
                $average_time_formatted .= ' et ' . $average_days_remainder . ' jour' . ($average_days_remainder > 1 ? 's' : '');
            }
        } else {
            // Afficher en mois si c'est plus de 30 jours
            $average_months = floor($average_days / 30);
            $average_days_remainder = $average_days % 30; // Jours restants après division en mois
            $average_time_formatted = $average_months . ' mois';
            if ($average_days_remainder > 0) {
                $average_time_formatted .= ' et ' . $average_days_remainder . ' jour' . ($average_days_remainder > 1 ? 's' : '');
            }
        }

        return $average_time_formatted;
    }
}
