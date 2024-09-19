<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Tbord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function performances() : HasMany
    {
        return $this->hasMany(Performance::class);
    }

     /**
     * Relation avec l'utilisateur associé (employé).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec le créateur du tableau de bord.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function search($query): Builder
    {
        return empty($query) ? static::query() :
            static::query()
            ->where(function ($q) use ($query) {
                $q->where('code', 'like', '%' . $query . '%');
                $q->orWhere('title', 'like', '%' . $query . '%');
                $q->orWhere('year', 'like', '%' . $query . '%');
                $q->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                });
            });
    }

}
