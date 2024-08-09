<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Direction;
use App\Models\Enterprise;
use App\Models\Site;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class UsersImport implements ToModel, WithHeadingRow
{
    protected $dateFormats = ['m/d/Y', 'd/m/Y', 'Y-m-d'];

    public function model(array $row)
    {
        // Assurez-vous que le matricule est présent
        $matricule = $row['matricule'] ?? 'default_matricule'; // Remplacez 'default_matricule' par une valeur par défaut si nécessaire

        // Convertir les dates
        $hiringDate = $this->convertDate($row['hiring_date'] ?? null);
        $dateOfBirth = $this->convertDate($row['date_of_birth'] ?? null);

        // Récupérer les IDs correspondants
        $main_evaluator = User::where('occupation', $row['main_evaluator'] ?? null)->first();
        $second_evaluator = User::where('occupation', $row['second_evaluator'] ?? null)->first();
        $responsable_n1 = User::where('occupation', $row['responsable_n1'] ?? null)->first();
        $responsable_n2 = User::where('occupation', $row['responsable_n2'] ?? null)->first();

        // Créer un nouvel utilisateur avec des valeurs par défaut pour les colonnes obligatoires
        return new User([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'matricule' => $matricule,
            'first_name' => $row['first_name'] ?? 'Unknown',
            'last_name' => $row['last_name'] ?? 'Unknown',
            'name' => $row['name'] ?? 'Unknown',
            'occupation' => $row['occupation'] ?? null,
            'pemp_temp' => $row['pemp_temp'] ?? null,
            'main_evaluator' => $main_evaluator->id ?? null,
            'second_evaluator' => $second_evaluator->id ?? null,
            'direction_id' => Direction::where('name', $row['direction'] ?? null)->value('id') ?? null,
            'enterprise_id' => Enterprise::where('name', $row['enterprise'] ?? null)->value('id') ?? null,
            'site_id' => Site::where('name', $row['site'] ?? null)->value('id') ?? null,
            'hiring_date' => $hiringDate,
            'length_of_service' => $row['length_of_service'] ?? null,
            'statut_category' => $row['statut_category'] ?? null,
            'responsable_n1' => $responsable_n1->id ?? null,
            'responsable_n2' => $responsable_n2->id ?? null,
            'date_of_birth' => $dateOfBirth,
            'email' => $row['email'] ?? null,
            'phone_number' => $row['phone_number'] ?? null,
            'gender' => $row['gender'] ?? null,
            'emergency_contact_name' => $row['emergency_contact_name'] ?? null,
            'emergency_contact_phone' => $row['emergency_contact_phone'] ?? null,
            'email_verified_at' => $row['email_verified_at'] ?? null,
            'status' => $row['status'] ?? 1,
            'password' => isset($row['password']) ? Hash::make($row['password']) : '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => $row['remember_token'] ?? null,
            'created_at' => $row['created_at'] ?? now(),
            'updated_at' => $row['updated_at'] ?? now(),
        ]);
    }

    private function convertDate($date)
    {
        if (!$date) {
            return null;
        }

        foreach ($this->dateFormats as $format) {
            try {
                return Carbon::createFromFormat($format, $date)->format('Y-m-d');
            } catch (\Exception $e) {
                // Continue to the next format if the current one fails
            }
        }

        // Return null if no format matches
        return null;
    }
}
