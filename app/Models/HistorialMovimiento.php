<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialMovimiento extends Model
{
    protected $table = 'historial_movimientos';
    public $timestamps = false;

    protected $fillable = ['movimiento_id', 'fecha', 'detalle'];
    protected $casts = ['fecha' => 'datetime'];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
