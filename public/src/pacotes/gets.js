$.ajax({
    type: 'get',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: '/categorias/getAll' + location.search,
})
.done(function (dados) {
    let html = '<option value="">Escolha uma categoria</option>'
    console.log(dados)
    dados.forEach(function (categoria, key) {
        html += `
        <option value = "${categoria.id}">${categoria.descricao}</option>
        `
    });
    if (dados.length > 0) {
        $('#categorias').html(html)
    } else {
        swal({
            title: 'CUIDADO!',
            showCancelButton: true,
            confirmButtonText: 'Sim, desejo incluir !',
            cancelButtonText: 'Cancelar',
            text: 'Para registar um serviço é necessário possuir ao menos uma categoria e sub-categoria cadastradas.',
            type: 'warning',
            confirmButtonColor: '#F54400',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                window.location.href = '/categorias/create'
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
.done(function (dados) {
    let c = 0
    let html = '<option value="">Escolha uma categoria</option>'
    console.log(dados)
    dados.forEach(function (categoria, key) {
        if (categoria.flag_receber == '1') {
            html += `
        <option value = "${categoria.id}">${categoria.descricao}</option>
        `
            c++
        }
    });
    if (c > 0) {
        $('#categorias').html(html)
    } else {
        swal({
            title: 'ATENÇÃO!',
            showCancelButton: true,
            confirmButtonText: 'cadastrar um CATEGORIA agora.',
            cancelButtonText: 'Cancelar',
            html: `<div>Para registar uma receita é necessário:<div> 
                    <div class="text-danger">Registrar categoria e subcatedoria </div>
                    <div class="text-danger">de receita! </div>`,

            type: 'warning',
            confirmButtonColor: '#F54400',
            showLoaderOnConfirm: true,
            preConfirm: () => {
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

$('#categorias').change(function () {
let categoria_id = $('#categorias').val();
$.ajax({
        type: 'get',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        url: `/sub_categorias/getByCategory/${categoria_id}` + location.search,
    })
    .done(function (dados) {
        let html = '<option value="">Escolha uma sub categoria</option>'
        console.log(dados)
        dados.forEach(function (sub_categoria, key) {
            html += `
        <option value = "${sub_categoria.id}">${sub_categoria.descricao}</option>
        `
        });
        if (dados.length > 0) {
            $('#sub_categorias').html(html)

        } else {
            message.push('Não há sub categoria de receitas cadastrada.')
            emptydepend(message)
        }
    });


}) 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 $.ajax({
         type: 'get',
         contentType: "application/json; charset=utf-8",
         dataType: 'json',
         url: '/servicos/getAll' + location.search,
     })
     .done(function (dados) {
         let html = '<option value="">Escolha um Servico</option>'
         dados.forEach(function (servico, key) {
             html += `
                <option value = "${servico.id}">${servico.descricao}</option>
                `
         });
         if (dados.length > 0) {
             $('#servicos').html(html)
         } else {
             swal({
                 title: 'CUIDADO!',
                 showCancelButton: true,
                 confirmButtonText: 'Sim, desejo incluir serviço!',
                 cancelButtonText: 'Cancelar',
                 text: 'Para registar um pacote de serviço é necessário possuir ao menos um serviço cadastrado!',
                 type: 'warning',
                 confirmButtonColor: '#F54400',
                 showLoaderOnConfirm: true,
                 preConfirm: () => {
                     window.location.href = '/servicos/create'
                 }
             })
         }

     });


 $('#servicos').change(function () {
     let servico_id = $('#servicos').val()
     $.ajax({
             type: 'get',
             contentType: "application/json; charset=utf-8",
             dataType: 'json',
             url: `/servicos/getById/${servico_id}` + location.search,
         })
         .done(function (dados) {
             $('#valor').val(dados.valor)
             $('#desconto').val('0,00')
             $('#valor_servico').val(dados.valor)
             $('#hide_descricao').val(dados.descricao)
             $('#hide_servico_id').val(dados.id)
         });
 });

 $('#tipo_desconto').change(function () {
     let tipo_desconto = $('#tipo_desconto').val()
     $('#desconto').keydown(function () {
         let valor_servico = 0
         let percent = 0
         let valor = $('#valor').val().replace(',', '.')
         let desconto = $('#desconto').val().replace(',', '.')
         if (tipo_desconto == 'absoluto') {
             $('#tipo').html('R$ - BRL')
             valor_servico = (valor - desconto).toFixed(2).replace('.', ',');
         }
         if (tipo_desconto == 'percentual') {
             $('#tipo').html('%')
             percent = (desconto / 100)
             valor_servico = valor * (1 - (percent))
             valor_servico = valor_servico.toFixed(2).replace('.', ',')
         }
         $('#valor_servico').val(valor_servico)
     })
 })
 let c = 1
 let dados = ``
 let loop = 0;

 $('#form-servicos-pacotes').submit(function (e) {
     e.preventDefault()
     let descricao_servico = $('#hide_descricao').val()
     let servico_id = $('#hide_servico_id').val()
     let valor = $('#valor').val().replace(',', '.')
     let valor_servico = $('#valor_servico').val().replace(',', '.')
     let quantidade = $('#quantidade').val()
     let desconto = ($('#valor').val().replace(',', '.')) - ($('#valor_servico').val().replace(',', '.'))
     let total_servicos = $('#total-servicos').val().replace(',', '.')
     let total_descontos = $('#total-descontos').val().replace(',', '.')
     let total_pacote = $('#total-pacote').val().replace(',', '.')
     let valor_total = parseFloat(valor_servico * quantidade).toFixed(2)
     loop = `<input type="hidden" name = "loop" id="loop" value="${c}">`
     html = ``
     html += `<tr>
                <td class='text-center'>${quantidade}</td>
                <td>${descricao_servico}</td>
                <td class='text-right'>R$ ${valor.replace('.',',')}</td>
                <td class='text-right'>R$ ${desconto.toFixed(2).replace('.',',')}</td>
                <td class='text-right'>R$ ${valor_servico.replace('.',',')}</td>
                <td class='text-right'>R$ ${valor_total.replace('.',',')}</td>
                <td>
                <span class="h4 remove_item" onclick="RemoveTableRow(this,${quantidade},${valor}, ${desconto}, ${valor_total})""><i class="fa fa-trash-o"></i></span>
                </td>

                <input type="hidden" name = "servico_id${c}" id="servico_id${c}" value="${servico_id}">
                <input type="hidden" name = "quantidade${c}" id="quantidade${c}" value="${quantidade}">
                <input type="hidden" name = "valor_unitario${c}" id="valor_unitario${c}" value="${valor.replace('.',',')}">
                <input type="hidden" name = "desconto_real${c}" id="desconto_real${c}" value="${desconto.toFixed(2).replace('.',',')}">
                <input type="hidden" name = "valor_servico${c}" id="valor_servico${c}" value="${valor_servico.replace('.',',')}">
                </td>

               
            </tr>`
     total_servicos = (parseFloat(total_servicos ? total_servicos : 0) + parseFloat(quantidade * valor)).toFixed(2)
     total_descontos = (parseFloat(total_descontos ? total_descontos : 0) + parseFloat(quantidade * desconto)).toFixed(2)
     total_pacote = (parseFloat(total_pacote ? total_pacote : 0) + parseFloat(quantidade * valor_servico)).toFixed(2)

     $('#total-servicos').val(total_servicos)
     $('#total-descontos').val(total_descontos)
     $('#total-pacote').val(total_pacote)
     $('#count').html(loop)
     if (valor_total > 0.00) {
         $('#item').removeClass('invisible')
         $(this).addClass('visible')
         $('#lista-pacote tbody').append(html)
     } else {
         c = 1
     }
     $('#form-servicos-pacotes').each(function () {
         this.reset()
     })

     $('#fechar-modal').click(function () {
         $('#form-servicos-pacotes').each(function () {
             this.reset()
         })
     })

     $('.modal').modal('hide')
     c++


 })

 function RemoveTableRow(handler, q, v, d, vt) {
    let total_servicos= $('#total-servicos').val()
    let total_descontos = $('#total-descontos').val()
    let total_pacote = $('#total-pacote').val()
 
     total_servicos = total_servicos - (q * v)
     total_descontos = total_descontos - (q * d)
     total_pacote = total_pacote - vt
        console.log(q*vt)
     total_servicos = total_servicos.toFixed(2)
     total_descontos = total_descontos.toFixed(2)
     total_pacote = total_pacote.toFixed(2)

     $('#total-servicos').val(total_servicos)
     $('#total-descontos').val(total_descontos)
     $('#total-pacote').val(total_pacote)
     let tr = $(handler).closest('tr')
     tr.fadeOut(100, function () {
         tr.remove()
     })
 }
