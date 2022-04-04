<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Entrada extends Model
{
    use HasFactory;
    protected $table    =   'entradas';

    public function taxa()
    {
        return $this->belongsTo(Taxa::class,'taxa_id');
    }

    public static function gravar(Request $r)
    {
        $taxa_pagamento             =   Taxa::find($r->get('taxa'));
        $entrada                    =   new Entrada();
        $entrada->valor             =   $r->get('valor');
        $entrada->valor_total       =   $r->get('valor');
        $entrada->descricao         =   $r->get('descricao');
        $entrada->taxa_id           =   $taxa_pagamento->id;
        $entrada->data              =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));

        if($entrada->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $entrada;
    }
}
