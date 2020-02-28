$.ajax({
    type: 'get',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: '/email/getByLicensed' + location.search,
    success: 
        function (response){
            if (!response.email.email){
                let mensagem = "Conta de e-mail não foi configurada, seus clientes não está recebendo notificações de agendamento e pedidos!"
                $('#notificacao-email').html(mensagem)
            }
            
        }
    
})