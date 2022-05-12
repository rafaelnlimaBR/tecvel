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

    public function terceirizados()
    {
        return $this->hasMany(Terceirizados::class,'historico_id');
    }

    public function pagamentos()
    {
        return $this->belongsToMany(Entrada::class,'entrada_historicos','historico_id','entrada_id','')->withTimestamps();
    }

    public function tipo()
    {
        return $this->belongsTo(TipoContrato::class,'tipo_id');
    }

    public function comissoes()
    {
        return $this->hasMany(Comissao::class,'historico_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class,'trabalhos','historico_id','servico_id')
            ->withPivot([
                'valor','autorizado','id'
            ]);
    }

    public function pecas()
    {
        return $this->belongsToMany(Peca::class,'historico_peca','historico_id','peca_id')
            ->withPivot('valor_fornecedor','qnt','pedido_id','id','autorizado','valor')
            ->withTimestamps();
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'historico_id');
    }

    public function excluirPagamentoEntrada()
    {
        foreach ($this->pagamentos as $p){
            $entrada     =   Entrada::find($p->pivot->entrada_id);
            $entrada->excluir();
        }
    }

    public function excluirPagamentosComissao()
    {
        foreach ($this->comissoes as $c){
           foreach ($c->pagamentos as $p){
               $saida      =   Saida::find($p->pivot->saida_id);
               $saida->excluir();
           }
        }
    }

    public function excluirPagamentosTerceirizado()
    {
        foreach ($this->terceirizados as $c){
            foreach ($c->pagamentos as $p){
                $saida      =   Saida::find($p->pivot->saida_id);
                $saida->excluir();
            }
        }
    }

    public function excluirPagamentosPedido()
    {
        foreach ($this->pedidos as $c){
            foreach ($c->pagamentos as $p){
                $saida      =   Saida::find($p->pivot->saida_id);
                $saida->excluir();
            }
        }
    }

    public function valorTotalPago()
    {
        return $this->pagamentos->sum('valor');
    }

    public function valorTotalComDesconto()
    {
        return $this->ValorTotalServicosAutorizadoComDesconto()+$this->ValorTotalPecasAutorizadoComDesconto();
    }


    public function ValorTotalServicosAutorizadoComDesconto()
    {
        $valor_total_servicos_autorizado       =   $this->valorTotalServicoAutorizado();
        $desconto                           =   $this->contrato->desconto_servico;
        return $valor_total_servicos_autorizado-($valor_total_servicos_autorizado *(($desconto/100)));
    }

    public function ValorTotalServicosComDesconto()
    {
        $valor_total_servicos       =   $this->valorTotalServico();
        $desconto                           =   $this->contrato->desconto_servico;
        return $valor_total_servicos-($valor_total_servicos *(($desconto/100)));
    }

    public function ValorTotalPecasAutorizadoComDesconto()
    {
        $valor_total_pecas       =   $this->valorTotalPecasAutorizado();
        $desconto                           =   $this->contrato->desconto_peca;
        return $valor_total_pecas-($valor_total_pecas *(($desconto/100)));
    }

    public function ValorTotalPecasComDesconto()
    {
        $valor_total_pecas_autorizado       =   $this->valorTotalPecas();
        $desconto                           =   $this->contrato->desconto_peca;
        return $valor_total_pecas_autorizado-($valor_total_pecas_autorizado *(($desconto/100)));
    }

    public function valorTotalServico()
    {
        $historico      =   $this;
        $valorServicoTotal    =  0;

        foreach ($historico->servicos as $s){

                $valorServicoTotal += $s->pivot->valor;

        }
        return $valorServicoTotal;
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
            if($s->pivot->autorizado == 1){
                $valorPecaTotalAutorizado += $s->pivot->valor*$s->pivot->qnt;
            }
        }
        return $valorPecaTotalAutorizado;
    }

    public function valorTotalPecas()
    {
        $historico      =   $this;
        $valorPecaTotal    =  0;

        foreach ($historico->pecas as $s){
                $valorPecaTotal += $s->pivot->valor*$s->pivot->qnt;

        }
        return $valorPecaTotal;
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
