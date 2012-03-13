function create_dr() {
    $('.success').hide();
    $('.notice').hide();
    
    var user_ids = get_ids('id');

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/sales/dr/create',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'enable' ang equivalent nung mahabang string na encrypted
                redirect('cms/sales/dr/index/MG4zUmExbTBMZW5hYmxl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function readyfordelivery() {
    $('.success').hide();
    $('.notice').hide();
    
    var user_ids = get_ids('id');

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/sales/dr/readyfordelivery',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'enable' ang equivalent nung mahabang string na encrypted
                redirect('cms/sales/dr/index/MG4zUmExbTBMZW5hYmxl');
            }
            else if(json.success == false) {
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