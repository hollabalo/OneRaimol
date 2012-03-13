function generatepdf() {
    $('.success').hide();
    $('.notice').hide();
    

    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    alert(from_date);
alert(to_date);

redirect('cms/reports/so/generatepdflist/' + from_date + '/' + to_date)


    wait_msg( message.loading );

    var settings = {
        url         : base_url + 'cms/reports/so/generatepdflist',
        type        : 'POST',
        dataType    : 'json',
        data        : {'from_date' : from_date,
                        'to_date' : to_date}
    }

    $.ajax(settings);
    return false;
}