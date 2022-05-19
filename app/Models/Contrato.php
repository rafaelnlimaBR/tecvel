<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contrato extends Model
{
    use HasFactory;
    protected $table    =   'contratos';

    private static $restricao = [
        'cliente'       =>     'required',
        'veiculo'       =>     'required',
        'desconto_peca'    =>     'required',
        'desconto_servico'    =>     'required',
        'data'          =>     'required',
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

    public function status()
    {
        return $this->belongsToMany(Status::class,'historicos','contrato_id','status_id')
            ->withPivot('data')
            ->withPivot('obs')
            ->withPivot('tipo_id')
            ->withPivot('id')
            ->withTimestamps();
    }



    public function historicos()
    {
        return $this->hasMany(Historico::class,'contrato_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class,'veiculo_id');
    }

    public function valorTotal()
    {
        return $this->TotalPecasAutorizadoComDesconto() + $this->totalServicoAutorizadoComDesconto();
    }

    public function totalServicoSemDesconto()
    {
        $valorTotalSemDesconto  =   0;
        $desconto               =   $this->desconto_servico;

        foreach ($this->historicos as $historico){
            $valorTotalSemDesconto  += $historico->valorTotalServico();
        }
        return $valorTotalSemDesconto;
    }

    public function totalServicoAutorizadoSemDesconto()
    {
        $valorTotalAutorizadoSemDesconto  =   0;



        foreach ($this->historicos as $historico){

            $valorTotalAutorizadoSemDesconto  += $historico->valorTotalServicoAutorizado();
        }
        return $valorTotalAutorizadoSemDesconto;
    }

    public function totalServicoComDesconto()
    {
        $valorTotalComDesconto  =   0;


        foreach ($this->historicos as $historico){
            $valorTotalComDesconto  += $historico->ValorTotalServicosComDesconto();
        }
        return $valorTotalComDesconto;
    }

    public function totalServicoAutorizadoComDesconto()
    {
        $valorTotalComDesconto  =   0;


        foreach ($this->historicos as $historico){
            $valorTotalComDesconto  += $historico->ValorTotalServicosAutorizadoComDesconto();
        }
        return $valorTotalComDesconto;
    }

    public function TotalPecasSemDesconto()
    {

        $valorPecaSemDesconto    =  0;

        foreach ($this->historicos as $historico){
            $valorPecaSemDesconto  += $historico->valorTotalPecas();
        }

        return $valorPecaSemDesconto;
    }

    public function TotalPecasAutorizadoSemDesconto()
    {

        $valorPecaAutorizadoSemDesconto    =  0;

        foreach ($this->historicos as $historico){
            $valorPecaAutorizadoSemDesconto  += $historico->valorTotalPecasAutorizado();
        }

        return $valorPecaAutorizadoSemDesconto;
    }

    public function TotalPecasComDesconto()
    {

        $valorPecaComDesconto    =  0;

        foreach ($this->historicos as $historico){
            $valorPecaComDesconto  += $historico->ValorTotalPecasComDesconto();
        }

        return $valorPecaComDesconto;
    }

    public function TotalPecasAutorizadoComDesconto()
    {

        $valorPecaComDesconto    =  0;

        foreach ($this->historicos as $historico){
            $valorPecaComDesconto  += $historico->ValorTotalPecasAutorizadoComDesconto();
        }

        return $valorPecaComDesconto;
    }

    public function qntServicos()
    {
        $qnt    =   0;
        foreach ($this->historicos as $historico){

            $qnt    += $historico->servicos()->count();
        }
        return $qnt;
    }

    public function qntPagamentos()
    {
        $qnt    =   0;
        foreach ($this->historicos as $historico){
            $qnt    += $historico->pagamentos()->count();
        }
        return $qnt;
    }

    public function verificarPagamento()
    {
        $total_pecas    =   $this->TotalPecasAutorizadoComDesconto();
        $total_servicos =   $this->totalServicoAutorizadoComDesconto();
        $total_pagamentos=  $this->valorTotalPagamentos();
        $valor_total    =   $total_servicos+$total_pecas;

        return $valor_total - $total_pagamentos;
    }

    public function qntPecas()
    {
        $qnt    =   0;
        foreach ($this->historicos as $historico){
            $qnt    +=  $historico->pecas()->count();
        }
        return $qnt;
    }

    public function valorTotalPagamentos()
    {
        $totalPagamentos    =   0;
        foreach ($this->historicos as $historico){
            $totalPagamentos    +=  $historico->valorTotalPago();
        }

        return $totalPagamentos;
    }


    public static function gravar(Request $r)
    {
        $conf                   =   Configuracao::find(1);
        $contrato               =   new Contrato();
        $contrato->obs          =   $r->get('obs');
        $contrato->defeito      =   $r->get('defeito');
        $contrato->data         =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        $contrato->cliente_id   =   $r->get('cliente');
        $contrato->veiculo_id   =   $r->get('veiculo');
        $contrato->garantia     =   $r->get('garantia');
        $contrato->desconto_peca=   $r->get('desconto_peca');
        $contrato->desconto_servico     =   $r->get('desconto_servico');
        $contrato->data_fim_garantia    =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'))->addDays( $r->get('garantia'));


        if($contrato->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }

        $status = null;
        if(\request()->get('tipo_contrato') == $conf->orcamento){
            $status =   $conf->aberto;
        }else{
            $status =   $conf->autorizado;
        }
        $contrato->status()->attach($status,
            [
                'obs'           =>   'Criado em '.\request()->get('data'),
                'data'          =>  Carbon::createFromFormat('d/m/Y H:i',$r->get('data')),
                'tipo_id'       => \request()->get('tipo_contrato'),
            ]);

        return $contrato;
    }

    public static function atualizar(Request $r)
    {
        $contrato                =   Contrato::find($r->get('contrato_id'));


        $contrato->obs          =   $r->get('obs');
        $contrato->defeito      =   $r->get('defeito');
        $contrato->data         =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        $contrato->cliente_id   =   $r->get('cliente');
        $contrato->veiculo_id   =   $r->get('veiculo');
        $contrato->garantia     =   $r->get('garantia');
        $contrato->desconto_peca=   $r->get('desconto_peca');
        $contrato->desconto_servico     =   $r->get('desconto_servico');



        if($contrato->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $contrato->id;
    }

    public static function excluir($id)
    {
        $contrato        =   Contrato::find($id);
        foreach ($contrato->historicos as $h){
            $h->excluirPagamentoEntrada();
            $h->excluirPagamentosComissao();
            $h->excluirPagamentosTerceirizado();
            $h->excluirPagamentosPedido();
        }

        if($contrato->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

    public function atualizarStatus(Request $r)
    {

        $tipo_id        =   null;
        $conf           =   Configuracao::find(1);
        $historico      =   Historico::find($r->get('historico_id'));
        $contrato       =   Contrato::find($r->get('contrato_id'));
        $pecas          =   [];
        $servicos       =   [];


        switch ($r->get('status_id')){
            case  $conf->autorizado:
                $pecas      =   $historico->pecas;
                $servicos   =   $historico->servicos;
                $tipo_id    =   $conf->ordem_servico;
                break;
            case $conf->nao_autorizado:

                $tipo_id    =   $conf->orcamento;
                break;
            case $conf->aberto:

                $tipo_id    =   $r->get('tipo_id');
                break;
            case $conf->concluido:

                $tipo_id    =   $r->get('tipo_id');
                break;
            case $conf->retorno:
                $contrato->data_fim_garantia    =    Carbon::createFromFormat('d/m/Y H:i',$r->get('data'))->addDays($contrato->garantia);
                if($contrato->save() == false){
                    throw new \Exception('Não foi possível realizar o registro',200);
                }
                $tipo_id    =   $r->get('tipo_id');
                break;
        };

        $this->status()->attach($r->get('status_id'),[
            'data'          =>  Carbon::createFromFormat('d/m/Y H:i',$r->get('data')),
            'obs'           =>  $r->get('obs'),
            'tipo_id'       =>  $tipo_id
            ]);
        if($r->get('status_id') == $conf->autorizado){
            $historico  =   Historico::find($this->status->last()->pivot->id);
            foreach ($pecas as $p){
                $historico->pecas()->attach($p->id,[
                    'valor'             =>      $p->pivot->valor,
                    'valor_fornecedor'  =>      $p->pivot->valor_fornecedor,
                    'qnt'               =>      $p->pivot->qnt,
                    'autorizado'        =>      true,
                ]);
            }
            foreach ($servicos as $s){
                $historico->servicos()->attach($s->id,[
                    'valor'             =>      $s->pivot->valor,
                    'autorizado'        =>      true,
                ]);
            }
        }
    }



}
