<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Historico extends Model
{
    use HasFactory;
    protected $table    =   "historicos";

    public function tipo()
    {
        return $this->belongsTo(TipoContrato::class,'tipo_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class,'trabalhos','historico_id','servico_id')
            ->withPivot([
                'valor','autorizado','data'
            ]);
    }

    public function cadastrarServico(Request $r)
    {
        $this->servicos()->attach($r->get('servico_id'),[
            'valor'         =>  $r->get('valor'),
            'autorizado'    =>  1,
            'data'          =>  Carbon::now()
        ]);
    }
}
