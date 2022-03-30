<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Peca extends Model
{
    use HasFactory;
    protected $table    =   "pecas";

    public static function cadastrar(Request $r)
    {
        $peca               =   new Peca();
        $peca->descricao    =   $r->get('descricao');
        $peca->valor        =   $r->get('valor');
        $peca->qnt          =   $r->get('qnt');
        $peca->autorizado   =   $r->get('autorizado');
        $peca->historico_id =   $r->get('historico_id');

        if($peca->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $peca;
    }
    public function excluir()
    {
        if($this->delete() == false){
            throw new \Exception('Não foi possível realizar a exclusão',200);
        }
    }
}
