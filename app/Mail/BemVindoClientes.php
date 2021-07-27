<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BemVindoClientes extends Mailable
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
        return $this->view('emails.registerCliente', ['nome' => $this->data->nome])
            ->from("no-replay@primmvs.com")
            ->subject('Veja bem vindo '.$this->data->nome)
            ->to($this->data->email);
    }

}
