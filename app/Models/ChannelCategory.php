<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChannelCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class, 'channel_category_id', 'id');
    }
}
