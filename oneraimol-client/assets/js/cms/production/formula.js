function cancel_formula() {
    redirect('cms/production/formula');
}


function submit_formula() {
    wait_msg( message.loading );
    
    $( '#formula-form' ).ajaxSubmit(
        function( response ) {
            var json = JSON.parse( response );
            if( json.success == true ) {
                if(json.action == 'add') {
                    //yung argument na mahabang string, add ang string na yan pag dinecode using base64
                    redirect('cms/production/formula/index/MG4zUmExbTBMYWRk');
                }
                else if(json.action == 'edit') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/production/formula/index/MG4zUmExbTBMZWRpdA==');
                }
                else if(json.action == 'approve') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/production/formula/index/MG4zUmExbTBMYXBwcm92ZQ==');
                }
                else if(json.action == 'disapprove') {
                    //yung argument na mahabang string, edit ang string na yan pag dinecode using base64
                    redirect('cms/production/formula/index/MG4zUmExbTBMZGlzYXBwcm92ZQ==');
                }
            } else {
                //ipakita yung fail message na sinabi dun sa controller codes
                error_msg( json.failmessage );
            }
        }
    );
}


function add_row (id) {
    
    $.post(
        base_url + 'cms/production/formula/populate_material', {}, 
        function(data){
            $('#' + id + '> tbody').append(data); 
        }
    );
}

function delete_row() {
    $("#del").live('click', function(event) {
            $(this).parent().parent().remove();
    });

}

function populate_pwoitems() {
    
    $.post(
        base_url + 'cms/production/formula/populate_pwoitems/' + $('#filterpwo').val(), {}, 
        function(data){
            $('#pwoitemsgrid').html(data); 
        }
    );

}

function populate_materialinfo() {
    
//    $('#material').change(function() {
//          var str = "";
//        $('select#material option').each(function(){
//            str = $(this).text() + " ";
//          if ($(this).hasClass('selected')) {
//                alert(str);
//                return(false);
//             }
//
//        }); 
//            alert(str)
//    }).change();     
// working pero nag sstack
//    $.post(
//        base_url + 'cms/production/formula/populate_materialinfo/' + $('#material').val(), {},
//        function(data) {
//            $('#a > tr').append(data); 
//        }
//    )

//infinite loop
//    $("select").change(function () {
//    $("select option:selected").each(function() {
//        $.post(
//            base_url + 'cms/production/formula/populate_materialinfo/' + $('#material').val(), {},
//            function(data) {
//                $('#a > tr').append(data); 
//            }
//            )
//        });
//    })
//    .change();
}

// example
//    $("select").change(function () {
//          var str = "";
//          $("select option:selected").each(function () {
//                str += $(this).text() + " ";
//              });
//          $("div").text(str);
//        })
//        .change();

function compute_formula() {
    var itemdesc = new Array(); 
    var itemdosage = new Array();
    var itemprice = new Array();
//    var itemid = new Array();
    var fopex = $('#opex').val();
    var fps = $('#ps').val();
   
    
    $('#formulafield > tbody > tr').each(function() {
        var dosage = $(this).find("td").eq(1).find("input").val();   
        var price = $(this).find("td").eq(2).find("input").val();   
        var materialdesc = $(this).find("td").eq(0).find("select").find("option:selected").html(); 
        var id = $(this).find("td").eq(0).find("select").find("option:selected").val(); 

        itemdosage.push(dosage);
        itemprice.push(price);
        itemdesc.push(materialdesc);
//        itemid.push(id);
//        alert(itemid);
    });
    
    $.post(
        base_url + 'cms/production/formula/process_compute/', 
        {
            desc : itemdesc,
            dosage : itemdosage,
            price : itemprice,
//            item_id : itemid,
            opex : fopex,
            ps : fps
        }, 
        function(data){
            $('#formulasummary').html(data); 
        }
    );
}