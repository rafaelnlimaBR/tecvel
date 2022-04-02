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

    public static function cadastrar(Request $r)
    {
        $peca               =   new Peca();
        $peca->descricao    =   strtoupper($r->get('descricao'));
        $peca->valor        =   $r->get('valor');
        $peca->valor_fornecedor        =   $r->get('valor_fornecedor');
        $peca->qnt          =   $r->get('qnt');
        $peca->autorizado   =   $r->get('autorizado');
        $peca->historico_id =   $r->get('historico_id');

        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $peca;
    }
    public function excluir()
    {
        if($this->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

    public function atualizar(Request $r)
    {
        $peca               =   $this;
        $peca->descricao    =   strtoupper($r->get('descricao'));
        $peca->valor        =   $r->get('valor');
        $peca->valor_fornecedor        =   $r->get('valor_fornecedor');
        $peca->qnt          =   $r->get('qnt');
        $peca->autorizado   =   $r->get('autorizado');
        $peca->historico_id =   $r->get('historico_id');

        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $peca;
    }

    public function adicionarPedido(Request $r)
    {
        $peca               =   $this;
        $peca->pedido_id    =   ($r->get('selecionado') == true?$r->get('pedido_id'):null);
        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
    }
}
