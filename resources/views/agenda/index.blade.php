@extends('layouts.codebase.index-page')

@section('title')Agenda
@endsection


@section('css_after')
<link rel="stylesheet" type="text/css" href="{{ mix('assets/sweetalert2/css/sweetalert2.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ mix('assets/select2/css/select2.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ mix('assets/fullcalendar/fullcalendar.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ mix('assets/datatable/datatable.css') }}" />
@endsection

@section('content')
<div class="content">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Agenda</h3>
            <div class="text-right">
                <button class="btn btn-rounded btn-secondary" id="block">
                    <i class="si si-calendar"></i> Reserva de Agenda
                </button>
                <button class="btn btn-circle btn-secondary" data-toggle="modal" id="btn-pesquisa">
                    <i class="fa fa-search"></i>
                </button>
            </div>

        </div>

        <div class="block-content pb-4">
            <div class="mb-30">
                <div id='calendar' class=""></div>
            </div>
        </div>
    </div>

    <!-- modal de agendamento -->
    <div class="modal fade" id="modelId" role="dialog" aria-labelledby="modelTitleId" tabindex="-1" aria-hidden="true">
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
                                <input type="datetime-local" class="form-control text-center" name="inicio" id="inicio"
                                    readonly />
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
                    <table id="focus" class="table table-sm responsive table-hover table-striped nowrap simple-datatable"
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
                            @foreach ($agendas as $agda)
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


</div>

@endsection

@section('pagejs')
<script type="text/javascript">
    window.urlCreate = "{{ route('agendas.create') }}";

</script>
@endsection

@section('js_after')


<script src="{{ asset('plugin/validate-jQuery/jquery.validate.js') }}"></script>
<script src="{{ asset('plugin/validate-jQuery/additional-methods.min.js') }}"></script>
<script src="{{ asset('plugin/validate-jQuery/pt-Br.js') }}"></script>

<script src="{{ asset('src/agenda/validate-form.js') }}"></script>
<script src="{{ asset('src/dashboard/gets.js') }}"></script>

<script src="{{ mix('assets/datatable/datatable.js') }}"></script>
<script src="{{ asset('js/simple-datatable.js') }}"></script>

<!-- calendário -->
{{-- <script src="{{ mix('assets/fullcalendar/fullcalendar.js') }}"></script> --}}



<script defer src="{{ asset('plugin/fullcalendar/packages/core/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/core/locales-all.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/interaction/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/daygrid/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/timegrid/main.js') }}"></script>
<script defer src="{{ asset('plugin/fullcalendar/packages/bootstrap/main.js') }}"></script>
<script src="{{ asset('plugin/fullcalendar/packages/moment/main.min.js') }}"></script>


<script>
    jQuery(function () {
        Codebase.helpers(['select2']);
    });

</script>

<script src="{{ mix('assets/select2/js/select2.js') }}"></script>
<script src="{{ mix('assets/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('src/mensagens-deletes/msgAndDelete.js') }}"></script>
<script src="{{ asset('src/agenda/gets.js') }}"></script>


{{-- CHAMADA DA PESQUISA MODAL --}}
<script>
    $('#btn-pesquisa').on('click', function(){
        $('#pesquisa').modal('show') ;
        $("#focus_filter input").focus();        
    })
</script>


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
            defaultDate: '{{ date("Y-m-d") }}',
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
                $('#modelId #inicio').val(moment(start.start).format("YYYY-MM-DDTHH:mm"));
                $('#modelId #fim').val(moment(start.end).format("YYYY-MM-DDTHH:mm"));
                $('#modelId #data_vencimento').val(moment(start.end).format("YYYY-MM-DD"));
                if (start.startStr > agora) {
                    $('#modelId').modal('show');
                    verificaCliente()
                    verificaServico()
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
