function update_qty(record, qtyfield) {
    var qty = $('#qty' + qtyfield).val();
    
    redirect('catalog/list/process_edititemqty/' + record + '/' + qty);
    
}

function delete_item(d) {
    redirect('catalog/list/process_deleteitem/' + d);
}

function get_ids( class_name ) {
    var ids = [];
    var counter = 0;

    $( '.' + class_name ).each(
        function() {
            if($(this).val() != '') {
                
                ids[ counter ] = $( this ).val();
                counter++;
                
            }
            else {
                ids = false;
                return false;
            }
        }
    );

    return ids;
}

function editqty() {
    
    var qtyseed = get_ids('qtyHidden');
    var qtys = get_ids('qtyInput');
    
    if(qtys == false) {
        $('#msg').html(error_msg(message.noselection));
        return false;
    }

    var settings = {
        url         : base_url + 'catalog/list/process_editqty',
        type        : 'POST',
        dataType    : 'json',
        data        : {
            'id' : qtys,
            'seed' : qtyseed
        },
        success     : function(json) {
            if( json.success == true ) {
                //'disable' ang equivalent nung mahabang string na encrypted
                redirect('cms/accounts/customer/index/MG4zUmExbTBMZGlzYWJsZQ==');
            }
            else if( json.success == false ) {
                
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}