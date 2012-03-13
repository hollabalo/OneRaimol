<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/product.js" type="text/javascript"></script>
<script  src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>

<div id="msg"></div>
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

<form id="productstock-form" method="post" action="<?php echo $base_url ?>cms/inventory/product/process_formstock/<?php if(isset($productstock)) echo Helper_Helper::encrypt($productstock->product_stock_id) ?>">

    <table class="form">

    <?php if(isset($productstock)) { ?>
        <?php echo $productstock->products->product_id ?>
    <input type="text" name="product_id" id="product_id" value="<?php echo Helper_Helper::encrypt($productstock->products->product_id); ?>" />
    <?php } ?>
    
    <?php if(isset($product)) { ?>
    <?php echo $product->product_id?>
    <input type="text" name="product_id" id="product_id" value="<?php echo Helper_Helper::encrypt($product->product_id); ?>" />
    <?php } ?>
        <input type="text" name="formstatus" value="<?php echo $formStatus; ?>" />
               
        <table class="fullWidth condensed-table zebra-striped">
        <tr>
            <td class="right"><span class="required">&ast;</span>
                Liters</td>
            <td>
                <label for="liters"></label>
                <input class="dd-input" value="<?php if(isset($productstock)) echo $productstock->liters ?>" name="liters" type="text" id="liters" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr> 
        
         <tr>
            <td class="right"><span class="required">&ast;</span>
                Date Stock</td>
            <td>
                <label for="datestock"></label>
                <input class="dd-input" id="datestock" readonly="readonly" value="<?php if(isset($productstock)) echo $productstock->stock_taking_date ?>" name="stock_taking_date" type="text" id="stock_taking_date" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>        
        
         <tr>
            <td class="right"><span class="required">&ast;</span>
                Expiration Date</td>
            <td>
                <label for="expiration_date"></label>
                <input class="dd-input" id="expiration_date" readonly="readonly" value="<?php if(isset($productstock)) echo $productstock->expiration_date ?>" name="expiration_date" type="text" id="expiration_date" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>  
        
        <tr>
            <td>&nbsp;</td>
            <td>
                <input name="btn_submit" type="submit" value="Save Stock" />
                <input name="btn_cancel" type="button" onclick="cancel_productstock()" value="Cancel" />
            </td>
        </tr>
    </table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/productstock.js" type="text/javascript"></script>