$( "#form-pacote" ).validate( {
    rules: {
        descricao: {
            required: true,
            minlength: 5
        },
    },
  
} );