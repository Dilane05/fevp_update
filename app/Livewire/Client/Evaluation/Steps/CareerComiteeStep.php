<?php

namespace App\Livewire\Client\Evaluation\Steps;

use App\Models\CareerComitee;
use Livewire\Component;
use App\Models\ResponseEvaluation;
use Spatie\LivewireWizard\Components\StepComponent;

class CareerComiteeStep extends StepComponent
{

    public $totalBonusMalus = 0;
    public $response, $comment;

    public $errorMessages = [];
    public $errorsModalVisible = false;

    public $editable;

    public $decisions = [
        'aucun_changement' => '',
        'promotion' => '',
        'evolution_salaire' => '',
        'evolution_grade' => '',
        'affectation_autre_poste' => '',
    ];

    public $profiles = [
        'key_talent' => '',
        'expert' => '',
        'potentiel' => '',
        'bon_contributeur' => '',
        'sous_performeur' => '',
    ];

    public $selectedDecision = '';

    public $selectedProfile = '';

    public $short_term_evolution;
    public $perspective_career;
    public $comment_n1;
    public $comment_n2;
    public $signature_n1_date;
    public $signature_n2_date;
    public $signature_rrdch_date;

    public function selectProfile($profile)
    {
        $this->selectedProfile = $profile;
    }

    public function selectDecision($decision)
    {
        $this->selectedDecision = $decision;
    }

    public function mount()
    {
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        // Charger les informations du comité de carrière existant
        $careerComitee = CareerComitee::where('response_evaluation_id', $this->response->id)->first();
        if ($careerComitee) {
            $this->selectedDecision = $careerComitee->selected_decision;
            $this->decisions[$this->selectedDecision] = $careerComitee->decision_comment;
            $this->selectedProfile = $careerComitee->selected_profile;
            $this->profiles[$this->selectedProfile] = $careerComitee->profile_comment;
            $this->short_term_evolution = $careerComitee->short_term_evolution;
            $this->perspective_career = $careerComitee->perspective_career;
            $this->comment_n1 = $careerComitee->comment_n1;
            $this->comment_n2 = $careerComitee->comment_n2;
            $this->signature_n1_date = $careerComitee->signature_n1_date;
            $this->signature_n2_date = $careerComitee->signature_n2_date;
            $this->signature_rrdch_date = $careerComitee->signature_rrdch_date;
        }
    }


    public function submit()
    {
        $this->nextStep();
    }

    public function sign_n1()
    {
        $career = CareerComitee::find($this->response->id);
        $career->signature_n1_date = now();
        $career->save();
    }

    public function sign_n2()
    {
        $career = CareerComitee::find($this->response->id);
        $career->signature_n2_date = now();
        $career->save();
    }

    public function sign_rrdch()
    {
        $career = CareerComitee::find($this->response->id);
        $career->signature_rrdch_date = now();
        $career->save();
    }

    public function save()
    {

        CareerComitee::updateOrCreate(
            // Condition pour trouver l'existence du comité
            ['response_evaluation_id' => $this->response->id],

            // Données à insérer ou mettre à jour
            [
                'selected_decision' => $this->selectedDecision,
                'decision_comment' => $this->decisions[$this->selectedDecision] ?? null,
                'short_term_evolution' => $this->short_term_evolution,
                'perspective_career' => $this->perspective_career,
                'selected_profile' => $this->selectedProfile,
                'profile_comment' => $this->profiles[$this->selectedProfile] ?? null,
                'comment_n1' => $this->comment_n1,
                'comment_n2' => $this->comment_n2,
                'signature_n1_date' => $this->signature_n1_date,
                'signature_n2_date' => $this->signature_n2_date,
                'signature_rrdch_date' => $this->signature_rrdch_date,
            ]
        );

        session()->flash('message', ' COMITÉ CARRIÈRE sauvergarder avec succès!');
    }


    public function stepInfo(): array
    {
        return [
            'label' => __('COMITÉ CARRIÈRE'),
            'icon' => 'fa-shopping-cart',
        ];
    }

    public function render()
    {
        return view('livewire.client.evaluation.steps.career-comitee-step');
    }
}
