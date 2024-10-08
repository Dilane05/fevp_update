<?php

namespace App\Livewire\Portal\Evaluation\Statistics;

use App\Models\User;
use Livewire\Component;
use App\Models\Evaluation;
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
        $this->evaluation = Evaluation::where('code',$code)->first();
    }

    public function render()
    {
        return view('livewire.portal.evaluation.statistics.index', [
            'occupations' => User::distinct()->pluck('occupation'),
            'pemp_temps' => User::distinct()->pluck('pemp_temp'),
            'directions' => \App\Models\Direction::all(),
            'enterprises' => \App\Models\Enterprise::all(),
            'sites' => \App\Models\Site::all(),
        ])->layout('components.layouts.dashboard');
    }
}
