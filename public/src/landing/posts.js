   /**
     * 
     * 
     */

    $("#cadastro").submit(function (e) {
        e.preventDefault()
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            url: `https://softworksistemas.com.br/api/pessoas/store`,
            type: 'POST',
            data: $('form').serialize(),
            success: function (dados) {
                console.log(dados)
                window.location.href=`/contrato/${dados.id}/${dados.nome}`
            },
            error: function (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Erro ao tentar efetuar o cadastro. Tente mais tarde!',
                    confirmButtonColor: '#cc0000',
                })
            }

        })
    })

/**
 * 
 * 
*/
$('form[name="pessoa"]').submit(function(e){
    e.preventDefault() 
   let pessoa_id = $('input[name="id"]').val()
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    })
    $.ajax({
        url: `https://softworksistemas.com.br/api/pessoas/update/${pessoa_id}`+'?_method=PUT',
        type: 'post',
        data: $('form[name="pessoa"]').serialize(),
        success: function (dados){
            Swal.fire({
                icon: 'success',
                title: 'OK!',
                text: 'Dados Cadastrais Atualizados com sucesso!',
                confirmButtonColor: '#b4c253',
            })
            $('#alert').html(" ")
        },
        error: function (e) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Erro ao tentar atualizar seus dados. Tente mais tarde!',
                confirmButtonColor: '#cc0000',
            })
        }

    })
})

/**
 * 
 * 
 */
    $('form[name="pagamento"]').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault()
        $.ajax({
            url: `https://softworksistemas.com.br/api/cartao-credito/store`,
            type: 'POST',
            data: $('form').serialize(),
            success: function (dados){
            if(dados =='rejected'){
                Swal.fire({
                    icon: 'error',
                    title: 'Negado!',
                    html: '<p>Não conseguimos processar o pagamento!</p><p>Verifique os dados informados ou entre em contato com a operadora de seu cartão </p>',
                    confirmButtonColor: '#cc0000',
                })
            }else{
                window.location.href=`/contrato/${dados.pessoa_id}/${dados.status}`
            }

            },
            error: function (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Erro ao validar seu cartão. Tente mais tarde!',
                    confirmButtonColor: '#cc0000',
                })
            }

        })
    })

 