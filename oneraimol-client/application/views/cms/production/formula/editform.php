<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/production/formula.js" type="text/javascript"></script>


    <form id="formula-form" method="post" action="<?php echo $base_url ?>cms/production/formula/process_form/<?php if(isset($formula)) echo Helper_Helper::encrypt($formula->formula_id) ?>">



                    
                    <table class="form">
                        <tr>
                            <th class="half">Formula</th>
                            <th class="half">Summary</th>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                
                                <input name="po_item_id" id="po_item_id" style="display:none"/>
                                <input name="pwo_item_id" id="pwo_item_id" style="display:none"/>
                                
                                OPEX:&nbsp;<input id="opex" value="<?php echo $formula->opex - $formula->direct_material_cost ?>"class="small" />
                                &nbsp;&nbsp;PS:&nbsp;<input id="ps" value="<?php echo $formula->selling_price ?>" class="small" />
                                
                                <div class=""><input id="add" name="btn_add" class="btn mini" type="button" onclick="add_row('formulafield')" value="Add" /></div>
                                <table class="form condensed-table" id="formulafield">
                                    
                                <?php if( isset($formula) ) { ?>
                                    <input type="hidden" name="formula_id" id="formula_id" value="<?php echo $formula->formula_id; ?>" />
                                <?php } ?>
                                    <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />

                                    <thead>
                                        <tr>
                                            <th style="width:25%">Raw Material</th>
                                           
                                            <th>Dosage</th>
                                            <th>Price</th>
                                            <th>Liters</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                       <?php foreach($formula->formuladetails->find_all() as $result) : ?>
                                        <tr>
                                            <input type="hidden" name="id[]" />
                                            <td>
                                                <select name="material[]" id="material">
                                                    <?php foreach($materialstocklevel as $stock) : ?>
                                                    <option class="fullWidth" value="<?php if(isset($stock)) echo Helper_Helper::encrypt($stock->materialsupply->materials->material_id) ?>" <?php echo ($result->stock_id == $stock->pk()) ? 'selected="selected"' : '' ?>><?php echo $stock->materialsupply->materials->description ?><?php echo $stock->stock_taking_date ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </td>
                                            <td><input id="dosage" name="dosage[]" value="<?php echo $result->dosage ?>" class="fullWidth" type="text" /></td>
                                            <td><input id="price" name="price[]" value ="<?php echo $result->price ?>" class="fullWidth" type="text" /></td>
                                            <td><input id="liters" name="liters[]" value ="<?php echo $result->liters ?>"class="fullWidth" type="text" /></td>
                                            <td><a style="margin-left:10px;" href="#" id="del" onclick="delete_row()">delete</a></td>
                                        </tr>
                                       <?php endforeach ?>
                                    </tbody>

                                </table>
                            </td>
                            
                            <td style="vertical-align:top">
                                <div class=""><input id="compute" name="btn_compute" class="btn mini" type="button" onclick="compute_formula()" value="Compute" /></div>
                                <div id="formulasummary" class="border"></div>
                            </td>
                        </tr>
                    </table>
                    
                    <input name="btn_submit" type="submit" class="btn" value="Save Formula" />
                    <input name="btn_cancel" type="button" class="btn" onclick="cancel_formula()" value="Cancel" />


    </form>
    <script src="<?php echo $base_url . $config['js'] ?>/cms/production/form/formula.js" type="text/javascript"></script>