<?php

namespace App\Livewire\Client\PerformanceContract;

use Livewire\Component;

class Index extends Component
{

    public $objectifs = [];

    public function mount()
    {
        $this->objectifs = [
            [
                'indicateurs' => [
                    ['cible' => '', 'coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => '']
                ]
            ]
        ];
    }

    // Méthode pour ajouter un nouvel indicateur à un objectif spécifique
    public function addIndicateur($index)
    {
        $this->objectifs[$index]['indicateurs'][] = ['cible' => '', 'coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => ''];
    }

    // Méthode pour ajouter un nouvel objectif
    public function addObjectif()
    {
        $this->objectifs[] = [
            'indicateurs' => [
                ['cible' => '', 'coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => '']
            ]
        ];
    }

    // Méthode pour supprimer un indicateur
    public function removeIndicateur($objectifIndex, $indicateurIndex)
    {
        unset($this->objectifs[$objectifIndex]['indicateurs'][$indicateurIndex]);
        $this->objectifs[$objectifIndex]['indicateurs'] = array_values($this->objectifs[$objectifIndex]['indicateurs']); // Réindexer
    }

    // Méthode pour supprimer un objectif
    public function removeObjectif($index)
    {
        unset($this->objectifs[$index]);
        $this->objectifs = array_values($this->objectifs); // Réindexer
    }

    public function render()
    {
        return view('livewire.client.performance-contract.index');
    }
}
