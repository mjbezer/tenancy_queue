       
$( "#form-pessoas" ).validate( {
    rules: {
        nome_razao_social: {
            required: true,
            minlength: 3
        },
        nome_usual_fantasia : {
            required: true,
            minlength: 3
        },
        cpf_cnpj: "required",
        data_nascimento_abertura: "required",
        email: {
            required: true,
            email: true
        },
    },
    messages: {
        nome_razao_social: {
            required: "Nome / Razão Social é requerido!",
            minlength: "Este campo deve conter ao menos 3 caractéres"
        },
        nome_usual_fantasia: {
            required: "Nome Usual / Fantasia é requerido!",
            minlength: "Este campo deve conter ao menos 3 caractéres"
        },
        cpf_cnpj: "CPF ou CNPJ é requerido!",
        data_nascimento_abertura: "Nascimento/Abertura é requerido!",
        email: "Informe um endereço de e-mail válido",
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
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
    }
} );