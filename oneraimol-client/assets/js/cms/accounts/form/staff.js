
$( document ).ready(
    function() {
        $( '#staff-form' ).validate(
            {
                rules : {
                    first_name      : 'required',
                    last_name       : 'required',
                    sex             : 'required',
                    address         : 'required',
                    province        : 'required',
                    city            : 'required',
                    country         : 'required',
                    telephone_no       : 'required',
                    birth_date      : 'required',
                    role            : 'required',
                    username        : 'required',
                    password        : {
                        required : true,
                        minlength : 8,
                        alphanumeric : true
                    },
                    retype_password : {
                        required : true,
                        minlength : 8,
                        equalTo : '#password'
                    },
                    primary_email   : {
                        required : true,
                        email : true
                    }
                },
                messages : {
                    first_name          : message.required,
                    last_name           : message.required,
                    sex                 : message.required,
                    address             : message.required,
                    province            : message.required,
                    city                : message.required,
                    country             : message.required,
                    telephone_no           : message.required,
                    birth_date          : message.required,
                    role                : message.required,
                    username            : message.required,
                    password            : {
                        required : message.required,
                        minlength: message.passwordshort
                    },
                    retype_password     : {
                        required : message.required,
                        minlength: message.passwordshort,
                        equalTo: message.passwordnotmatch
                    },
                    primary_email       : {
                        required : message.required,
                        email    : message.email
                    }
                },
                submitHandler : function() {
                    submit_staff();
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
    