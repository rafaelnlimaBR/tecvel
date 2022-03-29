<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Trabalho extends Model
{
    use HasFactory;
    protected $table    =   "trabalhos";

    public function scopePesquisarPorServico($query, $nome)
    {
        return $query->whereHas('servico', function ($query) use ($nome) {
            $query->where('descricao', 'like', '%' . $nome . '%');
        });
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class,'servico_id');
    }


    public function cadastrar(Request $r)
    {
        $this->servicos()->attach($r->get('servico_id'),[
            'valor'         =>  $r->get('valor'),
            'autorizado'    =>  $r->get('autorizado'),
            'data'          =>  Carbon::now()
        ]);
    }
    public function excluir()
    {
        if($this->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }


}
