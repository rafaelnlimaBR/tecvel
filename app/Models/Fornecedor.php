<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Fornecedor extends Model
{
    use HasFactory;
    protected $table    =   'fornecedores';

    public function scopePesquisarPorNome($query, $nome)
    {
        return $query->where('nome','like','%'.$nome.'%');
    }


    public static function gravar(Request $r)
    {
        $Fornecedor                 =   new Fornecedor();
        $Fornecedor->nome           =   $r->get('nome');
        $Fornecedor->endereco       =   $r->get('endereco');
        $Fornecedor->telefone01     =   $r->get('telefone01');
        $Fornecedor->telefone02     =   $r->get('telefone02');

        if($Fornecedor->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $Fornecedor->id;
    }

    public static function atualizar(Request $r)
    {
        $Fornecedor        =   Fornecedor::find($r->get('id'));
        $Fornecedor->nome           =   $r->get('nome');
        $Fornecedor->endereco       =   $r->get('endereco');
        $Fornecedor->telefone01     =   $r->get('telefone01');
        $Fornecedor->telefone02     =   $r->get('telefone02');
        if($Fornecedor->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $Fornecedor->id;
    }

    public static function excluir($id)
    {
        $Fornecedor        =   Fornecedor::find($id);
        if($Fornecedor->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
