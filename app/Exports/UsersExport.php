<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'UUID',
            'Username',
            'First Name',
            'Last Name',
            'Email',
            'Phone Number',
            'Gender',
            'Date of Birth',
            'Emergency Contact',
            'Emergency Phone',
            'Department',
            'Title',
            'Manager',
            'Company',
            'Location',
            'Department Detail',
            'Hire Date',
            'Category',
            'Active',
            'Password',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->uuid,
            $user->username,
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->phone_number,
            $user->gender,
            $user->date_of_birth,
            $user->emergency_contact,
            $user->emergency_phone,
            $user->department,
            $user->title,
            $user->manager,
            $user->company,
            $user->location,
            $user->department_detail,
            $user->hire_date,
            $user->category,
            $user->active,
            $user->password,
        ];
    }

}
