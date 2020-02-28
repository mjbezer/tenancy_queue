/*
* Ajax request for backend
* @return Response::Json
* Get  all providers : methods in /pessoas/getAll/tipo_fornecedor end point
*  
*/

$.ajax({
    type: 'get',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: '/pessoas/getAll/tipo_cliente' + location.search,
})
    .done(function (dados)
    {
        let html = '<option value=""></option>'
        dados.forEach(function (pessoa, key)
        {
            if (pessoa.tipo_cliente == 1)
            {
                html += `
            <option value = "${pessoa.id}">${pessoa.nome_razao_social}</option>
            `
            }
        });
        if (dados.length > 0)
        {
            $('#fornecedor').html(html)
        } else
        {
            swal({
                title: 'CUIDADO!',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: ' Registar Fornecedor',
                html: `<div>Para registar uma receita é necessário:<div> 
                        <div class="text-danger">Registrar fornecedor </div>`,
                type: 'warning',
                confirmButtonColor: '#F54400',
                showLoaderOnConfirm: true,
                preConfirm: () =>
                {
                    window.location.href = '/pessoas/create'
                }
            })
        }
    });
/*
* Ajax request for backend
* @return Response::Json
* Get  Category : methods in /categorias/getById end point
*  
*/
$.ajax({
    type: 'get',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: '/categorias/getAll' + location.search,
})
    .done(function (dados)
    {
        let c = 0
        let html = '<option value="">Escolha uma categoria</option>'
        console.log(dados)
        dados.forEach(function (categoria, key)
        {
            if (categoria.flag_receber == '1')
            {
                html += `
            <option value = "${categoria.id}">${categoria.descricao}</option>
            `
                c++
            }
        });
        if (c > 0)
        {
            $('#categorias').html(html)
        } else
        {
            swal({
                title: 'CUIDADO!',
                showCancelButton: true,
                confirmButtonText: ' Registar Categoria',
                cancelButtonText: 'Cancelar',
                html: `<div>Para registar uma receita é necessário:<div> 
                        <div class="text-danger">Registrar categoria e subcatedoria </div>
                        <div class="text-danger">de receita! </div>`,

                type: 'warning',
                confirmButtonColor: '#F54400',
                showLoaderOnConfirm: true,
                preConfirm: () =>
                {
                    window.location.href = '/categorias/create'
                }
            })

        }
    });
/**
* Ajax request for backend
* @return Response::Json
* @param $categotia_id
* Get Sub Category : methods in /sub_categorias/getByCategory end point
*  
*/

$('#categorias').change(function ()
{
    let categoria_id = $('#categorias').val();
    $.ajax({
        type: 'get',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        url: `/sub_categorias/getByCategory/${categoria_id}` + location.search,
    })
        .done(function (dados)
        {
            let html = '<option value="">Escolha uma sub categoria</option>'
            console.log(dados)
            dados.forEach(function (sub_categoria, key)
            {
                html += `
            <option value = "${sub_categoria.id}">${sub_categoria.descricao}</option>
            `
            });
            if (dados.length > 0)
            {
                $('#sub_categorias').html(html)

            } else
            {
                message.push('Não há sub categoria de receitas cadastrada.')
                emptydepend(message)

            }
        });


})


/**
  * Ajax request for backend
  * @return Response::Json
  * 
  * Make Consolidation : methods in /contas-pager/fastConsolidation end point
  *  
  */

$("#baixa-rapida").click(function ()
{
    let id = $('#id').val()
    console.log(id)
    $.ajax({
        type: 'get',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        url: `/contas-receber/fastConsolidation/${id}` + location.search,
        success:
            function (response)
            {
                if (response.conta_receber)
                {
                    $('#valor_consolidado').val(response.conta_receber.valor_pago)
                    $('#data_pagamento').val(response.conta_receber.data_pagamento)
                    Swal.fire({
                        type: 'success',
                        title: 'Baixa Realizada!',
                        text: `Conta a receber no valor de R$ ${response.conta_receber.valor_pago} consolidada!`,
                        confirmButtonColor: '#7fc600',
                    })
                }
            },
        error: function (e)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "Ocorreu um erro no acesso aos dados, tente mais tarde!",
                confirmButtonColor: '#cc0000',
            })
        }
    })
})

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
        $('#forma_recebimento_id').html(html)
    });