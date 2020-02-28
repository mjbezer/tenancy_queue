<?php

namespace AtitudeAgenda\Mail;

use AtitudeAgenda\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class PedidoEmail extends Mailable
{
    use Queueable, SerializesModels;

  
    protected $pedidoSearch;
    protected $pessoaSearch;
    protected $remetente;
    
    public function __construct(
        $pedidoSearch, 
        $pessoaSearch,
        $remetente)
    {
        $this->pedidoSearch = $pedidoSearch;
        $this->pessoaSearch = $pessoaSearch;
        $this->remetente = $remetente;
    }

    public function build()
    {     
       
        return $this->markdown('emails.pedido-markdown', ['pedido' => $this->pedidoSearch,
                                                          'agenda' => $this->pessoaSearch,
                                                          'remetente' => $this->remetente ]);
          
    }
}
