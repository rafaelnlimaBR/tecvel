<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsToMany(Status::class,'historicos','contrato_id','status_id')
            ->withPivot('data')
            ->withPivot('obs')
            ->withPivot('autorizado')
            ->withPivot('desconto_peca')
            ->withPivot('desconto_servico')
            ->withTimestamps();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class,'veiculo_id');
    }
}
