<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Veiculo extends Model
{
    use HasFactory;
    protected $table = 'veiculos';

    public function scopePesquisarPorPlaca($query, $placa)
    {
        return $query->where('placa','like','%'.$placa.'%');
    }


    public static function gravar(Request $r)
    {
        $Veiculo        =   new Veiculo();
        $Veiculo->placa  =   $r->get('placa');
        $Veiculo->mod_ano =   $r->get('mod_ano');
        $Veiculo->cor    =   $r->get('cor');
        $Veiculo->modelo    =   $r->get('modelo');
        $Veiculo->montadora    =   $r->get('montadora');
        if($Veiculo->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $Veiculo->id;
    }

    public static function atualizar(Request $r)
    {
        $Veiculo        =   Veiculo::find($r->get('id'));
        $Veiculo->nome  =   $r->input('nome');
        $Veiculo->mod_ano =   $r->input('mod_ano');
        $Veiculo->cor    =   $r->get('cor');
        $Veiculo->modelo    =   $r->get('modelo');
        $Veiculo->montadora    =   $r->get('montadora');
        if($Veiculo->save() == false){
            throw new \Exception('Não foi possível realizar a atualização',200);
        }
        return $Veiculo->id;
    }

    public static function excluir($id)
    {
        $Veiculo        =   Veiculo::find($id);
        if($Veiculo->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
