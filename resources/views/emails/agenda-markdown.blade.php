@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
@endcomponent
@endslot


Olá **{{ $pedido->pessoa->nome_usual_fantasia }}**, como é bom poder atendê-lo.
Este e-mail é apenas pra confirmar seu agendamento:

Dia **{{ date('d/m/Y', strtotime($agenda->inicio))}}** as **{{ date('H:i', strtotime($agenda->inicio))}}** - **{{$agenda->servico->descricao}}**
*<small>duração aproximada de {{$agenda->servico->duracao}} minutos</small>*.

@if(isset($pagamento))
@if($pagamento['sigla'] == 'TRF')
<small>{{$pagamento['mensagem']}}<br>
Titular: **{{$pagamento['titular']}}**<br>
CPF/CNPJ: **{{$pagamento['documento']}}**<br> 
Banco:  **{{$pagamento['banco']}}**<br> 
Agência:  **{{$pagamento['agencia']}}**
Conta {{$pagamento['tipo']}} : **{{$pagamento['conta']}}**</small>
@elseif($pagamento['sigla'] =='PSU')
<small>{{$pagamento['mensagem']}}</small>
@else
<small>{{ $pagamento['mensagem'] }}</small>
@endif
@endif
@if($pedido->pacotePedido->first()->detalhePedido->first()->qtde_adquirida > 1)
Veja como fica seu extrato de atendimento:
@foreach($pedido->pacotePedido as $pacotePedido)
| Descrição | Adquirida | Usada | Saldo |
|-----------|:---------:|:-----:|:-----:|
@foreach($pacotePedido->detalhePedido as $detalhePedido)
{{ $detalhePedido->servico->descricao }}|{{ $detalhePedido->qtde_adquirida}}|{{ $detalhePedido->qtde_consumida }}|{{ $detalhePedido->saldo() }}|
@endforeach
@endforeach
@endif

<br><br>
Grande abraço,<br><br>
**{{ $remetente }}**
<br><br><br>

@component('mail::footer')
Este é um e-Mail automático e não precisa ser respondido.
**Atitude Agenda, sua agenda cheia de atitude.**<br>Acesse: <a href="https://www.atitudeagenda.com.br" target="_blank">Atitude Agenda</a> e saiba mais ...
@endcomponent
@endcomponent
