<?php

namespace App\Models;
//teste
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";
    protected $fillable =   ['email','nome','telefone01'];
    private static $restricao = [
        'email'      =>     'required|unique:clientes',
        'nome'       =>     'required',
        'telefone01' =>     'required',
    ];
    private static $mensagem = [
        'required'    => 'O campo :attribute é obrigado.',
        'unique'    =>  'Já possui registro com esse :attribute ',
    ];
    public static function validacao($dados)
    {
        if(array_key_exists('id',$dados)){
            static::$restricao['email'] .= ',email,'.$dados['id'];

        }
        return \Validator::make($dados,static::$restricao,static::$mensagem);
    }

    public function scopePesquisarPorNome($query, $nome)
    {
        return $query->where('nome','like','%'.$nome.'%');
    }
    public function scopePesquisarPorEmail($query, $email)
    {
        return $query->where('email','like','%'.$email.'%');
    }

    public static function gravar(Request $r)
    {
        $cliente        =   new Cliente();
        $cliente->nome  =   strtoupper($r->get('nome'));
        $cliente->email =   strtolower($r->get('email'));
        $cliente->telefone01    =   $r->get('telefone01');
        $cliente->telefone02    =   $r->get('telefone02');
        if($cliente->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $cliente;
    }

    public static function atualizar(Request $r)
    {
        $cliente        =   Cliente::find($r->get('id'));
        $cliente->nome  =   strtoupper($r->get('nome'));
        $cliente->email =   strtolower($r->get('email'));
        $cliente->telefone01    =   $r->get('telefone01');
        $cliente->telefone02    =   $r->get('telefone02');
        if($cliente->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $cliente->id;
    }

    public static function excluir($id)
    {
        $cliente        =   Cliente::find($id);
        if($cliente->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
