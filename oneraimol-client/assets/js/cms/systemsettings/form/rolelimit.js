$( document ).ready(
    function() {
        $( '#role-form' ).validate(
            {
                rules : {
                    name      : 'required',
                    limit       : 'required'
                },
                messages : {
                    name          : message.required,
                    limit           : message.required
                },
                submitHandler : function() {
                    submit_role();
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
    