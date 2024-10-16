<?php

namespace App\Livewire\Client\Evaluation\Steps;

use App\Models\User;
use Livewire\Component;
use App\Models\Indicator;
use App\Models\PerformanceContrat;
use App\Models\ResponseEvaluation;
use App\Models\PerformanceContract;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Services\EvaluationAuthorizationService;
use Spatie\LivewireWizard\Components\StepComponent;

class BilanResultatStep extends StepComponent
{
    use LivewireAlert;

    public $totalCoef = 0;
    public $errorMessages = [];
    public $tfootErrorMessages = [];
    public $hasObservation = false;
    public $globalNote = 0;
    public $totalPossibleNote = 0;
    public $response;
    public $editable;

    protected $authorizationService;

    public function mount(EvaluationAuthorizationService $authorizationService)
    {

        $this->authorizationService = $authorizationService;
        // dd($this->totalCoef);
        $this->response = ResponseEvaluation::findOrFail($this->state()->forStep('create-evaluation-personal_info')['response']);

        $this->editable = $this->state()->forStep('create-evaluation-personal_info')['editable_user'];

        $user = User::findOrFail($this->response->user_id);
        $this->totalCoef = $user->type_fiche->value_result;

        if ($this->response->bilan_resultat) {
            $this->rows = $this->response->bilan_resultat;
        } else {
            // Récupérer l'année en cours
            $currentYear = date('Y');

            // Trouver le contrat de performance de l'année en cours
            $performanceContract = PerformanceContract::where('year', $currentYear)->where('user_id', auth()->user()->id)->first();

            if ($performanceContract) {
                // Récupérer les objectifs (performance_contrats) et leurs indicateurs pour ce contrat de performance
                $performanceContrats = PerformanceContrat::where('performance_contract_id', $performanceContract->id)
                    ->with('indicateurs') // Charger les indicateurs associés
                    ->get();

                // Remplir le tableau $rows avec les informations des indicateurs
                $this->rows = $performanceContrats->flatMap(function ($performanceContrat) {
                    return $performanceContrat->indicateurs->map(function ($indicator) {

                        // Nettoyage de la chaîne cible pour supprimer les espaces ou autres caractères invisibles
                        $cible_cleaned = trim($indicator->cible);

                        // Vérification si la cible contient un pourcentage
                        if (strpos($cible_cleaned, '%') !== false) {
                            // Retrait du symbole '%' et conversion en nombre flottant
                            $cible_pct = floatval(str_replace('%', '', $cible_cleaned));
                            $cible_nb = null; // Pas de valeur numérique brute
                        } else {
                            // Si pas de pourcentage, on considère que c'est une valeur numérique
                            $cible_pct = null;
                            $cible_nb = is_numeric($cible_cleaned) ? floatval($cible_cleaned) : null;
                        }

                        return [
                            'objectif' => $indicator->nom,
                            'indicateur' => $indicator->type,
                            'coef' => $indicator->coef,
                            'cible_pct' => $cible_pct,
                            'cible_nb' => $cible_nb,
                            'resultat_pct' => null, // Rempli plus tard
                            'resultat_nb' => null, // Rempli plus tard
                            'note' => null, // Rempli plus tard
                            'observations' => null,
                        ];
                    });
                })->toArray();
            } else {
                // Si aucun contrat de performance n'est trouvé pour l'année en cours, garder une ligne vide
                $this->rows = [
                    ['objectif' => '', 'indicateur' => '', 'coef' => '', 'cible_pct' => '', 'cible_nb' => '', 'resultat_pct' => '', 'resultat_nb' => '', 'note' => '', 'observations' => ''],
                ];
            }
        }
        $this->globalNote = $this->response->note_bilan_resultat ?? 0;

        $this->calculateNotes();
        $this->tfootErrorMessages[] = 'Note : ' . number_format($this->globalNote, 2) . '/' . $this->totalCoef;
    }

    public $rows = [
        ['objectif' => '', 'indicateur' => '', 'coef' => '', 'cible_pct' => '', 'cible_nb' => '', 'resultat_pct' => '', 'resultat_nb' => '', 'note' => '', 'observations' => ''],
    ];

    public function addRow()
    {
        $this->rows[] = ['objectif' => '', 'indicateur' => '', 'coef' => '', 'cible_pct' => '', 'cible_nb' => '', 'resultat_pct' => '', 'resultat_nb' => '', 'note' => '', 'observations' => ''];
    }

    public $indicators = ['performance', 'reputation', 'execution', 'budget'];

    public function updatedRows($value, $key)
    {
        $this->calculateNotes();

        $this->errorMessages = [];
        $this->tfootErrorMessages = [];

        $hasObjectif = array_filter($this->rows, function ($row) {
            return !empty($row['objectif']);
        });

        if (!empty($hasObjectif)) {
            $rowsToValidate = $this->getValidRows();
            $validator = Validator::make(['rows' => $rowsToValidate], $this->rules(), $this->messages());

            if ($validator->fails()) {
                foreach ($validator->errors()->getMessages() as $key => $messages) {
                    foreach ($messages as $message) {
                        $index = explode('.', $key)[1];
                        $ligne = $index + 1;
                        $this->errorMessages[] = str_replace(':index', $ligne, $message);
                    }
                }
            }

            $this->checkConflictingData(); // Ajouter la vérification des conflits

            $totalCoef = array_sum(array_column($rowsToValidate, 'coef'));
            if ($totalCoef < $this->totalCoef) {
                $this->tfootErrorMessages[] = 'Le total des coefficients renseignés est inférieur à ' . $this->totalCoef;
            } elseif ($totalCoef > $this->totalCoef) {
                $this->tfootErrorMessages[] = 'Le total des coefficients renseignés est supérieur à ' . $this->totalCoef;
            }

            if (!$this->hasObservation) {
                $this->tfootErrorMessages[] = 'Au moins une observation doit être renseignée.';
            }
        }

        if (empty($this->errorMessages) && empty($this->tfootErrorMessages)) {
            $this->tfootErrorMessages[] = 'Note : ' . number_format($this->globalNote, 2) . '/' . number_format($this->totalPossibleNote, 2);
        }
    }

