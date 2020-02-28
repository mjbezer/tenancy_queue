    
$( "#form-conta-pagar" ).validate( {
    rules: {
       
        pessoa_id : "required",
        data_vencimento: "required",
        valor_original: "required",
        documento_fiscal:"required",
        data_documento_fiscal:"required",
        categoria_id:"required",
        sub_categoria_id:"required"
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );
    
            if(element.parent().hasClass('input-group')){
                error.insertAfter( element.parent() );
              }else{
                    error.insertAfter( element );
              }
        },
   
} );

$( "#formAgendamento" ).validate( {
  rules: {
     
      pessoa_id : "required",
      servico_id: "required",
  },
   errorPlacement: function ( error, element ) {
      
          error.insertAfter(element)
        
       
  },
 
} );