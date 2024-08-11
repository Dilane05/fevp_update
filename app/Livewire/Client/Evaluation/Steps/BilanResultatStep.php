<?php

namespace App\Livewire\Client\Evaluation\Steps;

use Livewire\Component;
use App\Models\Indicator;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\LivewireWizard\Components\StepComponent;

class BilanResultatStep extends StepComponent
{

    use LivewireAlert;

    public $totalCoef = 70;
    public $errorMessages = [];


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

    public $indicators = [
        'performance',
        'reputation',
        'execution',
        'budget'
    ];

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

    public function submit()
    {
        $this->validate();

        // dd('ok');

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('Bilan des Resultats'),
            'icon' => 'fa-shopping-cart',
        ];
    }
    public function render()
    {
        return view('livewire.client.evaluation.steps.bilan-resultat-step');
    }
}
