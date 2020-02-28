    /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * get all register : methods in /pessoas/getAll end point
     *  
     */
    
    $.ajax({
        type:'get',		
        contentType: "application/json; charset=utf-8",
        dataType: 'json',	
        url: '/pessoas/getAll/tipo_cliente'+location.search,
        })
        .done(function( dados ) {
            let html ='<option value=""></option>'
            console.log(dados)
            dados.forEach(function(pessoa, key){
                html+=`
                <option value = "${pessoa.id}">${pessoa.nome_razao_social}</option>
                `
            });
        $('#pessoas').html(html)
    });

    /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * get all register : methods in /forma_recebimento/getByStatus end point
     *  
     */
    
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
    });

     /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * Get all register : methods in /pacotes/getAll end point
     *  
     */

    $.ajax({
        type:'get',		
        contentType: "application/json; charset=utf-8",
        dataType: 'json',	
        url: '/pacotes/getAll'+location.search,
        })
        .done(function( dados ) {
            let html =``
            let pacotes = ``
            let servicos = ``
            dados.forEach(function(pacote, key){
                if(pacote.padrao == 1){
                servicos +=`
                <option value = "${pacote.id}">${pacote.descricao}</option>

                `}
                if(pacote.padrao == 0){
                pacotes +=`
                <option value = "${pacote.id}">${pacote.descricao}</option>
                `}
            });
            
            html +=`<option value="">Escolha um Servico</option>
            <optgroup label="SERVIÇOS">
            ${servicos}
            <optgroup label="PACOTES">
            ${pacotes}`

            $('#servicos').html(html)
        
    });

    
    /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * Get by id register : methods in /pacotes/getById end point
     * Allows discount calculation
     * 
     */

    $('#servicos').change(function(){
        let pacote_id = $('#servicos').val()
        $.ajax({
            type:'get',		
            contentType: "application/json; charset=utf-8",
            dataType: 'json',	
            url: `/pacotes/getById/${pacote_id}`+location.search,
            })
            .done(function( dados ) {
                console.log(dados.id)
                $('#valor_item').val(dados.valor)
                $('#desconto_item').val(0)
                $('#valor_total').val(dados.valor)
                $('#hide_descricao').val(dados.descricao)
                $('#hide_pacote_id').val(dados.id)
        });
    });


    $('#tipo_desconto').change(function(){
        let tipo_desconto = $('#tipo_desconto').val()
        $('#desconto_item').keydown(function(){
            let valor_total = 0
            let percent =0
            let valor = $('#valor_item').val().replace(',','.')
            let desconto = $('#desconto_item').val().replace(',','.')
                if(tipo_desconto == 'absoluto'){
                    $('#tipo').html('R$ - BRL')
                    valor_total = (valor - desconto).toFixed(2).replace('.',',');
                }
                if(tipo_desconto == 'percentual'){
                    $('#tipo').html('%')
                    percent = (desconto/100)
                    valor_total = valor*(1-(percent))
                    valor_total  = valor_total.toFixed(2).replace('.',',')
                }   
                console.log(valor_total)
                $('#valor_total').val(valor_total)
        })
    })

    /**
    * Reactive Ajax Interaction
    * 
    * 
    * Records purchase order items,
    * and calculates final order value
    */

let c = 1
let dados = ``
let loop = 0;
    
$('#incluir').click(function(e){
    e.preventDefault()
    let descricao_servico = $('#hide_descricao').val()
    let pacote_id = $('#hide_pacote_id').val()
    let valor_item = numberForm($('#valor_item').val())
    let valor_total = numberForm($('#valor_total').val())
    let quantidade = $('#quantidade').val()
    let desconto = (numberForm($('#valor_item').val()))-(numberForm($('#valor_total').val()))
    
    let total_servicos =  $('#total-servicos').val().replace(',','.')
    let total_descontos =  $('#total-descontos').val().replace(',','.')
    let total_pedido =  $('#total-pedido').val().replace(',','.')
    let valor_final = parseFloat(valor_total*quantidade).toFixed(2)
     dados += `<input type="hidden" name = "pacote_id${c}" id="pacote_id${c}" value="${pacote_id}">
               <input type="hidden" name = "quantidade${c}" id="quantidade${c}" value="${quantidade}">
               <input type="hidden" name = "valor_unitario${c}" id="valor_unitario${c}" value="${valor_item.replace('.',',')}">
               <input type="hidden" name = "desconto_item${c}" id="desconto_item${c}" value="${desconto.toFixed(2).replace('.',',')}">
               <input type="hidden" name = "valor_liquido_unitario${c}" id="valor_total_item${c}" value="${valor_total.replace('.',',')}">
               <input type="hidden" name = "valor_total_item${c}" id="valor_total_item${c}" value="${valor_final.replace('.',',')}">`

               loop = `<input type="hidden" name = "loop" id="loop" value="${c}">`
               
               
          c++           
    
    html = ``
    html += `<tr>
                <td>${quantidade}</td>
                <td>${descricao_servico}</td>
                <td>${valor_item.replace('.',',')}</td>
                <td>${desconto.toFixed(2).replace('.',',')}</td>
                <td>${valor_total.replace('.',',')}</td>
                <td>${valor_final.replace('.',',')}</td>

                <td> <a class="btn btn-outline-success btn-sm" data-toggle="tooltip"
                href="{{ route('PacoteServico.edit', $PacoteServico->id) }}"
                title="Edita/Altera este registro..."><i class="fa fa-edit acoes"></i></a>
            <a class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
            onclick="if(confirm('Tem certeza que quer excluir este registro?')) { document.getElementById('form{{ $pacote->Id }}').submit(); }"
                href="#"
                title="Deleta/Exclui este registro..."><i class="fa fa-trash-o acoes"></i></a></td>
            </tr>`
            console.log(total_servicos ? 1 : 0)
    total_servicos =  (parseFloat(total_servicos ? total_servicos : 0) + parseFloat(quantidade*valor_item)).toFixed(2)
    total_descontos = (parseFloat(total_descontos ? total_descontos : 0) + parseFloat(quantidade*desconto)).toFixed(2)
    total_pedido =  (parseFloat(total_pedido ? total_pedido : 0) + parseFloat(quantidade*valor_total)).toFixed(2)

    $('#total-servicos').val(total_servicos)
    $('#total-descontos').val(total_descontos)
    $('#total-pedido').val(total_pedido)
    $('#fields').append(dados)
    $('#count').html(loop)
    $('#dataTable3btn tbody').prepend(html)
    $('#form_modal').each(function(){
        this.reset()
    })
    $('.modal').modal('hide')
})

/**
 * Form validation
 * 
 */
$(document).ready(function(){
    $(".validation").validate({
        rules:{
            pessoa_id:'required',
            valor_pedido :'required',
            forma_recebimento_id : 'required'
        }
    })
})

function numberForm(value){
    let remDot =  value.replace('.','')
    return remDot.replace(',','.')
}

