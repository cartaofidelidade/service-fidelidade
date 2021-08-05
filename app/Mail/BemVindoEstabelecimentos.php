<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BemVindoEstabelecimentos extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

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
        return $this->view('emails.register', ['nome' => $this->data->nome_fantasia])
            ->from("no-replay@primmvs.com")
            ->subject('Veja bem vindo parceiro')
            ->to($this->data->email);
    }

}
