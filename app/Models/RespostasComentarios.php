<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostasComentarios extends Model
{
    use HasFactory;
    protected $table    =   "respostas_comentarios";

    public function autor()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
