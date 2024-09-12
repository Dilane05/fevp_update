<?php

namespace App\Livewire\Client\Tbord\Find;

use App\Models\Tbord;
use Livewire\Component;

class Index extends Component
{

    public $tbord;

    public $year;

    public $title, $user_id;

    public $indicators = ['performance', 'reputation', 'execution', 'budget'];

    public $performances = [];

    public function mount($code)
    {
        $this->tbord = Tbord::where('code', $code)->first();

        // Initialisation des données du tableau de bord
        $this->title = $this->tbord->title;
        $this->year = $this->tbord->year;
        $this->user_id = $this->tbord->user_id;

        // Initialisation des performances associées
        $this->performances = $this->tbord->performances->map(function ($performance) {
            return [
                'indicateur' => $performance->indicateur,
                'objectif' => $performance->objectif,
                'type_indicator' => $performance->type_indicator,
                'performance' => $performance->performance,
                'cible' => $performance->cible,
                'coef' => $performance->coef,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.client.tbord.find.index')->layout('components.layouts.client.dashboard');
    }
}
