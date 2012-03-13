function cancel_dr() {
    redirect('cms/signatories/dr');
}

function submit_dr() {
    wait_msg(message.loading);
    
    
}

function search_dr() {
    wait_msg(message.loading);
}


function approval_pm(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide(); 
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var dr_id_encrypt = $('#dr_id_encrypt').val();
    var role = $('#role_pm').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/dr/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'dr_id'  : dr_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/details/' + dr_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
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
    
    var dr_id_encrypt = $('#dr_id_encrypt').val();
    var role = $('#role_sc').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/dr/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'dr_id'  : dr_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/details/' + dr_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
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
    
    var dr_id_encrypt = $('#dr_id_encrypt').val();
    var role = $('#role_gm').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/dr/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'dr_id'  : dr_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/details/' + dr_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_ic(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var dr_id_encrypt = $('#dr_id_encrypt').val();
    var role = $('#role_ic').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/dr/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'dr_id'  : dr_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/details/' + dr_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approval_labanalyst(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide();
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var dr_id_encrypt = $('#dr_id_encrypt').val();
    var role = $('#role_labanalyst').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/dr/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'dr_id'  : dr_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/details/' + dr_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function approve_dr() {
    $('.success').hide();
    $('.notice').hide();
    
    var dr_ids = get_ids('id');

    if( dr_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/dr/approve',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : dr_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/index/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function disapprove_dr() {
    $('.success').hide();
    $('.notice').hide();
    
    var dr_ids = get_ids('id');

    if( dr_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/dr/disapprove',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : dr_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/dr/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
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
    if(val == 13) approval_ic(action)
    else if(val == 3) approval_sc(action)   
    else if(val == 5) approval_labanalyst(action)
    else if(val == 9) approval_pm(action)
    else if(val == 7) approval_gm(action)
}

function button_clicked(val, type) {
    var btn = document.getElementById('buttonclicked');
    btn.value = val
}