<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupo extends Model
{
    use HasFactory;
    protected $fillable = ['cupo_aprobado', 'cupo_disponible', 'saldo', 'ultimo_credito', 'ultimo_pago', 'cliente_id'];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
}
