function cancel_pwo() {
    redirect('cms/production/pwo');
}

function submit_pwo() {
    $( '#pwo-form' ).ajaxSubmit(
        function( response ) {
            wait_msg( message.loading );
            
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/production/pwo/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/production/pwo/index/MG4zUmExbTBMZWRpdA==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}
function add_pwo() {
    var pwo_ids = get_ids('id');
    var x = get_ids('abc');
    
    for(var item in pwo_ids) {
        //$('#pwo_grid > tbody').append('<tr><td><input name="bullshrek1[]" class="fullWidth"/></td><td><input name="bullshrek1[]" class="fullWidth"/></td><td><input name="bullshrek1[]" class="fullWidth"/></td><td><input name="bullshrek1[]" class="fullWidth"/></td><td><input name="bullshrek1[]" class="fullWidth"/></td><td><input name="bullshrek1[]" class="fullWidth"/></td></tr>');
        $('#pwo_grid > tbody').append('<tr>\n\
                                        <td><input type="checkbox" class="id" name="id[]"/></td>\n\
                                        <td>' + x +'</td>\n\
                                        <td>'+ +'</td>\n\
                                        <td>'+ +'</td>\n\
                                       </tr>');
        
    }
}

function add_row(ctr, row){
    $("#item").live('click', function(event) {
            $(this).parent().parent().remove();
//            if(ctr != 0)$("#sohead" + ctr ).remove();
    });
    
    $.post(
        base_url + 'cms/production/pwo/populate_so/' + row, {}, 
        function(data){
            $('#pwo_grid > tbody').append(data);
        }
    );
}

function remove_row(row){
    $("#itemremove").live('click', function(event) {
            $(this).parent().parent().remove();
    });
    
    $.post(
        base_url + 'cms/production/pwo/remove_so/' + row, {}, 
        function(data){
            $('#tableso > tbody').append(data);
        }
    );
}


function delete_pwo() {
    $('.success').hide();
    $('.notice').hide();
    
    var pwo_ids = get_ids('id');

    if( pwo_ids.length < 1 ) {
        error_msg(message.noselection);
        return false;
    }

    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/production/pwo/delete',
        type        : 'POST',
        dataType    : 'json',
        data        : {'id' : pwo_ids},
        success     : function(json) {
            if( json.success == true ) {
                //'delete' ang equivalent nung mahabang string na encrypted
                redirect('cms/production/pwo/index/MG4zUmExbTBMZGVsZXRl');
            }
        },
        error       : function() {
            error_msg(message.ajaxerror);
        }
    }

    $.ajax(settings);
    return false;
}


function remove_pwo() {
    var pwo_ids = get_ids('id');
    
    for(var item in pwo_ids) {
        $('#pwo_grid > tbody').attr('tr').remove();
    }
}


//function addRow(tableID) {
// 
//            var table = document.getElementById(tableID);
// 
//            var rowCount = table.rows.length;
//            var row = table.insertRow(rowCount);
// 
//            var cell1 = row.insertCell(0);
//            var element1 = document.createElement("input");
//            element1.type = "checkbox";
//            cell1.appendChild(element1);
// 
//            var cell2 = row.insertCell(1);
//            cell2.innerHTML = rowCount + 1;
// 
//            var cell3 = row.insertCell(2);
//            var element2 = document.createElement("input");
//            element2.type = "text";
//            cell3.appendChild(element2);
// 
//        }
        
function addRow()
{
    //add a row to the rows collection and get a reference to the newly added row
    var newRow = document.all("pwo_grid").insertRow();
    
    //add 3 cells (<td>) to the new row and set the innerHTML to contain text boxes
    
    var oCell = newRow.insertCell();
    oCell.innerHTML = $_POST['id'];
    
    oCell = newRow.insertCell();
    oCell.innerHTML = "<input type='text' name='t2'>";
    
    oCell = newRow.insertCell();
    oCell.innerHTML = "<input type='text' name='t3'>  <input" + 
                      " type='button' value='Delete' onclick='removeRow(this);'/>";   
}
   