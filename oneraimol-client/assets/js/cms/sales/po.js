function cancel_purchaseorder() {
    redirect('cms/sales/po');
}


function submit_purchaseorder() {
    wait_msg( message.loading );
    
    $( '#po-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/sales/po/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/sales/po/index/MG4zUmExbTBMZWRpdA==');
                }
                else if(json.action == 'approve') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/sales/po/index/MG4zUmExbTBMYXBwcm92ZQ==');
                }
                else if(json.action == 'disapprove') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/sales/po/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}

function approve_po() {
    $('.success').hide();
    $('.notice').hide();
    
    var po_ids = get_ids('id');

    if( po_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/sales/po/approve',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : po_ids},
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/sales/po/index/MG4zUmExbTBMYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function delivery_date() {
    wait_msg( message.loading );

    var po_id = $('#id').val();
    
    var date = $('#delivery_date').val();

    var settings = {
        url         : base_url + 'cms/sales/po/process_form/' + po_id,
        type        : 'POST',
        dataType    : 'json',
        data        : {
            'delivery_date' : date,
            'formstatus' : 'edit'
        },
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/sales/po/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function disapprove_po() {
    wait_msg( message.loading );

    var po_id = $('#id').val();

    var settings = {
        url         : base_url + 'cms/sales/po/disapprove',
        type        : 'POST',
        dataType    : 'json',
        data        : {
            'id' : po_id
        },
        success     : function(json) {
            if( json.success == true ) {
                redirect('cms/sales/po/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function add_row (id) {
    
    $.post(
        base_url + 'cms/sales/po/populate_um', {}, 
        function(data){
            $('#' + id + '> tbody').append(data); 
        }
    );
}

function delete_row(id){
    $('#' + id + '> tbody').attr('tr').remove();
}

function bullshrek() {
    $("#del").live('click', function(event) {
            $(this).parent().parent().remove();
    });

}

function display_customer(radio){
    var txtcustomer = document.getElementById('customer');
    var hiddenfield = document.getElementById('custid' + radio);
    var hiddenfield_val = document.getElementById('custid_val');
    var da = document.getElementById('da-text');
//    var rbcustomer = document.getElementById('rad' + radio);
    var namecustomer = document.getElementById('name' + radio);
//    var companycustomer = document.getElementById('company' + radio);
    
    txtcustomer.value = namecustomer.textContent;
    hiddenfield_val.value = hiddenfield.value
    
    
        
        $.post(
        base_url + 'cms/sales/po/populate_deliveryaddress/' + radio, {}, 
        function(data){
            $('#cust-da').html(data); 
        }
    );
}

function filter_record() {
    redirect('cms/sales/po/filter/' + $('#filterpo').val())

}
