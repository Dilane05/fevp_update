<?php

namespace App\Livewire\Client\PerformanceContract;

use App\Models\User;
use Livewire\Component;
use App\Models\PerformanceContrat;
use App\Models\PerformanceContract;
use App\Livewire\Traits\WithDataTable;
use App\Models\IndicatorPerformanceContract;

class Index extends Component
{

    use WithDataTable;

    public $objectifs = [];

    public $year, $performanceContract;

    public $title, $user_id;

    public $indicators = ['performance', 'reputation', 'execution', 'budget'];

    public function mount()
    {
        $this->objectifs = [
            [
                'valeur' => '',
                'indicateurs' => [
                    ['cible' => '','type', 'coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => '']
                ]
            ]
        ];
    }

    public function addIndicateur($index)
    {
        $this->objectifs[$index]['indicateurs'][] = [
            'cible' => '',
            'type' => '',
            'coef' => '',
            'frequence' => '',
            'mode_calcul' => '',
            'observations' => ''
        ];
    }

    public function addObjectif()
    {
        $this->objectifs[] = [
            'valeur' => '',
            'indicateurs' => [
                ['cible' => '','type','coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => '']
            ]
        ];
    }

    public function removeIndicateur($objectifIndex, $indicateurIndex)
    {
        unset($this->objectifs[$objectifIndex]['indicateurs'][$indicateurIndex]);
        $this->objectifs[$objectifIndex]['indicateurs'] = array_values($this->objectifs[$objectifIndex]['indicateurs']);
    }

    public function removeObjectif($index)
    {
        unset($this->objectifs[$index]);
        $this->objectifs = array_values($this->objectifs);
    }

    protected $rules = [
        'title' => 'required',
        'year' => 'required|numeric',
        'user_id' => 'required'
    ];

    public function store()
    {
        // Sauvegarder tous les objectifs et indicateurs dans la base de données


        $this->validate();

        // Récupérer l'utilisateur actuellement connecté
        $user = User::findOrFail($this->user_id);

        // Extraire les 2 premières lettres du prénom et du nom
        $prenom = substr($user->first_name, 0, 2);
        $nom = substr($user->last_name, 0, 2);

        // Extraire les 2 derniers chiffres de l'année actuelle
        $year = substr($this->year, -2);

        // Générer le code Tbord personnalisé
        $perf = 'Perf' . strtoupper($prenom) . strtoupper($nom) . $year;

        $performance = PerformanceContract::Create([
            'code' => $perf,
            'title' => $this->title,
            'year' => $this->year,
            'user_id' => $this->user_id,
            'created_by' => auth()->user()->id
        ]);

        foreach ($this->objectifs as $objectifData) {
            // Création d'un nouvel objectif
            $objectif = PerformanceContrat::create([
                'performance_contract_id' => $performance->id,
                'valeur' => $objectifData['valeur']
            ]);

            // Sauvegarde des indicateurs liés à l'objectif
            foreach ($objectifData['indicateurs'] as $indicateurData) {
                $objectif->indicateurs()->create([
                    'nom' => $indicateurData['nom'],
                    'type' => $indicateurData['type'],
                    'cible' => $indicateurData['cible'],
                    'coef' => $indicateurData['coef'],
                    'frequence' => $indicateurData['frequence'],
                    'mode_calcul' => $indicateurData['mode_calcul'],
                    'observations' => $indicateurData['observations']
                ]);
            }
        }

        // Rafraîchir les objectifs après la sauvegarde
        $this->mount();

        $this->closeModalAndFlashMessage(__('Contrat de performance sauvegardés avec succès.'), 'EditPerformanceContract');
    }

    public function initData($id)
    {
        $contrat = PerformanceContract::find($id);
        $this->performanceContract = $contrat;

        $this->title = $contrat->title;
        $this->year = $contrat->year;
        $this->user_id = $contrat->user_id;

        $performanceContrats = $contrat->performances;

        // Mapper les données pour l'affichage
        $this->objectifs = $performanceContrats->map(function ($contrat) {
            return [
                'valeur' => $contrat->valeur,
                'indicateurs' => $contrat->indicateurs->map(function ($indicateur) {
                    return [
                        'nom' => $indicateur->nom,
                        'type' => $indicateur->type,
                        'cible' => $indicateur->cible,
                        'coef' => $indicateur->coef,
                        'frequence' => $indicateur->frequence,
                        'mode_calcul' => $indicateur->mode_calcul,
                        'observations' => $indicateur->observations,
                    ];
                })->toArray(),
            ];
        })->toArray();
    }
    public function update()
    {
        // Mettre à jour les informations du contrat de performance
        $this->performanceContract->update([
            'title' => $this->title,
            'year' => $this->year,
            'user_id' => $this->user_id,
            // 'updated_by' => auth()->user()->id, // Assurez-vous d'avoir ce champ dans la table si nécessaire
        ]);

        // Récupérer les IDs des objectifs actuels
        $existingObjectifIds = collect($this->objectifs)->pluck('id')->filter()->toArray();

        // Supprimer les objectifs qui ne sont plus dans la liste
        PerformanceContrat::where('performance_contract_id', $this->performanceContract->id)
            ->whereNotIn('id', $existingObjectifIds)
            ->delete();

        // Synchroniser ou créer des objectifs
        foreach ($this->objectifs as $key => $objectifData) {
            if (isset($objectifData['id'])) {
                // Mettre à jour un objectif existant
                $existingObjectif = PerformanceContrat::findOrFail($objectifData['id']);
                $existingObjectif->update([
                    'valeur' => $objectifData['valeur'],
                ]);

                // Récupérer les IDs des indicateurs actuels
                $existingIndicateurIds = collect($objectifData['indicateurs'])->pluck('id')->filter()->toArray();

                // Supprimer les indicateurs qui ne sont plus dans la liste
                IndicatorPerformanceContract::where('performance_contrat_id', $existingObjectif->id)
                    ->whereNotIn('id', $existingIndicateurIds)
                    ->delete();

                // Synchroniser ou créer des indicateurs
                foreach ($objectifData['indicateurs'] as $indicateurData) {
                    if (isset($indicateurData['id'])) {
                        // Mettre à jour un indicateur existant
                        $existingIndicateur = IndicatorPerformanceContract::findOrFail($indicateurData['id']);
                        $existingIndicateur->update([
                            'nom' => $indicateurData['nom'],
                            'type' => $indicateurData['type'],
                            'cible' => $indicateurData['cible'],
                            'coef' => $indicateurData['coef'],
                            'frequence' => $indicateurData['frequence'],
                            'mode_calcul' => $indicateurData['mode_calcul'],
                            'observations' => $indicateurData['observations'],
                        ]);
                    } else {
                        // Créer un nouvel indicateur
                        IndicatorPerformanceContract::create([
                            'performance_contrat_id' => $existingObjectif->id,
                            'nom' => $indicateurData['nom'],
                            'type' => $indicateurData['type'],
                            'cible' => $indicateurData['cible'],
                            'coef' => $indicateurData['coef'],
                            'frequence' => $indicateurData['frequence'],
                            'mode_calcul' => $indicateurData['mode_calcul'],
                            'observations' => $indicateurData['observations'],
                        ]);
                    }
                }
            } else {
                // Créer un nouvel objectif
                $newObjectif = PerformanceContrat::create([
                    'performance_contract_id' => $this->performanceContract->id,
                    'valeur' => $objectifData['valeur'],
                ]);

                // Créer les nouveaux indicateurs pour cet objectif
                foreach ($objectifData['indicateurs'] as $indicateurData) {
                    IndicatorPerformanceContract::create([
                        'performance_contrat_id' => $newObjectif->id,
                        'nom' => $indicateurData['nom'],
                        'type' => $indicateurData['type'],
                        'cible' => $indicateurData['cible'],
                        'coef' => $indicateurData['coef'],
                        'frequence' => $indicateurData['frequence'],
                        'mode_calcul' => $indicateurData['mode_calcul'],
                        'observations' => $indicateurData['observations'],
                    ]);
                }
            }
        }

        // Fermer le modal et afficher un message de succès
        $this->closeModalAndFlashMessage(__('Contrat de performance mis à jour avec succès.'), 'EditPerformanceContract');
    }

    public function delete()
    {

        // Supprimer les indicateurs liés aux objectifs du contrat de performance
        foreach ($this->performanceContract->performances as $objectif) {
            $objectif->indicateurs()->delete();
        }

        // Supprimer les objectifs du contrat de performance
        $this->performanceContract->performances()->delete();

        // Supprimer le contrat de performance lui-même
        $this->performanceContract->delete();

        // Message de confirmation et fermeture du modal
        $this->closeModalAndFlashMessage(__('Contrat de performance supprimé avec succès.'), 'EditPerformanceContract');
    }


    public function render()
    {

        // Générer la plage d'années : 10 années avant et 10 années après l'année actuelle
        $years = range(now()->year - 10, now()->year + 10);

        $users = auth()->user()->responsableN1Users;

        $performances = PerformanceContract::search($this->query)->where('created_by', auth()->user()->id)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        $myPerformances = PerformanceContract::search($this->query)->where('user_id', auth()->user()->id)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        return view('livewire.client.performance-contract.index',  compact('users', 'years', 'performances', 'myPerformances'))->layout('components.layouts.client.dashboard');;
    }
}
