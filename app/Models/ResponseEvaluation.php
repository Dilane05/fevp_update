<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

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

    public static function search($query): Builder
    {
        return empty($query) ? static::query() :
            static::query()
            ->where(function ($q) use ($query) {
                // $q->where('first_name', 'like', '%' . $query . '%');
                // $q->orWhere('last_name', 'like', '%' . $query . '%');
                // $q->orWhere('email', 'like', '%' . $query . '%');
                // $q->orWhere('occupation', 'like', '%' . $query . '%');
                // $q->orWhere('phone_number', 'like', '%' . $query . '%');
                $q->WhereHas('evaluation', function ($q) use ($query) {
                    $q->WhereHas('user', function ($q) use ($query) {
                        $q->where('first_name', 'like', '%' . $query . '%');
                        $q->orWhere('last_name', 'like', '%' . $query . '%');
                        $q->orWhere('email', 'like', '%' . $query . '%');
                        $q->orWhere('occupation', 'like', '%' . $query . '%');
                        $q->orWhere('phone_number', 'like', '%' . $query . '%');
                    });
                });
            });
    }

}
