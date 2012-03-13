<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/material.js" type="text/javascript"></script>


<div id="msg"></div>

<form id="materialstock-form" method="post" action="<?php echo $base_url ?>cms/inventory/material/process_formmaterialstock/<?php if(isset($materialstocklevel)) echo Helper_Helper::encrypt($materialstocklevel->material_supply_id) ?>">

    <table class="form">
        <input type="hidden" name="stock_id" id="stock_id" value="<?php echo $stock_id; ?>" />
        <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
       
        <tr>
            <td colspan="3" class="table-section">material stock information</td>
        </tr>

        <tr>
            <td class="right"><span class="required">&ast;</span>
                Material Name</td>
            <td>
                <label for="description"></label>
                <input class="dd-input" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->materialsupply->materials->description ?>" name="description" type="text" id="description" maxlength="11" <?php if(isset($materialstocklevel)) echo 'disabled="disabled"' ?> />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr> 

        <tr>
                <?php 
                $suppliers = ORM::factory('supplier')
                        ->find_all();
                ?>
            <td class="right">Supplier</td>
            <td><select name="supplier_id" id="supplier_id" size="4" multiple="single">
                <?php foreach($suppliers as $supplier) : ?>
                    <option class="dd-input" value="<?php if(isset($suppliers)) echo $supplier->supplier_id ?>"><?php echo $supplier->name ?></option>
                            <?php endforeach ?>
                </select>
            </td>
        </tr>

        <tr>
            <td class="right"><span class="required">&ast;</span>
                Price</td>
            <td>
                <label for="price"></label>
                <input class="dd-input" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->materialsupply->price ?>" name="price" type="text" id="price" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
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
                <input class="dd-input" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->stock_taking_date ?>" name="stock_taking_date" type="text" id="stock_taking_date" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>        
        
         <tr>
            <td class="right"><span class="required">&ast;</span>
                Expiration Date</td>
            <td>
                <label for="expiration_date"></label>
                <input class="dd-input" value="<?php if(isset($materialstocklevel)) echo $materialstocklevel->expiration_date ?>" name="expiration_date" type="text" id="expiration_date" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>  
        
        <tr>
            <td>&nbsp;</td>
            <td>
                <input name="btn_submit" type="submit" value="Save Stock" />
                <input name="btn_cancel" type="button" onclick="cancel_materialstock()" value="Cancel" />
            </td>
        </tr>
    </table>

    <script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/material.js" type="text/javascript"></script>