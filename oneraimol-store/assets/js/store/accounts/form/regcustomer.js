$( document ).ready(
    function() {
        $( '#customer-form' ).validate(
            {
                rules : {
                    username        : 'required',
                    password        : {
                            required : true,
                            minlength : 8,
                            alphanumeric : true
                    },
                    retype_password : {
                        required : true,
                        equalTo : "#password"
                    },
                    first_name      : 'required',
                    last_name       : 'required',
                    sex             : 'required',
                    address         : 'required',
                    delivery_address: 'required',
                    telephone_no    : {
                          required  : true,
                          number    : true
                    },
                    mobile          : {
                          number   : true
                    },
                    company         : 'required',
                    primary_email   : {
                        required : true,
                        email : true
                    },
                    secondary_email : {
                        email   : true
                    }
                },
                messages : {
                    username            : message.missing,
                    password            : {
                        required    : message.missing,
                        minlength   : message.passwordshort
                    },
                    retype_password     : {
                        required    : message.missing,
                        equalTo     : message.passwordnotmatch
                    },
                    first_name          : message.missing,
                    last_name           : message.missing,
                    sex                 : message.missing,
                    address             : message.missing,
                    delivery_address    : message.missing,
                    company             : message.missing,
                    telephone_no        : {
                        number  : message.numeric,
                        required: message.missing
                    },
                    mobile              : {
                        number  : message.numeric
                    },
                    primary_email       : {
                        required : message.missing,
                        email    : message.email
                    },
                    secondary_email   : {
                        email    : message.email
                    }
                },
                submitHandler : function() {
                    submit_customer();
                },
                errorPlacement: function( error, element ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);
    