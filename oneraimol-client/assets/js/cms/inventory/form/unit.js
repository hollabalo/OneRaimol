$( document ).ready(
    function() {
        $( '#unit-form' ).validate(
            {
                rules : {
                    description            : 'required',
                    size_liters            : 'required'
   
                },
                messages : {
                    description          : message.required,
                    size_liters          : message.required

                },
                submitHandler : function() {
                    submit_unit();
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