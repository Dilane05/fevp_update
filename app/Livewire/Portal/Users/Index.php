<?php

namespace App\Livewire\Portal\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
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
    public $first_name = null;
    public $last_name = null;
    public $email = null;
    public $phone_number = null;
    public $password = null;
    public $gender = null;
    public ?string $role_name;
    public $status = 1;
    public $auth_role;
    public $user_file = null;
    public $selectedStatus, $selectedSexe;
    public $countdown;

    //Update & Store Rules
    protected array $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email|unique:users',
        'gender' => 'required',

    ];

    public function mount()
    {
        $this->roles = Role::select('id', 'name')->whereNotIn('name', ['client'])->get();
        $this->countdown = 10; // Temps initial du compte à rebours
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
        $this->validate();


        $user = User::create([
            'matricule' => 'ssss5',
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'status' => $this->status === "true" ?  1 : 0,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole($this->role_name);

        // event(new UserCreated($user, $this->password));

        $this->clearFields();
        $this->closeModalAndFlashMessage(__('User created successfully!'), 'CreateUserModal');
    }

    public function update()
    {
        if (!Gate::allows('user-update')) {
            return abort(401);
        }
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'gender' => 'required',
        ]);

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'status' => $this->status === "true" ?  1 : 0,
            'password' => empty($this->password) ? $this->user->password : bcrypt($this->password),
        ]);

        if ($this->user->getRoleNames()->first() != $this->role_name) {
            $this->user->syncRoles($this->role_name);
        }

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

        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->gender = $user->gender;
        $this->status = $user->status;
        $this->role_name = $user->getRoleNames()->first();
    }

    public function import()
    {
        $this->validate([
            'user_file' => 'sometimes|nullable|mimes:xlsx,csv|max:500',
        ]);

        // Lancer le compte à rebours avant l'importation
        $this->countdown = 10;
        $this->dispatch('startCountdown');

        Excel::import(new UsersImport($this->user), $this->user_file);
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
            'first_name',
            'last_name',
            'email',
            'phone_number',
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

        return view('livewire.portal.users.index', [
            'users' => $users,
            'active_users' => $total_active_users,
            'inactive_users' => $total_inactive_users,
            'users_count' => $total_users,
        ])->layout('components.layouts.dashboard');
    }
}
