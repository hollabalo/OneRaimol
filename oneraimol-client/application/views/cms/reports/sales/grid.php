<script  src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/reports/po.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#from_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $('#to_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        
        $('#from_date2').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $('#to_date2').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        
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

     
    }); 
</script>

<form id="po-report-form" method="post" action="<?php echo $base_url ?>cms/reports/salesdocuments/generatepdf">
 

    <table class="borderless condensed-table">

        
        <tr>
            <td style="width:11%">
                Document Type
            </td>
            <td>
                <select id="doctype" name="doctype" onchange="filter()">
                    <option value="default">--Select Type--</option>
                    <option value="po">Purchase Order</option>
                    <option value="so">Sales Order</option>
                    <option value="dr">Delivery Receipt</option>
                </select>
            </td>
        </tr>
    </table>
        <table class="borderless condensed-table">

        <tr>
            <td style="width:3%">
                <input id="criteria1" name="criteria1" type="checkbox" />
            </td>
            <td style="width:8%">
                Status
            </td>
            <td>
                <select id="status" name="status">
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Disapproved</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <input id="criteria2" name="criteria2" type="checkbox" />
            </td>
            <td>
                Order Date
            </td>
            <td>
                FROM &nbsp;<input name="from_date" id="from_date" maxlength="10" /> - 
                TO &nbsp;<input name="to_date" id="to_date" maxlength="10" />
            </td>
        </tr>

        <tr>
            <td>
                <input id="criteria3" name="criteria3" type="checkbox" />
            </td>
            <td>
                Delivery Date
            </td>
            <td>
                FROM &nbsp;<input name="from_date2" id="from_date2" maxlength="10" /> - 
                TO &nbsp;<input name="to_date2" id="to_date2" maxlength="10" />
            </td>
        </tr>

    </table>
    <input name="btn_submit" type="submit" value="Generate Report" />
    
</form>

<!--<a href="<?php //echo $base_url ?>cms/reports/salesdocuments/masterfile">Sample</a>-->