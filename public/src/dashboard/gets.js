    /**
    *  Ajax request for backend
    *  @return Response::Json
    *  Calcular a hora final do agendamento : /servicos/getById end point
     */
    $('#servicos').change(function(){
        let servico_id = $('#servicos').val()
        $.ajax({
            type:'get',		
            contentType: "application/json; charset=utf-8",
            dataType: 'json',	
            url: `/servicos/getById/${servico_id}`+location.search,
            })
            .done(function( servico ) {
                    let inicio = $("#inicio").val()
                    var fim = moment(inicio, 'YYYY-MM-DDTHH:mm').add(servico.duracao, 'minutes').format('YYYY-MM-DDTHH:mm');
                    $('#fim').val(fim);
            })
            
    }) 



    /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * get all register : methods in /forma_recebimento/getByStatus end point
     *  
     */
    function  formaRecebimento(){ 
        $.ajax({
            type:'get',		
            contentType: "application/json; charset=utf-8",
            dataType: 'json',	
            url: '/recebimentos/getByStatus'+location.search,
            })
            .done(function( dados ) {
                let html ='<option value="" disabled selected>Selecione Pagamento</option>'
                dados.forEach(function(recebimento, key){
                    html+=`
                    <option value = "${recebimento.id}">${recebimento.forma}</option>
                    `
                });
            $('#forma_recebimento').html(html)
        })
    }
    /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * get all register : methods in /pessoas/getAll end point
     *  
     */
    function verificaCliente(){
    $.ajax({
        type:'get',		
        contentType: "application/json; charset=utf-8",
        dataType: 'json',	
        url: '/pessoas/getAll/tipo_cliente'+location.search,
        })
        .done(function( dados ) {
            let html ='<option value=""></option>'
            dados.forEach(function(pessoa, key){
                if(pessoa.tipo_cliente == 1){
                html+=`
                <option value = "${pessoa.id}">${pessoa.nome_razao_social}</option>
                `
                }
            });
        if (dados.length > 0){
            $('#pessoas').html(html)
        } else {
                swal({ 
                    title: 'CUIDADO!',
                     showCancelButton: true,
                     confirmButtonText: 'cadastrar um CLIENTE agora.',
                     cancelButtonText: 'Cancelar',
                     text: 'Antes de prosseguir com um agendamento, é necessário cadastrar ao menos um cliente.',
                     type: 'warning',
                     confirmButtonColor: '#308B2E',
                     showLoaderOnConfirm: true,
                    preConfirm: ()=>{
                        window.location.href ='/pessoas/create'
                    }
                })
            } 
    });
    }

      /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * Get all register : methods in /pacotes/getAll end point
     *  
     */
    function verificaServico(){
    $.ajax({
        type:'get',		
        contentType: "application/json; charset=utf-8",
        dataType: 'json',	
        url: '/pacotes/getAll'+location.search,
        })
        .done(function( dados ) {
            let html =`<option value = ""></option>`
             dados.forEach(function(pacote, key){
                 if(pacote.padrao==1){
                    pacote.pacote_servicos.forEach(function(pacote_servicos, key){
                    html +=`
                    <option value = "${pacote_servicos.servico_id}">
                    ${pacote.descricao}
                    </option>
                `
                    })
                }
        });
            if (dados.length > 0){
            $('#servicos').html(html)
            }else{
                swal({ 
                    title: 'ATENÇÃO!',
                     showCancelButton: true,
                     confirmButtonText: 'cadastrar um SERVIÇO agora.',
                     cancelButtonText: 'Cancelar',
                     text: 'Antes de prosseguir com o agendamento, é necessário cadastrar ao menos um SERVIÇO.',
                     type: 'warning',
                     confirmButtonColor: '#308B2E',
                     showLoaderOnConfirm: true,
                     preConfirm: ()=>{
                        window.location.href ='/servicos/create'
                     }})
            } 
    });
    }
     /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * Get  : methods in /pedidos/getByPessoa end point
     *  
     */
    $('#servicos').change(function(){
        let pessoa_id = $('#pessoas').val()
        let servico_id = $('#servicos').val()
        let html = ``
        $.ajax({
            type:'get',		
            contentType: "application/json; charset=utf-8",
            dataType: 'json',	
            url: `/pedidos/getByPessoa/${pessoa_id}/${servico_id}`+location.search
            })
            .done(function(dados){
                if(!dados){
                    $.ajax({
                        type:'get',		
                        contentType: "application/json; charset=utf-8",
                        dataType: 'json',
                        url: `/servicos/getById/${servico_id}`+location.search
                        })
                        .done(function(servico) {
                          html=`
                            <div class="col-lg-3 mt-2">
                            <label class="form-control-label">Valor do Servico</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">R$</span>
                                </div>
                                <input type="text" class="form-control text-right"
                                    name="valor" id="valor" value="${servico.valor}" readonly>
                             </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                        <label class="form-control-label">Desconto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">R$</span>
                            </div>
                            <input type="text" class="form-control text-right"
                                name="desconto" value= "0,00" id="desconto">
                         </div>
                    </div>
                    <div class="col-lg-3 mt-2">
                    <label class="form-control-label">Valor Final</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">R$</span>
                        </div>
                        <input type="text" class="form-control text-right"
                            name="valor_total" id="valor_total" value="${servico.valor}">
                     </div>
                </div>
                            <div class="col-lg-3 mt-2">
                                <label>Meio de Pagamento:</label>
                                <select name="forma_recebimento_id" class="form-control w-100" required 
                                id="forma_recebimento"
                                </select>
                            </div>
                            `
                            $('#valores_saldos').html(html)
                            $('#forma_recebimento').html(formaRecebimento)

                            $('#desconto').keyup(function(){
                                let valor = $('#valor').val().replace(',','.')
                                let desconto = $('#desconto').val().replace(',','.')
                                valor_servico = (valor - desconto).toFixed(2).replace('.',',');
                                $('#valor_total').val(valor_servico)
                                html =``
                            })
                        })
                }else{
                    dados.forEach(function(pedido){
                        html=`
                        <div class="col-lg-3 mt-2">
                            <input type="hidden" name="pedido_id" id="pedido_id" value="${pedido.pedido_id}" >
                            <input type="hidden" name="detalhe_pedido_id" id="detalhe_pedido_id" value="${pedido.detalhe_pedido_id}" >
                            <label class="form-control-label"><strong>Descrição</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <strong><i>${pedido.servico}</i></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                            <label class="form-control-label"><strong>Adquirido</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                            ${pedido.adquirido}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                            <label class="form-control-label"><strong>Consumido</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                            ${pedido.consumido}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-2">
                            <label class="form-control-label"><strong>Saldo</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                            ${pedido.saldo}
                                </div>
                            </div>
                        </div>
                        `
                        $('#valores_saldos').html(html)
                        html=``

                    })
                }

             });

    })

   /**
    *  Ajax request for backend
    *  @return Response::Json
    *  Calcular a hora final do agendamento : /servicos/getById end point
     */
    $('#servicos').change(function(){
        let servico_id = $('#servicos').val()
        $.ajax({
            type:'get',		
            contentType: "application/json; charset=utf-8",
            dataType: 'json',	
            url: `/servicos/getById/${servico_id}`+location.search,
            })
            .done(function( servico ) {
                $('#inicio').keyup(function(){
                    let inicio = $("#inicio").val()
                    var fim = moment(inicio, 'YYYY-MM-DDTHH:mm').add(servico.duracao, 'minutes').format('DD/MM/YYYY HH:mm');
                    $('#fim').val(fim);
                })
            })
    })

    function alertDate(){
        Swal.fire({
            icon: 'error    ',
            title: 'Oops!',
            text: "Não é possível agendar numa data e hora anterior a atual!",
            confirmButtonColor: '#cc0000',
        })

    }