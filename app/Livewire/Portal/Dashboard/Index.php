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

        $logs = match ($this->role) {
            "supervisor" => AuditLog::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->take(10),
            "manager" => AuditLog::manager()->orderBy('created_at', 'desc')->take(10),
            "admin" => AuditLog::orderBy('created_at', 'desc')->take(10),
            default => AuditLog::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->take(10),
        };

        return view('livewire.portal.dashboard.index', [
            'logs' => $logs,
        ])->layout('components.layouts.dashboard');
    }
}
