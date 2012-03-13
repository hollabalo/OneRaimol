function cancel_changepasswordcustomer() {
    redirect('account');
}

function submit_changepasswordcustomer() {
    wait_msg( message.loading ); 
   
    $( '#formcustomer-change-password' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                redirect('account/info/changepassword?success=true');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}
