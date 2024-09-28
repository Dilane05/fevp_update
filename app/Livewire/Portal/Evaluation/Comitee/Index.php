<?php

namespace App\Livewire\Portal\Evaluation\Comitee;

use App\Models\User;
use Livewire\Component;
use App\Models\Evaluation;
use App\Models\Occupation;
use Illuminate\Support\Str;
use App\Models\ComiteeCalibrage;

use App\Livewire\Traits\WithDataTable;
use App\Models\MembreComiteeCalibrage;
use App\Models\PopulationCibleComitee;

class Index extends Component
{

    use WithDataTable;

    public $code;
    public $title;
    public $date;
    public $location;
    public $user_ids = [];
    public $postes = [];
    public $users;
    public $comiteeDetails , $is_view = 0;

    public function mount()
    {
        $this->users = User::all();

        // $this->user_calibrages

    }

    public function store()
    {
        $this->validate([
            // 'code' => 'required|string|size:6|unique:comitee_calibrages,code',
            'title' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'user_ids' => 'required|array',
            'postes' => 'required|array',
        ]);

        // Générer un code unique de 6 caractères
        $this->code = Str::random(6);

        // Créer le comité de calibrage
        $comitee = ComiteeCalibrage::create([
            'code' => $this->code,
            'title' => $this->title,
            'date' => $this->date,
            'location' => $this->location,
            'status' => 1, // ou tout autre statut par défaut
            'created_by' => auth()->id(),
        ]);

        // Ajouter les membres du comité
        foreach ($this->user_ids as $user_id) {
            MembreComiteeCalibrage::create([
                'comitee_calibrage_id' => $comitee->id,
                'user_id' => $user_id,
            ]);
        }

        // Ajouter les cibles du comité
        foreach ($this->postes as $poste_id) {
            PopulationCibleComitee::create([
                'comitee_calibrage_id' => $comitee->id,
                'occupation_id' => $poste_id,
            ]);
        }

        // Réinitialiser les champs du formulaire
        $this->resetFields();


        $this->resetFields();
        // Close the modal and display success message
        $this->closeModalAndFlashMessage(__('Comité de calibrage créé avec succès!'), 'CreateComiteeModal');

    }


    public function initData($comiteeId)
    {
        // Initialiser les données pour les modals
        $comitee = ComiteeCalibrage::findOrFail($comiteeId);
        $this->is_view = 1;
        // $this->code = $comitee->code;
        // $this->title = $comitee->title;
        // $this->date = $comitee->date;
        // $this->location = $comitee->location;
        // $this->user_ids = $comitee->members()->pluck('user_id')->toArray();
        // $this->postes = $comitee->targets()->pluck('occupation_id')->toArray();
        $this->comiteeDetails = $comitee;
    }

    public function resetFields()
    {
        $this->code = '';
        $this->title = '';
        $this->date = '';
        $this->location = '';
        $this->user_ids = [];
        $this->postes = [];
    }


    public function delete()
    {


        if (!empty($this->comiteeDetails)) {
            $this->comiteeDetails->forceDelete();
        }

        $this->resetFields();
        $this->closeModalAndFlashMessage(__('Comité supprimé avec succès!'), 'DeleteModal');
    }

    public function render()
    {
        $comitees = ComiteeCalibrage::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        // Récupérer toutes les occupations distinctes des utilisateurs
        $occupations = User::distinct()->pluck('occupation')->filter(function ($value) {
            return !is_null($value);
        });

        // Pour chaque occupation, on va la créer ou l'ignorer si elle existe déjà
        foreach ($occupations as $occupation) {
            // Utiliser firstOrCreate pour vérifier et créer l'occupation si elle n'existe pas
            Occupation::firstOrCreate(
                ['name' => $occupation]
            );
        }

        $occupations = Occupation::all();

        // $comitee = ComiteeCalibrage::first();

        // foreach($comitee->members as $membre)
        // {
        //     dd($membre->user->name);
        // }

        return view('livewire.portal.evaluation.comitee.index', compact('comitees'), [
            'occupations' => $occupations
        ])->layout('components.layouts.dashboard');
    }
}
