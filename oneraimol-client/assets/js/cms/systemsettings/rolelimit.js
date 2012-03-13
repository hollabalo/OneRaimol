function cancel_role() {
    redirect('cms/systemsettings/rolelimit');
}

function submit_role() {
    wait_msg( message.loading );
    
    $( '#role-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/systemsettings/rolelimit/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/systemsettings/rolelimit/index/MG4zUmExbTBMZWRpdA==');
                }

            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}

