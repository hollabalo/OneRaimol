function cancel_pbt() {
    redirect('cms/production/pbt');
}

function submit_pbt() {
    wait_msg( message.loading );
    
    $( '#pbt-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/production/pbt/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/production/pbt/index/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}


function delete_pbt() {
    $('#delete-modal').modal('hide')
    $('.success').hide();
    $('.notice').hide();
    
    var pbt_ids = get_ids('id');

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/production/pbt/delete',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pbt_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'delete' ang equivalent nung mahabang string na encrypted
                redirect('cms/production/pbt/index/MG4zUmExbTBMZGVsZXRl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function update_pbt() {
    $('.success').hide();
    $('.notice').hide();
    
    var pbt_ids = get_ids('id');

    if( pbt_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/production/pbt/update/' + pbt_ids,
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pbt_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'enable' ang equivalent nung mahabang string na encrypted
                redirect('cms/production/pbt/index/MG4zUmExbTBMZW5hYmxl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function release_pbt() {
    $('.success').hide();
    $('.notice').hide();
    
    var user_ids = get_ids('id');

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/production/pbt/releasepbt',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'enable' ang equivalent nung mahabang string na encrypted
                redirect('cms/production/pbt/index/MG4zUmExbTBMZW5hYmxl');
            }
            else if( json.success == false ) {
                $('#msg').html(error_msg(json.failmessage))
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}