function cancel_customer() {
    redirect('');
}

function submit_customer() {
    wait_msg( message.loading );
    
    $( '#customer-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('register/verifymsg?token=' + json.token);
                }

            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}
