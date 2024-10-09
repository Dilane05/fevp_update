<?php

namespace App\Livewire\Portal\Users;

use Log;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\TypeFiche;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Validation\Rule;
use App\Models\PerformanceContrat;
use Spatie\Permission\Models\Role;
use App\Models\PerformanceContract;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use App\Livewire\Traits\WithDataTable;

class Index extends Component
{
    use WithDataTable;
    //
    public $tags = [];
    public $roles = [];
    public $user = null;
    public $user_id = null;

    public $user_ids = [];

    public $title;

    // Informations personnelles
    public $first_name = null;
    public $last_name = null;
    public $email = null;
    public $phone_number = null;
    public $occupation = null; // Ajouté
    public $is_manager = false; // Ajouté
    public $pemp_temp = null; // Ajouté
    public $date_of_birth = null; // Ajouté
    public $gender = null;
    public $emergency_contact_name = null; // Ajouté
    public $emergency_contact_phone = null; // Ajouté

    // Détails de l'emploi
    public $type_fiche_id = null; // Ajouté
    public $main_evaluator = null; // Ajouté
    public $second_evaluator = null; // Ajouté
    public $direction_id = null; // Ajouté
    public $enterprise_id = null; // Ajouté
    public $site_id = null; // Ajouté
    public $hiring_date = null; // Ajouté
    public $length_of_service = null; // Ajouté
    public $statut_category = null; // Ajouté
    public $responsable_n1 = null; // Ajouté
    public $responsable_n2 = null; // Ajouté

    // Détails du compte
    public $status = 1;
    public $password = null;
    public $confirm_password;

    // Autres variables
    public ?string $role_name = null;
    public $auth_role = null;
    public $user_file = null;
    public $selectedStatus = null; // Ajouté
    public $selectedSexe = null; // Ajouté
    public $countdown = null; // Ajouté

    public $type_fiche;

    // UUID - Peut être utilisé pour générer un identifiant unique
    public $uuid = null; // Ajouté pour correspondre à la table users
    public $matricule = null; // Ajouté pour correspondre à la table users

    public $objectifs = [];

    public $year, $performanceContract;

    // public $title, $user_id;

    public $indicators = ['performance', 'reputation', 'execution', 'budget'];


    //Update & Store Rules
    protected array $rules = [
        'matricule' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'occupation' => 'nullable|string|max:255',
        'is_manager' => 'nullable|boolean',
        'pemp_temp' => 'nullable|string|max:255',
        'type_fiche_id' => 'nullable|exists:type_fiches,id',
        'main_evaluator' => 'nullable|exists:users,id',
        'second_evaluator' => 'nullable|exists:users,id',
        'direction_id' => 'nullable|exists:directions,id',
        'enterprise_id' => 'nullable|exists:enterprises,id',
        'site_id' => 'nullable|exists:sites,id',
        'hiring_date' => 'nullable|date',
        'length_of_service' => 'nullable|integer',
        'statut_category' => 'nullable|string|max:255',
        'responsable_n1' => 'nullable|exists:users,id',
        'responsable_n2' => 'nullable|exists:users,id',
        'date_of_birth' => 'nullable|date',
        'email' => 'required|string|email|max:255|unique:users',
        'phone_number' => 'nullable|string|max:20',
        'gender' => 'nullable|in:male,female',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'status' => 'required|boolean',
        'password' => 'required|string|min:8',
    ];

