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
        'descricao'     =>  'required',
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

    public function tags()
    {
        return $this->belongsToMany(Tags::class,'post_tag','post_id','tag_id')
            ->withPivot('post_id')
            ->withPivot('tag_id');
    }

    public function tagsSeparadoPorVirtula()
    {
        $post       =   $this;
        $tags       =   [];

        foreach ($post->tags as $i=>$tag){
            $tags[$i]   =   $tag->nome;
        }

        $tags   =   implode(', ',$tags);
        return $tags;
    }

    public function scopeHabilitados($query, $h)
    {
        return $query->where('habilitado',$h);
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
        $extensao   =   $r->file('img')->extension();
        $nomeImg    =   time().'.'.$extensao;

        $post                   =   new Post();
        $post->titulo    =   $r->get('titulo');
        $post->conteudo           =   $r->get('conteudo');
        $post->descricao          =   $r->get('descricao');
        $post->user_id      =   $r->get('usuario');
        $post->habilitado            =   $r->get('habilitado');
        $post->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));
        $post->img              =   $nomeImg;

        if($post->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }

        $tags   =   [];
        $tag    =   "";
        foreach ($r->get('tags') as $i => $t){
//            dd($i);
            if(is_numeric($t)){
                $tag        =   Tags::firstOrCreate(['id'=>$t],['nome'=>$t]);
            }else{
                $tag    =   Tags::firstOrCreate(['nome'=>$t],['nome'=>$t]);
            }

            $tags[$i]   =   $tag->id;

        }
//        dd($tags);
        $post->tags()->sync($tags);
        $post->categorias()->sync($r->get('categorias'));
        if($r->hasFile('img') ){

            if($r->file('img')->move(public_path().'/imagens/posts/',$nomeImg) == false) {
                throw new \Exception('Registro atualizado mas não foi possível fazer o upload da imagem',200);
            }else{

            }
        }

        return $post;
    }

    public function atualizar(Request $r)
    {
        $post                         =   $this;
        $post->titulo    =   $r->get('titulo');
        $post->conteudo           =   $r->get('conteudo');
        $post->descricao          =   $r->get('descricao');
        $post->user_id      =   $r->get('usuario');
        $post->habilitado            =   $r->get('habilitado');
        $post->data             =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));

        if($r->hasFile('img') ){
            $extensao   =   $r->file('img')->extension();
            $nomeImg    =   time().'.'.$extensao;

            if($r->file('img')->move(public_path().'/imagens/posts/',$nomeImg) == false) {
                throw new \Exception('Registro atualizado mas não foi possível fazer o upload da imagem',200);
            }else{
                unlink(public_path().'/imagens/posts/'.$post->img);
                $post->img       =   $nomeImg;

            }
        }

        if($post->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
//        dd($r->get('tags'));
        $tags   =   [];
        $tag    =   "";
        foreach ($r->get('tags') as $i => $t){
//            dd($i);

            if(is_numeric($t)){
                $tag        =   Tags::firstOrCreate(['id'=>$t],['nome'=>$t]);
            }else{
                $tag    =   Tags::firstOrCreate(['nome'=>$t],['nome'=>$t]);
            }

            $tags[$i]   =   $tag->id;

        }
//        dd($tags);
        $post->tags()->sync($tags);
        $post->categorias()->sync($r->get('categorias'));


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
