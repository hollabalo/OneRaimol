<script type="text/javascript" src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js"></script>

<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/catalog/list.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
    }); 
</script>

<div class="span-18">
    <div class="span-6"><h4>Checkout</h4></div>
</div>

<div id="errorcontainer" class="span-18 clearfix last">
    <div id="msg"></div>
</div>

<div class="span-18">
    <form id="cartForm" method="post" action="<?php echo $base_url?>checkout/place">
        <table class="cartTable">
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
                    
                    <?php $totalcost += ($product->price * $product->sku) * $item['qty'] ?>

                    <?php $product->clear() ?>
                </tr>
                <?php endforeach ?>
            </tbody>

            <tfoot>
                <tr>
                    <td class="text-right text-bold" colspan="5">Total Estimated Cost:</td>
                    <td>PhP <?php echo number_format($totalcost, 2) ?></td>
                </tr>
            </tfoot>
        </table>
        
        <input type="hidden" id="order_amount" name="order_amount" value="<?php echo $totalcost ?>" />
        
        <div id="cartBox" class="span-12">
            <div class="inside">
                <div class="span-5"><h5>Purchase Order Information:</h5></div>
                <div class="span-3 right"><em><span class="required">*</span> - Required</em></div>
                
                <div class="cartInputs span-10 last">
                    <table id="cartInputTable" class="clearErrorFormat">
                        <tr>
                            <td class="text-right"><span class="required">*</span>Shipping Address:</td>
                            <td style="width:60%;" class="inputFullWidth">
                                <select name="delivery_address_id" class="fullWidth">
                                <?php foreach($user->deliveryaddresses->find_all() as $address) :?>
                                    <option value="<?php echo Helper_Helper::encrypt($address->pk())?>" <?php if(isset($_SESSION['purchaseorder'])) echo (Helper_Helper::decrypt($_SESSION['purchaseorder']['delivery_address_id']) == $address->pk()) ? 'selected="selected"' : ''?> ><?php echo $address->complete_address() ?></option>
                               <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><span class="required">*</span>Terms:</td>
                            <td><input id="terms" style="width:35px;" name="terms" maxlength="4" value="<?php echo isset($_SESSION['purchaseorder']) ? substr($_SESSION['purchaseorder']['terms'], 0, strpos($_SESSION['purchaseorder']['terms'], 'Days') - 1) : '' ?>" />&nbsp;Days</td>
                        </tr>
                        <tr>
                            <td class="text-right"><span class="required">*</span>Delivery Date:</td>
                            <td><input name="delivery_date" id="date" maxlength="10" value="<?php echo isset($_SESSION['purchaseorder']) ? $_SESSION['purchaseorder']['delivery_date'] : ''?>" /></td>
                        </tr>
                        <tr>
                            <td class="text-right"><span class="required">*</span>Payment Method:</td>
                            <td>
                                <select class="fullWidth" name="payment_method">
                                    <option></option>
                                    <option value="Cash/COD" <?php echo (isset($_SESSION['purchaseorder']) && ( $_SESSION['purchaseorder']['payment_method'] == 'Cash/COD')) ? 'selected="selected"' : ''?> >Cash/COD</option>
                                    <option value="Check" <?php echo (isset($_SESSION['purchaseorder']) && ( $_SESSION['purchaseorder']['payment_method'] == 'Check')) ? 'selected="selected"' : ''?> >Check</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Special Instructions / Comments:</td>
                            <td>
                                <textarea name="order_comment" style="width: 237px; height: 100px;"><?php echo isset($_SESSION['purchaseorder']) ? $_SESSION['purchaseorder']['order_comment'] : '' ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div id="checkoutSubmitBox" class="span-6 last">
            <p class="text-emphasize">Note: Delivery date is subject to change.</p>
            <div id="submitButton" class="span-6 last right"><input type="submit" class="prepend-top button fullWidth" value="Place Order"/></div>
        </div>
        
    </form>
</div>

<script src="<?php echo $base_url . $config['js'] ?>/store/catalog/form/place.js" type="text/javascript"></script>