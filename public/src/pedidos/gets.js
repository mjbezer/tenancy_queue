    /**
     * Ajax request for backend
     * @return Response::Json
     * 
     * get all register : methods in /forma_recebimento/getByStatus end point
     *  
     */

    $.ajax({
            type: 'get',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            url: '/recebimentos/getByStatus' + location.search,
        })
        .done(function (dados) {
            let html = '<option value="" disabled selected>Selecione Pagamento</option>'
            dados.forEach(function (recebimento, key) {
                html += `
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
            type: 'get',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            url: '/pacotes/getAll' + location.search,
        })
        .done(function (dados) {
            let html = ``
            let pacotes = ``
            let servicos = ``
            dados.forEach(function (pacote, key) {
                if (pacote.padrao == 1) {
                    servicos += `
                <option value = "${pacote.id}">${pacote.descricao}</option>

                `
                }
                if (pacote.padrao == 0) {
                    pacotes += `
                <option value = "${pacote.id}">${pacote.descricao}</option>
                `
                }
            });

            html += `<option value="">Escolha um Servico</option>
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

    $('#servicos').change(function () {
        let pacote_id = $('#servicos').val()
        $.ajax({
                type: 'get',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                url: `/pacotes/getById/${pacote_id}` + location.search,
            })
            .done(function (dados) {
                $('#valor_item').val(dados.valor)
                $('#desconto_item').val(0)
                $('#valor_total').val(dados.valor)
                $('#hide_descricao').val(dados.descricao)
                $('#hide_pacote_id').val(dados.id)
            });
    });


    $('#tipo_desconto').change(function () {
        let tipo_desconto = $('#tipo_desconto').val()
        $('#desconto_item').keypress(function () {
            let valor_total = 0
            let percent = 0
            let valor = $('#valor_item').val().replace(',', '.')
            let desconto = $('#desconto_item').val().replace(',', '.')
            if (tipo_desconto == 'absoluto') {
                valor_total = (valor - desconto).toFixed(2).replace('.', ',');
            }
            if (tipo_desconto == 'percentual') {
                $('#tipo').html('%')
                percent = (desconto / 100)
                valor_total = valor * (1 - (percent))
                valor_total = valor_total.toFixed(2).replace('.', ',')
            }
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

    $('#incluir').click(function (e) {
        e.preventDefault()
        let descricao_servico = $('#hide_descricao').val()
        let pacote_id = $('#hide_pacote_id').val()
        let valor_item = numberForm($('#valor_item').val())
        let valor_total = numberForm($('#valor_total').val())
        let quantidade = $('#quantidade').val()
        let desconto = (numberForm($('#valor_item').val())) - (numberForm($('#valor_total').val()))

        let total_servicos = $('#total-servicos').val().replace(',', '.')
        let total_descontos = $('#total-descontos').val().replace(',', '.')
        let total_pedido = $('#total-pedido').val().replace(',', '.')
        let valor_final = parseFloat(valor_total * quantidade).toFixed(2)
        loop = `<input type="hidden" name = "loop" id="loop" value="${c}">`
        html = ``
        html += `<tr id='item-td'>
                <td class='text-center'>${quantidade}</td>
                <td>${descricao_servico}</td>
                <td class='text-right'>R$ ${valor_item.replace('.',',')}</td>
                <td class='text-right'>R$ ${desconto.toFixed(2).replace('.',',')}</td>
                <td class='text-right'>R$ ${valor_total.replace('.',',')}</td>
                <td class='text-right' id='valor_final${c}'>R$ ${valor_final.replace('.',',')}</td>
                <td>
                <input type="hidden" name = "pacote_id${c}" id="pacote_id${c}" value="${pacote_id}">
                <input type="hidden" name = "quantidade${c}" id="quantidade${c}" value="${quantidade}">
                <input type="hidden" name = "valor_unitario${c}" id="valor_unitario${c}" value="${valor_item.replace('.',',')}">
                <input type="hidden" name = "desconto_item${c}" id="desconto_item${c}" value="${desconto.toFixed(2).replace('.',',')}">
                <input type="hidden" name = "valor_liquido_unitario${c}" id="valor_total_item${c}" value="${valor_total.replace('.',',')}">
                <input type="hidden" name = "valor_total_item${c}" id="valor_total_item${c}" value="${valor_final.replace('.',',')}">
                <span class="input-group-addon remove_item" onclick="RemoveTableRow(this,${quantidade},${valor_item}, ${desconto}, ${valor_total})""><i class="fa fa-trash-o text-danger" ></i></span></td>
  
            </tr>`
        c++

        total_servicos = (parseFloat(total_servicos ? total_servicos : 0) + parseFloat(quantidade * valor_item)).toFixed(2)
        total_descontos = (parseFloat(total_descontos ? total_descontos : 0) + parseFloat(quantidade * desconto)).toFixed(2)
        total_pedido = (parseFloat(total_pedido ? total_pedido : 0) + parseFloat(quantidade * valor_total)).toFixed(2)

        $('#total-servicos').val(total_servicos)
        $('#total-descontos').val(total_descontos)
        $('#total-pedido').val(total_pedido)
        $('#count').html(loop)
        if (valor_final > 0.00) {
            $('#item').removeClass('invisible')
            $(this).addClass('visible')
            $('#lista-pedido tbody').prepend(html)
            $('#form-servicos-pacotes').each(function () {
                this.reset()
            })
        } else {
            c = 1
        }

        $('#fechar-modal').click(function () {
            $('#form-servicos-pacotes').each(function () {
                this.reset()
            })
        })
        $('.modal').modal('hide')
    })

    /**
     * Form validation
     * 
     */
    $(document).ready(function () {
        $(".validation").validate({
            rules: {
                pessoa_id: 'required',
                valor_pedido: 'required',
                forma_recebimento_id: 'required'
            }
        })
    })

    function numberForm(value) {
        let remDot = value.replace('.', '')
        return remDot.replace(',', '.')
    }


    function RemoveTableRow(handler, q, v, d, t) {
        let total_servicos = $('#total-servicos').val().replace(',', '.')
        let total_descontos = $('#total-descontos').val().replace(',', '.')
        let total_pedido = $('#total-pedido').val().replace(',', '.')
        total_servicos =   total_servicos - (q*v)
        total_descontos =  total_descontos - (q*d)
        total_pedido =  total_pedido - (q*t) 
        total_servicos =   total_servicos.toFixed(2) 
        total_descontos =  total_descontos.toFixed(2)
        total_pedido =  total_pedido.toFixed(2)
        
        $('#total-servicos').val(total_servicos)
        $('#total-descontos').val(total_descontos)
        $('#total-pedido').val(total_pedido)
        var tr = $(handler).closest('tr')
        tr.fadeOut(100, function () {
            tr.remove()
        })
    }

    function replaceQtde(qtde, c , vt, d){
        desconto = (d*qtde.value).toFixed(2)
        valor_final = ((vt*qtde.value)- desconto).toFixed(2)
        $(`#valor_final${c}`).html(`R$ ${valor_final.replace('.',',')}`)
        console.log($('#total-pedido').val() + valor_final )
        
    }

    
