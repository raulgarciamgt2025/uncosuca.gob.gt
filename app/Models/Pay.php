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
        'fecha_transaccion',
    ];

    protected $attributes = [
        'status' => 0, // Default to 'PENDIENTE'
        'estado' => 'CUOTA', // Default to 'CUOTA'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fecha_pago' => 'date',
        'fecha_transaccion' => 'datetime',
        'penalty' => 'float',
        'variable' => 'float',
        'amount' => 'float',
        'rejections' => 'json'
    ];

    public function getUsuariosAttribute()
    {
        return $this->pay;
    }

    public function setUsuariosAttribute($value)
    {
        $this->pay = $value;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
