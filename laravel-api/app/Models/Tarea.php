<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'estado',
        'fecha_vencimiento',
    ];

    // Relación: una tarea pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
        return $this->belongsTo(\App\Models\Usuario::class, 'usuario_id');
    }
}
