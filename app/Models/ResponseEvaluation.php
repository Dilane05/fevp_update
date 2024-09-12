<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResponseEvaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function careerComitee(): HasOne
    {
        return $this->hasOne(CareerComitee::class);
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
