<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/catalog/list.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".productimage").fancybox();
	});
</script>

<?php if(Session::instance()->get('userid')) : ?>

<?php if(ORM::factory('customer')->where('customer_id', '=', Helper_Helper::decrypt(Session::instance()->get('userid')))->find()->deliveryaddresses->find_all()->count() == 0) : ?>
    <div class="notice">
        <p style="margin: 0;">You currently don't have any delivery address saved on your account. To make successful purchase orders, add a delivery address
          on your account via the <a href="<?php echo $base_url?>account/addresses/add">delivery address entry page</a>.</p>
    </div>
<?php endif ?>

<form id="formItemDetails" class="itemView" method="post" action="<?php echo $base_url?>catalog/list/process_form">
    <input type="hidden" name="product_id" value="<?php echo Helper_Helper::encrypt($item->pk()) ?>"/>
<?php endif ?>
    <table>
        <tbody>
            <tr>
                <td class="itemImage" align="center" style="width:100px;">
                    <a class="productimage" href="<?php echo Request::initial()->protocol() . '://' . $_SERVER['SERVER_NAME']?>/products/<?php echo isset($item->picture) && !is_null($item->picture) ? $item->picture : 'nopic.jpg' ?>">
                        <img width="80" height="80" class="listingProductImage" title="<?php echo $item->name ?>" alt="<?php echo $item->name ?>" src="<?php echo Request::initial()->protocol() . '://' .$_SERVER['SERVER_NAME']?>/productsthumbs/<?php echo isset($item->picture) && !is_null($item->picture) ? $item->picture : 'nopic.jpg' ?>"/>
                    </a>
                </td>
                <td class="itemDescription">
                    <h3><?php echo $item->name ?></h3>
                    <br />
                    <p><?php echo $item->description ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="packageSizeList" class="span-12">
        <h5>Package Sizes</h5>
        <table>
            <thead>
                <tr>
                    <th style="width:25%">Size</th>
                    <th style="width:25%">Price (Per Unit)</th>
                    <th style="width:25%">Packaging</th>
                </tr>
            </thead>
            
            <tbody>
                <?php if($item->productprice->find_all()->count() > 0) : ?>
                    <?php foreach($item->productprice->find_all() as $size) : ?>
                    <tr>
                        <td><?php echo $size->package_size ?>L</td>
                        <td>PhP <?php echo number_format(($size->price * $size->package_size) * $size->sku, 2) ?></td>
                        <td><?php echo $size->unitmaterials->get_description() ?></td>
                    </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr><td colspan="3" style="text-align:center;font-style:italic">Not available</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    
    <div id="cartBox" class="span-6 last">
        <div class="inside">
            <?php if(isset($cartbox)) : echo $cartbox ?>
            <?php else : echo 'ERROR: Cartbox not set.'?>
            <?php endif ?>
        </div>
    </div>
<?php if(Session::instance()->get('items')) : ?>
</form>
<?php endif ?>
<script src="<?php echo $base_url . $config['js'] ?>/store/catalog/form/view.js" type="text/javascript"></script>