<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table    =   'comentarios';

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function autor()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
}
