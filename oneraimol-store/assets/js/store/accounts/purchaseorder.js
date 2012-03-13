function confirm_receive() {
    wait_msg( message.loading );
    
    $( '#order-receive' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                redirect('account/history/vieworder/' + json.url + '?success=true')

            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}
