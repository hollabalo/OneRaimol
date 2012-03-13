<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/unit.js" type="text/javascript"></script>



<div id="msg"></div>
<form id="unit-form" method="post" action="<?php echo $base_url ?>cms/inventory/unit/process_form/<?php if(isset($unit)) echo Helper_Helper::encrypt($unit->um_id) ?>">
        
    <table class="form">
        <?php if( isset($unit) ) { ?>
            <input type="hidden" name="um_id" id="um_id" value="<?php echo $unit->um_id; ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
              <tr>
                  <td colspan="3" class="table-section">unit information</td>
              </tr>
              <tr>
                <td class="right">
                    <span class="required">&ast;</span>Unit
                </td>
                <td>
                    <label for="description"></label>
                    <input class="dd-input" value="<?php if (isset ($unit)) echo $unit->description ?>" name="description" type="text" id="description" maxlength="" />
                </td>
                <td style="width:40%;"><span id="msg"></span></td>
              </tr>
              
              <tr>
                <td class="right">
                    <span class="required">&ast;</span>Size/Liters
                </td>
                <td>
                    <label for="size_liters"></label>
                    <input class="dd-input" value="<?php if (isset ($unit)) echo $unit->size_liters ?>" name="size_liters" type="text" id="size_liters" maxlength="" />
                </td>
                <td style="width:40%;"><span id="msg"></span></td>
              </tr>
              
              <tr>
                <td class="right">
                    Box Per SKU
                </td>
                <td>
                    <label for="box_per_sku"></label>
                    <input class="dd-input" value="<?php if (isset ($unit)) echo $unit->box_per_sku ?>" name="box_per_sku" type="text" id="box_per_sku" maxlength="" />
                </td>
                <td style="width:40%;"><span id="msg"></span></td>
              </tr>
                          
              <tr>
            <td>&nbsp;</td>
            <td>
                    <input name="btn_submit" type="submit" value="Save Unit" />
                    <input name="btn_cancel" type="button" onclick="cancel_unit()" value="Cancel" />
            </td>
              </tr>
            
    </table>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/unit.js" type="text/javascript"></script>