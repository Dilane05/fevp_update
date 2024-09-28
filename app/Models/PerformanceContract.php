<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerformanceContract extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec les indicateurs
    public function performances() : HasMany
    {
        return $this->hasMany(PerformanceContrat::class);
    }

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
