<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'evaluation_user');
    }

    public function comitees()
    {
        return $this->belongsToMany(User::class, 'membre_comitee_calibrage');
    }

    public function responses() : HasMany
    {
        return $this->hasMany(ResponseEvaluation::class);
    }

    // Méthode pour générer un code d'évaluation
    public static function generateEvaluationCode()
    {
        // Obtenir l'année en cours
        $currentYear = date('Y');
        $yearSuffix = date('y'); // Les deux derniers chiffres de l'année

        // Rechercher la dernière évaluation de l'année en cours
        $lastEvaluation = self::whereYear('created_at', $currentYear)
                              ->orderBy('id', 'desc')
                              ->first();

        // Déterminer le numéro de l'évaluation (incrémentation)
        $evaluationNumber = $lastEvaluation ? (int)substr($lastEvaluation->code, -2) + 1 : 1;

        // Générer le code au format EVAL + année + numéro (ex : EVAL2401)
        $evaluationCode = sprintf('EVAL%s%02d', $yearSuffix, $evaluationNumber);

        return $evaluationCode;
    }

    public static function search($query): Builder
    {
        return empty($query) ? static::query() :
            static::query()
            ->where(function ($q) use ($query) {
                $q->where('code', 'like', '%' . $query . '%');
                $q->orWhere('title', 'like', '%' . $query . '%');
                $q->orWhere('start_date', 'like', '%' . $query . '%');
                $q->orWhere('end_date', 'like', '%' . $query . '%');
            });
    }

}
