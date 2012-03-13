<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/production/pwo/generatepdf/<?php echo Helper_Helper::encrypt($productionworkorder->pwo_id) ?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

         
        
            <table class="fullWidth condensed-table bordered-table ">
                <thead>
                    <tr>
                        <th>SO #</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>U/M</th>
                        <th>Customer</th>
                        <th>PO #</th>
                        <th>Terms</th>
                        <th>Batch #</th>
                        <th>Delivery Date</th>
<!--                        <th>DR</th>
                        <th>Remarks</th>-->
                    </tr>
                </thead>
                <tbody> 
                     <?php $record_count = 0;?>
                     <?php foreach($productionworkorder->pwoitems->find_all() as $result) :?>
                     <?php $record_count++;?>   
                    
                    <?php if($result->soitems->salesorders->purchaseorders->store_flag == "1") : ?>
                        <tr>
                            <td><?php echo $result->soitems->salesorders->so_id_string  ?></td>
                            <td><?php echo $result->soitems->poitems->product_description ?></td>
                            <td><?php echo $result->soitems->poitems->qty ?></td>
                            <td><?php echo $result->soitems->poitems->variants->unitmaterials->get_description() ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->customers->full_name(); ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->terms?></td>
                            <td><?php echo $result->batch_no ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->delivery_date ?></td>
<!--                            <td><?php // echo $result->pwoitems->find()->dr_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->remarks ?></td>-->
                        </tr>
                    <?php elseif ($result->soitems->salesorders->purchaseorders->store_flag == "2") : ?>
                        <tr>
                            <td><?php echo $result->soitems->salesorders->so_id_string  ?></td>
                            <td><?php echo $result->soitems->poitems->product_description ?></td>
                            <td><?php echo $result->soitems->poitems->qty ?></td>
                            <td><?php echo $result->soitems->poitems->unitmaterials->get_description() ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->customers->full_name(); ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->terms?></td>
                            <td><?php echo $result->batch_no ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->delivery_date ?></td>
<!--                            <td><?php // echo $result->pwoitems->find()->dr_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->remarks ?></td>-->
                        </tr>
                     <?php endif ?>
                        <?php endforeach ?>               
                     <?php if($record_count == 0) : ?>
                        <tr><td colspan="12" style="text-align: center; font-style: italic">No records found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>

<table class="condensed-table bordered-table">
  <tr>
    <td><strong>Prepared By:</strong></td>
    <td><strong>Noted By:</strong></td>
  </tr>
  <tr>
    <td>
        <center>
        <?php if(!is_null($productionworkorder->prepared->signature) && ($productionworkorder->prepared->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionworkorder->prepared->signature ?>" />
            <hr/>
            <?php echo $productionworkorder->prepared->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionworkorder->prepared->full_name() ?>
        <?php endif ?>
        </center> 
    </td>
    
    <td>
        <center>
        <?php if(!is_null($productionworkorder->noted->signature) && ($productionworkorder->noted->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionworkorder->noted->signature ?>" />
            <hr/>
            <?php echo $productionworkorder->noted->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionworkorder->noted->full_name() ?>
        <?php endif ?>
        </center>
    </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Approved By:</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td>
        <center>
        <?php if(!is_null($productionworkorder->approved->signature) && ($productionworkorder->approved->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $productionworkorder->approved->signature ?>" />
            <hr/>
            <?php echo $productionworkorder->approved->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $productionworkorder->approved->full_name() ?>
        <?php endif ?>
        </center>
         
      </td>
      <td>&nbsp;</td>
  </tr>

</table>