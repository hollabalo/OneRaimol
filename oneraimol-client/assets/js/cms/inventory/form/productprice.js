$( document ).ready(
    function() {
        $( '#productprice-form' ).validate(
            {
                rules : {
                    price              : 'required',
                    packaging_size     : 'required',
                    sku                : 'required',
                    unit               : 'required'
                },
                messages : {
                    price            : message.required,
                    packaging_size   : message.required,
                    sku              : message.required,
                    unit             : message.required
                },
                submitHandler : function() {
                    submit_productprice();
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