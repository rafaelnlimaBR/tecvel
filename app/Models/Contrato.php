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

        return $contrato->id;
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
        if($contrato->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

    public function atualizarStatus(Request $r)
    {
        $tipo_id        =   null;
        $conf           =   Configuracao::find(1);
        if($conf->autorizado == $r->get('status_id')){
            $tipo_id    =   $conf->ordem_servico;
        }elseif($conf->nao_autorizado == $r->get('status_id')){
            $tipo_id    =   $conf->orcamento;
        }else{
            $tipo_id    =   $this->historicos->last()->tipo->id;
        }


        $this->status()->attach($r->get('status_id'),[
            'data'          =>  Carbon::createFromFormat('d/m/Y H:i',$r->get('data')),
            'obs'           =>  $r->get('obs'),
            'tipo_id'       =>  $tipo_id
            ]);
    }
}
