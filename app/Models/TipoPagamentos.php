<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagamentos extends Model
{
    use HasFactory;
    protected $table    =   'tipo_pagamentos';



    public function taxas()
    {
        return $this->hasMany(Taxa::class,'tipo_id');
    }
}
