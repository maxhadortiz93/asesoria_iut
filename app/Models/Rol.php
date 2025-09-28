<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    public $timestamps = false;

    protected $fillable = ['nombre', 'permisos'];
    protected $casts = [
        'permisos' => 'array',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
