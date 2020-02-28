/**
 * Method GET
 * API Painel WEB - https://softwork.painelweb.com.br/api/pessoas/getById
 * 
 * Efetua Login 
 */

$('form').submit(function (e)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault()
    $.ajax({
        url: `https://softworksistemas.com.br/api/authenticate`,
        type: 'POST',
        data: $('form').serialize(),
        success: function (response)
        {
            if (response.message)
            {
                notify("top",
                    "right",
                    "danger",   
                    "Erro",
                    response.message
                );
            } else
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `/loginApi` + location.search,
                    type: 'POST',
                    data: { 
                            $('meta[name="csrf-token"]').attr('content'), "id":id,
                            $('form').serialize()
                           },
                    success: function (response)
                    {
                        if (response.redirect)
                        {
                            window.location.href = response.redirect
                        } else
                            {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops!',
                                text: "Não conseguimos acessar sua agenda, tente mais tarde!",
                                confirmButtonColor: '#cc0000',
                            })
                        }
                    }
                })
            }

        },
        error: function (e)
        {
            Swal.fire({
                type: 'error',
                title: 'Oops!',
                text: "Não conseguimos acessar seus dados em nossos servicos, tente mais tarde!",
                confirmButtonColor: '#cc0000',
            })
        }

    })
})


function notify (from, align, type, title, message)
{
    $.growl({
        title: title,
        message: message,
        url: ''
    }, {
        element: 'body',
        type: type,
        allow_dismiss: true,
        placement: {
            from: from,
            align: align
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 999999,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,
    });
};



