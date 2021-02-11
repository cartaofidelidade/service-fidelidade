<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class register extends Mailable
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
        $this->subject('Novo Cadastro Cartão Fidelidade');
        $this->to($this->data['Email'], $this->data['Nome']);
        return $this->view('emails.register', [
            'Nome' => $this->data['Nome'],
            'Codigo' => $this->data['Codigo']
        ]);
    }
}
