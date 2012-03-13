$( document ).ready(
    function() {
        $( '#order-receive' ).validate(
            {
                rules : {
                    confirmation_code   : 'required'
                },
                messages : {
                    confirmation_code   : message.missing
                },
                submitHandler : function() {
                    confirm_receive();
                },
                errorPlacement: function( error ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);
    