    public function submit()
    {
        $this->errorMessages = [];
        $rowsToValidate = $this->getValidRows();

        $validator = Validator::make(['rows' => $rowsToValidate], $this->rules(), $this->messages());

        if ($validator->fails()) {
            foreach ($validator->errors()->getMessages() as $key => $messages) {
                foreach ($messages as $message) {
                    $index = explode('.', $key)[1];
                    $ligne = $index + 1;
                    $this->errorMessages[] = str_replace(':index', $ligne, $message);
                }
            }
        }

        $totalCoef = array_sum(array_column($rowsToValidate, 'coef'));
        if ($totalCoef != $this->totalCoef) {
            $this->errorMessages[] = 'Le total des coefficients renseignés doit être égal à ' . $this->totalCoef;
        }

        if (!$this->hasObservation) {
            $this->errorMessages[] = 'Au moins une observation doit être renseignée.';
        }

        $this->checkConflictingData(); // Ajouter la vérification des conflits

        if (!empty($this->errorMessages)) {
            $this->dispatch('show-error-modal');
        } else {
            if ($this->editable == "disabled") {
                $this->nextStep();
            } else {
                $this->response->bilan_resultat = $this->rows;
                $this->response->note_bilan_resultat = $this->globalNote;
                $this->response->save();
                $this->nextStep();
            }
        }
    }

    protected function calculateNotes()
    {
        $this->hasObservation = false;
        $this->globalNote = 0;
        $this->totalPossibleNote = 0;

        foreach ($this->rows as &$row) {
            if (!empty($row['cible_pct']) && !empty($row['resultat_pct'])) {
                $tauxRealisation = ($row['resultat_pct'] / $row['cible_pct']) * 100;
                $row['note'] = ($this->calculateNoteBasedOnIndicator($row['indicateur'], $tauxRealisation) * $row['coef']) / 100;
            } elseif (!empty($row['cible_nb']) && !empty($row['resultat_nb'])) {
                $tauxRealisation = ($row['resultat_nb'] / $row['cible_nb']) * 100;
                $row['note'] = ($this->calculateNoteBasedOnIndicator($row['indicateur'], $tauxRealisation) * $row['coef']) / 100;
            } else {
                $row['note'] = 0;
            }

            $coef = is_numeric($row['coef']) ? floatval($row['coef']) : 0;
            if ($coef > 0) {
                if (!empty($row['note'])) {
                    $this->globalNote += $row['note'];
                }
                $this->totalPossibleNote += $coef;
            }

            if (!empty($row['observations'])) {
                $this->hasObservation = true;
            }
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
            'rows.*.observations' => 'nullable|string',
        ];
    }

    protected function messages()
    {
        return [
            'rows.*.objectif.required' => 'L\'objectif est requis au niveau de la ligne :index.',
            'rows.*.indicateur.required' => 'L\'indicateur est requis au niveau de la ligne :index.',
            'rows.*.coef.required' => 'Le coefficient est requis au niveau de la ligne :index.',
            'rows.*.coef.numeric' => 'Le coefficient doit être un nombre au niveau de la ligne :index.',
            'rows.*.cible_pct.numeric' => 'La cible en pourcentage doit être un nombre au niveau de la ligne :index.',
            'rows.*.cible_nb.numeric' => 'La cible en nombre doit être un nombre au niveau de la ligne :index.',
            'rows.*.resultat_pct.numeric' => 'Le résultat en pourcentage doit être un nombre au niveau de la ligne :index.',
            'rows.*.resultat_nb.numeric' => 'Le résultat en nombre doit être un nombre au niveau de la ligne :index.',
            'rows.*.note.numeric' => 'La note doit être un nombre au niveau de la ligne :index.',
            'rows.*.observations.string' => 'L\'observation doit être une chaîne de caractères au niveau de la ligne :index.',
        ];
    }

    protected function checkConflictingData()
    {
        foreach ($this->rows as $index => $row) {
            if (
                !empty($row['cible_pct']) && !empty($row['cible_nb']) ||
                !empty($row['resultat_pct']) && !empty($row['resultat_nb'])
            ) {
                $this->errorMessages[] = 'Vous ne pouvez pas utiliser à la fois les pourcentages et les nombres dans la ligne ' . ($index + 1) . '. Veuillez choisir uniquement l\'un ou l\'autre.';
                break;
            }
        }
    }

    protected function getValidRows()
    {
        return array_filter($this->rows, function ($row) {
            return !empty($row['coef']) || array_sum(array_column($this->rows, 'coef')) <= $this->totalCoef;
        });
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
