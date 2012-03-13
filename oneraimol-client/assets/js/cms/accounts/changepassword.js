function cancel_changepasswordcustomer() {
    var customer_id = $('#customer_id').val();  
    redirect('cms/accounts/customer/edit/' + customer_id );
}

function submit_changepasswordcustomer() {
    wait_msg( message.loading );
   var customer_id = $('#customer_id').val();   
   
    $( '#formcustomer-change-password' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
            if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/accounts/customer/edit/' + customer_id + '/MG4zUmExbTBMYWRk');
                }
            
            else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/accounts/customer/edit/' + customer_id + '/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}


function cancel_changepasswordstaff() {
    var staff_id = $('#staff_id').val();  
    redirect('cms/accounts/staff/edit/' + staff_id );
}

function submit_changepasswordstaff() {
    wait_msg( message.loading );
   var staff_id = $('#staff_id').val();   
   
    $( '#formstaff-change-password' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
            if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/accounts/staff/edit/' + staff_id + '/MG4zUmExbTBMYWRk');
                }
            
            else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/accounts/staff/edit/' + staff_id + '/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}