<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Forgot extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return  $this->view('emails.forgot',[
            'nome' => $this->data->login,
            'codigo' =>$this->data->tokenAlteracaoSenha
        ])
            ->from("no-replay@primmvs.com")
            ->subject('Recuperar Senha')
            ->to($this->data->login);
    }
}
