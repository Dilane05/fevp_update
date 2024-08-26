<?php

namespace App\Livewire\Portal\Evaluation\Comitee;

use App\Models\User;
use Livewire\Component;
use App\Models\Evaluation;
use App\Models\ComiteeCalibrage;
use App\Livewire\Traits\WithDataTable;

class Index extends Component
{

    use WithDataTable;
    public $users;
    public $selectedUsers = [];

    public $evaluationId;

    public function mount()
    {
        $this->users = User::all();


    }

    public function resetFields()
    {

    }

    public function render()
    {
        $comitees = ComiteeCalibrage::search($this->query)
        ->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        return view('livewire.portal.evaluation.comitee.index', compact('comitees'),[
            'occupations' => User::distinct()->pluck('occupation'),
            'pemp_temps' => User::distinct()->pluck('pemp_temp'),
            'directions' => \App\Models\Direction::all(),
            'enterprises' => \App\Models\Enterprise::all(),
            'sites' => \App\Models\Site::all(),
            ])->layout('components.layouts.dashboard');
    }
}
