<?php

namespace App\Livewire\Portal\Scorecard;

use Livewire\Component;
use App\Models\Indicator;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{

    use LivewireAlert;

    public $totalCoef = 70;
    public $errorMessages = [];
    public $hasObservation;

    public $step = 1;

    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function setStep($step)
    {
        $this->step = $step;
    }

    // public function update()
    // {
    //     // Validation en temps réel
    //     dd('dd');
    //     $this->validateData();
    // }


    public function validateData()
    {
        $this->errorMessages = [];

        foreach ($this->rows as $index => $row) {
            $lineNumber = $index + 1;  // Commence l'index à 1

            // Validation pour chaque ligne
            $validator = Validator::make(['row' => $row], $this->rules());

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $this->errorMessages[] = "Ligne $lineNumber : $error";
                }
            }

            // Validation des cibles et résultats
            if (!empty($row['cible_pct']) && !empty($row['cible_nb'])) {
                $this->errorMessages[] = "Ligne $lineNumber : Vous ne pouvez pas saisir la cible en pourcentage et en nombre en même temps.";
            }

            if (!empty($row['resultat_pct']) && !empty($row['resultat_nb'])) {
                $this->errorMessages[] = "Ligne $lineNumber : Vous ne pouvez pas saisir le resultat en pourcentage et en nombre en même temps.";
            }

            if (!empty($row['cible_pct']) && !empty($row['resultat_nb'])) {
                $this->errorMessages[] = "Ligne $lineNumber : Vous ne pouvez pas saisir la cible en pourcentage et le resultat en nombre.";
            }

            if (!empty($row['resultat_pct']) && !empty($row['cible_nb'])) {
                $this->errorMessages[] = "Ligne $lineNumber : Vous ne pouvez pas saisir le resultat en pourcentage et la cible en nombre.";
            }

            // Correction automatique
            if (!empty($row['cible_pct'])) {
                $row['resultat_nb'] = null; // Effacer le nombre si cible est en pourcentage
                $row['resultat_pct'] = $row['resultat_pct'] ?? ''; // Assurer que résultat en pourcentage est défini
            }

            if (!empty($row['cible_nb'])) {
                $row['resultat_pct'] = null; // Effacer le pourcentage si cible est en nombre
                $row['resultat_nb'] = $row['resultat_nb'] ?? ''; // Assurer que résultat en nombre est défini
            }

            // Réaffecter les modifications à la ligne
            $this->rows[$index] = $row;

            // Vérifier si au moins une observation est renseignée
            if (!empty($row['observations'])) {
                $this->hasObservation = true;
            }
        }

        // Vérification des totaux des coefficients
        $totalCoef = array_sum(array_column($this->rows, 'coef'));
        if ($totalCoef != $this->totalCoef) {
            $this->errorMessages[] = 'Le total des coefficients doit être égal à ' . $this->totalCoef;
        }

        // Validation d'observation
        if (!$this->hasObservation) {
            $this->errorMessages[] = 'Au moins une observation doit être renseignée.';
        }

        if (!empty($this->errorMessages)) {
            // Afficher les erreurs dans une alerte
            $this->alert('error', implode("\n", $this->errorMessages), [
                'position' => 'center',
                'timer' => 5000,
                'toast' => true,
                'timerProgressBar' => true,
                'showConfirmButton' => true
            ]);
        } else {
            $this->calculateNotes();
        }
    }

    protected function rules()
    {
        return [
            'rows.*.objectif' => 'required|string',
            'rows.*.indicateur' => 'required|string',
            'rows.*.coef' => 'required|numeric',
            'rows.*.cible_pct' => 'nullable|numeric|exclude_if:rows.*.cible_nb,!=,null',
            'rows.*.cible_nb' => 'nullable|numeric|exclude_if:rows.*.cible_pct,!=,null',
            'rows.*.resultat_pct' => 'nullable|numeric',
            'rows.*.resultat_nb' => 'nullable|numeric',
            'rows.*.note' => 'nullable|numeric',
            'rows.*.observations' => 'required|string',
        ];
    }

    public function calculateNotes()
    {
        foreach ($this->rows as $index => &$row) {
            if (!empty($row['cible_pct']) && !empty($row['resultat_pct'])) {
                $tauxRealisation = ($row['resultat_pct'] / $row['cible_pct']) * 100;
                // dd($tauxRealisation);
                $row['note'] = ($this->calculateNoteBasedOnIndicator($row['indicateur'], $tauxRealisation) * ($row['coef']) / 100);
            } elseif (!empty($row['cible_nb']) && !empty($row['resultat_nb'])) {
                $tauxRealisation = ($row['resultat_nb'] / $row['cible_nb']) * 100;
                $row['note'] = $this->calculateNoteBasedOnIndicator($row['indicateur'], $tauxRealisation) * ($row['coef'] / 100);
            }
            // dd($row['note']);
        }

    }

    protected function calculateNoteBasedOnIndicator($indicator, $tauxRealisation)
    {
        $params = Indicator::where('name', $indicator)->get();

        foreach ($params as $param) {
            if ($tauxRealisation >= $param->min_value && $tauxRealisation <= $param->max_value) {
                return $param->min_score + ($tauxRealisation - $param->min_value) * ($param->max_score - $param->min_score) / ($param->max_value - $param->min_value);
            }
        }

        return 0;
    }

    // protected function calculateNoteBasedOnIndicator($indicator, $tauxRealisation)
    // {
    //     switch ($indicator) {
    //         case 'performance':
    //             if ($tauxRealisation < 80) {
    //                 return 0;
    //             } elseif ($tauxRealisation >= 80 && $tauxRealisation <= 100) {
    //                 return 50 + ($tauxRealisation - 80) * (50 / 20);
    //             } elseif ($tauxRealisation > 100 && $tauxRealisation <= 110) {
    //                 return 100 + ($tauxRealisation - 100) * (5 / 10);
    //             } else {
    //                 return 105;
    //             }

    //         case 'execution':
    //             if ($tauxRealisation < 80) {
    //                 return 0;
    //             } elseif ($tauxRealisation >= 80 && $tauxRealisation <= 100) {
    //                 return 50 + ($tauxRealisation - 80) * (50 / 20);
    //             }
    //             break;

    //         case 'budget':
    //             if ($tauxRealisation < 85) {
    //                 return 105;
    //             } elseif ($tauxRealisation >= 85 && $tauxRealisation <= 100) {
    //                 return 105 - ($tauxRealisation - 85) * (25 / 15);
    //             } elseif ($tauxRealisation > 100 && $tauxRealisation <= 105) {
    //                 return 50 - ($tauxRealisation - 100) * (50 / 5);
    //             } else {
    //                 return 0;
    //             }

    //         case 'reputation':
    //         default:
    //             return 0;
    //     }
    // }

    public $indicators = [
        'performance',
        'reputation',
        'execution',
        'budget'
    ];

    public $rows = [
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
        ['' => '', '' => '', 'coef' => '', 'cible' => '', 'resultat_percent' => '', 'resultat_number' => '', 'note' => '', 'observations' => ''],
    ];

    public function addRow()
    {
        $this->rows[] = [
            'objectif' => '',
            'indicateur' => '',
            'coef' => '',
            'cible_pct' => '',
            'cible_nb' => '',
            'resultat_pct' => '',
            'resultat_nb' => '',
            'note' => '',
            'observations' => ''
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Re-index the array
    }

    public $keyResults = [
        ['domain' => '', 'note' => '', 'observations' => ''],
        ['domain' => '', 'note' => '', 'observations' => ''],
        ['domain' => '', 'note' => '', 'observations' => ''],
        ['domain' => '', 'note' => '', 'observations' => ''],
    ];

    public $qualities = [
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
        ['quality' => '', 'target' => '', 'realization' => '', 'observations' => ''],
    ];

    public $performanceCriteria = [
        [
            'criteria' => 'Le respect des règles: travaille selon les règles de l\'art du métier (normes, procédures, instructions de travail…)',
            'scores' => ['', '', '', '', '']
        ],
        [
            'criteria' => 'Le respect des engagements: (Ex: Tâche à faire, Délais convenus…)',
            'scores' => ['', '', '', '', '']
        ],
        [
            'criteria' => 'Un travail de qualité au 1er coup: (rigueur, exactitude, précision)',
            'scores' => ['', '', '', '', '']
        ],
        [
            'criteria' => 'Propreté/Hygiène: (Environnement de travail propre, EPI, Vêtements, Véhicules…)',
            'scores' => ['', '', '', '', '']
        ],
    ];

    public $projects = [
        ['description' => '', 'note' => ''],
        ['description' => '', 'note' => ''],
    ];

    public $sanctions = [
        ['type' => 'Nombre d\'avertissement (s)', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de blâme (s)', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de mise à pied de 1 à 3 jours', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de mise à pied de 4 à 5 jours', 'number' => '', 'sanction' => ''],
        ['type' => 'Nombre de mise à pied de 6 à 8 jours', 'number' => '', 'sanction' => ''],
    ];

    public function render()
    {
        return view('livewire.portal.scorecard.index')->layout('components.layouts.dashboard');
    }
}
