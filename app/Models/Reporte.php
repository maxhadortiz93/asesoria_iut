<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';
    public $timestamps = false;

    protected $fillable = ['usuario_id', 'tipo', 'fecha_generado', 'archivo_pdf_path'];
    protected $casts = ['fecha_generado' => 'datetime'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
