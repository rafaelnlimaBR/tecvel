<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';

    public function scopePesquisarPorDescricao($query, $descricao)
    {
        return $query->where('nome','like','%'.$descricao.'%');
    }
    public function scopePesquisarPorHabilitados($query)
    {
        return $query->where('habilitado',1);
    }

    public function proximos()
    {
        return $this->belongsToMany(Status::class,'status_status','status_atual_id','status_proximo_id');
    }

    public function historicos()
    {
        return $this->hasMany(Historico::class,'status_id');
    }

    public static function gravar(Request $r)
    {
        $Status                         =   new Status();
        $Status->nome                   =   $r->get('nome');
        $Status->cor                    =   $r->get('cor');
        $Status->habilitado             =   $r->get('habilitado');
        $Status->editar_servicos        =   $r->get('editar_servicos');
        $Status->editar_pecas           =   $r->get('editar_pecas');
        $Status->editar_pagamentos      =   $r->get('editar_pagamentos');
        $Status->editar_pedidos         =   $r->get('editar_pedidos');
        $Status->editar_comissoes       =   $r->get('editar_comissoes');
        $Status->editar_terceirizados   =   $r->get('editar_terceirizados');

        if($Status->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $Status->id;
    }

    public static function atualizar(Request $r)
    {
        $Status        =   Status::find($r->get('id'));
        $Status->nome                   =   $r->get('nome');
        $Status->cor                    =   $r->get('cor');
        $Status->habilitado             =   $r->get('habilitado');
        $Status->editar_servicos        =   $r->get('editar_servicos');
        $Status->editar_pecas           =   $r->get('editar_pecas');
        $Status->editar_pagamentos      =   $r->get('editar_pagamentos');
        $Status->editar_pedidos         =   $r->get('editar_pedidos');
        $Status->editar_comissoes       =   $r->get('editar_comissoes');
        $Status->editar_terceirizados   =   $r->get('editar_terceirizados');

        if($Status->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $Status->id;
    }

    public static function excluir($id)
    {
        $Status        =   Status::find($id);
        if($Status->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

    public static function adicionarRelacionamento(Request $r)
    {
        $status_atual    =   Status::find($r->get('status_atual_id'));
        $status_atual->proximos()->syncWithoutDetaching($r->get('status_proximo_id'));
    }

    public static function removerRelacionamento($id_atual,$id_proximo)
    {
        $status_atual    =   Status::find($id_atual);
        $status_atual->proximos()->detach($id_proximo);
    }
}
