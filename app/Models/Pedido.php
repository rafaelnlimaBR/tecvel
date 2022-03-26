<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table    =   'pedidos';

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class,'fornecedor_id','id');
    }

    public function historicos()
    {

    }

    /*public static function gravar(Request $r)
    {
        $pedido                =   new Pedido();
        $pedido->descricao     =   $r->get('descricao');
        $pedido->valor         =   $r->get('valor');
        if($pedido->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $pedido->id;
    }

    public static function atualizar(Request $r)
    {
        $pedido                =   Pedido::find($r->get('id'));
        $pedido->descricao     =   $r->get('descricao');
        $pedido->valor         =   $r->get('valor');
        if($pedido->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $pedido->id;
    }

    public static function excluir($id)
    {
        $pedido        =   Pedido::find($id);
        if($pedido->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }*/
}
