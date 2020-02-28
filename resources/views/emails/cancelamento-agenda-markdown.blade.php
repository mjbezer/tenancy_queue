@component('mail::layout')
{{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        @endcomponent
    @endslot
Olá **{{$pedido->pessoa->nome_usual_fantasia}}**, conforme combinado, estamos confirmando o **CANCELAMENTO** do seu atendimento ( **{{ $agenda->servico->descricao }}** ) que aconteceria no dia **{{ date('d/m/Y', strtotime($agenda->inicio)) }}** as **{{ date('H:i', strtotime($agenda->inicio)) }}** horas.

Estamos a disposição caso queira agendar uma nova data.

<br><br>
Grande abraço,<br><br>
**{{ $remetente }}**
<br><br><br>

@component('mail::footer')
Este é um e-Mail automático e não precisa ser respondido.
**Atitude Agenda, sua agenda cheia de atitude.**<br>Acesse: <a href="https://www.atitudeagenda.com.br" target="_blank">Atitude Agenda</a> e saiba mais ...
@endcomponent
@endcomponent
