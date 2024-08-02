<?php

namespace App\Livewire\Portal\Scorecard\Indicator;

use Livewire\Component;
use App\Models\Indicator;
use App\Livewire\Traits\WithDataTable;

class Index extends Component
{

    use WithDataTable;

    public $indicators;
    public $indicatorId, $name, $min_value, $max_value, $condition_type;
    public $min_score, $max_score;

    public function mount()
    {
        $this->indicators = Indicator::all();
    }

    public function clearFields()
    {
        $this->name = '';
        $this->min_value = '';
        $this->max_value = '';
        $this->min_score = '';
        $this->max_score = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'min_value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'min_score' => 'required|numeric',
            'max_score' => 'required|numeric',
            'condition_type' => 'required',
        ]);

        Indicator::Create($validatedData);
        $this->indicators = Indicator::all();
        $this->clearFields();
        $this->closeModalAndFlashMessage(__('Formule Enregistrer avec succes'), 'CreateIndicatorModal');
    }

    public function initData($id)
    {
        $indicator = Indicator::findOrFail($id);
        $this->indicatorId = $id;
        $this->name = $indicator->name;
        $this->min_value = $indicator->min_value;
        $this->max_value = $indicator->max_value;
        $this->min_score = $indicator->min_score;
        $this->max_score = $indicator->max_score;
        $this->condition_type = $indicator->condition_type;
    }

    public function delete($id)
    {
        Indicator::find($id)->delete();
        session()->flash('message', 'Indicator Deleted Successfully.');
        $this->indicators = Indicator::all();
    }

    public function render()
    {
        $indicators = Indicator::all();

        return view('livewire.portal.scorecard.indicator.index', compact('indicators'))->layout('components.layouts.dashboard');
    }
}
