function cancel_formula() {
    redirect('cms/signatories/formula');
}

function submit_formula() {
    wait_msg(message.loading);
    
    
}

function search_formula() {
    wait_msg(message.loading);
}


function approval_ceo(action) {
    if(action == 'APPROVE') $('#approve-modal').hide()
    else if(action == 'DISAPPROVE') $('#disapprove-modal').hide()
    
    $('.success').hide(); 
    $('.notice').hide();
    
    wait_msg( message.loading );
    
    var formula_id_encrypt = $('#formula_id_encrypt').val();
    var role = $('#role_ceo').val();
    var comment = $('#comment').val();

    var settings = {
        url         : base_url + 'cms/signatories/formula/approve/' + role,
        type        : 'POST',
        dataType    : 'json',
        data        : {'action' : action,
                       'formula_id'  : formula_id_encrypt,
                       'comment' : comment},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/formula/details/' + formula_id_encrypt + '/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}


function approve_formula() {
    $('.success').hide();
    $('.notice').hide();
    
    var formula_ids = get_ids('id');

    if( formula_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/formula/approve',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : formula_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/formula/index/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function disapprove_formula() {
    $('.success').hide();
    $('.notice').hide();
    
    var formula_ids = get_ids('id');

    if( formula_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/signatories/formula/disapprove',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : formula_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/signatories/formula/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
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
}

function button_clicked(val, type) {
    var btn = document.getElementById('buttonclicked');
    btn.value = val
}