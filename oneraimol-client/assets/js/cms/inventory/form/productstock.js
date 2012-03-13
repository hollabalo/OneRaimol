$( document ).ready(
    function() {
        $( '#productstock-form' ).validate(
            {
                rules : {
                    liters          : 'required',
                    datestock       : 'required',
                    expiration_date : 'required'
                },
                messages : {
                    liters          : message.required,
                    datestock       : message.required,
                    expiration_date : message.required
                },
                submitHandler : function() {
                    submit_productstock();
                },
                errorPlacement: function( error, element ) {
                    element.closest('tr')
                           .find('span:last')
                           .append( error );
                }
            }
        );
    }
);