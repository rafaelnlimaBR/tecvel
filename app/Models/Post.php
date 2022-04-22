<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;
    protected $table    =   "posts";

    private static $restricao = [
        'titulo'       =>     'required',
        'conteudo'       =>  'required',
        'data'          =>  'required',
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
    

    public function gravar(Request $r)
    {
        $post                   =   new Post();
        $post->titulo    =   $r->get('titulo');
        $post->conteudo           =   $r->get('conteudo');
        $post->user_id      =   $r->get('user_id');
        $post->habilitado            =   $r->get('habilitado');
        $post->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($post->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $post;
    }

    public function atualizar(Request $r)
    {
        $post                         =   $this;
        $post->titulo    =   $r->get('titulo');
        $post->conteudo           =   $r->get('conteudo');
        $post->user_id      =   $r->get('user_id');
        $post->habilitado            =   $r->get('habilitado');
        $post->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($post->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $post;
    }

    public function excluir()
    {
        $post        =   $this;
        if($post->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

}
