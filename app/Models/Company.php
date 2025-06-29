<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'mercantile_name',
        'social_denomination',
        'nit',
        'address',
        'station_address',
        'coverage',
        'owners',
        'village',
        'cui',
        'phone',
        'users_number',
        'license',
        'emails',
        'latitude',
        'longitude',
        'location_image',
        'legal_representative',
        'resolution',
        'start_date',
        'end_date',
        'status',
        'payment_status',
        'company_type',
        'workflows_history',
        'user_id',
        'cancellation_comment',
        'municipality_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    protected $casts = [
        'workflows_history' => 'json',
        'emails' => 'json',
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function municipality(): HasOne
    {
        return $this->hasOne(Municipality::class, 'id', 'municipality_id');
    }

    public function assignedUsers(): HasMany
    {
        return $this->hasMany(UserCompany::class, 'company_id', 'id');
    }

    public function pays(): HasMany
    {
        return $this->hasMany(Pay::class, 'company_id', 'id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'company_id', 'id');
    }

    public function channels(): HasMany
    {
        return $this->hasMany(CompanyChannel::class, 'company_id', 'id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(CompanyDocument::class, 'company_id', 'id');
    }
}
