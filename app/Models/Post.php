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

    public function imagens()
    {
        return $this->hasMany(Imagens::class,'post_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class,'post_categoria','post_id','categoria_id')
            ->withPivot('categoria_id')
            ->withPivot('post_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class,'post_id');
    }

    /*public function scopeHabilitados($query,$habilitado)
    {
        return $query->where('habilitado','=',$habilitado);
    }*/

    public function adicionarVisita()
    {
        $post       =   $this;
        $post->visitas  += 1;
        if($post->save() == false){
            throw new \Exception('Não foi possível adicionar visita',200);
        }
    }

    public function gravar(Request $r)
    {
        $post                   =   new Post();
        $post->titulo    =   $r->get('titulo');
        $post->conteudo           =   $r->get('conteudo');
        $post->user_id      =   $r->get('usuario');
        $post->habilitado            =   $r->get('habilitado');
        $post->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($post->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        $post->categorias()->attach(1);
        return $post;
    }

    public function atualizar(Request $r)
    {
        $post                         =   $this;
        $post->titulo    =   $r->get('titulo');
        $post->conteudo           =   $r->get('conteudo');
        $post->user_id      =   $r->get('usuario');
        $post->habilitado            =   $r->get('habilitado');
        $post->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        if($post->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        $post->categorias()->sync(\request('categorias'));
        return $post;
    }

    public function excluir()
    {
        $post        =   $this;
        foreach ($post->imagens as $i){
            $i->excluir();
        }
        if($post->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }

}
