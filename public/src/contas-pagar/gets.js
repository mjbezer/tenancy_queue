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
    url: '/pessoas/getAll/tipo_fornecedor' + location.search,
})
    .done(function (dados)
    {
        let html = '<option value=""></option>'
        dados.forEach(function (pessoa, key)
        {
            if (pessoa.tipo_fornecedor == 1)
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
                html: `<div>Para registar uma despesa é necessário:<div> 
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
            if (categoria.flag_receber != '1')
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
                html: `<div>Para registar uma despesa é necessário:<div> 
                        <div class="text-danger">Registrar uma categoria e uma subcategoria </div>
                        <div class="text-danger">de despesa! </div>`,

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
                message.push('Não há sub categoria de despesas cadastrada.')
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
    $.ajax({
        type: 'get',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        url: `/contas-pagar/fastConsolidation/${id}` + location.search,
        success: function (response)
        {
            if (response.conta_pagar)
            {
                $('#valor_consolidado').val(response.conta_pagar.valor_pago)
                $('#data_pagamento').val(response.conta_pagar.data_pagamento)
                Swal.fire({
                    type: 'success',
                    title: 'Baixa Realizada!',
                    text: `Conta a pagar no valor de R$ ${response.conta_pagar.valor_pago} consolidada!`,
                    confirmButtonColor: '#7fc600',
                })
            }
        },

        error: function (e)
        {
            Swal.fire({
                type: 'error',
                title: 'Oops!',
                text: "Ocorreu um erro no acesso aos dados, tente mais tarde!",
                confirmButtonColor: '#cc0000',
            })
        }
    })
})
