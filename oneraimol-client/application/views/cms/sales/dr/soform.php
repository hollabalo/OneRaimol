<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/so.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>


 
    <ul class="tabs" data-tabs="tabs">
        
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#general">General</a></li>
        <li><a href="#items">Items</a></li>
    </ul>
    

    
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                        
                    <td class="half borderless formData">
                        
                       <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Approved to SO:</td>
                                <td colspan="2"><?php echo $purchaseorder->salesorders->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Chief Executive Officer:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('ceo_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('ceo_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->ceo_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->ceo->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>General Manager:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('gm_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('gm_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->gm_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->approved->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('sc_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->sc_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->prepared->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Accountant:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('accountant_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('accountant_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->accountant_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->checked->full_name() ?></td>
                            </tr>

                        </table>
                        
                    </td>
                    
                </tr>
            </table>
           
        </div>
        <div id="general" class="tab-pane">
            <table class="fullWidth formData">
                <tr>
                    <td class="half borderless formData">
                        <fieldset>
                            <legend>Base Information</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td class="half">Date:</td>
                                    <td><?php echo $purchaseorder->salesorders->date_created ?></td>
                                </tr>
                                <tr>
                                    <td>Order #:</td>
                                    <td><?php echo $purchaseorder->salesorders->so_id_string ?></td>
                                </tr>
                                <tr>
                                    <td>Terms:</td>
                                    <td><?php echo $purchaseorder->terms ?></td>
                                </tr>
                                <tr>
                                    <td>PO #:</td>
                                    <td><?php echo $purchaseorder->po_id_string  ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>

                    <td class="half borderless formData">  
                        <fieldset>
                            <legend>Billing and Shipping</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td>Payment Method:</td>
                                    <td><?php echo $purchaseorder->payment_method ?></td>
                                </tr>
                                <tr>
                                    <td>Ship Date:</td>
                                    <td><?php echo $purchaseorder->delivery_date ?></td>
                                </tr>
                                <tr>
                                    <td>Bill To:</td>
                                    <td><?php echo $purchaseorder->deliveryaddresses->complete_address() ?></td>
                                </tr>
                                <tr>
                                    <td>Ship To:</td>
                                    <td><?php echo $purchaseorder->deliveryaddresses->complete_address() ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </div>
      
        <div id="items" class="tab-pane">
            <table class="fullWidth condensed-table zebra-striped ">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit of Material</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                        <th>Tax Rate</th>
                        <th>Gross Amount</th>
                        <th>Tax Amount</th>
                    </tr>
                </thead>
              <tbody>
                  <?php if($purchaseorder->store_flag == "1") : ?>
                                <?php $record_count = 0;?>                 
                                <?php foreach($purchaseorder->salesorders->soitems->find_all() as $item) : ?>
                                <?php $record_count++;?>        
                                <tr>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td><?php echo $item->poitems->qty ?></td>
                                    <td><?php echo $item->poitems->variants->unitmaterials->get_description() ?></td>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td>PhP <?php echo number_format($item->poitems->variants->price, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                                    <td><?php echo $item->taxcodes->description ?></td>
                                    <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                                </tr>
                                <?php endforeach ?>
                    <?php elseif ($purchaseorder->store_flag == "2") :?>
                                <?php $record_count = 0;?>                 
                                <?php foreach($purchaseorder->salesorders->soitems->find_all() as $item) : ?>
                                <?php $record_count++;?>        
                                <tr>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td><?php echo $item->poitems->qty ?></td>
                                    <td><?php echo $item->poitems->unitmaterials->get_description() ?></td>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td>PhP <?php echo number_format($item->poitems->unit_price, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                                    <td><?php echo $item->taxcodes->description ?></td>
                                    <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                                </tr>
                                <?php endforeach ?>
                    <?php endif ?>
              </tbody>
            </table>
         
        </div>
        
    </div>
   