$( document ).ready(
    function() {
        $( '#material-form' ).validate(
            {
                rules : {
                    description          : 'required',
                    material_category_id : 'required',
                    critical_level        : 'required'
                },
                messages : {
                    description             : message.required,
                    material_category_id    : message.required,
                    critical_level           : message.required
                },
                submitHandler : function() {
                    submit_material();
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
    
$( document ).ready(
    function() {
        $( '#materialstock-form' ).validate(
            {
                rules : {
                    materialname      : 'required',
                    price             : 'required',
                    liters            : 'required',
                    stock_taking_date : 'required',
                    expiration_date   : 'required'
                },
                messages : {
                    materialname      : message.required,
                    price             : message.required,
                    liters            : message.required,
                    stock_taking_date : message.required,
                    expiration_date   : message.required
                },
                submitHandler : function() {
                    submit_materialstock();
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