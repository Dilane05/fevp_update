<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'matricule' => $row['matricule'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'gender' => $row['gender'],
            'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']),
            'emergency_contact_name' => $row['emergency_contact_name'],
            'emergency_contact_phone' => $row['emergency_contact_phone'],
            'occupation' => $row['occupation'],
            'pemp_temp' => $row['pemp_temp'],
            'direction' => $row['direction'],
            'enterprise' => $row['enterprise'],
            'site' => $row['site'],
            'signification_direction' => $row['signification_direction'],
            'hiring_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['hiring_date']),
            'statut_category' => $row['statut_category'],
            'email_verified_at' => now(),
            'status' => $row['status'] ?? User::STATUS_ACTIVE,
            'password' => Hash::make($row['password']),
        ]);
    }
}
