<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','activo'];

    public function pagoFacturas() {
        return $this->hasMany('App\Models\PagoFactura');
    }
}
