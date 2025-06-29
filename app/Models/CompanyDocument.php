<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CompanyDocument extends Model
{

    protected $fillable = [
        'url',
        'description',
        'observations',
        'company_id'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
