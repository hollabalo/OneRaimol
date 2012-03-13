<script type="text/javascript" src="http://localhost/oneraimol/assets/js/jquery.ui.js"></script>
  <script src="<?php echo $base_url . $config['js'] ?>/cms/reports/so.js" type="text/javascript"></script>
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
    }); 
</script>


<table class="condensed-table bordered-table">
    <tr>
        <td>
                        <select>
                            <option>Delivery Date</option>
                            <option>Order Date</option>
                        </select>
        </td>
        <td>
                        From<input name="from_date" id="from_date" readonly="readonly" maxlength="10" />
                        To<input name="to_date" id="to_date" readonly="readonly" maxlength="10" />
                        <a href="javascript:void(0)" onclick="generatepdf()">save lists as pdf</a>
        </td>
    </tr>

</table>