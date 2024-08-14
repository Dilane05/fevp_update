<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TypeFiche;
use Illuminate\Database\Seeder;

class AssignTypeFichierToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer tous les IDs de type_fichier
        $typeFichierIds = TypeFiche::pluck('id')->toArray();

        // Assigner un type_fichier_id aléatoire à chaque utilisateur
        User::all()->each(function ($user) use ($typeFichierIds) {
            $user->type_fiche_id = $typeFichierIds[array_rand($typeFichierIds)];
            $user->save();
        });
    }
}
