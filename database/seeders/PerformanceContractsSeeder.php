<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerformanceContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        // Liste des utilisateurs
        $user_ids = [404, 411, 402, 365, 212, 343, 412, 243, 401, 358, 403, 230, 218, 356];

        // Fonction pour générer un code aléatoire
        function generateRandomCode($length = 8) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            return substr(str_shuffle($characters), 0, $length);
        }

        // Insertion des données dans la table `performance_contracts` sans spécifier d'ID
        foreach ($user_ids as $user_id) {
            $contract_id = DB::table('performance_contracts')->insertGetId([
                'code' => generateRandomCode(6), // Génération d'un code aléatoire de 6 caractères
                'title' => 'Test',
                'year' => '2024',
                'valeur' => null,
                'user_id' => $user_id,
                'created_by' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            // Insertion des 4 indicateurs pour chaque `performance_contract` en utilisant `contract_id` auto-généré
            DB::table('indicator_performance_contracts')->insert([
                [
                    'performance_contract_id' => $contract_id,
                    'nom' => 'Augmenter les ventes de 10% d\'ici la fin du trimestre',
                    'type' => 'performance',
                    'cible' => '80',
                    'coef' => 15,
                    'frequence' => 'dddd',
                    'mode_calcul' => '22222',
                    'observations' => 'dmmmdmdm',
                    'created_at' => $now,
                    'updated_at' => $now
                ],
                [
                    'performance_contract_id' => $contract_id,
                    'nom' => 'Réduire le taux d’erreurs dans les rapports de 15%',
                    'type' => 'performance',
                    'cible' => '80',
                    'coef' => 15,
                    'frequence' => 'kdkkdqlq',
                    'mode_calcul' => 'dkdk',
                    'observations' => 'kddddd',
                    'created_at' => $now,
                    'updated_at' => $now
                ],
                [
                    'performance_contract_id' => $contract_id,
                    'nom' => 'Finaliser un projet spécifique avec succès',
                    'type' => 'performance',
                    'cible' => '70%',
                    'coef' => 40,
                    'frequence' => 'ldldld',
                    'mode_calcul' => 'ldl',
                    'observations' => 'd',
                    'created_at' => $now,
                    'updated_at' => $now
                ],
                [
                    'performance_contract_id' => $contract_id,
                    'nom' => 'Améliorer la satisfaction client de 20%',
                    'type' => 'performance',
                    'cible' => '90%',
                    'coef' => 20,
                    'frequence' => 'weekly',
                    'mode_calcul' => 'feedback',
                    'observations' => 'Evaluation continue',
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            ]);
        }
    }
}
