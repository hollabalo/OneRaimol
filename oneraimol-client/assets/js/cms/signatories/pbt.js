function cancel_pbt() {
    redirect('cms/signatories/pbt');
}

function submit_pbt() {
    wait_msg(message.loading);
    
    
}

function search_pbt() {
    wait_msg(message.loading);
}


function approval_labanalyst(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide(); 
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pbt_id_encrypt = $('#pbt_id_encrypt').val();
    var role = $('#role_labanalyst').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/pbt/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pbt_id'  : pbt_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pbt/details/' + pbt_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_qa(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pbt_id_encrypt = $('#pbt_id_encrypt').val();
    var role = $('#role_qa').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/pbt/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pbt_id'  : pbt_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pbt/details/' + pbt_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_hc(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pbt_id_encrypt = $('#pbt_id_encrypt').val();
    var role = $('#role_hc').val();
    var comment = $('#comment').val();
    
    var settings = {
        url         : base_url + 'cms/signatories/pbt/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pbt_id'  : pbt_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pbt/details/' + pbt_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_qah(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var pbt_id_encrypt = $('#pbt_id_encrypt').val();
    var role = $('#role_qah').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/pbt/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'pbt_id'  : pbt_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pbt/details/' + pbt_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approve_pbt() {
    $('.success').hide();
    $('.notice').hide();
    
    var pbt_ids = get_ids('id');

    if( pbt_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/pbt/approve',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pbt_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pbt/index/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function disapprove_pbt() {
    $('.success').hide();
    $('.notice').hide();
    
    var pbt_ids = get_ids('id');

    if( pbt_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/pbt/disapprove',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pbt_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/pbt/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function determine_signatory(val,action,types) {
    if(val == 4) approval_hc(action)
    else if(val == 10) approval_qah(action)
    else if(val == 11) approval_qa(action)
    else if(val == 5) approval_labanalyst(action)
}

function button_clicked(val, type) {
    var btn = document.getElementById('buttonclicked');
    btn.value = val
}