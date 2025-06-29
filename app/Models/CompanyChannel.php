<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CompanyChannel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'company_id',
        'channel_id',
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function channel(): HasOne
    {
        return $this->hasOne(Channel::class, 'id', 'channel_id');
    }
}
