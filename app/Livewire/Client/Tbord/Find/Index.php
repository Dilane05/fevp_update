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
                // Si 'performances' est non null, on la prend, sinon on charge un array par défaut
                'performance' => $performance->performances ? json_decode($performance->performances, true) : $this->defaultPerformanceArray(),
                'cible' => $performance->cible,
                'coef' => $performance->coef,
            ];
        })->toArray();
    }

    public function defaultPerformanceArray()
    {
        return [
            'Nb actions réalisées' => [
                'jan' => null,
                'feb' => null,
                'mar' => null,
                'apr' => null,
                'may' => null,
                'jun' => null,
                'jul' => null,
                'aug' => null,
                'sep' => null,
                'oct' => null,
                'nov' => null,
                'dec' => null
            ],
            'Nb actions réalisées dans délais' => [
                'jan' => null,
                'feb' => null,
                'mar' => null,
                'apr' => null,
                'may' => null,
                'jun' => null,
                'jul' => null,
                'aug' => null,
                'sep' => null,
                'oct' => null,
                'nov' => null,
                'dec' => null
            ],
            'Nb actions planifiées' => [
                'jan' => null,
                'feb' => null,
                'mar' => null,
                'apr' => null,
                'may' => null,
                'jun' => null,
                'jul' => null,
                'aug' => null,
                'sep' => null,
                'oct' => null,
                'nov' => null,
                'dec' => null
            ],
            '% Mise en œuvre' => [
                'jan' => null,
                'feb' => null,
                'mar' => null,
                'apr' => null,
                'may' => null,
                'jun' => null,
                'jul' => null,
                'aug' => null,
                'sep' => null,
                'oct' => null,
                'nov' => null,
                'dec' => null
            ]
        ];
    }

    public function render()
    {
        return view('livewire.client.tbord.find.index')->layout('components.layouts.client.dashboard');
    }
}
