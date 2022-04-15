<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contrato extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsToMany(Status::class,'historicos','contrato_id','status_id')
            ->withPivot('data')
            ->withPivot('obs')
            ->withPivot('desconto_peca')
            ->withPivot('desconto_servico')
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
                'desconto_peca' =>  0,
                'desconto_servico'=>    0,
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
