<?php

namespace App\Livewire\Portal\AuditLogs;

use App\Livewire\Traits\WithDataTable;
use Livewire\Component;
use App\Models\AuditLog;


class Index extends Component
{
    use WithDataTable;

    public function render()
    {
        $role = auth()->user()->getRoleNames()->first();

        $logs = match($role){
            "supervisor" =>  AuditLog::search($this->query)->whereUserId(auth()->user()->id)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage),
            "manager" => AuditLog::search($this->query)->manager()->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage) ,
            "admin" => AuditLog::search($this->query)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage) ,
            default => AuditLog::search($this->query)->whereUserId(auth()->user()->id)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage),
        };
        $logs_count = match($role){
            "supervisor" =>  AuditLog::whereUserId(auth()->user()->id)->count(),
            "manager" => AuditLog::manager()->count() ,
            "admin" => AuditLog::count() ,
           default => AuditLog::whereUserId(auth()->user()->id)->count(),
        };
        $creation_log_count = match($role){
            "supervisor" =>  AuditLog::creation()->whereUserId(auth()->user()->id)->count(),
            "manager" => AuditLog::creation()->manager()->count() ,
            "admin" => AuditLog::creation()->count() ,
           default => AuditLog::creation()->whereUserId(auth()->user()->id)->count(),
        };
        $update_log_count = match($role){
            "supervisor" =>  AuditLog::updation()->whereUserId(auth()->user()->id)->count(),
            "manager" => AuditLog::updation()->manager()->count() ,
            "admin" => AuditLog::updation()->count() ,
           default => AuditLog::updation()->whereUserId(auth()->user()->id)->count(),
        };
        $deletion_log_count = match($role){
            "supervisor" =>  AuditLog::deletion()->whereUserId(auth()->user()->id)->count(),
            "manager" => AuditLog::deletion()->manager()->count() ,
            "admin" => AuditLog::deletion()->count() ,
           default => AuditLog::deletion()->whereUserId(auth()->user()->id)->count(),
        }; 
            
        return view('livewire.portal.audit-logs.index', [
            'logs' => $logs,
            'logs_count' => $logs_count,
            'creation_log_count' => $creation_log_count,
            'update_log_count' => $update_log_count,
            'deletion_log_count' => $deletion_log_count,
            ])->layout('components.layouts.dashboard');
    }
}
