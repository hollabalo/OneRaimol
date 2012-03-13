<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/sales/po/generatepdf/<?php echo Helper_Helper::encrypt($purchaseorder->po_id) ?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<strong><center>PURCHASE ORDER INFORMATION</center></strong>

<table class="bordered-table condensed-table">
  <tr>
    <td width="120"><strong>Date</strong></td>
    <td><?php echo $purchaseorder->date_created ?></td>
  </tr>
  <tr>
    <td><strong>Purchase Order #</strong></td>
    <td><?php echo $purchaseorder->po_id_string ?></td>
  </tr>
  <tr><td><strong>Company</strong></td>
      <td><?php echo $purchaseorder->customers->company ?></td>
  </tr>
  <tr>
      <td><strong>Customer Name</strong></td>
      <td><?php echo $purchaseorder->customers->full_name() ?></td>
  </tr>
  <tr><td><strong>Address</strong></td>
      <td><?php echo $purchaseorder->deliveryaddresses->complete_address() ?></td>
  </tr>
  <tr><td><strong>Contact Number</strong></td>
       <td><?php echo $purchaseorder->customers->telephone_no ?></td>
  </tr>
</table>

<div id="spacer"></div>

<table class="bordered-table condensed-table">
    <thead>
  <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
  </tr>
    </thead>
  <tbody>
                     <?php foreach($purchaseorder->poitems->find_all() as $record) : ?>
                              <?php if($purchaseorder->store_flag == "1") : ?>
                        <tr>
                            <td><?php echo $record->product_description ?></td>
                            <td><?php echo $record->qty ?></td>
                            <td><?php echo $record->variants->unitmaterials->get_description() ?></td>
                            <td>PhP <?php echo number_format($record->variants->price, 2) ?></td>
                            <td>PhP <?php echo number_format(($record->qty * $record->variants->price),2) ?></td>
                        </tr>
                        <?php elseif ($purchaseorder->store_flag == "2") :?>
                        <tr>
                            <td><?php echo $record->product_description ?></td>
                            <td><?php echo $record->qty ?></td>
                            <td><?php echo $record->unitmaterials->get_description() ?></td>
                            <td>PhP <?php echo number_format($record->unit_price, 2) ?></td>
                            <td>PhP <?php echo number_format(($record->qty * $record->unit_price), 2) ?></td>
                        </tr>
                        <?php endif ?>

                   <?php endforeach ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>PhP <?php echo number_format($purchaseorder->order_amount, 2) ?> TOTAL</strong></td>
                    </tr>
  </tbody>
  
</table>
