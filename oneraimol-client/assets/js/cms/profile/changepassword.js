
function cancel_changepasswordstaff() {
    redirect('cms/profile/index' );
}

function submit_changepasswordstaff() {
    wait_msg( message.loading );
   
    $( '#formstaff-change-password' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
            if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/profile/MG4zUmExbTBMYWRk');
                }
            
            else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/profile');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}