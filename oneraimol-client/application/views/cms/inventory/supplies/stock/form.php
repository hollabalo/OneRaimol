<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/suppliesstock.js" type="text/javascript"></script>
<script  src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>

<script type="text/javascript">
    
    $(function() {
        $('#datestock').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $('#expiration_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    }); 
    
</script>

<div id="msg"></div>

<form id="suppliesstock-form" method="post" action="<?php echo $base_url ?>cms/inventory/suppliesstock/process_form/<?php if(isset($materialstocklevel)) echo Helper_Helper::encrypt($materialstocklevel->stock_id) ?>">

    <table class="form">
        <?php if( isset($materialsupply) ) { ?>
        <input type="hidden" name="material_supply_id" id="material_supply_id" value="<?php echo is_bool($materialsupply) ? Helper_Helper::encrypt($materialstocklevel->materialsupply->material_supply_id) : Helper_Helper::encrypt($materialsupply->material_supply_id); ?>" />
        <?php } ?>
        
        <?php if( isset($materialstocklevel) ) { ?>
        <input type="hidden" name="stock_id" id="stock_id" value="<?php echo Helper_Helper::encrypt($materialstocklevel->stock_id); ?>" />
        <?php } ?>
        <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
       
        <tr>
            <td colspan="3" class="table-section"><?php echo $formStatus ?>material stock information</td>
        </tr>

        <tr>
            <td class="right"><span class="required">&ast;</span>
                Liters</td>
            <td>
                <label for="liters"></label>
                <input class="dd-input" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->liters ?>" name="liters" type="text" id="liters" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr> 
        
         <tr>
            <td class="right"><span class="required">&ast;</span>
                Date Stock</td>
            <td>
                <label for="datestock"></label>
                <input class="dd-input" id="datestock" readonly="readonly"value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->stock_taking_date ?>" name="stock_taking_date" type="text" id="stock_taking_date" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>        
        
         <tr>
            <td class="right"><span class="required">&ast;</span>
                Expiration Date</td>
            <td>
                <label for="expiration_date"></label>
                <input class="dd-input" id="expiration_date" readonly="readonly" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->expiration_date ?>" name="expiration_date" type="text" id="expiration_date" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>  
        
        <tr>
            <td>&nbsp;</td>
            <td>
                <input name="btn_submit" type="submit" value="Save Stock" />
                <input name="btn_cancel" type="button" onclick="cancel_suppliesstock()" value="Cancel" />
            </td>
        </tr>
    </table>
    
    <script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/suppliesstock.js" type="text/javascript"></script>