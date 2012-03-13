$( document ).ready(
        function() {
            $( '#formItemDetails' ).validate(
                {
                    rules : {
                        product         : 'required',
                        qty             : {
                            required         : true,
                            number           : true,
                            minlength        : 1
                        }
                    },
                    messages : {
                        product        : message.missing,
                        qty            : {
                            required : message.noqty,
                            minlength: message.password_minlength,
                            number : message.alphanumeric_only
                        }
                    },
                    submitHandler : function() {
                        submit_changepasswordcustomer();
                    },
                    errorPlacement: function( error ) {
                        $('#msg').html(error);
                    }
                }
            );
        }
    );