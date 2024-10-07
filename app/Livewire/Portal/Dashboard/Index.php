<?php

namespace App\Livewire\Portal\Dashboard;

use App\Models\User;
use Livewire\Component;
use App\Models\AuditLog;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;
    public $role;

    public $categories;
    public $doshaOptions;
    public $dosha;
    public $selections = [];

    public function mount()
    {
        $this->role = auth()->user()->getRoleNames()->first();
    }

    public function render()
    {

        return view('livewire.portal.dashboard.index', [
        ])->layout('components.layouts.dashboard');
    }
}
