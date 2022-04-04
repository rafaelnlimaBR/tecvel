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

    public function contrato()
    {
        return $this->belongsTo(Contrato::class,'contrato_id');
    }

    public function pagamentos()
    {
        return $this->belongsToMany(Entrada::class,'entrada_historicos','historico_id','entrada_id','')->withTimestamps();
    }

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

    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'historico_id');
    }

    public function valorTotalPago()
    {
        return $this->pagamentos->sum('valor');
    }

    public function valorTotalServicoAutorizado()
    {
        $historico      =   $this;
        $valorServicoTotalAutorizado    =  0;

        foreach ($historico->servicos as $s){
            if($s->pivot->autorizado == 1){
                $valorServicoTotalAutorizado += $s->pivot->valor;
            }
        }
        return $valorServicoTotalAutorizado;
    }
    public function valorTotalPecasAutorizado()
    {
        $historico      =   $this;
        $valorPecaTotalAutorizado    =  0;

        foreach ($historico->pecas as $s){
            if($s->autorizado == 1){
                $valorPecaTotalAutorizado += $s->valor*$s->qnt;
            }
        }
        return $valorPecaTotalAutorizado;
    }

    public function historico_pedido()
    {
        return $this->belongsToMany(Pedido::class, 'pecas','historico_id','pedido_id')
            ->withPivot('id','valor','valor_fornecedor','descricao','qnt');
    }

    public function scopePedidosSR ()
    {
        // I assume resources is the relation name, instead of singular resource
        return $this::whereHas('pecas', function ($q) {
            $q->distinct('pedido_id');
        });
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
