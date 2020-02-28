    
$( "#form-agenda" ).validate( {
    rules: {
       
        pessoa_id : "required",
        servico_id: "required",
        inicio: "required",
        forma_recebimento_id: "require"
    },
     errorPlacement: function ( error, element ) {
        if (element.parent(".select2_demo_3")) {
            error.insertAfter(element.next('.select2'))
          } else {
            error.insertAfter(element)
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