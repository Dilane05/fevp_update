<?php

namespace App\Livewire\Portal\Evaluation\Calibrage;

use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleBilanResult;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleBonusMalus;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleComplianceCorporateCulture;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleManagerialQuality;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleNote;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleSanction;
use App\Livewire\Portal\Evaluation\Calibrage\Steps\HandleTenueGlobalPoste;
use App\Models\Calibrage;
use App\Models\ResponseEvaluation;
use Livewire\Component;

class Index extends Component
{

    use HandleBilanResult, HandleTenueGlobalPoste, HandleManagerialQuality, HandleComplianceCorporateCulture, HandleBonusMalus, HandleSanction, HandleBonusMalus, HandleNote;

    public $step = 1;

    public $response, $response_id;

    public $calibrage;

    public $errorMessages = [];

    public $errorsModalVisible;

    public $tfootErrorMessages = [];

    public $hasObservation = false;

    public function mount($id)
    {

        $this->response_id = $id;
        $this->response = ResponseEvaluation::findOrFail($id);

        $existingCalibrage = Calibrage::where('response_evaluation_id', $this->response_id)->first();
        // dd($existingCalibrage);
        if ($existingCalibrage) {
            $this->calibrage = Calibrage::findOrFail($existingCalibrage->id);
            $this->checkBilan();
            $this->checkTenueGlobal();
            $this->checkManagerialQuality();
            $this->checkComplianceCorporate();
            $this->checkBonusMalus();
            $this->checkSanction();
        } else {

            $this->calibrage = Calibrage::create([
                'response_evaluation_id' => $id,
                'status' => 0, // Brouillon
                // 'date' => now(),
            ]);

            // Assigner l'ID de la nouvelle réponse à la variable response
            // $this->calibrage = $newCalibrage->id;

            $this->firstMountingBilan();
            $this->firstTenueGlobalBilan();
            $this->firstManagerialQuality();
            $this->firstComplianceCorporate();
            $this->firstBonusMalus();
            $this->firstSanction();
            // Sinon, créer une nouvelle réponse avec le statut de brouillon
        }

        $this->calculateNote();

    }

    public function nextStep()
    {
        $this->step++;
        if ($this->step === 7) {
            $this->calculateNote();
        }
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function setStep($step)
    {
        $this->step = $step;

        if ($this->step === 7) {
            $this->calculateNote();
        }
    }

    public function render()
    {
        return view(
            'livewire.portal.evaluation.calibrage.index',
            [
                // 'percentages' => $this->getPercentages()
            ]
        )->layout('components.layouts.dashboard');
    }
}
