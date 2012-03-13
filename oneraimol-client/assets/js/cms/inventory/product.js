/**
 * for Product Only
 */

function cancel_product() {
    redirect('cms/inventory/product');
}

function submit_product() {
    wait_msg( message.loading );
    
    $( '#product-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/inventory/product/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/inventory/product/index/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}


function delete_product() {
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
        url         : base_url + 'cms/inventory/product/delete',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'delete' ang equivalent nung mahabang string na encrypted
                redirect('cms/inventory/product/index/MG4zUmExbTBMZGVsZXRl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

/**
 * for Product Price Only
 */
function cancel_productprice() {
    var product_id = $('#product_id').val();
    redirect('cms/inventory/product/details/' + product_id);
}

function submit_productprice() {
    wait_msg( message.loading );
    
    var product_id = $('#product_id').val();
    
    $( '#productprice-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/inventory/product/details/' + product_id +'/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/inventory/product/details/' + product_id + '/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}



function delete_productprice() {
    $('.success').hide();
    $('.notice').hide();
    
    var user_ids = get_ids('id');
    
    var product_id = $('#product_id').val();

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/inventory/product/deleteprice',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'delete' ang equivalent nung mahabang string na encrypted
                redirect('cms/inventory/product/details/' + product_id + '/MG4zUmExbTBMZGVsZXRl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}

function populate_cat(level) {
    if(level == 1) {
        $('#catholder1').html(''); 
        $('#catholder2').html(''); 
    }
    else if(level == 2) {
        $('#catholder2').html('');
    }
    
    if(level != 3) {
        $.post(
            base_url + 'cms/inventory/product/subcat' + level + '/' + $('#subcatbox'+ (level - 1)).val(), {}, 
            function(data){
                $('#catholder'+ level).html(data); 
            }
        ) 
    }

}

/**
 * Product Stock
 */

function cancel_productstock() {
     var product_id = $('#product_id').val();
    redirect('cms/inventory/product/details/' + product_id);
}

function submit_productstock() {
    wait_msg( message.loading );
    
    var product_id = $('#product_id').val();
    
    $( '#productstock-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/inventory/product/details/' + product_id +'/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/inventory/product/details/' + product_id + '/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}

function delete_productstock() {
    $('.success').hide();
    $('.notice').hide();
    
    var user_ids = get_ids('id');

    var product_id = $('#product_id').val();

    if( user_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/inventory/product/deletestock',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : user_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'delete' ang equivalent nung mahabang string na encrypted
                redirect('cms/inventory/product/details/' + product_id + '/MG4zUmExbTBMZGVsZXRl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}