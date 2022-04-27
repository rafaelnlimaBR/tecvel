<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Categoria extends Model
{
    use HasFactory;
    protected $table    =   "categorias";
    private static $restricao = [
        'nome'      =>     'required|unique:categorias',

    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {
        if(array_key_exists('id',$dados)){
            static::$restricao['nome'] .= ',nome,'.$dados['id'];

        }
        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public  function gravar(Request $r)
    {
        $categoria                 =   $this;
        $categoria->nome           =   $r->get('nome');

        if($categoria->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $categoria;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_categoria','categoria_id','post_id');
    }

    public function atualizar(Request $r)
    {
        $categoria                  =  $this;
        $categoria->nome           =   $r->get('nome');
        if($categoria->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $categoria;
    }

    public function excluir()
    {
        $categoria        =   $this;
        if($categoria->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
