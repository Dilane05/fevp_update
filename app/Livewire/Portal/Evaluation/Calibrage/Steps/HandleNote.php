<?php

namespace App\Livewire\Portal\Evaluation\Calibrage\Steps;

use App\Models\User;

trait HandleNote
{

    public $averageScore;

    public $average_bilan_resultat, $average_tenue_global_poste, $average_quality_managerial, $average_compliance_corporate, $global_average;

    public $note_bonus_malus, $note_sanction;

    public $note_bilan_resultat, $note_tenue_global_poste, $note_quality_managerial, $note_compliance_corporate,
        $total_bilan_resultat, $total_tenue_global_poste, $total_quality_managerial, $total_compliance_corporate;

    public $response;

    public function calculateNote()
    {
        $response = $this->calibrage;
        // $this->response = $response;
        $user = User::findOrFail($this->response->user_id);

        // Maximum possible scores (totals)
        $total_bilan_resultat = $user->type_fiche->value_result ?? 0; // Example: 80
        $total_tenue_global_poste = 5;
        $total_quality_managerial = $user->type_fiche->value_manageriale > 0 ? $user->type_fiche->value_manageriale : 0;
        $total_compliance_corporate = 15;

        // Actual scores
        $note_bilan_resultat = is_numeric($response->note_bilan_resultat) ? $response->note_bilan_resultat : 0;
        $note_tenue_global_poste = is_numeric($response->note_tenue_global) ? $response->note_tenue_global : 0;
        $note_quality_managerial = is_numeric($response->note_mangeriale_quality) ? $response->note_mangeriale_quality : 0;
        $note_compliance_corporate = is_numeric($response->note_compliance_resultat) ? $response->note_compliance_resultat : 0;
        $this->note_bonus_malus = is_numeric($response->note_bonus_malus) ? $response->note_bonus_malus : 0;
        $this->note_sanction = is_numeric($response->note_sanction) ? $response->note_sanction : 0;

        $this->note_bilan_resultat = $note_bilan_resultat;
        // dd($note_bilan_resultat);
        $this->note_tenue_global_poste = $note_tenue_global_poste;
        $this->note_quality_managerial = $note_quality_managerial;
        $this->note_compliance_corporate = $note_compliance_corporate;

        $this->total_bilan_resultat = $total_bilan_resultat;
        $this->total_tenue_global_poste = $total_tenue_global_poste;
        $this->total_quality_managerial = $total_quality_managerial;
        $this->total_compliance_corporate = $total_compliance_corporate;

        // Calculate individual averages
        $this->average_bilan_resultat = ($total_bilan_resultat > 0) ? ($note_bilan_resultat / $total_bilan_resultat) * 20 : 0;
        $this->average_tenue_global_poste = ($total_tenue_global_poste > 0) ? ($note_tenue_global_poste / $total_tenue_global_poste) * 20 : 0;
        // dd($note_tenue_global_poste);
        $this->average_quality_managerial = ($total_quality_managerial > 0) ? ($note_quality_managerial / $total_quality_managerial) * 20 : 0;
        $this->average_compliance_corporate = ($total_compliance_corporate > 0) ? ($note_compliance_corporate / $total_compliance_corporate) * 20 : 0;

        // Calculate total actual score (including bonus/malus and sanction)
        $total_actual_scores = $note_bilan_resultat + $note_tenue_global_poste + $note_quality_managerial + $note_compliance_corporate + $this->note_bonus_malus + $this->note_sanction;

        // Calculate total possible score
        $total_possible_scores = $total_bilan_resultat + $total_tenue_global_poste + $total_quality_managerial + $total_compliance_corporate;

        // Calculate global average score on a scale of 20
        $this->global_average = ($total_possible_scores > 0) ? ($total_actual_scores / $total_possible_scores) * 20 : 0;
    }

    // public function getPercentages()
    // {
    //     // Calculer les pourcentages pour chaque rubrique
    //     return [
    //         $this->total_bilan_resultat ? ($this->note_bilan_resultat / $this->total_bilan_resultat) * 100 : 0,
    //         $this->total_tenue_global_poste ? ($this->note_tenue_global_poste / $this->total_tenue_global_poste) * 100 : 0,
    //         $this->total_quality_managerial ? ($this->note_quality_managerial / $this->total_quality_managerial) * 100 : 0,
    //         $this->total_compliance_corporate ? ($this->note_compliance_corporate / $this->total_compliance_corporate) * 100 : 0,
    //         $this->note_bonus_malus,
    //         $this->note_sanction,
    //     ];
    // }

}
