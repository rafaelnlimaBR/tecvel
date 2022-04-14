<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Terceirizados extends Model
{
    use HasFactory;
    protected $table    =   "terceirizados";

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class,'fornecedor_id');
    }

    public function historico()
    {
        return $this->belongsTo(Historico::class,'historico_id');
    }

    public function pagamentos()
    {
            return $this->belongsToMany(Saida::class,'saida_terceirizado','terceirizado_id','saida_id')
                ->withPivot('saida_id')
                ->withPivot('terceirizado_id')
                ->withTimestamps();
    }

    public static function gravar(Request $r)
    {
        $terceirizado                   =   new Terceirizados();
        $terceirizado->fornecedor_id    =   $r->get('fornecedor');
        $terceirizado->codigo           =   $r->get('codigo');
        $terceirizado->historico_id     =   $r->get('historico_id');
        $terceirizado->valor            =   $r->get('valor');
        $terceirizado->obs              =   $r->get('obs');
        $terceirizado->servico          =   $r->get('servico');
        $terceirizado->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($terceirizado->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $terceirizado;
    }

    public function atualizar(Request $r)
    {
        $terceirizado                         =   $this;
        $terceirizado->fornecedor_id    =   $r->get('fornecedor');
        $terceirizado->codigo           =   $r->get('codigo');
        $terceirizado->historico_id     =   $r->get('historico_id');
        $terceirizado->valor            =   $r->get('valor');
        $terceirizado->obs              =   $r->get('obs');
        $terceirizado->servico          =   $r->get('servico');
        $terceirizado->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($terceirizado->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $terceirizado;
    }

    public function excluir()
    {
        $terceirizado        =   $this;
        if($terceirizado->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
