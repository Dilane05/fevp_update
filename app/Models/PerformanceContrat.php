<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceContrat extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation avec les indicateurs
    public function indicateurs()
    {
        return $this->hasMany(IndicatorPerformanceContract::class);
    }

}
