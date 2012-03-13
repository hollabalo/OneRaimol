$( document ).ready(
    function() {
        $( '#suppliesstock-form' ).validate(
            {
                rules : {
                    liters             : 'required',
                    stock_taking_date  : 'required',
                    expiration_date    : 'required'

                },
                messages : {
                    liters              : message.required,
                    stock_taking_date   : message.required,
                    expiration_date     : message.required
                },
                submitHandler : function() {
                    submit_suppliesstock();
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