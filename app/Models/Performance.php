<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Performance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'months' => 'array',
    ];

    public function tbord() : BelongsTo
    {
        return $this->belongsTo(Tbord::class);
    }

}
