<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cargo',
        'email',
        'telefono',
        'salario',
        'fecha_contratacion',
    ];

    protected $casts = [
        'fecha_contratacion' => 'date',
        'salario' => 'decimal:2',
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }
}
