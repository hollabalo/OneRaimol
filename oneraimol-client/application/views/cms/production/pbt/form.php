<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/production/pbt.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#date_produced').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        
        $('.tabs').tabs();
    });
</script>

    <div id="msg"></div>
    
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#pbt">PBT Details</a></li>
        <li><a href="#raw">Raw Material Volume Composition</a></li>
        <li><a href="#formula">Formula</a></li>
    </ul>
    <form id="pbt-form" method="post" action="<?php echo $base_url ?>cms/production/pbt/process_form/<?php if(isset($productionbatchticket)) echo Helper_Helper::encrypt($productionbatchticket->pbt_id) ?>">

<div class="tab-content">     

    <input type="hidden" id="pbt_id_encrypt" value="<?php echo Helper_Helper::encrypt($productionbatchticket->pbt_id) ?>" />

    <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
    
    <div id="pbt" class="tab-pane active">
        
   
    <table class="form">
    	<tr>
            <td class="right">Product Code</td>
            <td><input class="dd-input" id="product_code" name="product_code" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->product_code ?>" type="text" /></td>
        </tr>
        <tr>
            <td class="right">Batch #</td>
            <td><input class="dd-input" id="batch_no" name="batch_no" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->formulas->pwoitems->batch_no ?>" type="text" readonly="readonly" /></td>
     	</tr>
        <tr>
            <td class="right">Blending Time Required</td>
            <td><input class="dd-input" id="blending_time" name="blending_time_required" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->blending_time_required ?>" type="text" /></td>
        </tr>
        <tr>
            <td class="right">Product Description</td>
            <td><input class="dd-input" id="product_description" name="product_description" value="<?php echo $productionbatchticket->formulas->poitems->product_description ?>" type="text" readonly="readonly" /></td>
        </tr>
        <tr>
            <td class="right">Customer</td>
            <td><input class="dd-input" id="customer" name="customer" value="<?php echo $productionbatchticket->formulas->poitems->purchaseorders->customers->full_name() ?>" type="text" readonly="readonly" /></td>
        </tr>
        <tr>
            <td class="right">Quantity Required</td>
            <td><input class="dd-input" id="qty_required" name="qty_required" value="<?php echo $productionbatchticket->formulas->poitems->qty ?>" type="text" readonly="readonly" /></td>
        </tr>
        <tr>
            <td class="right">Required Delivery Date</td>
            <td><input class="dd-input" id="req_delivery_date" name="req_delivery_date" value="<?php echo $productionbatchticket->formulas->poitems->purchaseorders->delivery_date ?>" type="text" readonly="readonly" /></td>
        </tr>    
        <tr>
            <td class="right" >Packaging Required:</td>
            <?php if($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "1") : ?>
            <td><input class="dd-input" id="packaging_req" name="packaging_req" value="<?php echo $productionbatchticket->formulas->poitems->variants->unitmaterials->get_description() ?>" type="text" readonly="readonly" /></td>
            <?php elseif ($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "2") : ?>
            <td><input class="dd-input" id="packaging_req" name="packaging_req" value="<?php echo $productionbatchticket->formulas->poitems->unitmaterials->get_description() ?>" type="text" readonly="readonly" /></td>
            <?php endif ?>
        </tr>
        <tr>
            <td class="right">Reference P.W.O. #:</td>
            <td><input class="dd-input" id="ref_pwo" name="ref_pwo" value="<?php echo $productionbatchticket->formulas->pwoitems->productionworkorders->pwo_id_string ?>" type="text" readonly="readonly" /></td>
        </tr>    
        <tr>
            <td class="right">Reference P.O. #</td>
            <td><input class="dd-input" id="ref_po" name="ref_po" value="<?php echo $productionbatchticket->formulas->poitems->purchaseorders->po_id_string ?>" type="text" readonly="readonly" /></td>
        </tr>  
        <tr>
            <td class="right">Performed By</td>
            <td>
                <select class="dd-input" name="production_performed_by" id="production_performed_by">
                    <?php foreach($staffrole as $result) : ?>
                    <option   value="<?php if(isset($staffrole)) echo $result->staffs->full_name() ?>"><?php echo $result->staffs->full_name() ?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr> 
        <tr>
            <td class="right">Date Produced</td>
            <td><input class="dd-input" id="date_produced" name="date_produced" value="<?php echo $productionbatchticket->date_produced ?>" type="text" /></td>
        </tr> 
    </table>
    </div>
    
    <div id="raw" class="tab-pane">

        <table class="form">
 
    	<tr>
        	<td>Production Yield (Volume / Quantity):</td> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Theoretical</td>
            <td>Actual</td>
            <td>Variance</td>            
       	</tr>
        <tr>
            <td><input class="dd-input" id="py_theoretical" name="py_theoretical" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->py_theoretical ?>" type="text" /></td>
            <td><input class="dd-input" id="py_actual" name="py_actual" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->py_actual ?>" type="text" /></td>
            <td><input class="dd-input" id="variance" name="variance" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->variance ?>" type="text" /></td>
        </tr>        
        <tr>
            <td>Machine No. / Description</td>
            <td>Blending Time</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><input class="dd-input" id="machine_desc" name="machine_desc" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->machine_desc ?>" type="text" /></td>
            <td><input class="dd-input" id="blending_time" name="blending_time" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->blending_time ?>" type="text" /></td>
            <td>&nbsp;</td>
        </tr>


        <tr>
            <td>Overall Comments / Remarks:<textarea class="dd-input" id="remarks" name="remarks" value="<?php if(isset($productionbatchticket)) echo $productionbatchticket->remarks ?>" rows="4"></textarea> </td>
        </tr>        
    </table>
    </div>
    
 
    <div id="formula" class="tab-pane">
        

            <table class="fullWidth condensed-table">
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Liters</th>
                        <th>Dosage</th>
                        <th>&nbsp;</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $record_count = 0;?>                  
                    <?php foreach($productionbatchticket->formulas->formuladetails->find_all() as $result) : ?>
                    <?php $record_count++;?>
                   <tr>
                      
                        <td><?php echo $result->materialstocklevels->materialsupply->materials->description ?></td>
                        <td><?php echo $result->liters ?>L</td>
                        <td><?php echo $result->dosage ?></td>
                        <td>x</td>
                        <td><?php echo $result->price ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php endforeach ?>


                    
                    <?php if($record_count == 0) : ?>
                        <tr><td colspan="6" style="text-align: center; font-style: italic">No formula components found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>
    
            <div class="span-6 right">
                <strong>Direct Material Cost (DMC):</strong> PhP <?php echo number_format($productionbatchticket->formulas->direct_material_cost, 2) ?> <br/>
                <strong>Selling Price (PS):</strong> PhP <?php echo number_format($productionbatchticket->formulas->selling_price, 2) ?> <br/>
                <strong>Net Price (PN):</strong> PhP <?php echo number_format($productionbatchticket->formulas->net_price, 2) ?> <br/>
                <strong>OPEX:</strong> <?php echo $productionbatchticket->formulas->opex ?> <br/>
                <strong>Quantity:</strong> <?php echo $productionbatchticket->formulas->poitems->qty ?> Pcs<br/>
                
                <strong>Total Liters:</strong>
                        
                
                <?php 
                    
                    if(is_null($productionbatchticket->formulas->poitems->product_price_id)) {
                       echo $productionbatchticket->formulas->poitems->unitmaterials->size_liters;
                    }
                    else {
                        echo $productionbatchticket->formulas->poitems->variants->package_size;
                    }
                
                ?>
                <br/>
                
                <strong>Total Volume:</strong> 
                
                <?php 
                    
                    if(is_null($productionbatchticket->formulas->poitems->product_price_id)) {
                        echo ($productionbatchticket->formulas->direct_material_cost * $productionbatchticket->formulas->poitems->unitmaterials->size_liters) * $productionbatchticket->formulas->poitems->qty;
                    }
                    else {
                        echo ($productionbatchticket->formulas->direct_material_cost * $productionbatchticket->formulas->poitems->variants->package_size) * $productionbatchticket->formulas->poitems->qty;
                    }
                
                ?>

    </div>
    </div>
                    <input name="btn_submit" type="submit"  value="Save PBT" />
                    <input name="btn_cancel" type="button" onclick="cancel_pbt()" value="Cancel" />                  
    </div>
            </form>

       
    <script src="<?php echo $base_url . $config['js'] ?>/cms/production/form/pbt.js" type="text/javascript"></script>
    
