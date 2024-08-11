<?php

namespace App\Livewire\Client\Evaluation;

use Livewire\Component;
use App\Models\Evaluation;

class Show extends Component
{
    public function render()
    {
        $evaluation = Evaluation::orderBy('start_date', 'desc')->first();
        return view('livewire.client.evaluation.show', compact('evaluation'))->layout('components.layouts.client.dashboard');
    }
}
