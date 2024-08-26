<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ComiteeCalibrage extends Model
{
    use HasFactory;

    protected $guarded = [];



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
