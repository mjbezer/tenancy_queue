@extends('layouts.codebase.index-page')

@section('title')Agenda
@endsection

@section('css_after')
<link rel="stylesheet" type="text/css" href="{{ mix('assets/sweetalert2/css/sweetalert2.min.css') }}" />
<link rel="stylesheet" href="{{asset ('plugin/css/select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{asset ('plugin/css/notify/jquery.toast.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ mix('assets/fullcalendar/fullcalendar.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ mix('assets/datatable/datatable.css') }}" />
@endsection

@section('content')
<div class="content">

    <div class="row">

        {{-- BOLOCO DO CALENDÁRIO --}}
        <div class="col-lg-8 col-md-6">
            <div class="block">
                <div class="block-header block-header-default bg-gd-lake">
                    <h3 class="block-title">Calendário em modo de edição</h3>
                    <div class="block-options">
                        <button class="btn btn-rounded btn-secondary" id="block">
                            <i class="si si-calendar"></i> Reservar Horário
                        </button>
                        <button class="btn btn-circle btn-secondary" data-toggle="modal" data-target="#pesquisa">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="block-content pb-4">
                    <div id='calendar' class=""></div>
                </div>
            </div>
        </div>

        {{-- BLOCO DE EDIÇÃO DAS AGENDAS --}}
        <div class="col-lg-4 col-md-6">
            <div class="block">
                <div class="block-header block-header-default bg-gd-lake">
                    <h3 class="block-title text-white">Agenda ( Editar )</h3>
                    @if($errors)
                    @foreach($errors->all() as $error)
                    {{$error}}
                    @endforeach
                    @endif
                </div>
                <div class="block-content pb-4">
                    {{-- RESERVA DE AGENDA --}}
                    @if($agenda->status_agenda == 2)
                    <form action="{{ route('agendas.updateBlocked', $agenda->id) }}" id="formBloqueio" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="row">

                            <div class="col-md-6 my-1">
                                <label class="form-control-label">Início: </label>
                                <input type="datetime-local" class="form-control text-center" name="inicio"
                                    id="inicio-block" required
                                    value="{{ date('Y-m-d\TH:i', strtotime($agenda->getOriginal('inicio'))) }}">
                            </div>
                            <div class="col-md-6 my-1">
                                <label class="form-control-label">Fim: </label>
                                <input type="datetime-local" class="form-control text-center" name="fim" id="fim-block"
                                    value="{{ date('Y-m-d\TH:i', strtotime($agenda->getOriginal('fim'))) }}">
                            </div>
                            <div class="col-md-12 my-1">
                                <label class="form-control-label">Observações:</label>
                                <input name="observacao" class="form-control" value="{{$agenda->observacao }}">

                            </div>

                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-6">
                                <a href="{{ route('agendas.index') }}" class="btn btn-alt-warning">
                                    <i class="fa fa-chevron-left"></i> Voltar
                                </a>
                                <button type="submit" class="btn btn-alt-success" id="update-block"><i
                                        class="fa fa-check"></i>
                                    Gravar</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="javascript:deletaBloqueio({{$agenda->id}})" class="btn btn-alt-danger"><i
                                        class="fa fa-close"></i> Cancelar Bloqueio</a>
                            </div>

                        </div>
                    </form>
                    @endif

                    {{-- AGENDA NORMAL --}}
                    @if( $agenda->status_agenda != 2 )
                    <form action="{{ route('agendas.update', $agenda->id) }}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="servico_id" value="{{ $agenda->servico_id }}">
                        <div class="row">
                            <div class="col-md-6 my-1">
                                <label class="form-control-label">Cliente:</label>
                                <input type="text" class="form-control"
                                    value="{{ $agenda->pedido->pessoa->nome_razao_social }}" readonly>
                                <input type="hidden" name="pessoa_id" value="{{ $agenda->pedido->pessoa_id }}">
                            </div>

                            <div class="col-md-6 my-1">
                                <label class="form-control-label">Serviço:</label>
                                <input type="text" class="form-control" value="{{ $agenda->servico->descricao }}"
                                    readonly>
                            </div>

                            <div class="col-md-6 my-1">
                                <label class="form-control-label">Início: </label>
                                <input type="datetime-local" class="form-control text-center" name="inicio" id="inicio"
                                    required
                                    value="{{ date('Y-m-d\TH:i', strtotime($agenda->getOriginal('inicio'))) }}">
                            </div>

                            <div class="col-md-6 my-1">
                                <label class="form-control-label">Fim: </label>
                                <input type="text" class="form-control text-center" name="fim" id="fim" readonly
                                    value="{{ $agenda->fim }}">
                            </div>

                            <div class="col-md-12 my-1">
                                <label class="form-control-label">Observações:</label>
                                <textarea name="Observacao" class="form-control"
                                    rows="5">{{ $agenda->Observacao }}</textarea>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('agendas.index') }}" class="btn btn-alt-warning">
                                    <i class="fa fa-chevron-left"></i> Cancelar
                                </a>
                                <a class="btn btn-alt-danger" href="javascript:deleteAgenda({{ $agenda->id }})">
                                    <i class="si si-close"></i> Excluir
                                </a>
                                <button type="submit" class="btn btn-alt-success">
                                    <i class="fa fa-check"></i> Confirmar
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('agendas.atendimento',  $agenda->id) }}"
                                    class="btn btn-rounded btn-alt-info shadow my-1" data-toggle="tooltip"
                                    title="Confirmar presença.">
                                    <i class="si si-user-following"></i> Confirmar presença
                                </a>
                                <a href="{{ route('contas-receber.edit', $agenda->pedido->contaReceber->id) }}"
                                    class="btn btn-rounded btn-alt-success shadow" data-toggle="tooltip"
                                    title="Baixar recebimento.">
                                    <i class="si si-wallet"></i> Confirmar pagamento
                                </a>
                                <a href="" class="btn btn-alt-success btn-circle shadow">
                                    <i class="fa fa-whatsapp"></i>
                                </a>

                                <a href="" class="btn btn-alt-danger btn-rounded shadow">
                                    <i class="si si-docs"></i> Desdobrar
                                </a>

                            </div>
                        </div>

                    </form>
                    @endif
                    {{-- fim da agenda normal --}}
                </div>

            </div>
        </div>

        <!-- modal de agendamento -->
        <div class="modal fade" id="modelId" role="dialog" aria-labelledby="modelTitleId" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-earth-lighter">
                        <h4 class="modal-title"><i class="si si-calendar"></i> Inserir Agenda</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="formAgendamento" method="post" action="{{ route('agendas.store') }}" class="agenda">
                            @csrf
                            <div class="form-group row">

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Cliente</label>
                                    <select class="js-select2 form-control" style="width: 100%" name="pessoa_id"
                                        id="pessoas" required data-placeholder="Selecione um cliente ...">
                                    </select>
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Serviço</label>
                                    <select name="servico_id" id="servicos" class="js-select2 form-control"
                                        style="width: 100%" required data-placeholder="Selecione um serviço ...">
                                    </select>
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Início</label>
                                    <input type="datetime-local" class="form-control text-center" name="inicio"
                                        id="inicio" readonly />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Fim</label>
                                    <input type="datetime-local" class="form-control text-center" name="fim" id="fim"
                                        readonly />
                                </div>

                                <div class="col-lg-4 mt-2">
                                    <label class="form-control-label">Vencimento</label>
                                    <input type="date" class="form-control text-center" name="data_vencimento"
                                        id="data_vencimento" required />
                                </div>
                            </div>

                            <div class="form-group row" id="valores_saldos">


                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 mt-2">
                                    <label class="form-control-label">Observações</label>
                                    <textarea name="observacao" class="form-control" rows="3"></textarea>
                                </div>

                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col">
                                    <button type="button" class="btn btn-alt-warning" data-dismiss="modal"><i
                                            class="fa fa-chevron-left"></i> Voltar</button>
                                    <button type="submit" class="btn btn-alt-success" value="Gravar">
                                        <span><i class="fa fa-check"></i> Gravar</span>
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <!-- End Modal-->

                </div>
            </div>
        </div>


        {{-- MODAL DE PESQUISA --}}
        <div class="modal fade" id="pesquisa" role="dialog" aria-labelledby="modelTitleId" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content rounded">
                    <div class="modal-header bg-gray">
                        <h4 class="modal-title"><i class="fa fa-search"></i> Pesquisa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm responsive table-hover table-striped nowrap simple-datatable"
                            width="100%">
                            <thead class="bg-earth-lighter">
                                <tr>
                                    <td class="font-w600 text-center">Início</td>
                                    <td class="font-w600 text-center">Cliente</td>
                                    <td class="font-w600 text-center">Serviço</td>
                                    <td class="font-w600 text-center">Agendamento </td>
                                    <td class="font-w600 text-center">Financeiro</td>
                                    <td class="text-center no-sort" style="min-width: 65px"><i
                                            class="si si-settings"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesquisa as $agda)
                                <tr>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($agda->inicio))  }}
                                        <b>{{ date('H:i', strtotime($agda->inicio))  }}</b></td>
                                    <td>{{ $agda->pedido->pessoa->nome_razao_social }}
                                        (<b>{{ $agda->pedido->pessoa->nome_usual_fantasia }}</b> )</td>
                                    <td>{{ $agda->servico->descricao }}</td>
                                    <td class="text-center">{{ $agda->status_agenda ? 'Agendado' : 'Atendido' }}</td>
                                    <td class="text-center">
                                        {{ $agda->pedido->contaReceber['data_pagamento'] ? 'Pago' : 'Aberto' }}</td>
                                    <td class="text-center">
                                        <a class="h4" data-toggle="tooltip"
                                            href="{{ route('agendas.edit', $agda->id) }}"
                                            title="Edita/Altera este registro...">
                                            <i class="si si-note"></i>
                                        </a>
                                        <a class="h4 text-danger" href="javascript:deleteAgenda({{ $agda->id }})">
                                            <i class="si si-close"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- FINAL DO MODAL DE PESQUISA --}}

        {{-- MODAL DO BLOQUEIO DE AGENDA / RESERVA --}}
        <!-- modal de Bloqueio de Agenda -->
        <div class="modal fade" id="modalBlock" role="dialog" aria-labelledby="modelTitleId" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-pulse-lighter">
                        <h4 class="modal-title"><i class="si si-calendar"></i> Reserva de Agenda</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="formBloqueio" method="post" action="{{ route('agendas.store') }}" class="agenda">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Início</label>
                                    <input type="datetime-local" class="form-control text-center" name="inicio"
                                        id="inicio-block" />
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label class="form-control-label">Fim</label>
                                    <input type="datetime-local" class="form-control text-center" name="fim"
                                        id="fim-block" />
                                </div>
                            </div>
                            <input type="hidden" name="status_agenda" value="2">
                            <input type="hidden" name="status_financeiro" value="0">
                            <div class="form-group row">
                                <div class="col-lg-12 mt-2">
                                    <label class="form-control-label">Motivo de Bloqueio</label>
                                    <input name="observacao" class="form-control">
                                </div>
                            </div>

                            <hr>
                            <div class="form-group row">
                                <div class="col">
                                    <button type="button" class="btn btn-alt-warning" data-dismiss="modal"><i
                                            class="fa fa-chevron-left"></i> Voltar</button>
                                    <button type="button" id="sub-block" class="btn btn-alt-success" value="Gravar">
                                        <span><i class="fa fa-check"></i> Gravar</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal-->

        </div>
        {{-- FINAL MODAL DO BLOQUEIO DE AGENDA / RESERVA --}}

    </div>
