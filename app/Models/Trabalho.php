<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{
    use HasFactory;
    protected $table    =   "trabalhos";

    public function scopePesquisarPorServico($query, $nome)
    {
        return $query->whereHas('servico', function ($query) use ($nome) {
            $query->where('descricao', 'like', '%' . $nome . '%');
        });
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class,'servico_id');
    }


}
