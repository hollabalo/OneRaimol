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


function limit_record(refURL, method) {
    if(method != '') {
        redirect(refURL + '/' + method + '/' + $('#limitpicker').val());
    }
    else {
        redirect(refURL + '/' + $('#limitpicker').val());
    }
}

function logout() {
    redirect('cms/dashboard/logout');
}

function search() {
    redirect($('#searchrefURL').val() + '/' + $('#searchbox').val() + '/' +$('#limitpicker').val()); 
}

function close_deletemodal() {
    $('#delete-modal').modal('hide')
}

function close_approvemodal() {
    $('#approve-modal').modal('hide')
}

function close_disapprovemodal() {
    $('#disapprove-modal').modal('hide')
}

function close_ceoapprovemodal() {
    $('#ceoapprove-modal').modal('hide')
}