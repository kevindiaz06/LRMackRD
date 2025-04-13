<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'libro_id',
        'cantidad',
        'ubicacion_estante',
    ];

    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class);
    }
}
