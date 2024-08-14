<?php

namespace Database\Seeders;

use App\Models\TypeFiche;
use Illuminate\Database\Seeder;

class TypeFichierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeFichiers = [
            ['slug' => 'CHEFS_DE_SERVICE_AUTRES_MANAGERS', 'name' => 'Chefs de Service et Autres Managers', 'value_result' => 70, 'value_manageriale' => 10],
            ['slug' => 'CHEFS_DEPARTEMENTS', 'name' => 'Chefs de Départements', 'value_result' => 60, 'value_manageriale' => 15],
            ['slug' => 'DGA', 'name' => 'DGA', 'value_result' => 60, 'value_manageriale' => 15],
            ['slug' => 'PERSONNEL_CONTRACTUEL', 'name' => 'Personnel Contractuel', 'value_result' => 80, 'value_manageriale' => 0],
            ['slug' => 'FONCTIONS_SPECIFIQUES', 'name' => 'Fonctions Spécifiques', 'value_result' => 75, 'value_manageriale' => 5],
            ['slug' => 'NON_MANAGERS', 'name' => 'Non Managers', 'value_result' => 80, 'value_manageriale' => 0],
            ['slug' => 'EMPLOYES_OUVRIERS', 'name' => 'Employés et Ouvriers', 'value_result' => 80, 'value_manageriale' => 0],
        ];

        foreach ($typeFichiers as $typeFiche) {
            TypeFiche::create($typeFiche);
        }
    }
}
