<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Saida extends Model
{
    use HasFactory;
    protected $table = 'saidas';

    public static function gravar(Request $r)
    {
  
        $saida                    =   new Saida();
        $saida->valor             =   $r->get('valor');
        $saida->descricao         =   $r->get('descricao');
        $saida->data              =   Carbon::createFromFormat('d/m/Y H:i',$r->get('data'));

        if($saida->save() == false){
            throw new \Exception('Não foi possível realizar o registro',200);
        }
        return $saida;
    }
}
