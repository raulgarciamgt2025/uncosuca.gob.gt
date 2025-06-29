<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'status',
        'reject_motive',
        'response',
        'filling_date',
        'acceptance_date',
        'history'
    ];

    protected $casts = [
        'response' => 'json',
        'filling_date' => 'datetime',
        'acceptance_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'history' => 'json'
    ];
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