    public function mount()
    {
        $this->roles = Role::select('id', 'name')->whereNotIn('name', ['client'])->get();
        $this->countdown = 10; // Temps initial du compte à rebours
        $this->objectifs = [
            [
                'valeur' => '',
                'indicateurs' => [
                    ['cible' => '', 'type', 'coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => '']
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
                ['cible' => '', 'type', 'coef' => '', 'frequence' => '', 'mode_calcul' => '', 'observations' => '']
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

    public function contract()
    {
        // Sauvegarder tous les objectifs et indicateurs dans la base de données


        $this->validate([
            'title' => 'required',
            'year' => 'required|numeric',
            'user_ids' => 'required'
        ]);

        foreach ($this->user_ids as $key => $user_id) {
            // dd($user_id);
            // Récupérer l'utilisateur actuellement connecté
            $user = User::findOrFail($user_id);

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
                'user_id' => $user_id,
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
        }

        // Rafraîchir les objectifs après la sauvegarde
        $this->mount();

        $this->closeModalAndFlashMessage(__('Contrat de performance sauvegardés avec succès.'), 'CreateContractModal');
    }

    // public function updatedRoleName($value)
    // {
    //     if (!empty($value)) {
    //         $this->show_consultation_types = $value === 'expert' ? 1 : 0;
    //     }
    // }

    public function store()
    {
        if (!Gate::allows('user-create')) {
            return abort(401);
        }

        // dd($this->second_evaluator);
        $this->validate();


        $user = User::create([
            'matricule' => $this->matricule,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'occupation' => $this->occupation,
            'is_manager' => $this->is_manager,
            'pemp_temp' => $this->pemp_temp,
            'type_fiche_id' => $this->type_fiche_id,
            'main_evaluator' => $this->main_evaluator,
            'second_evaluator' => $this->second_evaluator,
            'direction_id' => $this->direction_id,
            'enterprise_id' => $this->enterprise_id,
            'site_id' => $this->site_id,
            'hiring_date' => $this->hiring_date,
            'length_of_service' => $this->length_of_service,
            'statut_category' => $this->statut_category,
            'responsable_n1' => $this->responsable_n1,
            'responsable_n2' => $this->responsable_n2,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_phone' => $this->emergency_contact_phone,
            'status' => $this->status,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole($this->role_name);

        // event(new UserCreated($user, $this->password));

        $this->clearFields();
        $this->closeModalAndFlashMessage(__('User created successfully!'), 'CreateUserModal');
    }

    public function update()
    {
        // Vérifiez les autorisations
        if (!Gate::allows('user-update')) {
            return abort(401);
        }

        // Validation des données
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'nullable',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'gender' => 'required',
            'status' => 'required|boolean',
            'occupation' => 'nullable|string',
            'hiring_date' => 'nullable|date',
            'date_of_birth' => 'nullable|date',
            'type_fiche_id' => 'nullable|exists:type_fiches,id',
            'main_evaluator' => 'nullable|exists:users,id',
            'second_evaluator' => 'nullable|exists:users,id',
            'direction_id' => 'nullable|exists:directions,id',
            'enterprise_id' => 'nullable|exists:enterprises,id',
            'site_id' => 'nullable|exists:sites,id',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_phone' => 'nullable|string',
            'length_of_service' => 'nullable|integer',
            'statut_category' => 'nullable|string',
            'responsable_n1' => 'nullable|exists:users,id',
            'responsable_n2' => 'nullable|exists:users,id',
            // Autres validations selon les besoins...
        ]);

        // dd($this->status);

        // Mise à jour des données de l'utilisateur
        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'status' => $this->status,
            'occupation' => $this->occupation,
            'hiring_date' => $this->hiring_date ? Carbon::parse($this->hiring_date) : null,
            'date_of_birth' => $this->date_of_birth ? Carbon::parse($this->date_of_birth) : null,
            'type_fiche_id' => $this->type_fiche_id,
            'main_evaluator' => $this->main_evaluator,
            'second_evaluator' => $this->second_evaluator,
            'direction_id' => $this->direction_id,
            'enterprise_id' => $this->enterprise_id,
            'site_id' => $this->site_id,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_phone' => $this->emergency_contact_phone,
            'length_of_service' => $this->length_of_service,
            'statut_category' => $this->statut_category,
            'responsable_n1' => $this->responsable_n1,
            'responsable_n2' => $this->responsable_n2,
            // Ne pas mettre à jour le mot de passe si aucun nouveau mot de passe n'est fourni
            'password' => empty($this->password) ? $this->user->password : bcrypt($this->password),
        ]);

        // Mise à jour des rôles si nécessaire
        if ($this->user->getRoleNames()->first() != $this->role_name) {
            $this->user->syncRoles($this->role_name);
        }

        // Réinitialiser les champs et afficher un message de succès
        $this->clearFields();
        $this->closeModalAndFlashMessage(__('User successfully updated!'), 'EditUserModal');
    }


    public function delete()
    {
        if (!Gate::allows('user-delete')) {
            return abort(401);
        }

        if (!empty($this->user)) {

            if ($this->user->getRoleNames()->first() === 'admin') {
                $this->clearFields();
                $this->closeModalAndFlashMessage(__('Sorry you cannot delete admin users!'), 'DeleteModal');

                return;
            } else {

                $this->user->forceDelete();
            }
        }

        $this->clearFields();
        $this->closeModalAndFlashMessage(__('User successfully deleted!'), 'DeleteModal');
    }

    public function initData($user_id)
    {
        $user = User::findOrFail($user_id);

        // Informations personnelles
        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->matricule = $user->matricule;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->occupation = $user->occupation;
        $this->is_manager = $user->is_manager;
        $this->pemp_temp = $user->pemp_temp;
        $this->type_fiche = $user->type_fiche ? $user->type_fiche->id : '';

        // Dates formatées pour les champs d'entrée
        $this->date_of_birth = $user->date_of_birth ? Carbon::parse($user->date_of_birth)->format('Y-m-d') : null;
        $this->hiring_date = $user->hiring_date ? Carbon::parse($user->hiring_date)->format('Y-m-d') : null;

        // Détails supplémentaires
        $this->gender = $user->gender;
        $this->emergency_contact_name = $user->emergency_contact_name;
        $this->emergency_contact_phone = $user->emergency_contact_phone;

        // Détails de l'emploi
        $this->type_fiche_id = $user->type_fiche_id;
        $this->main_evaluator = $user->main_evaluator;
        $this->second_evaluator = $user->second_evaluator;
        $this->direction_id = $user->direction_id;
        $this->enterprise_id = $user->enterprise_id;
        $this->site_id = $user->site_id;
        $this->length_of_service = $user->length_of_service;
        $this->statut_category = $user->statut_category;
        $this->responsable_n1 = $user->responsable_n1;
        $this->responsable_n2 = $user->responsable_n2;

        // Détails du compte
        $this->status = $user->status; // Assurez-vous que le status est bien géré (1 ou 0)
        $this->password = null; // Ne pas charger le mot de passe pour des raisons de sécurité

        // Récupérer le rôle
        $this->role_name = $user->getRoleNames()->first();
    }

    public function import()
    {
        set_time_limit(300);

        $this->validate([
            'user_file' => 'sometimes|nullable|mimes:xlsx,csv|max:500',
        ]);

        // Vérifier que le fichier est un UploadedFile valide
        if (!$this->user_file instanceof \Illuminate\Http\UploadedFile) {
            $this->addError('user_file', 'Le fichier n\'a pas été correctement uploadé.');
            return;
        }

        // Lancer le compte à rebours avant l'importation
        $this->countdown = 10;
        $this->dispatch('startCountdown');

        try {
            // Utiliser le chemin réel du fichier pour l'importation
            Excel::import(new UsersImport($this->user), $this->user_file->getRealPath());
            auditLog(
                auth()->user(),
                'user_imported',
                'web',
                __('Imported excel file for users') . auth()->user()->name
            );

            // Réinitialiser le compte à rebours après l'importation
            $this->countdown = 0;
            $this->clearFields();
            $this->closeModalAndFlashMessage(__('Users successfully imported!'), 'importusersModal');
        } catch (\Exception $e) {
            // Capturer et loguer l'erreur
            Log::error('Erreur lors de l\'importation du fichier Excel:', ['message' => $e->getMessage()]);
            $this->addError('user_file', 'Erreur lors de l\'importation. Veuillez réessayer.');
        }
    }


    public function decrementCountdown()
    {
        if ($this->countdown > 0) {
            $this->countdown--;
        }
    }

    public function export()
    {
        auditLog(
            auth()->user(),
            'user_exported',
            'web',
            __('Exported excel file for users for tag ') . auth()->user()->name
        );
        return Excel::download(new UsersExport($this->query), ucfirst(auth()->user()->name) . '-users-' . Str::random(5) . '.xlsx');
    }


    public function close()
    {
        $this->clearFields();
    }

    public function clearFields()
    {
        $this->reset([
            'uuid',
            'matricule',
            'first_name',
            'last_name',
            'occupation',
            'is_manager',
            'pemp_temp',
            'type_fiche_id',
            'main_evaluator',
            'second_evaluator',
            'direction_id',
            'enterprise_id',
            'site_id',
            'hiring_date',
            'length_of_service',
            'statut_category',
            'responsable_n1',
            'responsable_n2',
            'date_of_birth',
            'email',
            'phone_number',
            'gender',
            'emergency_contact_name',
            'emergency_contact_phone',
            'status',
            'password',
        ]);
    }

    public function render()
    {
        if (!Gate::allows('user-read')) {
            return abort(401);
        }

        $users = User::search($this->query)->with('roles')
            ->when($this->selectedStatus, function ($query, $selectedStatus) {
                return $query->where('is_active', $selectedStatus);
            })
            ->when($this->selectedSexe, function ($query, $selectedSexe) {
                return $query->where('sexe', $selectedSexe);
            })
            ->orderBy($this->orderBy, $this->orderAsc)->paginate($this->perPage);

        // Calcul du total des utilisateurs
        $total_users = User::count();

        // Calcul du total des utilisateurs actifs
        $total_active_users = User::where('status', true)->count();

        // Calcul du total des utilisateurs inactifs
        $total_inactive_users = User::where('status', false)->count();

        // dd($users);

        return view('livewire.portal.users.index', [
            'users' => $users,
            'userss' => User::all(),
            'type_fiches' => \App\Models\TypeFiche::all(),
            'active_users' => $total_active_users,
            'inactive_users' => $total_inactive_users,
            'users_count' => $total_users,
            'occupations' => User::distinct()->pluck('occupation'),
            'pemp_temps' => User::distinct()->pluck('pemp_temp'),
            'directions' => \App\Models\Direction::all(),
            'enterprises' => \App\Models\Enterprise::all(),
            'sites' => \App\Models\Site::all(),
            'years' => range(now()->year - 10, now()->year + 10),
        ])->layout('components.layouts.dashboard');
    }
}
