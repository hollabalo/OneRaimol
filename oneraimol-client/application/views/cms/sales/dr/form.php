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
    
    <input type="hidden" id="dr_id_encrypt" value="<?php echo Helper_Helper::encrypt($deliveryreceipt->dr_id) ?>" />
    
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                        
                    <td class="half borderless formData">
                        
                         <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Created DR:</td>
                                <td colspan="2"><?php echo $deliveryreceipt->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Production Manager:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('pm_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('pm_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->pm_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->received->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>General Manager:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('gm_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('gm_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->gm_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->approved->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('sc_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->sc_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->prepared->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Inventory Contoller:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('ic_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('ic_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->ic_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->received->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Laboratory Analyst:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('labanalyst_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('labanalyst_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->labanalyst_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->checked->full_name() ?></td>
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
                                    <td><?php echo $deliveryreceipt->date_created ?></td>
                                </tr>
                                <tr>
                                    <td>Order #:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->so_id_string ?></td>
                                </tr>
                                <tr>
                                    <td>Terms:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->terms ?></td>
                                </tr>
                                <tr>
                                    <td>PO #:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->po_id_string  ?></td>
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
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->payment_method ?></td>
                                </tr>
                                <tr>
                                    <td>Ship Date:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->delivery_date ?></td>
                                </tr>
                                <tr>
                                    <td>Bill To:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->deliveryaddresses->complete_address() ?></td>
                                </tr>
                                <tr>
                                    <td>Ship To:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->deliveryaddresses->complete_address() ?></td>
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
                                <?php foreach($deliveryreceipt->salesorders->soitems->find_all() as $item) : ?>
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
                                <?php foreach($deliveryreceipt->salesorders->soitems->find_all() as $item) : ?>
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
                                <?php if($record_count == 0) : ?>
                                    <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                                 <?php endif ?>
              </tbody>


            </table>
         
        </div>
        
    </div>
   