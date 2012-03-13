$( document ).ready(
    function() {
        $( '#customer-form' ).validate(
            {
                rules : {
                    first_name      : 'required',
                    last_name       : 'required',
                    sex             : 'required',
                    address         : 'required',
                    delivery_address: 'required',
                    telephone       : 'required',
                    company         : 'required',
                    bank_name       : 'required',
                    bank_account_no : 'required',
                    credit_limit    : 'required',
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
                    delivery_address    : message.required,
                    company             : message.required,
                    telephone           : message.required,
                    bank_name           : message.required,
                    bank_account_no     : message.required,
                    credit_limit         : message.required,
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
                    submit_customer();
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
    