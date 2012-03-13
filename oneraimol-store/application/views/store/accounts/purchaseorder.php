<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/purchaseorder.js" type="text/javascript"></script>

<div class="span-18 last">
    <div class="span-6"><h4>Purchase Order: <?php echo $po->po_id_string?></h4></div>
</div>

<div id="errorcontainer" class="span-18 clearfix last">
    <div id="msg">

        <?php if(isset($success)) : ?>
            <label class="success">Order receive status successfully updated.</label>
        <?php endif ?>
    </div>
</div>

<div class="span-18 last">
    <div class="span-12">
        <table class="tablenozebra">
            <tr>
                <td style="width:30%"><strong>Name:</strong></td>
                <td><?php echo $po->customers->full_name()?></td>
            </tr>
            <tr>
                <td><strong>Company:</strong></td>
                <td><?php echo $po->customers->company ?></td>
            </tr>
            <tr>
                <td><strong>Shipping Address:</strong></td>
                <td><?php echo $po->deliveryaddresses->complete_address(); ?></td>
            </tr>
        </table>
    </div>
    
    <div class="span-6 last">
        <h5 class="text-emphasize">Purchase Order Status:</h5>

        <p class="text-emphasize right" style="font-size:11px;">
                <?php if(!is_null($po->so_id) && is_null($po->dr_id)) : ?>
                    Accepted to Sales Order as of <strong><?php echo Helper_Helper::date($po->salesorders->date_created, 'M d, Y') ?></strong>.
                <?php elseif(!is_null($po->so_id) && !is_null($po->dr_id)) : ?>
                    <?php if(!is_null($po->deliveryreceipts->delivered_date)) : ?>
                        <?php if(!is_null($po->deliveryreceipts->order_receive_status)) : ?>
                            <?php if($po->deliveryreceipts->order_receive_status == 1 ) : ?>
                                Order already delivered and received as of <strong><?php echo Helper_Helper::date($po->deliveryreceipts->date_order_received, 'M d, Y') ?></strong>.
                            <?php elseif($po->deliveryreceipts->order_receive_status == 0) : ?>
                                Order not received.
                            <?php elseif($po->deliveryreceipts->order_receive_status == 2 ) : ?>
                                Order already delivered and received as of <strong><?php echo Helper_Helper::date($po->deliveryreceipts->date_order_received, 'M d, Y') ?></strong>.<br/>(Delivery arrival status automatically verified by Rainchem)
                            <?php endif ?>
                        <?php else : ?>
                            Dispatched to client as of <strong><?php echo Helper_Helper::date($po->deliveryreceipts->delivered_date, 'M d, Y') ?></strong>.
                        <?php endif ?>
                    <?php else : ?>
                    
                    Ready for delivery as of <strong><?php echo Helper_Helper::date($po->deliveryreceipts->date_created, 'M d, Y') ?></strong>.
                    
                    <?php endif ?>
                <?php else : ?>
                    Purchase Order is still processed. 
                <?php endif ?>
        </p>
    </div>

    <table class="cartTable ">
        <thead>
            <tr>
                <th class="qty">Qty</th>
                <th class="text-center">Item Name</th>
                <th>Packaging</th>
                <th>Unit</th>
                <th>Total</th>
                <th>Total*Qty</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($po->poitems->find_all() as $item) : ?>
            <tr>
                <td><?php echo $item->qty ?></td>
                <td><?php echo $item->product_description ?></td>
                <td><?php echo $item->variants->unitmaterials->get_description()?></td>
                <td>PhP <?php echo number_format($item->variants->price, 2) ?></td>
                <td>PhP <?php echo number_format($item->variants->price * $item->variants->sku, 2)?></td>
                <td>PhP <?php echo number_format(($item->variants->price * $item->variants->sku) * $item->qty, 2) ?></td>
            </tr>   
            <?php endforeach ?>
        </tbody>

        <tfoot>
            <tr>
                <td class="text-right text-bold" colspan="5">Total Estimated Cost:</td>
                <td colspan="2">PhP <?php echo number_format($po->order_amount, 2) ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="span-12">
        <table class="tablenozebra">
            <tr>
                <td style="width:30%;"><strong>Delivery Date:</strong></td>
                <td><?php echo Helper_Helper::date($po->delivery_date, 'D | M d, Y') ?></td>
            </tr>
            <tr>
                <td><strong>Terms:</strong></td>
                <td><?php echo $po->terms ?></td>
            </tr>
            <tr>
                <td><strong>Payment Method:</strong></td>
                <td><?php echo $po->payment_method ?></td>
            </tr>
            <tr>
                <td><strong>Special Instructions<br/>Comments:</strong></td>
                <td><?php echo htmlentities($po->order_comment) ?></td>
            </tr>
        </table>
    </div>
    <div class="span-6 last">
        <div class="right">
            <p>If you want to download a copy of this purchase order details, click the button below.</p>
            <a class="button button-text" href="<?php echo $base_url?>account/history/generatepdf/<?php echo Helper_Helper::encrypt($po->pk()) ?>">Download PDF Copy</a>
        </div>
    </div>
</div>

<?php if(!is_null($po->deliveryreceipts->confirmation_code)) :?>
    <?php if($po->deliveryreceipts->order_receive_status == 0 ) : ?>
    <div class="span-9 last">
        <h4>Purchase Order Arrival Confirmation</h4>
        <p>If your purchase order has arrived and has been received, enter the confirmation code found on your delivery receipt: </p>

        <form id="order-receive" class="clearErrorFormat" method="post" action="<?php echo $base_url ?>account/history/receiveorder/<?php echo Helper_Helper::encrypt($po->pk())?>">
            <table>
                <tr>
                    <td style="padding: 0 10px; width:60%;"><input name="confirmation_code" id="confirmation_code" class="fullWidth"/></td>
                    <td style="padding: 0; width:40%;"><input class="button fullWidth" type="submit" value="Confirm PO Arrival" /></td>
                </tr>
            </table>
        </form>
    </div>

    <script src="<?php echo $base_url . $config['js'] ?>/store/accounts/form/purchaseorder.js" type="text/javascript"></script>
    <?php endif ?>
<?php endif ?>