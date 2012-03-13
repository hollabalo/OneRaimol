function cancel_stock() {
    redirect('cms/inventory/stock');
}

function submit_stock() {
    wait_msg( message.loading );
    
    $( '#stock-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/inventory/stock/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/inventory/stock/index/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    ); 
}


function delete_stock() {
    $('#delete-modal').modal('hide')
    $('.success').hide();
    $('.notice').hide();
    
    var user_ids = get_ids('id');

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/inventory/stock/delete',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'delete' ang equivalent nung mahabang string na encrypted
                redirect('cms/inventory/stock/index/MG4zUmExbTBMZGVsZXRl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}