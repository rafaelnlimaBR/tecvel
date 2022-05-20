<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacaoTeste extends Mailable
{
    use Queueable, SerializesModels;


    private $para;

    public function __construct($para)
    {
        $this->para     =   $para;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("email de teste");
        $this->to($this->para);
        return $this->view('admin.mail.notificacao-teste')->with('email',$this->para);
    }
}
