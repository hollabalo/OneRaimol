<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/pwo.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#items">Items</a></li>
    </ul>
    
  
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData">
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Accountant:</td>
                                <td style="color: <?php echo $productionworkorder->color_status('accountant_approved_status') ?>; font-weight: bold;"><?php echo $productionworkorder->role_status('accountant_approved_status') ?></td>
                                <td><?php echo $productionworkorder->accountant_approved_date ?></td>
                                <td><?php echo $productionworkorder->noted->full_name()?></td>
                            </tr>
                            <tr>
                                <td>Head Chemist:</td>
                                <td style="color: <?php echo $productionworkorder->color_status('hc_approved_status') ?>; font-weight: bold;"><?php echo $productionworkorder->role_status('hc_approved_status') ?></td>
                                <td><?php echo $productionworkorder->hc_approved_date ?></td>
                                <td><?php echo $productionworkorder->approved->full_name()?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $productionworkorder->color_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $productionworkorder->role_status('sc_approved_status') ?></td>
                                <td><?php echo $productionworkorder->sc_approved_date ?></td>
                                <td><?php echo $productionworkorder->prepared->full_name()?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
      
        <div id="items" class="tab-pane">
            <table class="fullWidth condensed-table zebra-striped ">
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
                        <th>Invoice</th>
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
                            <td><?php echo $result->soitems->salesorders->purchaseorders->terms ?></td>
                            <td><?php echo $result->batch_no ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->delivery_date ?></td>
<!--                            <td><?php // echo $result->pwoitems->find()->dr_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->invoice_flag ?></td>
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
                            <td><?php echo $result->soitems->salesorders->purchaseorders->terms ?></td>
                            <td><?php echo $result->batch_no ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->delivery_date ?></td>
<!--                            <td><?php // echo $result->pwoitems->find()->dr_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->invoice_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->remarks ?></td>-->
                        </tr>
                     <?php endif ?>
                        <?php endforeach ?>
                     <?php //endforeach ?>
                     

                     <?php if($record_count == 0) : ?>
                        <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>
 
        </div>
        
    </div>
 