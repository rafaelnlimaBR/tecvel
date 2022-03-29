<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Historico extends Model
{
    use HasFactory;
    protected $table    =   "historicos";

    public function tipo()
    {
        return $this->belongsTo(TipoContrato::class,'tipo_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class,'trabalhos','historico_id','servico_id')
            ->withPivot([
                'valor','autorizado','data','id'
            ]);
    }

    public function pecas()
    {
        return $this->hasMany(Peca::class,'historico_id');
    }

    public function cadastrarServico(Request $r)
    {
        $this->servicos()->attach($r->get('servico_id'),[
            'valor'         =>  $r->get('valor'),
            'autorizado'    =>  $r->get('autorizado'),
            'data'          =>  Carbon::now()
        ]);
    }
    public function excluirServico($trabalho_id)
    {
        $tabalho        =   Trabalho::find($trabalho_id);
        if($tabalho == null){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
        $tabalho->excluir();
    }


}
