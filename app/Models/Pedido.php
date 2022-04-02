<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Pedido extends Model
{
    use HasFactory;
    protected $table    =   'pedidos';

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class,'fornecedor_id');
    }

    public function pecas()
    {
        return $this->hasMany(Peca::class,'pedido_id');
    }

    public function historico()
    {
        return $this->belongsTo(Historico::class,'historico_id');
    }

    public static function gravar(Request $r)
    {
        $pedido                =   new Pedido();
        $pedido->fornecedor_id =   $r->get('fornecedor');
        $pedido->numero_pedido =   $r->get('codigo');
        $pedido->historico_id  =   $r->get('historico_id');
        $pedido->desconto      =   $r->get('desconto');
        $pedido->data           =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($pedido->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $pedido;
    }

    public static function atualizar(Request $r)
    {
        $pedido                =   Pedido::find($r->get('pedido_id'));
        $pedido->fornecedor_id =   $r->get('fornecedor');
        $pedido->numero_pedido =   $r->get('codigo');
        $pedido->historico_id  =   $r->get('historico_id');
        $pedido->desconto      =   $r->get('desconto');
        $pedido->data           =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($pedido->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $pedido;
    }

    public static function excluir($id)
    {
        $pedido        =   Pedido::find($id);
        if($pedido->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }


}
