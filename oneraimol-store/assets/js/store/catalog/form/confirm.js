$( document ).ready(
    function() {
        $( '#confirm' ).validate(
            {
                rules : {
                    terms   : 'required',
                    date    : 'required'
                },
                messages : {
                    terms   : message.required_field
                },
                submitHandler : function() {
                    submit_po();
                },
                errorPlacement: function( error ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);