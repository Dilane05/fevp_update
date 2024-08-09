<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère le rôle 'user' ou en crée un s'il n'existe pas
        $role = Role::firstOrCreate(['name' => 'user']);

        // Récupère tous les utilisateurs sauf le premier
        $users = User::where('id', '!=', User::min('id'))->get();

        // Assigne le rôle 'user' à chaque utilisateur
        foreach ($users as $user) {
            $user->roles()->syncWithoutDetaching([$role->id]);
        }
    }
}
