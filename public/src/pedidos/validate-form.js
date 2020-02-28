let totalPedido = $('#total-pedido').val()
if( totalPedido > 0){
    $('#validate').removeClass('visible')
    $(this).addClass('invisible')
}

$( "#form-pedidos" ).validate( {
    focusInvalid: false,
    rules: {
        
        forma_recebimento_id: "required",
        data_vencimento:"required",
    },
    message : {
        forma_recebimento_id:"Seleção Obrigatória",
        data_vencimento:"Preeencimento Obrigatório",

    },
  
    errorElement: "em",
    errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass( "help-block" );

        if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
        } else {
            error.insertAfter( element );
        }

        if($('#total-pedido').val() == 0){
            $('#validate').removeClass('invisible')
            $(this).addClass('visible text-danger')
            $('#add-servico').focus()
    }

       
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
    }
} );