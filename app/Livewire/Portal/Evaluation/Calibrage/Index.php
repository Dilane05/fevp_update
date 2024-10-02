<?php

namespace App\Livewire\Portal\Evaluation\Calibrage;

use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleBilanResult;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleBonusMalus;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleComplianceCorporateCulture;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleManagerialQuality;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleSanction;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleTenueGlobalPoste;
use App\Models\Calibrage;
use App\Models\ResponseEvaluation;
use Livewire\Component;

class Index extends Component
{

    use HandleBilanResult , HandleTenueGlobalPoste , HandleManagerialQuality , HandleComplianceCorporateCulture , HandleBonusMalus , HandleSanction;

    public $step = 1;

    public $response , $response_id;

    public function mount($id)
    {

        $this->response_id = $id;
        $this->response = ResponseEvaluation::findOrFail($id);

        $existingCalibrage = Calibrage::where('response_evaluation_id', $this->response_id)->first();
        // dd($existingCalibrage);
        if ($existingCalibrage) {
            // Si une réponse existe déjà, assigner l'ID à la variable response
        } else {
            $this->firstMountingBilan();
            $this->firstTenueGlobalBilan();
            $this->firstManagerialQuality();
            $this->firstComplianceCorporate();
            $this->firstBonusMalus();
            $this->firstSanction();
            // Sinon, créer une nouvelle réponse avec le statut de brouillon
        }

    }

    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function render()
    {
        return view('livewire.portal.evaluation.calibrage.index')->layout('components.layouts.dashboard');
    }
}
