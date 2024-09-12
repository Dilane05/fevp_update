<?php

namespace App\Livewire\Client\Tbord;

use App\Models\User;
use App\Models\Tbord;
use Livewire\Component;
use App\Models\Indicator;
use App\Models\Performance;
use App\Livewire\Traits\WithDataTable;

class Index extends Component
{

    use WithDataTable;

    public $performances = [];
    public $newRow = [
        'objectif' => '',
        'performance' => '',
        'indicateur' => '',
        'type_indicator' => '',
        'cible' => '',
        'coef' => '',
        'months' => []
    ];

    public $year;

    public $title, $user_id;

    public $indicators = ['performance', 'reputation', 'execution', 'budget'];

    public $tbord;

    public function mount()
    {
        $this->year = now()->year;
    }

    public function addRow()
    {
        $this->performances[] = $this->newRow;
    }

    // $table->foreignId('tbord_id')->constrained()->onDelete('cascade');
    // $table->string('objectif');
    // $table->string('indicateur');
    // $table->string('type_indicator');
    // $table->string('performance');
    // $table->decimal('cible', 5, 2); // Valeur cible
    // $table->decimal('coef', 5, 2);  // Coefficient
    // $table->json('months')->nullable();

    protected $rules = [
        'title' => 'required',
        'year' => 'required|numeric',
        'user_id' => 'required'
    ];

    public function store()
    {
        $this->validate();

        // Récupérer l'utilisateur actuellement connecté
        $user = User::findOrFail($this->user_id);

        // Extraire les 2 premières lettres du prénom et du nom
        $prenom = substr($user->first_name, 0, 2);
        $nom = substr($user->last_name, 0, 2);

        // Extraire les 2 derniers chiffres de l'année actuelle
        $year = substr($this->year, -2);

        // Générer le code Tbord personnalisé
        $codeTbord = 'Tbord' . strtoupper($prenom) . strtoupper($nom) . $year;

        $tbord = Tbord::Create([
            'code' => $codeTbord,
            'title' => $this->title,
            'year' => $this->year,
            'user_id' => $this->user_id,
            'created_by' => auth()->user()->id
        ]);

        foreach ($this->performances as $key => $performance) {
            Performance::create([
                'tbord_id' => $tbord->id,
                'indicateur' => $performance['objectif'],
                'objectif' => $performance['objectif'],
                'type_indicator' => $performance['type_indicator'],
                'performance' => $performance['performance'],
                'cible' => $performance['cible'],
                'coef' => $performance['coef'],
            ]);
        }

        $this->closeModalAndFlashMessage(__('Tableau de bord et performances sauvegardés avec succès.'), 'CreateTbordModal');
    }

    public function initData($id)
    {
        // Récupère le tableau de bord avec les performances associées
        $this->tbord = Tbord::with('performances')->findOrFail($id);

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

    public function update()
    {
        // Mettre à jour les informations du tbord
        $this->tbord->update([
            'title' => $this->title,
            'year' => $this->year,
            'user_id' => $this->user_id,
            'created_by' => auth()->user()->id
        ]);

        // Récupérer les IDs des performances actuelles
        $existingPerformanceIds = collect($this->performances)->pluck('id')->filter()->toArray();

        // Supprimer les performances qui ne sont plus dans la liste
        Performance::where('tbord_id', $this->tbord->id)
            ->whereNotIn('id', $existingPerformanceIds)
            ->delete();

        // Synchroniser ou créer des performances
        foreach ($this->performances as $key => $performance) {
            if (isset($performance['id'])) {
                $existingPerformance = Performance::findOrFail($performance['id']);
                $existingPerformance->update([
                    'objectif' => $performance['objectif'],
                    'indicateur' => $performance['indicateur'],
                    'type_indicator' => $performance['type_indicator'],
                    'performance' => $performance['performance'],
                    'cible' => $performance['cible'],
                    'coef' => $performance['coef'],
                ]);
            } else {
                Performance::create([
                    'tbord_id' => $this->tbord->id,
                    'objectif' => $performance['objectif'],
                    'indicateur' => $performance['indicateur'],
                    'type_indicator' => $performance['type_indicator'],
                    'performance' => $performance['performance'],
                    'cible' => $performance['cible'],
                    'coef' => $performance['coef'],
                ]);
            }
        }

        $this->dispatch('EditTbordModal');

        $this->closeModalAndFlashMessage(__('Tbord et performances mis à jour avec succès.'), 'EditTbordModal');

    }

    public function removeRow($index)
    {
        // Supprimer la performance de la base de données si elle a un ID
        if (isset($this->performances[$index]['id'])) {
            Performance::find($this->performances[$index]['id'])->delete();
        }

        // Supprimer la performance de la liste
        array_splice($this->performances, $index, 1);
    }

    public function delete()
    {

        if (!empty($this->tbord)) {
            $this->tbord->delete();
        }

        $this->closeModalAndFlashMessage(__('Tbord supprimé avec succès.'), 'confirmDeleteModal');
    }

    public function render()
    {

        // Générer la plage d'années : 10 années avant et 10 années après l'année actuelle
        $years = range(now()->year - 10, now()->year + 10);

        $users = auth()->user()->responsableN1Users;
        // dd(auth()->user()->id);
        // dd($users);

        $tbords = Tbord::search($this->query)->where('created_by', auth()->user()->id)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        $myTbords = Tbord::search($this->query)->where('user_id', auth()->user()->id)->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        return view('livewire.client.tbord.index', compact('users', 'years', 'tbords', 'myTbords'))->layout('components.layouts.client.dashboard');
    }
}
