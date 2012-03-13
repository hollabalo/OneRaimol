<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/sales/dr/generatepdf/<?php echo Helper_Helper::encrypt($deliveryreceipt->dr_id) ?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<table class="bordered-table condensed-table">
  <tr>
    <td style="width:10%"><strong>Date</strong></td>
    <td ><?php echo $deliveryreceipt->salesorders->date_created ?></td>
  </tr>
  <tr>
    <td><strong>Order #</strong></td>
    <td><?php echo $deliveryreceipt->salesorders->so_id_string ?></td>
  </tr>
  <tr>
    <td><strong>Payment Method</strong></td>
    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->payment_method ?></td>
  </tr>
  <tr>
    <td><strong>Terms</strong></td>
    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->terms ?></td>
  </tr>
  <tr>
    <td><strong>PO #</strong></td>
    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->po_id_string  ?></td>
  </tr>
    <tr><td><strong>Company</strong></td>
      <td><?php echo $deliveryreceipt->salesorders->purchaseorders->customers->company ?></td>
  </tr>
  <tr>
      <td><strong>Customer Name</strong></td>
      <td><?php echo $deliveryreceipt->salesorders->purchaseorders->customers->full_name() ?></td>
  </tr>  
  <tr>
    <td><strong>Ship Date:</strong></td>
    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->delivery_date ?></td>
  </tr>
  <tr>
      <td><strong>Confirmation Code</strong></td>
      <?php if(!is_null($deliveryreceipt->confirmation_code)) :?>
      <td><?php echo $deliveryreceipt->confirmation_code ?></td>
      <?php else :?>
      <td>PENDING FOR DELIVERY</td>
      <?php endif ?>
  </tr>  
</table>




<table class="bordered-table condensed-table">
  <tr>
    <td><strong>Bill to:</strong></td>
    <td><strong>Ship to:</strong></td>
  </tr>
  <tr>
    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->deliveryaddresses->complete_address() ?></td>
    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->deliveryaddresses->complete_address() ?></td>
  </tr>
</table>

    



<table class="bordered-table condensed-table">
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
                    <?php $record_count = 0;?>                 
                    <?php foreach($deliveryreceipt->salesorders->soitems->find_all() as $item) : ?>
                    <?php $record_count++;?>    
      <?php if($deliveryreceipt->salesorders->purchaseorders->store_flag == "1") : ?>
                    <tr>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td><?php echo $item->poitems->qty ?></td>
                        <td><?php echo $item->poitems->variants->unitmaterials->get_description() ?></td>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td><?php echo $item->poitems->variants->price ?></td>
                        <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                        <td><?php echo $item->taxcodes->description ?></td>
                        <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                        <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                    </tr>
        <?php elseif($deliveryreceipt->salesorders->purchaseorders->store_flag == "2") :?>
                    <tr>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td><?php echo $item->poitems->qty ?></td>
                        <td><?php echo $item->poitems->unitmaterials->get_description() ?></td>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td><?php echo $item->poitems->unit_price ?></td>
                        <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                        <td><?php echo $item->taxcodes->description ?></td>
                        <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                        <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                    </tr>
                    
        <?php endif ?>
                    
                    <?php endforeach ?>
  </tbody>
  
</table>
       <div class="floatRight"><strong>PhP <?php echo number_format($deliveryreceipt->salesorders->purchaseorders->order_amount, 2) ?> TOTAL</strong></div>


<table class="condensed-table bordered-table">
  <tr>
    <td><strong>Prepared By:</strong></td>
    <td><strong>Checked By:</strong></td>
  </tr>
  <tr>
    <td>
        <center>
        <?php if(!is_null($deliveryreceipt->prepared->signature) && ($deliveryreceipt->prepared->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $deliveryreceipt->prepared->signature ?>" />
            <hr/>
            <?php echo $deliveryreceipt->prepared->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $deliveryreceipt->prepared->full_name() ?>
        <?php endif ?>
        </center> 
    </td>
    
    <td>
        <center>
        <?php if(!is_null($deliveryreceipt->checked->signature) && ($deliveryreceipt->checked->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $deliveryreceipt->checked->signature ?>" />
            <hr/>
            <?php echo $deliveryreceipt->checked->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $deliveryreceipt->checked->full_name() ?>
        <?php endif ?>
        </center>
    </td>
  </tr>
  <tr>
      <td><hr width="200px" /></td>
      <td><hr width="200px" /></td>
  </tr>
  <tr>
    <td><center>Approved By:</center></td>
    <td><center>Released By:</center></td>
  </tr>
  <tr>
      <td>
        <center>
        <?php if(!is_null($deliveryreceipt->approved->signature) && ($deliveryreceipt->approved->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $deliveryreceipt->approved->signature ?>" />
            <hr/>
            <?php echo $deliveryreceipt->approved->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $deliveryreceipt->approved->full_name() ?>
        <?php endif ?>
        </center>
         
      </td>
      <td>
        <center>
        <?php if(!is_null($deliveryreceipt->released->signature) && ($deliveryreceipt->released->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $deliveryreceipt->released->signature ?>" />
            <hr/>
            <?php echo $deliveryreceipt->released->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $deliveryreceipt->released->full_name() ?>
        <?php endif ?>
        </center>  
            
      </td>
  </tr>
  <tr>
      <td><strong>Received By:</strong></td>
  </tr>
  <tr>
    <td>
        
        <center>
        <?php if(!is_null($deliveryreceipt->received->signature) && ($deliveryreceipt->received->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $deliveryreceipt->received->signature ?>" />
            <hr/>
            <?php echo $deliveryreceipt->received->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $deliveryreceipt->received->full_name() ?>
        <?php endif ?>
        </center>
        
    </td>
  </tr>
</table>