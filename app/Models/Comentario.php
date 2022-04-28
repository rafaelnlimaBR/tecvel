<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comentario extends Model
{
    use HasFactory;
    protected $table    =   'comentarios';

    private static $restricao = [
        'email'      =>     'required',
        'nome'       =>     'required',
        'whatsapp' =>     'required',
        'comentario' =>     'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {
        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }


    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function autor()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    public function respostas()
    {
        return $this->hasMany(RespostasComentarios::class,'comentario_id');
    }

    public function scopeHabilitados($query,$habilitado)
    {
        return $query->where('habilitado',1);
    }

    public function visualizar()
    {
        $comentario =   $this;
        $comentario->visualizado =   1;
        if($comentario->save() == false){
            throw new \Exception('Não foi possível atualizar o comentário',200);
        }
    }

    public static function gravar(Request $r)
    {
        $cliente                    =   Cliente::firstOrCreate(['email'=>strtolower($r->get('email'))],['nome'=>strtoupper($r->get('nome')),'telefone01'=>$r->get('whatsapp')]);


        $comentario                 =   new Comentario();
        $comentario->texto          =   $r->get('comentario');
        $comentario->data           =   Carbon::now();
        $comentario->habilitado     =   1;
        $comentario->post_id        =   $r->get('post_id');
        $comentario->cliente_id     =   $cliente->id;
        $comentario->visualizado    =   0;

        if($comentario->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $comentario->id;
    }

    public function atualizar(Request $r)
    {
        $comentario                 =   $this;
        $comentario->texto          =   $r->get('texto');
        $comentario->data           =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        $comentario->habilitado     =   $r->get('habilitado');
        $comentario->cliente_id     =   $r->get('cliente_id');

        if($comentario->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $comentario->id;
    }
}
