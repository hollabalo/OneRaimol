$( document ).ready(
    function() {
        $( '#supplier-form' ).validate(
            {
                rules : {
                    company_name    : 'required',
                    first_name      : 'required',
                    last_name       : 'required',
                    address         : 'required',
                    city            : 'required',
                    province        : 'required',
                    country         : 'required',
                    email   : {
                        required : true,
                        email : true
                    }
                },
                messages : {
                    company_name  : message.required,
                    first_name    : message.required,
                    last_name     : message.required,
                    address       : message.required,
                    city          : message.required,
                    province      : message.required,
                    country       : message.required,
                    email       : {
                        required : message.required,
                        email    : message.email
                    }
                },
                submitHandler : function() {
                    submit_supplier();
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