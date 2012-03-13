$( document ).ready(
    function() {
        $( '#po-form' ).validate(
            {
                rules : {
                    company         : 'required',
                    terms           : 'required',
                    delivery_date   : 'required',
                    delivery_address: 'required',
                    order_date      : 'required'

                },
                messages : {
                    company          : message.required,
                    terms            : message.required,
                    delivery_date    : message.required,
                    delivery_address : message.required,
                    order_date       : message.required

                },
                submitHandler : function() {
                    submit_purchaseorder();
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
   