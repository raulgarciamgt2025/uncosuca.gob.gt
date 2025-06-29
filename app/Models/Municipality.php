<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Municipality extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'province_id'
    ];

    public function province(): HasOne
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }
}
