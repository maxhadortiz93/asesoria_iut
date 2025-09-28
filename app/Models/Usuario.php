<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada.
     */
    protected $table = 'usuarios';

    /**
     * Atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'rol_id',
        'cedula',
        'nombre',
        'correo',
        'hash_password',
        'activo',
    ];

    /**
     * Atributos que deben ocultarse en arrays o JSON.
     */
    protected $hidden = [
        'hash_password',
    ];

    /**
     * Conversión de tipos para atributos.
     */
    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Relación: Un usuario pertenece a un rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    /**
     * Relación: Un usuario tiene muchos reportes.
     */
    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    /**
     * Relación: Un usuario tiene muchos movimientos.
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
