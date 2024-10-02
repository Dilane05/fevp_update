<?php

namespace App\Livewire\Portal\Evaluation\Response;

use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ResponseEvaluation;
use App\Livewire\Traits\WithDataTable;

class Index extends Component
{

    use WithDataTable;
    // public $resultCount;
    public $evaluation;

    public function mount($code)
    {
        $this->evaluation = Evaluation::where('code', $code)->first();
    }

    public function render()
    {
        $responses = ResponseEvaluation::search($this->query)  // Appel correct de la méthode search
        ->where('evaluation_id', $this->evaluation->id)
        ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        ->paginate($this->perPage);

        return view('livewire.portal.evaluation.response.index', compact('responses'))->layout('components.layouts.dashboard');
    }
}
