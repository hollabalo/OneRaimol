function redirect(str) {
    document.location = base_url + str;
}

function error_msg( message ) {
    $('#msg').html('<span class="error"><p>' + message + '</p></div>');
}

function notice_msg( message ) {
    $('#msg').html('<span class="notice">' + message + '</div>');
}

function wait_msg( message ) {
    $('#msg').html('<span class="notice wait">' + message + '</div>');
}

function success_msg( message ) {
    $('#msg').html('<span class="success">' + message + '</div>');
}

function get_ids( class_name ) {
    var ids = [];
    var counter = 0;

    $( '.' + class_name ).each(
        function() {
            if( $( this ).attr('checked') ) {
                ids[ counter ] = $( this ).val();
                counter++;
            }
        }
    );

    return ids; 
}

function check_all( object ) {
    var checked = $( object ).attr('checked');

    $( object ).closest('table').find(':checkbox').each(
    
        function() {
            if( checked == 'checked' ) {
                $( this ).attr( 'checked', checked );
            } else {
                $( this ).removeAttr('checked');
            }
        }
    );
}

function logout() {
    redirect('store/logout');
}
