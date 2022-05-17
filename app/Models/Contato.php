<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contato extends Model
{
    use HasFactory;
    protected $table    =   "contatos";

    private static $restricao = [
        'email'      =>     'required',
        'nome'       =>     'required',
        'whatsapp' =>     'required',
        'mensagem' =>     'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {
        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function scopeVisualizados($query,$v)
    {
        return $query->where('visualizado',$v);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    public function diferencaTempo()
    {
        return now()->diffForHumans(Carbon::parse($this->created_at));
    }

    public function visualizar()
    {
        $comentario =   $this;
        $comentario->visualizado =   1;
        if($comentario->save() == false){
            throw new \Exception('Não foi possível atualizar o comentário',200);
        }
    }

    public function gravar(Request $r)
    {
        $cliente                    =   Cliente::firstOrCreate(['email'=>strtolower($r->get('email'))],['nome'=>strtoupper($r->get('nome')),'telefone01'=>$r->get('whatsapp')]);


        $contato                 =   $this;
        $contato->mensagem       =   $r->get('mensagem');
        $contato->cliente_id     =   $cliente->id;
        $contato->visualizado    =   0;

        if($contato->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $contato;
    }

    public function atualizar(Request $r)
    {
        $contato                 =   $this;
        $contato->mensagem       =   $r->get('mensagem');
        $contato->cliente_id     =   $contato->cliente_id;
        $contato->visualizado    =   0;

        if($contato->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $contato;
    }

    public function excluir()
    {
        $contato        =   $this;
        if($contato->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
