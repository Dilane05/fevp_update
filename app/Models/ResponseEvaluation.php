<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseEvaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'bilan_resultat' => 'array', // Utiliser array pour les colonnes JSON
        'tenue_global' => 'array',
        'mangerial_quality' => 'array',
        'compliance_corporate' => 'array',
        'bonus_malus' => 'array',
        'sanction' => 'array',
        'other' => 'array',
    ];

}
