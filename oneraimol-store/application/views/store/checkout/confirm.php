<script src="<?php echo $base_url . $config['js'] ?>/store/catalog/list.js" type="text/javascript"></script>

<div class="span-18">
    <div class="span-6"><h4>Confirm Purchase Order</h4></div>
</div>

<div id="msg"></div>

<form id="confirm" method="post" action="<?php echo $base_url?>checkout/process_checkout?fromconfirm">
    <div class="span-18">
        <div class="span-12">
            <table class="tablenozebra">
                <tr>
                    <td style="width:30%"><strong>Name:</strong></td>
                    <td><?php echo $user->full_name()?></td>
                </tr>
                <tr>
                    <td><strong>Company:</strong></td>
                    <td><?php echo $user->company ?></td>
                </tr>
                <tr>
                    <td><strong>Shipping Address:</strong></td>
                    <td><?php echo $shipping->complete_address(); ?></td>
                </tr>
            </table>
        </div>
        <div class="span-6 last">
            <div class="right">
                <em>Note: Delivery date is subject to change.</em>
            </div>
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

                <?php $totalcost = 0; ?>

                <?php foreach($items as $item) : ?>
                <tr>
                    <?php $product->where('product_price_id', '=', Helper_Helper::decrypt($item['product_price_id']))->find(); ?>
                    <td><?php echo $item['qty'] ?></td>
                    <td><?php echo $product->products->name ?></td>
                    <td><?php echo $product->unitmaterials->get_description() ?></td>
                    <td>PhP <?php echo number_format($product->price, 2) ?></td>
                    <td>PhP <?php echo number_format($product->price * $product->sku, 2) ?></td>
                    <td>PhP <?php echo number_format(($product->price * $product->sku) * $item['qty'], 2) ?></td>

                    <?php $totalcost+= ($product->price * $product->sku) * $item['qty'] ?>

                    <?php $product->clear() ?>
                </tr>
                <?php endforeach ?>
            </tbody>

            <tfoot>
                <tr>
                    <td class="text-right text-bold" colspan="5">Total Estimated Cost:</td>
                    <td colspan="2">PhP <?php echo number_format($totalcost, 2) ?></td>
                </tr>
            </tfoot>
        </table>

        <input type="hidden" name="order_amount" value="<?php echo $totalcost ?>" />
        
        <div class="span-12">
            <table class="tablenozebra">
                <tr>
                    <td style="width:30%;"><strong>Delivery Date:</strong></td>
                    <td><?php echo Helper_Helper::date($details['delivery_date'], 'D | M d, Y')?></td>
                </tr>
                <tr>
                    <td><strong>Terms:</strong></td>
                    <td><?php echo $details['terms'] ?></td>
                </tr>
                <tr>
                    <td><strong>Payment Method:</strong></td>
                    <td><?php echo $details['payment_method'] ?></td>
                </tr>
                <tr>
                    <td><strong>Special Instructions<br/>Comments:</strong></td>
                    <td><?php echo $details['order_comment']; ?></td>
                </tr>
            </table>
        </div>
        <div class="span-6 last">
            <div class="right">
                <input type="submit" class="button fullWidth" value="Confirm Purchase Order" />
                <div class="clearfix">&nbsp;</div>
                <input type="button" class="button fullWidth" value="Edit Purchase Order" onclick="checkout()"/>
            </div>
        </div>
    </div>
</form>