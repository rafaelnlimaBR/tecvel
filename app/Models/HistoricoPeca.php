<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoPeca extends Model
{
    use HasFactory;
    protected $table    =   'historico_peca';


    public function peca()
    {
        return $this->belongsTo(Peca::class,'peca_id');
    }
}
