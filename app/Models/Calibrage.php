<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calibrage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function response_evaluation()
    {
        return $this->belongsTo(ResponseEvaluation::class);
    }

    protected $casts = [
        'bilan_resultat' => 'array', // Utiliser array pour les colonnes JSON
        'tenue_global' => 'array',
        'manegerial_quality' => 'array',
        'compliance_corporate' => 'array',
        'bonus_malus' => 'array',
        'sanction' => 'array',
        'other' => 'array',
    ];

}
