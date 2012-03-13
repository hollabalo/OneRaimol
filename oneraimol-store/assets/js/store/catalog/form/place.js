$( document ).ready(
    function() {
        $( '#cartForm' ).validate(
            {
                rules : {
                    terms   : 'required',
                    delivery_date    : 'required'
                },
                messages : {
                    terms   : message.missing,
                    delivery_date : message.missing
                },
                submitHandler : function() {
                    place_order();
                },
                errorPlacement: function( error ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);