</div>
@endsection

@section('js_after')
<!-- Notify-->
<script src="{{ asset('plugin/js/notify/jquery.toast.min.js') }}"></script>
<script src="{{ asset('plugin/js/notify/toastr.init.js') }}"></script>

<!-- Moment-->
<script src="{{ asset('plugin/js/moment/momentJs.min.js') }}"></script>

<!-- Select 2-->
<script src="{{asset ('plugin/js/select2/select2.full.min.js') }}"></script>
<script src="{{ mix('assets/sweetalert2/js/sweetalert2.min.js') }}"></script>


<!-- GetCliente-->
<script defer src="{{ asset('src/agenda/gets.js') }}"></script>
<script src="{{ asset('src/mensagens-deletes/msgAndDelete.js') }}"></script>

<script src="{{ asset('src/agenda/validate-form.js') }}"></script>
<script src="{{ asset('src/dashboard/gets.js') }}"></script>


@if($agenda->status_agenda != 2)
<script type="text/javascript">
    $('#inicio').keyup(function () {
        var duracao = @json($agenda->servico->duracao);
        var inicio = $('#inicio').val();
        var fim = moment(inicio, 'YYYY-MM-DDTHH:mm').add(duracao, 'minutes').format('DD/MM/YYYY HH:mm');
        $('#fim').val(fim);
    })
