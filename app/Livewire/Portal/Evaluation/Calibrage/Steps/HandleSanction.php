<?php

namespace App\Livewire\Portal\Evaluation\Calibrage\Steps;

trait HandleSanction
{

    public $sanctions = [
        ['type' => 'Nombre d\'avertissement (s)', 'number' => 0, 'sanction' => 0],
        ['type' => 'Nombre de blâme (s)', 'number' => 0, 'sanction' => 0],
        ['type' => 'Nombre de mise à pied de 1 à 3 jours', 'number' => 0, 'sanction' => 0],
        ['type' => 'Nombre de mise à pied de 4 à 5 jours', 'number' => 0, 'sanction' => 0],
        ['type' => 'Nombre de mise à pied de 6 à 8 jours', 'number' => 0, 'sanction' => 0],
    ];

    public $totalSanctionScore = 0;

    public function firstSanction()
    {
        $this->sanctions = $this->response->sanction;
        $this->totalSanctionScore = $this->response->note_sanction ?? 0;
    }

    public function updatedSanctions($propertyName, $value)
    {
        $this->calculateSanctionScores();
    }

    private function calculateSanctionScores()
    {
        // Définir les valeurs des sanctions
        $sanctionValues = [
            'Nombre d\'avertissement (s)' => -2.5,
            'Nombre de blâme (s)' => -5,
            'Nombre de mise à pied de 1 à 3 jours' => -7.5,
            'Nombre de mise à pied de 4 à 5 jours' => -10,
            'Nombre de mise à pied de 6 à 8 jours' => -12.5,
        ];

        $totalSanctionScore = 0;

        foreach ($this->sanctions as $index => $sanction) {
            if (isset($sanctionValues[$sanction['type']])) {
                // $this->sanctions[$index]['sanction'] = $sanctionValues[$sanction['type']] * intval($sanction['number']);
                $totalSanctionScore += $sanctionValues[$sanction['type']] * intval($sanction['number']);
            }
        }

        $this->totalSanctionScore = $totalSanctionScore;
    }

}
