<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workflow extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'steps', 'requirements', 'double_process', 'type'];

    protected $searchableFields = ['*'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function workflowRequests()
    {
        return $this->hasMany(WorkflowRequest::class);
    }
}
