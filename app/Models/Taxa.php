<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;

    protected $table    =   'taxas';

    public function formaPagamento()
    {
        return $this->belongsTo(TipoPagamentos::class,'tipo_id');
    }
}
