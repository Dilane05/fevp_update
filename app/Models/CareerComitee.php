<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CareerComitee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function response(): BelongsTo
    {
        return $this->belongsTo(ResponseEvaluation::class);
    }

}
