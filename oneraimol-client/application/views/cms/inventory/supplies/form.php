<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/supplies.js" type="text/javascript"></script>



<div id="msg"></div>

<form id="supplies-form" method="post" action="<?php echo $base_url ?>cms/inventory/supplies/process_form/<?php if(isset($materialsupply)) echo Helper_Helper::encrypt($materialsupply->material_supply_id) ?>">

    <table class="form">
  
        <?php if( isset($materialsupply) ) { ?>
        <input type="hidden" name="material_supply_id" id="material_supply_id" value="<?php echo Helper_Helper::encrypt($materialsupply->material_supply_id); ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
            <tr>
                <td colspan="3" class="table-section">Supplier-Material information</td>
            </tr>
  
         <tr>
                <?php 
                $materials = ORM::factory('material')
                        ->find_all();
                ?>
            <td class="right">
                <span class="required">&ast;</span>Materials</td>
            <td><select name="material_id" id="material_id" size="4" multiple="single">
                <?php foreach($materials as $material) : ?>
                    <option class="dd-input" value="<?php if(isset($materials)) echo $material->material_id ?>"><?php echo $material->description ?></option>
                            <?php endforeach ?>
                </select>
            </td>
                        <td style="width:40%;"><span id="msg"></span></td>
        </tr>
        
        <tr>

                <?php 
                $suppliers = ORM::factory('supplier')
                        ->find_all();
                ?>
            <td class="right">
                <span class="required">&ast;</span>Suppliers</td>
            <td><select name="supplier_id" id="supplier_id" multiple="single">
                <?php foreach($suppliers as $supplier) : ?>
                    <option class="dd-input" value="<?php if(isset($suppliers)) echo $supplier->supplier_id ?>"><?php echo $supplier->company_name ?></option>
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
                </td>
               
                <td style="width:40%;"><span id="msg"></span></td>
            </tr>
  
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input name="btn_submit" type="submit" value="Save Supplies" />
                    <input name="btn_cancel" type="button" onclick="cancel_supplies()" value="Cancel" />
                </td>
            </tr>
    </table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/supplies.js" type="text/javascript"></script>