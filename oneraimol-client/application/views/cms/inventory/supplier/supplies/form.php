<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/suppliersupplies.js" type="text/javascript"></script>



<div id="msg"></div>

<form id="suppliersupplies-form" method="post" action="<?php echo $base_url ?>cms/inventory/suppliersupplies/process_form/<?php if(isset($materialsupply)) echo Helper_Helper::encrypt($materialsupply->material_supply_id) ?>">

    <table class="form">
  
        <?php if( isset($supplier) ) { ?>
        <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo is_bool($supplier) ? Helper_Helper::encrypt($materialsupply->suppliers->supplier_id) : Helper_Helper::encrypt($supplier->supplier_id); ?>" />
        <?php } ?>
        
        <?php if( isset($materialsupply) ) { ?>
        <input type="hidden" name="material_id" id="material_id" value="<?php echo Helper_Helper::encrypt($materialsupply->material_id); ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
  <!--asdasd-->
            <tr>
                <td colspan="3" class="table-section">Material Supply information</td>
            </tr>
  
         <tr>
                <?php 
                $materials = ORM::factory('material')
                        ->find_all();
                ?>
            <td class="right">
                <span class="required">&ast;</span>Materials</td>
            <td><select name="material_id" id="material_id" size="4" multiple="single" <?php if(isset($materialsupply)) echo 'disabled' ?>>
                <?php foreach($materials as $material) : ?>
                    <option class="dd-input" value="<?php if(isset($materials)) echo Helper_Helper::encrypt ($material->material_id) ?>"><?php echo $material->description ?></option>
                            <?php endforeach ?>
                </select>
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>

            <tr>
                <td class="right">
                    <span class="required">&ast;</span>Price</td>
                <td>
                    <label for="price"></label>
                    <input class="dd-input" value="<?php if(isset($materialsupply)) echo $materialsupply->price ?>" name="price" id="price" type="text"/>
                </td
               
                <td style="width:40%;"><span id="msg"></span></td>
            </tr>
  
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input name="btn_submit" type="submit" value="Save Material" />
                    <input name="btn_cancel" type="button" onclick="cancel_suppliersupplies()" value="Cancel" />
                </td>
            </tr>
    </table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/suppliersupplies.js" type="text/javascript"></script>