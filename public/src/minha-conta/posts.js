$('form[name="addUser"]').submit(function (e) {
    e.preventDefault()
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `https://softworksistemas.com.br/api/user/store`,
        type: 'POST',
        data: $('form[name="addUser"]').serialize(),
        success: function (response){
        if(response =='recusado'){
            Swal.fire({
                type: 'error',
                title: 'Negado!',
                html: '<p>Não conseguimos cadastrar o usuário!</p><p>Sua conta excedeu o numero de usuários cadatrados!</p>',
                confirmButtonColor: '#cc0000',
            })
        }else{
            $.ajax({
                url: `/cadastro-local/${contrato_id}`,
                type: 'POST',
                data: $('form[name="addUser"]').serialize(),
                success: function (response) {
                    Swal.fire({
                        type: 'success',
                        title: 'OK!',
                        html: '<p>Usuário cadastrado com sucesso!</p>',
                        confirmButtonColor: '#b3c249',
                    })
                }
            })
          
            
        }

        },
        error: function (e) {
            Swal.fire({
                type: 'error',
                title: 'Oops!',
                text: 'Não foi possivel acessão a base de dados. Tente mais tarde!',
                confirmButtonColor: '#cc0000',
            })
        }

    })
})
