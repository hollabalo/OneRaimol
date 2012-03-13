function generatepdf() {
    $('.success').hide();
    $('.notice').hide();
    

    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    
    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/reports/po/generatepdflist',
        type        : 'POST',
        dataType    : 'json',
        data        : {'from_date' : from_date,
                        'to_date' : to_date}
    }

    $.ajax(settings);
    return false;
}

function filter() {
    var doc = $('#doctype').val();
    
    if(doc == 'po') {
        $('#criteria1').prop("checked", false);
        $('#criteria2').prop("checked", false);
        $('#criteria3').prop("checked", false);
        
        $('#criteria1').prop('disabled', false);
        $('#status').prop('disabled', false);
        $('#criteria2').prop('disabled', false);
        $('#from_date').prop('disabled', false);
        $('#to_date').prop('disabled', false);
        $('#criteria3').prop('disabled', true);
        $('#from_date2').prop('disabled', true);
        $('#to_date2').prop('disabled', true);
        
        $('#criteria1').prop("checked", true);
        $('#criteria2').prop("checked", true);
    }
    else if(doc == 'so') {
        $('#criteria1').prop("checked", false);
        $('#criteria2').prop("checked", false);
        $('#criteria3').prop("checked", false);
        
        $('#criteria1').prop('disabled', false);
        $('#status').prop('disabled', false);
        $('#criteria2').prop('disabled', true);
        $('#from_date').prop('disabled', true);
        $('#to_date').prop('disabled', true);
        $('#criteria3').prop('disabled', true);
        $('#from_date2').prop('disabled', true);
        $('#to_date2').prop('disabled', true);
        
        $('#criteria1').prop("checked", true);
    }
    else if(doc == 'dr') {
        $('#criteria1').prop("checked", false);
        $('#criteria2').prop("checked", false);
        $('#criteria3').prop("checked", false);
        
        $('#criteria1').prop('disabled', false);
        $('#status').prop('disabled', false);
        $('#criteria2').prop('disabled', true);
        $('#from_date').prop('disabled', true);
        $('#to_date').prop('disabled', true);
        $('#criteria3').prop('disabled', false);
        $('#from_date2').prop('disabled', false);
        $('#to_date2').prop('disabled', false);
        
        $('#criteria1').prop("checked", true);
        $('#criteria3').prop("checked", true);
    }
    else if(doc == 'default') {
        $('#criteria1').prop('disabled', true);
        $('#status').prop('disabled', true);
        $('#criteria2').prop('disabled', true);
        $('#from_date').prop('disabled', true);
        $('#to_date').prop('disabled', true);
        $('#criteria3').prop('disabled', true);
        $('#from_date2').prop('disabled', true);
        $('#to_date2').prop('disabled', true);
        
        $('#criteria1').prop("checked", false);
        $('#criteria2').prop("checked", false);
        $('#criteria3').prop("checked", false);
    }
}