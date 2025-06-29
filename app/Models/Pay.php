<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pay extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'mount',
        'year',
        'pay',
        'amount',
        'variable',
        'penalty',
        'ticket_number',
        'ticket_file',
        'rejections',
        'subscribers_number',
        'status',
        'company_id',
        'estado',
        'fecha_pago',
        'observaciones',
    ];

    protected $attributes = [
        'status' => 0, // Default to 'PENDIENTE'
        'estado' => 'CUOTA', // Default to 'CUOTA'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha_pago' => 'date',
        'rejections' => 'json'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
