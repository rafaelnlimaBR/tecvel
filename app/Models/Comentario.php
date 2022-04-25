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

    public static function gravar(Request $r)
    {
        $cliente                    =   Cliente::firstOrCreate(['email'=>strtolower($r->get('email'))],['nome'=>strtoupper($r->get('nome')),'telefone01'=>$r->get('whatsapp')]);
        $comentario                 =   new Comentario();
        $comentario->texto          =   $r->get('comentario');
        $comentario->data           =   Carbon::now();
        $comentario->habilitado     =   1;
        $comentario->post_id        =   $r->get('post_id');
        $comentario->cliente_id     =   $cliente->id;

        if($comentario->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $comentario->id;
    }
}
