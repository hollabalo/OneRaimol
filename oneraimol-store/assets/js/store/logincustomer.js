function submit_logincustomer(){
    wait_msg( message.loading );
    
    $( '#customer-login-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                // Redirect back to the source URL
                if(json.redirect == true) {
                    redirect(json.url);
                }
                else redirect('store');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage ); 
            }
        }
    );
}

function submit_forgotpass() {
    wait_msg( message.loading );
    
    $( '#customer-forgotpw-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                $('#msg').html(success_msg(json.successmessage));
                $('#email').val('');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage ); 
            }
        }
    );
    
}

function submit_resetpassword() {
    wait_msg( message.loading );
    
    $( '#customer-forgotpw-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                redirect('catalog');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage ); 
            }
        }
    );
    
}