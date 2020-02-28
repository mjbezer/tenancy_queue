@extends('layouts.app')

@section('title') - Agenda
@endsection

@section('css_after')
<link rel="stylesheet" href="{{mix('assets/select2/css/select2.css') }}" />    
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="container corpo shadow">
        <div class="col">
            <h4><i class="fa fa-calendar icone"></i>Agenda ( novo )</h4>
            <hr>
            <form action="{{ route('agendas.store') }}" method="post" id="form-agenda">
            {{ csrf_field() }}
           
            <div class="form-group row">

            <div class="col-lg-6 mt-2">
            <label class="form-control-label">Cliente</label>
                    <select class="select2_pessoas form-control" name="pessoa_id" id="pessoas" required>
                    </select>
            </div>
        

                <div class="col-lg-6 mt-2">
                    <label class="form-control-label">Serviço:</label>
                    <select class="select2_demo_ form-control" name="servico_id" id="servicos" required>
                    </select>
                </div>
            </div>
            <div class="form-group row">
   
                <div class="col-lg-4 mt-2">
                    <label class="form-control-label">Início:</label>
                    <input type="datetime-local" class="form-control text-center" name="inicio" id="inicio" required/>
                </div>

                <div class="col-lg-4 mt-2">
                    <label class="form-control-label">Fim:</label>
                    <input type="text" class="form-control text-center" name="fim" id="fim" readonly />
                </div>

                <div class="col-lg-4 mt-2">
                    <label class="form-control-label">Vencimento:</label>
                    <input type="date" class="form-control text-center" name="data_vencimento" id="data_vencimento"
                        required value="{{ date('Y-m-d') }}" />
                </div>

              <div class="row">
                <div class="col" id="valores_saldos"></div>
            </div>
                <div class="form-row col-lg-12">
                    <div class="col-lg-12 mt-2">
                        <label class="form-control-label">Observações:</label>
                        <textarea name="observacao" class="form-control" rows="3"></textarea>
                    </div>
                </div>

            </div>

            </div>
            <hr>
            <div class="form-group row ml-0 ">
                <button type="button" class="btn btn-warning btn150" onclick="location.href='{{ route('agendas.index') }}'"><i
                        class="fa fa-chevron-left"></i> Voltar</button>
                <button type="submit" class="btn btn-success btn150 ml-1" value="Gravar">
                    <span><i class="fa fa-check"></i> Gravar</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scriptJs')
@if(session('message'))
<script>
  Swal.fire({
            icon: 'error    ',
            title: 'Oops!',
            text: '{{ Session("message")}}',
            confirmButtonColor: '#cc0000',
        })

</script>
@endif
@endpush

@section('js_after')
<script src="{{ mix('assets/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset ('plugin/validate-jQuery/jquery.validate.js') }}"></script>
<script src="{{ asset ('plugin/validate-jQuery/additional-methods.min.js') }}"></script>
<script src="{{ asset ('plugin/validate-jQuery/pt-Br.js') }}"></script>
<script src="{{ asset ('src/agenda/validate-form.js') }}"></script>

<script defer src="{{ asset('src/agenda/gets.js') }}"></script>
<script src="{{ asset('plugin/js/moment/momentJs.min.js') }}"></script>
<script src="{{asset ('plugin/js/select2/select2.full.min.js') }}"></script>

<script>
    $(".select2_pessoas").select2({
                    placeholder: "Selecione o cliente",
                    allowClear: true
                });
    </script>
@endsection
