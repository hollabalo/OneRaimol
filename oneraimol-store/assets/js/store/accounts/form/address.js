$( document ).ready(
    function() {
        $( '#address-form' ).validate(
            {
                rules : {
                    province          : 'required',
                    country : 'required'
                },
                messages : {
                    province             : message.missing,
                    country    :            message.missing
                },
                submitHandler : function() {
                    submit_address();
                },
                errorPlacement: function( error, element ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);