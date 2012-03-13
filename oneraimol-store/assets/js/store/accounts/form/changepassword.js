$( document ).ready(
        function() {
            $( '#formcustomer-change-password' ).validate(
                {
                    rules : {
                        old_password : 'required',
                        password : {
                            required : true,
                            minlength : 8,
                            alphanumeric : true
                        },
                        retype_password : {
                            required : true,
                            equalTo  : '#password'
                        }
                    },
                    messages : {
                        old_password    : message.missing,
                    password            : {
                        required : message.missing,
                        minlength: message.password_minlength,
                        alphanumeric : message.alphanumeric_only
                    },
                    retype_password     : {
                        required : message.missing,
                        minlength: message.password_minlength,
                        equalTo: message.retype_password
                    }
                    },
                    submitHandler : function() {
                        submit_changepasswordcustomer();
                    },
                    errorPlacement: function( error, element ) {
                        $('#msg').html(error);
                    }
                }
            );
        }
    );
        
        
$( document ).ready(
        function() {
            $( '#formstaff-change-password' ).validate(
                {
                    rules : {
                        old_password : 'required',
                        password : {
                            required : true,
                            minlength : 8,
                            alphanumeric : true
                        },
                        retype_password : {
                            required : true,
                            equalTo : "#password"
                        }
                    },
                    messages : {
                        old_password    : message.required_field,
                    password            : {
                        required : message.required_field,
                        minlength: message.password_minlength,
                        alphanumeric : message.alphanumeric_only
                    },
                    retype_password     : {
                        required : message.required_field,
                        minlength: message.password_minlength,
                        equalTo: message.retype_password
                    }
                    },
                    submitHandler : function() {
                        submit_changepasswordstaff();
                    },
                    errorPlacement: function( error, element ) {
                        element.closest('tr')
                               .find('td:last')
                               .append( error );
                    }
                }
            );
        }
    );