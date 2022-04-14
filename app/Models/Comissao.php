<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comissao extends Model
{
    use HasFactory;
    protected $table = "comissoes";

    private static $restricao = [
        'valor'       =>     'required',
        'data'      =>  'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {
        if(array_key_exists('id',$dados)){

        }
        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class,'fornecedor_id');
    }

    public function historico()
    {
        return $this->belongsTo(Historico::class, 'historico_id');
    }

    public function pagamentos()
    {
        return $this->belongsToMany(Saida::class,'saida_comissao','comissao_id','saida_id')
            ->withPivot('saida_id')
            ->withPivot('comissao_id')
            ->withTimestamps();
    }
    public static function gravar(Request $r)
    {
        $comissao                   =   new Comissao();
        $comissao->fornecedor_id    =   $r->get('fornecedor');
        $comissao->historico_id     =   $r->get('historico_id');
        $comissao->valor            =   $r->get('valor');
        $comissao->descricao        =   $r->get('descricao');
        $comissao->obs              =   $r->get('obs');
        $comissao->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($comissao->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $comissao;
    }

    public function atualizar(Request $r)
    {
        $comissao                         =   $this;
        $comissao->fornecedor_id    =   $r->get('fornecedor');
        $comissao->historico_id     =   $r->get('historico_id');
        $comissao->valor            =   $r->get('valor');
        $comissao->descricao        =   $r->get('descricao');
        $comissao->obs              =   $r->get('obs');
        $comissao->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($comissao->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $comissao;
    }

    public function excluir()
    {
        $comissao        =   $this;
        if($comissao->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
    
}
