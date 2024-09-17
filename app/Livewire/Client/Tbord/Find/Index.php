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
        // Pré-chargement des performances pour éviter le N+1 problem
        $this->tbord = Tbord::with('performances')->where('code', $code)->firstOrFail();

        // Initialisation des données du tableau de bord
        $this->title = $this->tbord->title;
        $this->year = $this->tbord->year;
        $this->user_id = $this->tbord->user_id;

        // Initialisation des performances associées
        $this->performances = $this->formatPerformances($this->tbord->performances);
    }

    // Formatage des performances
    private function formatPerformances($performances)
    {
        return $performances->map(function ($performance) {
            return [
                'id' => $performance->id,
                'indicateur' => $performance->indicateur,
                'objectif' => $performance->objectif,
                'type_indicator' => $performance->type_indicator,
                'performance' => $this->getPerformanceData($performance),
                'cible' => $performance->cible,
                'coef' => $performance->coef,
            ];
        })->toArray();
    }

    // Récupération ou création des données de performance
    private function getPerformanceData($performance)
    {
        return $performance->performances
            ? json_decode($performance->performances, true)
            : $this->defaultPerformanceArray();
    }

    // Génération dynamique du tableau de performances par défaut
    private function defaultPerformanceArray()
    {
        $months = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
        $indicators = [
            'Nb actions réalisées',
            'Nb actions réalisées dans délais',
            'Nb actions planifiées',
            '% Mise en œuvre',
            'Note Mois'
        ];

        $defaultArray = [];
        foreach ($indicators as $indicator) {
            $defaultArray[$indicator] = array_fill_keys($months, null);
        }

        return $defaultArray;
    }

    // Cette fonction sera appelée à chaque modification d'une performance
    public function calcul()
    {

        // dd($this->performances);

        // Vérifier la clé modifiée et recalculer en conséquence
        foreach ($this->performances as &$performance) {
            $performanceData = $performance['performance'];
            foreach ($performanceData['Nb actions planifiées'] as $month => $planifiees) {
                // Assurer que les valeurs sont définies avant de calculer
                $realisees = $performanceData['Nb actions réalisées'][$month] ?? 0;
                $realiseesDelais = $performanceData['Nb actions réalisées dans délais'][$month] ?? 0;
                $planifiees = $planifiees ?? 0;

                if ($planifiees > 0) {
                    // Calcul du pourcentage de mise en œuvre
                    $pourcentageMiseEnOeuvre = $this->calculPourcentageMiseEnOeuvre($realisees, $realiseesDelais, $planifiees);

                    // Calcul de la note du mois
                    $noteMois = $performance['coef'] * $pourcentageMiseEnOeuvre;

                    // Mettre à jour les valeurs dans le tableau des performances
                    $performance['performance']['% Mise en œuvre'][$month] = round($pourcentageMiseEnOeuvre * 100, 2); // En pourcentage
                    $performance['performance']['Note Mois'][$month] = round($noteMois, 2);
                } else {
                    // Si aucune action n'est planifiée, la mise en œuvre est 0
                    $performance['performance']['% Mise en œuvre'][$month] = 0;
                    $performance['performance']['Note Mois'][$month] = 0;
                }
            }
        }
    }

    // Calcul du pourcentage de mise en œuvre
    private function calculPourcentageMiseEnOeuvre($actionsRealisees, $actionsRealiseesDelais, $actionsPlanifiees)
    {
        if ($actionsPlanifiees > 0) {
            $ratioRealisees = $actionsRealisees / $actionsPlanifiees;
            $ratioDelais = $actionsRealiseesDelais / $actionsPlanifiees;

            return (0.7 * $ratioRealisees) + (0.3 * $ratioDelais);
        }
        return 0; // Évite la division par zéro si aucune action n'est planifiée
    }

    public function render()
    {
        return view('livewire.client.tbord.find.index')
            ->layout('components.layouts.client.dashboard');
    }
}
