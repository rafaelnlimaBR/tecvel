<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RespostasComentarios extends Model
{
    use HasFactory;
    protected $table    =   "respostas_comentarios";
    private static $restricao = [
        'resposta'      =>     'required',
        'data'       =>     'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {

        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function scopeHabilitados($query,$habilitado)
    {
        return $query->where('habilitado',$habilitado);
    }

    public function autor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function gravar(Request $r)
    {
        $resposta                 =   $this;
        $resposta->texto          =   $r->get('resposta');
        $resposta->data           =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        $resposta->habilitado     =   $r->get('habilitado');
        $resposta->user_id     =   $r->get('usuario_id');
        $resposta->comentario_id    =   $r->get('comentario_id');

        if($resposta->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $resposta->id;
    }

    public function atualizar(Request $r)
    {
        $resposta                 =   $this;
        $resposta->texto          =   $r->get('resposta');
        $resposta->data           =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        $resposta->habilitado     =   $r->get('habilitado');
        $resposta->user_id     =   $r->get('usuario_id');
        $resposta->comentario_id    =   $r->get('comentario_id');

        if($resposta->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $resposta->id;
    }
    public function excluir()
    {
        $resposta        =   $this;
        if($resposta->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

}
