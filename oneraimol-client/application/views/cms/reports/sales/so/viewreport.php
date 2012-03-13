<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/sales/so/generatepdf/<?php echo Helper_Helper::encrypt($salesorder->so_id) ?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>
<center><strong>SALES ORDER INFORMATION</strong></center>

<table class="condensed-table bordered-table">
  <tr>
    <td style="width:10%"><strong>Date</strong></td>
    <td><?php echo $salesorder->date_created ?></td>
  </tr>
  <tr>
    <td><strong>Order #</strong></td>
    <td><?php echo $salesorder->so_id_string ?></td>
  </tr>
  <tr>
    <td><strong>Payment Method</strong></td>
    <td><?php echo $salesorder->purchaseorders->payment_method ?></td>
  </tr>
  <tr>
    <td><strong>Terms</strong></td>
    <td><?php echo $salesorder->purchaseorders->terms ?></td>
  </tr>
  <tr>
    <td><strong>PO #</strong></td>
    <td><?php echo $salesorder->purchaseorders->po_id_string  ?></td>
  </tr>
  <tr><td><strong>Company</strong></td>
      <td><?php echo $salesorder->purchaseorders->customers->company ?></td>
  </tr>
  <tr>
      <td><strong>Customer Name</strong></td>
      <td><?php echo $salesorder->purchaseorders->customers->full_name() ?></td>
  </tr>    
  <tr>
    <td><strong>Ship Date:</strong></td>
    <td><?php echo $salesorder->purchaseorders->delivery_date ?></td>
  </tr>
</table>

<table class="condensed-table bordered-table">
  <tr>
    <td><strong>Bill to:</strong></td>
    <td><strong>Ship to:</strong></td>
  </tr>
  <tr>
    <td><?php echo $salesorder->purchaseorders->deliveryaddresses->complete_address() ?></td>
    <td><?php echo $salesorder->purchaseorders->deliveryaddresses->complete_address() ?></td>
  </tr>
</table>

<table class="condensed-table bordered-table">
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
                    <?php foreach($salesorder->soitems->find_all() as $item) : ?>
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
                    <?php foreach($salesorder->soitems->find_all() as $item) : ?>
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
   <div class="floatRight"><strong>PhP <?php echo number_format($salesorder->purchaseorders->order_amount, 2) ?> TOTAL</strong></div>


<table class="condensed-table">
  <tr>
    <td><strong>Prepared By:</strong></td>
    <td><strong>Checked By:</strong></td>
  </tr>
  <tr>
    <td>
        <center>
        <?php if(!is_null($salesorder->prepared->signature) && ($salesorder->prepared->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->prepared->signature ?>" />
            <hr/>
            <?php echo $salesorder->prepared->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->prepared->full_name() ?>
        <?php endif ?>
        </center> 
    </td>
    
    <td>
        <center>
        <?php if(!is_null($salesorder->checked->signature) && ($salesorder->checked->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->checked->signature ?>" />
            <hr/>
            <?php echo $salesorder->checked->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->checked->full_name() ?>
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
    <td><strong>CEO:</strong></td>
  </tr>
  <tr>
      <td>
        <center>
        <?php if(!is_null($salesorder->approved->signature) && ($salesorder->approved->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->approved->signature ?>" />
            <hr/>
            <?php echo $salesorder->approved->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->approved->full_name() ?>
        <?php endif ?>
        </center>
         
      </td>
      <td>
        <center>
        <?php if(!is_null($salesorder->ceo->signature) && ($salesorder->ceo->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->ceo->signature ?>" />
            <hr/>
            <?php echo $salesorder->ceo->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->ceo->full_name() ?>
        <?php endif ?>
        </center>  
            
      </td>
  </tr>

</table>