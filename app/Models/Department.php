<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'active', 'manager_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
