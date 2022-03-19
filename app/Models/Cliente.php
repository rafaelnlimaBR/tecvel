<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";



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
        $cliente->nome  =   $r->get('nome');
        $cliente->email =   $r->get('email');
        $cliente->telefone01    =   $r->get('telefone01');
        $cliente->telefone02    =   $r->get('telefone02');
        if($cliente->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $cliente->id;
    }

    public static function atualizar(Request $r)
    {
        $cliente        =   Cliente::find($r->get('id'));
        $cliente->nome  =   $r->input('nome');
        $cliente->email =   $r->input('email');
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
