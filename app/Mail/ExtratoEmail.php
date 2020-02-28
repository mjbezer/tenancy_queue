<?php

namespace AtitudeAgenda\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExtratoEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pedido;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.extrato-markdown', ['pedido'=>$this->pedido]);
    }
}
