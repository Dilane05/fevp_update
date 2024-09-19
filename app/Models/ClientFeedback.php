<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientFeedback extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client() : BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public static function search($query)
    {
        return empty($query) ? static::query() :
            static::query()
            ->where(function ($q) use ($query) {
                $q->where('created_at', 'like', '%' . $query . '%');
                $q->orWhere('feedback', 'like', '%' . $query . '%');
                $q->orWhereHas('client', function ($q) use ($query) {
                    $q->where('first_name', 'like', '%' . $query . '%');
                    $q->orWhere('last_name', 'like', '%' . $query . '%');
                    $q->orWhere('phone_number', 'like', '%' . $query . '%');
                    $q->orWhere('email', 'like', '%' . $query . '%');
                });
              
            });
    }
}
