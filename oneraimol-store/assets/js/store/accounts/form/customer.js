$( document ).ready(
    function() {
        $( '#customer-form' ).validate(
            {
                rules : {
                    username        : 'required',
                    first_name      : 'required',
                    last_name       : 'required',
                    sex             : 'required',
                    address         : 'required',
                    telephone_no       : {
                          required  : true,
                          number    : true
                    },
                    mobile          : {
                          number    : true  
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
                    first_name          : message.missing,
                    last_name           : message.missing,
                    sex                 : message.missing,
                    address             : message.missing,
                    company             : message.missing,
                    telephone_no           : {
                        required : message.missing,
                        number   : message.numeric
                    },
                    mobile      : {
                       number   : message.numeric  
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
    