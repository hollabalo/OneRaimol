function cancel_pwo() {
    redirect('cms/signatories/pwo');
}

function submit_pwo() {
    wait_msg(message.loading);
    
    
}

function search_pwo() {
    wait_msg(message.loading);
}


function approval_hc(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide(); 
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pwo_id_encrypt = $('#pwo_id_encrypt').val();
    var role = $('#role_hc').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/pwo/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pwo_id'  : pwo_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pwo/details/' + pwo_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_sc(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pwo_id_encrypt = $('#pwo_id_encrypt').val();
    var role = $('#role_sc').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/pwo/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pwo_id'  : pwo_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pwo/details/' + pwo_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_acc(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pwo_id_encrypt = $('#pwo_id_encrypt').val();
    var role = $('#role_acc').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/pwo/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pwo_id'  : pwo_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pwo/details/' + pwo_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approve_pwo() {
    
    $('.success').hide();
    $('.notice').hide();
    
    var pwo_ids = get_ids('id');

    if( pwo_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/pwo/approve',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pwo_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pwo/index/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function disapprove_pwo() {
    $('.success').hide();
    $('.notice').hide();
    
    var pwo_ids = get_ids('id');

    if( pwo_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/pwo/disapprove',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pwo_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pwo/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function determine_signatory(val,action) {
    if(val == 2) approval_vp(action)
    else if(val == 3) approval_sc(action)
    else if(val == 4) approval_hc(action)
    else if(val == 8) approval_acc(action)
}

function button_clicked(val, type) {
    var btn = document.getElementById('buttonclicked');
    btn.value = val
}