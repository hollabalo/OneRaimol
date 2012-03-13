<script src="<?php echo $base_url . $config['js'] ?>/store/catalog/cart.js" type="text/javascript"></script>

<div class="span-18">
    
    <div class="span-6"><h4>Purchase Order Information</h4></div>
    
    <div class="span-4 right last"><a href="<?php echo $base_url?>catalog/list/emptycart">Empty Cart</a></div>
    
</div>

<div id="errorcontainer" class="span-18 clearfix last">
    <div id="msg">

        <?php if(isset($action)) : ?>
            <?php if($action == 'qty' ) : ?>
            <label class="success">Item quantity successfully changed.</label>
            <?php elseif($action == 'delete') : ?>
            <label class="success">Item successfully deleted in cart.</label>
            <?php elseif($action == 'cartqty') : ?>
            <label class="success">Cart item quantities successfully changed.</label>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>

<div class="span-18">
    <form id="cartsh" method="post" action="<?php echo $base_url?>/catalog/list/process_edititemqty">
        <table class="cartTable">
            <thead>
                <tr>
                    <th class="qty">Qty</th>
                    <th class="text-center">Item Name</th>
                    <th>Packaging</th>
                    <th>Unit</th>
                    <th>Total</th>
                    <th>Total*Qty</th>
                    <th class="delete">&nbsp;</th>
                </tr>
            </thead>

            <tbody>

                <?php $totalcost = 0; ?>
                <?php $ctr = 0; ?>
                
                <?php foreach($items as $item) : ?>
                <tr>
                    <?php $product->where('product_price_id', '=', Helper_Helper::decrypt($item['product_price_id']))->find(); ?>
                    <td>
                        <input class="qtyInput" id="qty<?php echo $ctr ?>" name="qty[<?php echo $ctr?>]" value="<?php echo $item['qty'] ?>" maxlength="4"/>
                        <a href="javascript:void(0)" onclick="update_qty('<?php echo Helper_Helper::encrypt($item['seed'])?>', '<?php echo $ctr ?>')"><img src="<?php echo $base_url . $config['images']?>/button_update_cart.gif"/></a>
                    </td>
                    <td><?php echo $product->products->name ?></td>
                    <td><?php echo $product->unitmaterials->get_description() ?></td>
                    <td>PhP <?php echo number_format($product->price, 2) ?></td>
                    <td>PhP <?php echo number_format($product->price * $product->sku, 2)?></td>
                    <td>PhP <?php echo number_format(($product->price * $product->sku) * $item['qty'], 2) ?></td>
                    <td><a href="javascript:void(0)" onclick="delete_item('<?php echo Helper_Helper::encrypt($item['seed'])?>')"><img src="<?php echo $base_url . $config['images'] ?>/small_delete.gif"/></a></td>

                    <?php $totalcost+= ($product->price * $product->sku) * $item['qty'] ?>

                    <input type="hidden" class="qtyHidden" value="<?php echo $item['seed']?>" />
                    
                    <?php $product->clear() ?>
                </tr>
                    <?php $ctr++; ?>
                <?php endforeach ?>
            </tbody>

            <tfoot>
                <tr>
                    <td class="text-right text-bold" colspan="5">Total Estimated Cost:</td>
                    <td colspan="2">PhP <?php echo number_format($totalcost, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    
        <a class="button button-text"href="<?php echo $base_url?>checkout">Checkout</a>
    </form>
</div>


<?php 
    $str = '';

    for($i=0;$i<$ctr;$i++) {
        $str .= "qty[$i] : 'required',";
    }
    
    $str = rtrim($str, ',');

?>


<script type="text/javascript">

$( document ).ready(
    function() {
        $( '#cartsh' ).validate(
            {
                rules : {
                    <?php echo $str ?>
                },
                messages : {
                    terms   : message.missing,
                    delivery_date : message.missing
                },
                submitHandler : function() {
                    place_order();
                },
                errorPlacement: function( error ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);

</script>
    