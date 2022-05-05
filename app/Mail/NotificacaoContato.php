<?php

namespace App\Mail;

use App\Models\Contato;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacaoContato extends Mailable
{
    use Queueable, SerializesModels;
    private $contato;
    private $para;
    private $titulo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contato $contato, $to,$titulo)
    {
        $this->contato    =   $contato;
        $this->para         =   $to;
        $this->titulo       =   $titulo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->titulo);

        return $this->view('admin.mail.notificacao-contato')
            ->to($this->para)

            ->with('contato',$this->contato);
    }
}
