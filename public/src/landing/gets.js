
/**
 * Method GET
 * API Painel WEB - https://softwork.painelweb.com.br/api/contratos/validacao/
 * 
 * Validação de contrato e criação do DB 
 */



let contrato_id = $('input[name="contrato_id"]').val()
let user_id = $('input[name="user_id"]').val()

$.ajax({
    type: 'get',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: `https://softworksistemas.com.br/api/contratos/validacao/${contrato_id}`,
})


$.ajax({
    type: 'GET',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: `https://softworksistemas.com.br/api/user/getById/${user_id}`,
    success: function (response) {
        $('input[name="name"]').val(response.name)
        $('input[name="email"]').val(response.email)
        $('input[name="password"]').val(response.password)
        $.ajax({
            url: `/parametros/validacao/${contrato_id}`,
            type: 'GET',
            success: function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `/cadastro-local/${contrato_id}`,
                    type: 'POST',
                    data: $('form').serialize(),
                    success: function (response) {
                        $( "#progress-ico" ).removeClass("fa-cog fa-spin");
                        $( "#progress-ico" ).addClass("fa-check-square-o");
                        $('#progress-msg').html('Concluido...')


                        swal({
                            title: 'Parabéns!',
                            showCancelButton: true,
                            confirmButtonText: 'Sim, efetuar login!',
                            cancelButtonText: 'Agora não!',
                            text: 'Seu ambiente de trabalho foi criado com sucesso. Deseja fazer login?',
                            type: 'success',
                            confirmButtonColor: '#adbe5e',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                location.href = '/login';
                            }
                            })

                    }
                })
            },
            error: function (response) {}
        })

    },
    error: function (response) {}
})
