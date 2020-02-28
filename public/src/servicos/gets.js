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
                confirmButtonText: 'cadastrar uma CATEGORIA agora.',
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
