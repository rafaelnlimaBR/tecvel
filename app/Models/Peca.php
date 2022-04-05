<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Peca extends Model
{
    use HasFactory;
    protected $table    =   "pecas";

    public function pedido()
    {
        return $this->belongsTo(Pedido::class,'pedido_id');
    }

    public static function cadastrar($descricao,$valor)
    {
        $peca               =   new Peca();
        $peca->descricao    =   strtoupper($descricao);
        $peca->valor        =   $valor;


        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $peca;
    }


    public function atualizar($descricao)
    {
        $peca               =   $this;
        $peca->descricao    =   strtoupper($descricao);


        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $peca;
    }

    public function adicionarPedido(Request $r)
    {
        $peca               =   $this;
        $peca->pedido_id    =   ($r->get('selecionado') =="true"?$r->get('pedido_id'):null);
        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
    }

    public function adicionarPeca()
    {

    }
}
