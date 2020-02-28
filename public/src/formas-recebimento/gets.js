/**
     * Ajax request for backend
     * @return Response::Json
     * 
     * get all register : methods in /forma_recebimento/getByStatus end point
     *  
     */
        $.ajax({
            type:'get',		
            contentType: "application/json; charset=utf-8",
            dataType: 'json',	
            url: '/recebimentos/getByStatus'+location.search,
            })
            .done(function( dados ) {
                let html =''
                dados.forEach(function(recebimento, key){
                    html+=`
                    <option value = "${recebimento.id}">${recebimento.forma}</option>
                    `
                });
            $('#forma_pagamento_id').html(html)
            console.log(html)
        })
    
