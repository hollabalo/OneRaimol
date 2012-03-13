$( document ).ready(
    function() {
        $( '#stock-form' ).validate(
            {
                rules : {
                    material_supply_id  : 'required',
                    liters              : 'required',
                    stock_taking_date   : 'required',
                    expiration_date     : 'required'
                },
                messages : {
                    material_supply_id  : message.required,
                    liters              : message.required,
                    stock_taking_date   : message.required,
                    expiration_date     : message.required

                },
                submitHandler : function() {
                    submit_stock();
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