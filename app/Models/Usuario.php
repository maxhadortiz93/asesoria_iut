<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;

    /**
     * Tabla personalizada para el modelo de autenticación.
     */
    protected $table = 'usuarios';

    /**
     * Atributos que pueden ser asignados masivamente.
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
     * Atributos ocultos en serializaciones.
     */
    protected $hidden = [
        'hash_password',
    ];

    /**
     * Casts automáticos para atributos.
     */
    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Laravel usará este campo como contraseña.
     */
    public function getAuthPassword()
    {
        return $this->hash_password;
    }

    /**
     * Laravel usará este campo como identificador de login.
     */
    public function getAuthIdentifierName()
    {
        return 'correo';
    }

    /**
     * Relación: Usuario pertenece a un Rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    /**
     * Relación: Usuario tiene muchos Reportes.
     */
    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    /**
     * Relación: Usuario tiene muchos Movimientos.
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}



