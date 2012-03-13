$( document ).ready(
    function() {
        $( '#suppliersupplies-form' ).validate(
            {
                rules : {
                    material_id       : 'required',
                    price             : 'required'

                },
                messages : {
                    material_id : message.required,
                    price       : message.required
                },
                submitHandler : function() {
                    submit_suppliersupplies();
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