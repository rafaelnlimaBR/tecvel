<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    private static $restricao = [
        'img'      =>     'image|mimes:jpeg,png,jpg',
        'titulo'      =>     'required',
        'sequencia'      =>     'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse(a) :attribute ',
    ];

    public static function validacao($dados)
    {

        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }


    public function scopeHabilitados($query,$habilitado)
    {
        return $query->where('habilitado',$habilitado);
    }

    public function scopeSequenciadas($query,$seq)
    {
        return $query->orderby('sequencia',$seq);
    }



    public static function gravar(Request $r)
    {
        $extensao   =   $r->file('img')->extension();
        $nomeImg    =   time().'.'.$extensao;
        
        $banner                         =   new banner();
        $banner->titulo                   =   $r->get('titulo');
        $banner->habilitado                    =   $r->get('habilitado');
        $banner->texto             =   $r->get('descricao');
        $banner->url        =   $r->get('url');
        $banner->sequencia        =   $r->get('sequencia');
        $banner->img        =   $nomeImg;
        

        if($banner->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        if($r->hasFile('img') ){

            if($r->file('img')->move(public_path().'/imagens/banners/',$nomeImg) == false) {
                throw new \Exception('Registro atualizado mas não foi possível fazer o upload da imagem',200);
            }else{

            }
        }
        
        
        return $banner;
    }

    public static function atualizar(Request $r)
    {
        $banner                         =   banner::find($r->get('id'));
        $banner->titulo                   =   $r->get('titulo');
        $banner->habilitado                    =   $r->get('habilitado');
        $banner->texto             =   $r->get('descricao');
        $banner->url        =   $r->get('url');
        $banner->sequencia        =   $r->get('sequencia');

        if($r->hasFile('img') ){
            $extensao   =   $r->file('img')->extension();
            $nomeImg    =   time().'.'.$extensao;

            if($r->file('img')->move(public_path().'/imagens/banners/',$nomeImg) == false) {
                throw new \Exception('Registro atualizado mas não foi possível fazer o upload da imagem',200);
            }else{
                unlink(public_path().'/imagens/banners/'.$banner->img);
                $banner->img       =   $nomeImg;
            }
        }
        
        if($banner->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $banner;
    }

    public static function excluir($id)
    {
        $banner        =   Banner::find($id);
        if($banner->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
