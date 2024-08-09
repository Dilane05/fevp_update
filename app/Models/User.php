<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Illuminate\Support\Str;
use App\Models\ClientConsent;
use App\Models\Traits\HasUUID;
use Illuminate\Support\Carbon;
use Nnjeim\World\Models\State;
use Nnjeim\World\Models\Country;
use Spatie\Permission\Traits\HasRoles;
use App\Consultations\TimeSlotGenerator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Boolean;
use App\Consultations\Filters\ConsultationFilter;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Consultations\Filters\UnavailabilityFilter;
use App\Consultations\Filters\SlotsPassedTodayFilter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasUUID;

    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 0;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean'
        ];
    }

    public function getInitialsAttribute(): string
    {
        return strtoupper(Str::substr($this->first_name, 0, 1)) . "" . strtoupper(Str::substr($this->last_name, 0, 1));
    }
    public function getNameAttribute(): string
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

    public function getRedirectRoute(): string
    {
        return $this->getRoleNames()->first() === 'user' ? 'my/dashboard' : 'portal/dashboard';
    }

    public function getStatusStyleAttribute(): string
    {
        return match ($this->status) {
            true => 'success',
            false => 'danger',
            default => 'info'
        };
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            true => __('Actif'),
            false => __('Banit'),
            NULL => __('Actif'),
        };
    }


    public function getGenderStyleAttribute(): string
    {
        return match ($this->gender) {
            'male' => 'gray-400',
            'female' => 'gray-600',
            default => 'info'
        };
    }

    public function scopeActive($query): Builder
    {
        return $query->where('status', 1);
    }

    public function scopeInActive($query): Builder
    {
        return $query->where('status', 0);
    }

    public function getRoleStyleAttribute(): string
    {
        return match ($this->getRoleNames()->first()) {
            'user' => 'info',
            'admin' => 'primary',
            default => 'danger'
        };
    }

    // public function enterprise():BelongsTo
    // {
    //     return $this->belongsTo(Enterprise::class,'enterprise_id');
    // }

    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class);
    }

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class, 'evaluation_user');
    }

    public static function search($query): Builder
    {
        return empty($query) ? static::query() :
            static::query()
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'like', '%' . $query . '%');
                $q->orWhere('last_name', 'like', '%' . $query . '%');
                $q->orWhere('email', 'like', '%' . $query . '%');
                $q->orWhere('occupation', 'like', '%' . $query . '%');
                $q->orWhere('phone_number', 'like', '%' . $query . '%');
                $q->orWhereHas('roles', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                });
            });
    }
}
