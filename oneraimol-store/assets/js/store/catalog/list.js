function submit_to_cart() {
    $( '#formItemDetails' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                redirect('list/cart');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}

function submit_po() {
    $( '#confirm' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                redirect('list/cart');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}

function place_order() {
    $( '#cartForm' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                redirect('checkout/confirm');
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}

function checkout() {
    redirect('checkout');
}
