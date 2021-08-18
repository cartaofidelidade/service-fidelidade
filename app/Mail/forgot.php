<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Forgot extends Mailable
{
    use Queueable, SerializesModels;

    private $token, $nome, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->token = $data['token'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.forgot', [
            'nome' => $this->nome,
            'token' => $this->token,
            'email' => $this->email
        ])
            ->from("no-replay@primmvs.com")
            ->subject('Cartão Fidelidade - Recuperar Senha')
            ->to($this->email);
    }
}
