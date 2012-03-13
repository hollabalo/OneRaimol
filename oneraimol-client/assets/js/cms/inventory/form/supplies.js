$( document ).ready(
    function() {
        $( '#supplies-form' ).validate(
            {
                rules : {
                    material_id     : 'required',
                    supplier_id     : 'required',
                    price           : 'required'

                },
                messages : {
                    material_id       : message.required,
                    supplier_id       : message.required,
                    price             : message.required
                },
                submitHandler : function() {
                    submit_supplies();
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