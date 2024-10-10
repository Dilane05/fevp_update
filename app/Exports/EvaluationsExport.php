<?php

namespace App\Exports;

use App\Models\ResponseEvaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


class EvaluationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return ResponseEvaluation::all();
    // }
    public function collection()
    {
        // Récupérer les évaluations avec les relations nécessaires
        return ResponseEvaluation::with('user', 'user.site', 'user.direction')->get();
    }

    // Définir les en-têtes du fichier Excel
    public function headings(): array
    {
        return [
            'Matricule',
            'Nom',
            'Occupation',
            'Site',
            'Direction',
            'Étape 1',
            'Étape 2',
            'Étape 3',
        ];
    }

    // Mapper les données pour chaque ligne
    public function map($evaluation): array
    {
        return [
            $evaluation->user->matricule,
            $evaluation->user->name,
            $evaluation->user->occupation,
            $evaluation->user->site->name,
            $evaluation->user->direction->name,
            $evaluation->is_send ? Carbon::parse($evaluation->date)->format('d/m/Y') : 'N/A',
            $evaluation->is_n1 ? Carbon::parse($evaluation->date_n1)->format('d/m/Y') : 'N/A',
            $evaluation->is_n2 ? Carbon::parse($evaluation->date_n2)->format('d/m/Y') : 'N/A',
        ];
    }

}
