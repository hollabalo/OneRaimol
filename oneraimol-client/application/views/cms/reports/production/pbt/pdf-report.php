<html>
    <title>
        
    </title>
    
    <head>
        
    </head>
    
    <body>

    <table class="condensed-table bordered-table">
    	<tr>
            <td style="width:20%">Product Code</td>
            <td><?php echo $productionbatchticket->product_code ?></td>
        </tr>
        <tr>
            <td>Batch #</td>
            <td><?php echo $productionbatchticket->formulas->pwoitems->batch_no ?></td>
     	</tr>
        <tr>
            <td>Blending Time Required</td>
            <td><?php echo $productionbatchticket->blending_time_required ?></td>
        </tr>
        <tr>
            <td>Product Description</td>
            <td><?php echo $productionbatchticket->formulas->poitems->product_description ?></td>
        </tr>
        <tr>
            <td>Customer</td>
            <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->customers->full_name() ?></td>
        </tr>
        <tr>
            <td>Quantity Required</td>
            <td><?php echo $productionbatchticket->formulas->poitems->qty ?></td>
        </tr>
        <tr>
            <td>Required Delivery Date</td>
            <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->delivery_date ?></td>
        </tr>    
        <tr>
            <td>Packaging Required:</td>
            <?php if($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "1") : ?>
            <td><?php echo $productionbatchticket->formulas->poitems->variants->unitmaterials->description ?></td>
            <?php elseif ($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "2") : ?>
            <td><?php echo $productionbatchticket->formulas->poitems->unitmaterials->description ?></td>
            <?php endif ?>
        </tr>
        <tr>
            <td>Reference P.W.O. #:</td>
            <td><?php echo $productionbatchticket->formulas->pwoitems->productionworkorders->pwo_id_string ?></td>
        </tr>    
        <tr>
            <td>Reference P.O. #</td>
            <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->po_id_string ?></td>
        </tr>  
        <tr>
            <td>Performed By</td>
            <td><?php echo $productionbatchticket->production_performed_by ?>
            </td>
        </tr> 
        <tr>
            <td>Date Produced</td>
            <td><?php echo $productionbatchticket->date_produced ?></td>
        </tr> 
    </table>
    


        <table class="condensed-table bordered-table">
 
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
            <td><?php  echo $productionbatchticket->py_theoretical ?></td>
            <td><?php  echo $productionbatchticket->py_actual ?></td>
            <td><?php  echo $productionbatchticket->variance ?></td>
        </tr>        
        <tr>
            <td>Machine No. / Description</td>
            <td>Blending Time</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $productionbatchticket->machine_desc ?></td>
            <td><?php echo $productionbatchticket->blending_time ?></td>
            <td>&nbsp;</td>
        </tr>


        <tr>
            <td>Overall Comments / Remarks:<?php echo $productionbatchticket->remarks ?></td>
        </tr>        
    </table>

    
 

        

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

<br/><br/><br/><br/>

<table class="condensed-table bordered-table">
  <tr>
    <td><strong>Prepared By:</strong></td>
    <td><strong>Noted By:</strong></td>
  </tr>
  <tr>
    <td>
        <center>
        <?php if(!is_null($productionbatchticket->prepared->signature) && ($productionbatchticket->prepared->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionbatchticket->prepared->signature ?>" />
            <hr/>
            <?php echo $productionbatchticket->prepared->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionbatchticket->prepared->full_name() ?>
        <?php endif ?>
        </center> 
    </td>
    
    <td>
        <center>
        <?php if(!is_null($productionbatchticket->noted->signature) && ($productionbatchticket->noted->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionbatchticket->noted->signature ?>" />
            <hr/>
            <?php echo $productionbatchticket->noted->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionbatchticket->noted->full_name() ?>
        <?php endif ?>
        </center>
    </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Checked By (QA):</strong></td>
    <td><strong>Checked By (Chemist):</strong></td>
  </tr>
  <tr>
      <td>
        <center>
        <?php if(!is_null($productionbatchticket->checked_one->signature) && ($productionbatchticket->checked_one->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionbatchticket->checked_one->signature ?>" />
            <hr/>
            <?php echo $productionbatchticket->checked_one->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionbatchticket->checked_one->full_name() ?>
        <?php endif ?>
        </center>
         
      </td>
      <td>
        <center>
        <?php if(!is_null($productionbatchticket->checked_two->signature) && ($productionbatchticket->checked_two->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionbatchticket->checked_two->signature ?>" />
            <hr/>
            <?php echo $productionbatchticket->checked_two->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionbatchticket->checked_two->full_name() ?>
        <?php endif ?>
        </center>
            
      </td>
  </tr>

</table>

    </body>
</html>