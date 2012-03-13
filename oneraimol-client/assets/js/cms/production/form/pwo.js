$( document ).ready(
    function() {
        $( '#pwo-form' ).validate(
            {
                submitHandler : function() {
                    submit_pwo();
                },
                errorPlacement: function( error, element ) {
                    element.closest('td')
                           .find('span:last')
                           .append( error );
                }
            }
        );
    }
);
   