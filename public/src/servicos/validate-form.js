    
$( "#form-servicos" ).validate( {
    highlight: function(element) {
        $(element).parent().parent().addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parent().parent().removeClass('has-error');
    },
    focusCleanup: true,
    errorLabelContainer: "input .labell",
    errorElement: "div",
    rules: {
        descricao: {
            required: true,
            minlength: 5
        },
        duracao : "required",
        valor: "required",
        categoria_id: "required",
        sub_categoria_id: "required"
    },
   
    errorElement: "em",
    errorPlacement: function ( error, element ) {

        error.addClass( "help-block" );

        if(element.parent().hasClass('input-group')){
            error.insertAfter( element.parent() );
          }else{
                error.insertAfter( element );
          }
    },

   
} );