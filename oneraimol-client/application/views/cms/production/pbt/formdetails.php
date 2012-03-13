<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/pbt.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#details">Details</a></li>
        <li><a href="#formula">Formula</a></li>
    </ul>
    
 <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData">
                        
         <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Approved to PBT:</td>
                                <td colspan="2"><?php echo $productionbatchticket->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Head Chemist:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('hc_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('hc_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->hc_approved_date ?></td>
                                <td><?php echo $productionbatchticket->checked_two->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Quality Assurance Head:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('qa_head_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('qa_head_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->qa_head_approved_date ?></td>
                                <td><?php echo $productionbatchticket->noted->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Quality Assurance:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('qa_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('qa_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->qa_approved_date ?></td>
                                <td><?php echo $productionbatchticket->checked_one->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Laboratory Analyst:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('labanalyst_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('labanalyst_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->labanalyst_approved_date ?></td>
                                <td><?php echo $productionbatchticket->prepared->full_name() ?></td>
                            </tr>
                        </table>
                        
                    </td>
                    
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
                <div id="details" class="tab-pane">
                    
           <table class="fullWidth formData">
                <tr>
                    <td class="half borderless formData">
<fieldset>
                            <legend>Base Information</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td class="half">Product Code:</td>
                                    <td><?php echo $productionbatchticket->product_code ?></td>
                                </tr>
                                <tr>
                                    <td>Batch #:</td>
                                    <td><?php echo $productionbatchticket->formulas->pwoitems->batch_no ?></td>
                                </tr>
                                <tr>
                                    <td>Blending Time Required:</td>
                                    <td><?php echo $productionbatchticket->blending_time_required ?></td>
                                </tr>
                                <tr>
                                    <td>Product Description:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->product_description ?></td>
                                </tr>
                                <tr>
                                    <td>Customer:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->customers->full_name()  ?></td>
                                </tr>
                                <tr>
                                    <td>Quantity Required:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->qty  ?></td>
                                </tr>
                                <tr>
                                    <td>Required Delivery Date:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->delivery_date  ?></td>
                                </tr>
                                <tr>
                                    <td>Packaging Required:</td>
                                    <?php if($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "1") : ?>
                                    <td><?php echo $productionbatchticket->formulas->poitems->variants->unitmaterials->description ?> </td>
                                    <?php elseif ($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "2") : ?>
                                    <td><?php echo $productionbatchticket->formulas->poitems->unitmaterials->description ?></td>
                                    <?php endif ?>
                                </tr>
                                <tr>
                                    <td>Reference P.W.O. #:</td>
                                    <td><?php echo $productionbatchticket->formulas->pwoitems->productionworkorders->pwo_id_string  ?></td>
                                </tr>
                                <tr>
                                    <td>Reference P.O. #</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->po_id_string  ?></td>
                                </tr>
                                <tr>
                                    <td>Performed By:</td>
                                    <td><?php echo $productionbatchticket->production_performed_by  ?></td>
                                </tr>
                                <tr>
                                    <td>Date Produced:</td>
                                    <td><?php echo $productionbatchticket->date_produced  ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>

                    <td class="half borderless formData">  
                        <fieldset>
                            <legend>Raw Material Volume Composition</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td>Theoretical:</td>
                                    <td><?php echo $productionbatchticket->py_theoretical ?></td>
                                </tr>
                                <tr>
                                    <td>Actual:</td>
                                    <td><?php echo $productionbatchticket->py_actual ?></td>
                                </tr>
                                <tr>
                                    <td>Variance:</td>
                                    <td><?php echo $productionbatchticket->variance ?></td>
                                </tr>
                                <tr>
                                    <td>Machine No. / Description:</td>
                                    <td><?php echo $productionbatchticket->machine_desc ?></td>
                                </tr>
                                <tr>
                                    <td>Blending Time</td>
                                    <td><?php echo $productionbatchticket->blending_time ?></td>
                                </tr>
                                <tr>
                                    <td>Overall Comments/Remarks:</td>
                                    <td><?php echo $productionbatchticket->remarks ?></td>
                                </tr>                       
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
                </div>
        
    </div>
    
