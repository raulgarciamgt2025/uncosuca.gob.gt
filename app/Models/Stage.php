<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'json',
        'assign_id',
        'assign_type',
        'assign_level',
        'workflow_id',
    ];

    protected $searchableFields = ['*'];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function stateStages()
    {
        return $this->hasMany(StateStage::class);
    }
}
