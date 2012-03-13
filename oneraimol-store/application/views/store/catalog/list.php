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
<?php endif ?>

<?php if(isset($search)) : ?>
<h2>Search Results</h2>
<?php else : ?>
<h2>Catalog: <?php echo isset($category) ? $category->description : 'All Products' ?></h2>
<?php endif ?>


<table class="detailView">
    <thead>
        <tr>
            <th>Image</th>
            <th>Item</th>
            <th>Prices</th>
        </tr>
    </thead>
    
    <tbody>
        <?php $recordcount = 0; ?>
        <?php foreach($items as $item) : ?>
        <?php $recordcount++ ?>
        <tr>
            <td align="center" style="width:85px;">
                <a class="productimage" href="<?php echo Request::initial()->protocol() . '://' . $_SERVER['SERVER_NAME']?>/products/<?php echo isset($item->picture) && !is_null($item->picture) ? $item->picture : 'nopic.jpg' ?>" title="<?php echo $item->name ?>">
                    <img width="80" height="80" class="listingProductImage" alt="<?php echo $item->name ?>" src="<?php echo Request::initial()->protocol() . '://' .$_SERVER['SERVER_NAME']?>/productsthumbs/<?php echo isset($item->picture) && !is_null($item->picture) ? $item->picture : 'nopic.jpg' ?>"/>
                </a>
            </td>
            <td>
                <h4><a href="<?php echo $base_url?>catalog/list/view/<?php echo Helper_Helper::encrypt($item->pk())?>"><?php echo $item->name ?></a></h4>
                <div class="listingDescription">
                        <?php echo rtrim(substr($item->description, 0, 150)) ?><?php echo rtrim(strlen($item->description)) > 151 ? '...' : ''?>
                </div>
            </td>
            <td align="right" style="width:170px;">
                
                <?php if($item->productprice->find_all()->count() > 0) : ?>
                
                    <?php foreach($item->productprice->find_all() as $price) :?>
                        PhP <?php echo number_format(($price->price * $price->package_size) * $price->sku, 2) ?> - <?php echo $price->unitmaterials->get_description() ?><br/>
                    <?php endforeach ?>
                <?php else : ?>
                        <em>Prices not yet available</em>
                <?php endif ?>
            </td>
        </tr>
        
        <?php endforeach ?>
        
        <?php if($recordcount == 0) : ?>
        <tr><td colspan="3" style="text-align: center"><em>No products found</em></td></tr>
        <?php endif ?>
        
    </tbody>
</table>

<div class="span-12 right"><?php echo isset($pagination) ? $pagination : '' ?></div>