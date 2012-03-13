function generatepdf() {
    $('.success').hide();
    $('.notice').hide();
    

    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    
    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/reports/dr/generatepdflist',
        type        : 'POST',
        dataType    : 'json',
        data        : {'from_date' : from_date,
                        'to_date' : to_date}
    }

    $.ajax(settings);
    return false;
}