<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// namespace App\Mail;
// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Contracts\Queue\ShouldQueue;

class BemVindo extends Mailable
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
    // public function build()
    // {
    //     $this->subject('Novo Cadastro Cartão Fidelidade');
    //     $this->to($this->data['Email'], $this->data['Nome']);
    //     return $this->view('emails.register', [
    //         'Nome' => $this->data['Nome'],
    //         'Codigo' => $this->data['Codigo']
    //     ]);
    // }

    public function build()
    {

        return  $this->view('emails.register',[
            'nome' => $this->data->nome          
        ])
            ->from("no-replay@primmvs.com")
            ->subject('Veja bem vindo parceiro')
            ->to($this->data->email);
    
    }   

}
