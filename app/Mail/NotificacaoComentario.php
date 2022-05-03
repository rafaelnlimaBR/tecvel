<?php

namespace App\Mail;

use App\Models\Comentario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacaoComentario extends Mailable
{
    use Queueable, SerializesModels;
    private $comentario ;
    private $para;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comentario $comentario,$to)
    {
        $this->comentario   =   $comentario;
        $this->para           =   $to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Novo Comentário');

        return $this->view('admin.mail.notificacao-comentario')
            ->to($this->para)

            ->with('comentario',$this->comentario);
    }
}