</script>
@endif


<script src="{{ mix('assets/datatable/datatable.js') }}"></script>
<script src="{{ asset('js/simple-datatable.js') }}"></script>


{{-- calendário --}}
<script defer src="{{ asset('plugin/fullcalendar/packages/core/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/core/locales-all.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/interaction/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/daygrid/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/timegrid/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/bootstrap/main.js') }}"></script>
<script src="{{ asset('plugin/fullcalendar/packages/moment/main.min.js') }}"></script>

<script>
    var agora = new Date(new Date().toString().split('GMT')[0] + ' UTC').toISOString().split('.')[0];

    document.addEventListener('DOMContentLoaded', function () {
        var initialLocaleCode = 'pt-br';
        var largura = $(window).width();
        if (largura > 800) {
            var estilo = 'timeGridWeek';
            var direita = 'timeGridDay,timeGridWeek';
        } else {
            var estilo = 'timeGridDay';
            var direita = '';
        }
        const calendarEl = document.querySelector('#calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'timeGrid'],
            defaultView: estilo,
            titleFormat: {
                month: '2-digit',
                year: 'numeric',
                day: '2-digit'
            },
            height: 'parent',
            header: {
                left: 'prev,today,next',
                center: 'title',
                right: direita
            },
            defaultDate: '{{ $agenda->inicio }}',
            locale: initialLocaleCode,
            hiddenDays: [0],
            minTime: "08:00:00",
            maxTime: "19:00:00",
            weekNumbers: false,
            editable: false,
            eventLimit: true, // allow "more" link when too many events    
            selectable: true,
            selectHelper: true,            
            select: function (start) {
                if (start.startStr > agora) {
                    var duracao = @json($agenda->servico->duracao);
                    var inicio = moment(start.start).format("YYYY-MM-DDTHH:mm");
                    var fim = moment(inicio, 'YYYY-MM-DDTHH:mm').add(duracao, 'minutes').format('DD/MM/YYYY HH:mm');                
                    $('#inicio').val(inicio);
                    $('#fim').val(fim);

                } else {
                    Swal.fire(
                        'Desculpe!',
                        'mas não podemos criar um agendamento com uma data/hora inferior a atual.',
                        'error'
                    )
                }
            },
            events: function (data, successCallback, failureCallback) {
                $.ajax({
                        type: 'get',
                        contentType: "application/json; charset=utf-8",
                        dataType: 'json',
                        url: '/dashboard/agendas' + location.search,
                    })
                    .done(function (dados) {
                        let eventos = []
                        dados.forEach(function (agenda, key) {
                            if (agenda.status_agenda == 2) {
                                eventos.push({
                                    id: agenda.id,
                                    title: agenda.observacao,
                                    start: agenda.inicioJS,
                                    end: agenda.fimJS,
                                    textColor: '#000000',
                                    backgroundColor: 'rgba(198, 198, 198, 0.4)',
                                    url: `/agendas/${agenda.id}/edit`
                                })
                            } else {
                                eventos.push({
                                    id: agenda.id,
                                    title: agenda.servico.descricao +
                                        " - " + agenda
                                        .pedido.pessoa
                                        .nome_razao_social,
                                    description:'teste de descrição',
                                    start: agenda.inicioJS,
                                    end: agenda.fimJS,
                                    textColor: agenda.servico.cor_texto,
                                    backgroundColor: agenda.servico
                                        .cor_fundo,
                                    url: `/agendas/${agenda.id}/edit`
                                })
                            }


                        })
                        successCallback(eventos);
                    })
            }
        })
        calendar.refetchEvents();
        calendar.render();
    });

</script>
@endsection
