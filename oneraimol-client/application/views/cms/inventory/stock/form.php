<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/stock.js" type="text/javascript"></script>
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

<form id="stock-form" method="post" action="<?php echo $base_url ?>cms/inventory/stock/process_form/<?php if(isset($materialstocklevel)) echo Helper_Helper::encrypt($materialstocklevel->stock_id) ?>">

    <table class="form">
        <?php if( isset($materialstocklevel) ) { ?>
        <input type="hidden" name="stock_id" id="stock_id" value="<?php echo Helper_Helper::encrypt($materialstocklevel->stock_id); ?>" />
        <?php } ?>
        <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
       
        <tr>
            <td colspan="3" class="table-section"><?php echo $formStatus ?>material stock information</td>
        </tr>

                <table class="condensed-table bordered-table">
                    <thead>
                          <tr>
                            <th>&nbsp;</th>
                            <th>Material Name</th>
                            <!--<th>Price</th>
-->                            <th>Supplier</th>
                          </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                        $materialsupply = ORM::factory('materialsupply')
                                ->find_all();
                        ?>        
                        <?php $record_count = 0;?>
                        <?php foreach($materialsupply as $result) :?>
                            <?php $record_count++;?>
                          <tr>
                            <td style="width:1%;"><input class="id" name="material_supply_id" type="radio" value ="<?php echo Helper_Helper::encrypt($result->material_supply_id); ?>" id="chk<?php echo $result->material_supply_id ?>"/></td>
                            <td><?php echo $result->materials->description ?></td>
                            <!--<td><?php //echo $result->price ?></td>
-->                            <td><?php echo $result->suppliers->company_name ?></td>  
                          </tr>
                    
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="2" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                     </tbody>
                </table>
        
        <table class="fullWidth condensed-table zebra-striped">

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
                <input class="dd-input" id="datestock" readonly="readonly" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->stock_taking_date ?>" name="stock_taking_date" type="text" id="stock_taking_date" maxlength="11" />
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
                <input name="btn_cancel" type="button" onclick="cancel_stock()" value="Cancel" />
            </td>
        </tr>
    </table>
                        </table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/stock.js" type="text/javascript"></script>