<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Imagens extends Model
{
    use HasFactory;
    protected $table    =   'imagens_post';

    private static $restricao = [
        'img'      =>     'image|mimes:jpeg,png,jpg',
        'alt'      =>     'required',
        'titulo'    =>  'required',

    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse(a) :attribute ',
    ];

    public static function validacao($dados)
    {

        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function salvar(Request $r)
    {
        $extensao   =   $r->file('img')->extension();
        $nomeImg    =   time().'.'.$extensao;

        $imagem             =   new Imagens();
        $imagem->img        =   $nomeImg;
        $imagem->descricao  =   $r->get('descricao');
        $imagem->titulo     =   $r->get('titulo');
        $imagem->sequencia  =   $r->get('sequencia');
        $imagem->alt        =   $r->get('alt');
        $imagem->post_id    =   $r->get('post_id');

        if($imagem->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }

        if($r->hasFile('img') ){

            if($r->file('img')->move(public_path().'/imagens/posts/',$nomeImg) == false) {
                throw new \Exception('Registro atualizado mas não foi possível fazer o upload da imagem',200);
            }else{

            }
        }
    }

    public function atualizar(Request $r)
    {


        $imagem             =   $this;
        $imagem->descricao  =   $r->get('descricao');
        $imagem->titulo     =   $r->get('titulo');
        $imagem->sequencia  =   $r->get('sequencia');
        $imagem->alt        =   $r->get('alt');
        $imagem->post_id    =   $r->get('post_id');




        if($r->hasFile('img') ){
            $extensao   =   $r->file('img')->extension();
            $nomeImg    =   time().'.'.$extensao;

            if($r->file('img')->move(public_path().'/imagens/posts/',$nomeImg) == false) {
                throw new \Exception('Registro atualizado mas não foi possível fazer o upload da imagem',200);
            }else{
                unlink(public_path().'/imagens/posts/'.$imagem->img);
                $imagem->img       =   $nomeImg;

            }
        }

        if($imagem->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }

    }

    public function excluir()
    {
        $imagem         =   $this;
        unlink(public_path().'/imagens/posts/'.$imagem->img);
        if($imagem->delete() == false){
            throw new \Exception('Não foi possível excluir o registro',200);
        }

    }
}
