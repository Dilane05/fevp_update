<?php

namespace App\Livewire\Portal\Evaluation\Cible;

use App\Models\Site;
use App\Models\User;
use Livewire\Component;
use App\Models\Direction;
use App\Models\Enterprise;
use App\Models\Evaluation;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $occupation = '';
    public $pemp_temp = '';
    public $direction_id = '';
    public $enterprise_id = '';
    public $site_id = '';
    public $hiring_date_from;
    public $hiring_date_to;
    public $length_of_service_from;
    public $length_of_service_to;
    public $perPage = 10;
    public $selectedUsers = [];
    public $selectAll = false;
    public $evaluationId;

    public function mount($evaluation)
    {
        $eval = Evaluation::where('code',$evaluation)->first();
        // dd($eval);
        $this->evaluationId = $eval->id;
        $this->loadSelectedUsers();
    }

    public function loadSelectedUsers()
    {
        $evaluation = Evaluation::find($this->evaluationId);

        if ($evaluation) {
            $this->selectedUsers = $evaluation->participants()->pluck('users.id')->toArray();
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->users->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        $this->selectAll = false;
    }

    public function getUsersProperty()
    {
        return User::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('matricule', 'like', "%{$this->search}%"))
            ->when($this->occupation, fn($query) => $query->where('occupation', $this->occupation))
            ->when($this->pemp_temp, fn($query) => $query->where('pemp_temp', $this->pemp_temp))
            ->when($this->direction_id, fn($query) => $query->where('direction_id', $this->direction_id))
            ->when($this->enterprise_id, fn($query) => $query->where('enterprise_id', $this->enterprise_id))
            ->when($this->site_id, fn($query) => $query->where('site_id', $this->site_id))
            ->when($this->hiring_date_from, fn($query) => $query->whereDate('hiring_date', '>=', $this->hiring_date_from))
            ->when($this->hiring_date_to, fn($query) => $query->whereDate('hiring_date', '<=', $this->hiring_date_to))
            ->when($this->length_of_service_from, fn($query) => $query->whereRaw('TIMESTAMPDIFF(YEAR, hiring_date, CURDATE()) >= ?', $this->length_of_service_from))
            ->when($this->length_of_service_to, fn($query) => $query->whereRaw('TIMESTAMPDIFF(YEAR, hiring_date, CURDATE()) <= ?', $this->length_of_service_to))
            ->paginate($this->perPage);
    }

    // public function test()
    // {
    //     dd($this->selectedUsers);
    // }

    public function saveParticipants()
    {
        $evaluation = Evaluation::find($this->evaluationId);
        $evaluation->participants()->sync($this->selectedUsers);
        session()->flash('message', 'Les participants ont été enregistrés avec succès.');

        return redirect()->route('portal.evaluation.index');

    }

    public function render()
    {

        return view('livewire.portal.evaluation.cible.index', [
            'users' => $this->users,
            'occupations' => User::distinct()->pluck('occupation'),
            'pemp_temps' => User::distinct()->pluck('pemp_temp'),
            'directions' => \App\Models\Direction::all(),
            'enterprises' => \App\Models\Enterprise::all(),
            'sites' => \App\Models\Site::all(),
        ])->layout('components.layouts.dashboard');
    }
}
