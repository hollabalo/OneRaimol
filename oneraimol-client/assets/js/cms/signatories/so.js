function cancel_so() {
    redirect('cms/signatories/so');
}

function submit_so() {
    wait_msg(message.loading);
    
    
}

function search_so() {
    wait_msg(message.loading);
}


function approval_sc(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide(); 
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var so_id_encrypt = $('#so_id_encrypt').val();
    var role = $('#role_sc').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/so/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'so_id'  : so_id_encrypt,
                       'comment': comment},
        success     : function(json) {
            if( json.success == true ) {
                if(json.approve == true) {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
                }
                else {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
                }
                
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_gm(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var so_id_encrypt = $('#so_id_encrypt').val();
    var role = $('#role_gm').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/so/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'so_id'  : so_id_encrypt,
                       'comment': comment},
        success     : function(json) {
            if( json.success == true ) {
                if(json.approve == true) {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
                }
                else {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
                }
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_acc(action, type) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()

    $('.success').hide();
    $('.notice').hide();
    
    
    wait_msg( message.loading );
    
    var so_id_encrypt = $('#so_id_encrypt').val();
    var role = $('#role_acc').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/so/approve/' + role + '/' + type,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'so_id'  : so_id_encrypt,
                       'comment': comment},
        success     : function(json) {
            if( json.success == true ) {
                if(json.approve == true) {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
                }
                else {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
                }
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_ceo(action) {
    if(action == 'APPROVE') $('#ceoapprove-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var so_id_encrypt = $('#so_id_encrypt').val();
    var role = $('#role_ceo').val();
    var ceocomment = $('#ceocomment').val();

    var settings = {
        url         : base_url + 'cms/signatories/so/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'so_id'  : so_id_encrypt,
                       'comment': ceocomment},
        success     : function(json) {
            if( json.success == true ) {
                if(json.approve == true) {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
                }
                else {
                    redirect('cms/signatories/so/details/' + so_id_encrypt + '/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
                }
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approve_so() {
    $('.success').hide();
    $('.notice').hide();
    
    var so_ids = get_ids('id');

    if( so_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/so/approve',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : so_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/so/index/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function disapprove_so() {
    $('.success').hide();
    $('.notice').hide();
    
    var so_ids = get_ids('id');

    if( so_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/so/disapprove',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : so_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/so/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
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
    if(val == 1) approval_ceo(action)
    else if(val == 3) approval_sc(action)
    else if(val == 7) approval_gm(action)
    else if(val == 8) approval_acc(action)
    
}

function button_clicked(val, type) {
    var btn = document.getElementById('buttonclicked');
    var types = document.getElementById('type')
    btn.value = val
    types.value = type
}