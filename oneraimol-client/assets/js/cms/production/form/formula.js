$( document ).ready(
    function() {
        $( '#formula-form' ).validate(
            {
                submitHandler : function() {
                    submit_formula();
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
   