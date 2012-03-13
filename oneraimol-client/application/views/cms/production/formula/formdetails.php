<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/formula.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#components">Components</a></li>
    </ul>
    
   <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>

                    <td class="half borderless formData">
                        
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Created to FORMULA:</td>
                                <td colspan="2"><?php echo $formula->date_created ?></td>
                            </tr>
                            <tr>
                                <td>President:</td>
                                <td style="color: <?php echo $formula->color_status('ceo_approved_status') ?>; font-weight: bold;"><?php echo $formula->role_status('ceo_approved_status') ?></td>
                                <td><?php echo $formula->ceo_approved_date ?></td>
                                <td><?php echo $formula->approved->full_name() ?></td>
                            </tr>
                        </table>
                        
                    </td>
                    
                </tr>
            </table>
           
        </div>
      
        <div id="components" class="tab-pane">
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
                    <?php foreach($formuladetail as $result) : ?>
                    <?php $record_count++;?>
                   <tr>
                      
                        <td><?php echo $result->materialstocklevels->materialsupply->materials->description ?></td>
                        <td><?php echo $result->liters ?>L</td>
                        <td><?php echo $result->dosage ?></td>
                        <td>x</td>
                        <td>PhP <?php echo number_format($result->price, 2) ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php endforeach ?>


                    
                    <?php if($record_count == 0) : ?>
                        <tr><td colspan="6" style="text-align: center; font-style: italic">No formula components found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>
            
            <div class="span-6 right">
                <strong>Direct Material Cost (DMC):</strong> PhP <?php echo number_format($formula->direct_material_cost, 2) ?> <br/>
                <strong>Selling Price (PS):</strong> PhP <?php echo number_format($formula->selling_price, 2) ?> <br/>
                <strong>Net Price (PN):</strong> PhP <?php echo number_format($formula->net_price, 2) ?> <br/>
                <strong>OPEX:</strong> <?php echo $formula->opex ?> <br/>

                <strong>Quantity:</strong> <?php echo $formula->poitems->qty ?> Pcs<br/>
                
                <strong>Total Liters:</strong>
                        
                
                <?php 
                    
                    if(is_null($formula->poitems->product_price_id)) {
                       echo $formula->poitems->unitmaterials->size_liters;
                    }
                    else {
                        echo $formula->poitems->variants->package_size;
                    }
                
                ?>
                <br/>
                
                <strong>Total Volume:</strong> 
                
                <?php 
                    
                    if(is_null($formula->poitems->product_price_id)) {
                        echo ($formula->direct_material_cost * $formula->poitems->unitmaterials->size_liters) * $formula->poitems->qty;
                    }
                    else {
                        echo ($formula->direct_material_cost * $formula->poitems->variants->package_size) * $formula->poitems->qty;
                    }
                
                ?>
            </div>
        </div>
        
    </div>
    