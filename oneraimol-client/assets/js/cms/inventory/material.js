/*
 * material
 */

function cancel_material() {
    redirect('cms/inventory/material');
}

function submit_material() {
    wait_msg( message.loading );
    
    $( '#material-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/inventory/material/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/inventory/material/index/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}


/*
 * material stock
 */

function cancel_materialstock() {
        var material_supply_id = $('#material_supply_id').val();
        
    redirect('cms/inventory/material/details/' + material_supply_id);
}

function submit_materialstock() {
    wait_msg( message.loading );
    var material_supply_id = $('#stock_id').val();
    $( '#materialstock-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/inventory/material/details/'+ material_supply_id +'/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/inventory/material/details/'+ material_supply_id +'/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}