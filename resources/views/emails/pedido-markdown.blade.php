@component('mail::layout')
{{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        @endcomponent
    @endslot
Olá **{{$pedido->pessoa->nome_razao_social}}**

Agradecemos por nos escolher. Este é um e-mail de confirmação do seu pedido conforme abaixo:

Pedido Nº : **{{ $pedido->id }} **

 Valor : **R$ {{ $pedido->valor_total }} **
 
 @if(isset($pagamento))
 @if($pagamento['sigla'] == 'TRF')
 {{$pagamento['mensagem']}} 
  Titular  :{{$pagamento['titular']}}
  CPF/CNPJ :{{$pagamento['documento']}} 
  Banco    :{{$pagamento['banco']}} 
  Agência  :{{$pagamento['agencia']}}
  Conta {{$pagamento['tipo']}} : {{$pagamento['conta']}}
 @elseif($pagamento['sigla'] =='PSU')
     {{$pagamento['mensagem']}}
 @else
 {{ $pagamento['mensagem'] }}
 @endif
@endif

Serviços Adquiridos.

@foreach($pedido->pacotePedido as $pacotePedido)
@component('mail::table')
|Descrição|Adquirida|Usada|Saldo|
|:--------|:-------:|:---:|:---:|
@foreach($pacotePedido->detalhePedido as $detalhePedido)
|{{ $detalhePedido->servico->descricao }}|{{ $detalhePedido->qtde_adquirida}}|{{ $detalhePedido->qtde_consumida }}|{{ $detalhePedido->saldo() }}|
@endforeach
@endforeach
@endcomponent
Atenciosamente,
<br>
**{{$remetente}}**


@component('mail::footer')
Este é um e-Mail automático e não precisa ser respondido.

Atitude Agenda, sua agenda cheia de atitude. Acesse: <a href="https://www.atitudeagenda.com.br" target="_blank">Atitude Agenda</a> e saiba mais ...
@endcomponent
@endcomponent