$('#form').submit(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: `/cadastro-local` + location.search,
        type: 'POST',
        data: $('#form').serialize(),
        success: function (response){
            $('#form-servicos-pacotes').each(function () {
                this.reset()
            })
            $('.modal').modal('hide')
            $('#div').html(response.comentario)
        },
       
        
    })

    
})