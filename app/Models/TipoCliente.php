<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;

    protected $fillable = ['tipo','activo'];

    public function clientes() {
        return $this->hasMany('App\Models\Cliente');
    }
}
