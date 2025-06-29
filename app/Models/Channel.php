<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'channel_category_id',
        'active'
    ];

    public function category()
    {
        return $this->hasOne(ChannelCategory::class, 'id', 'channel_category_id');
    }
}
