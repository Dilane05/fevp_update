<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComiteeCalibrage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function members() : HasMany
    {
        return $this->hasMany(MembreComiteeCalibrage::class);
    }

    public function populations() : HasMany
    {
        return $this->hasMany(PopulationCibleComitee::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public static function search($query): Builder
    {
        return empty($query) ? static::query() :
            static::query()
            ->where(function ($q) use ($query) {
                $q->where('code', 'like', '%' . $query . '%');
                $q->orWhere('title', 'like', '%' . $query . '%');
            });
    }

}
