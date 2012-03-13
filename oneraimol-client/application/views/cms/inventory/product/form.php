<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/product.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>


    <div id="msg">
        
       <?php if(isset($_GET['upload']) && ($_GET['upload'] == 'success')) : ?>
            <span class="success"><p>Product image upload successful.</p></span>
       <?php elseif(isset($_GET['upload']) && ($_GET['upload'] == 'fail')) : ?>
            <span class="error"><p>Product image upload failed. File size limit exceeded.</p></span>
       <?php endif ?>
        
    </div>

    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#item">Item</a></li>
        <li><a href="#price">Price</a></li>
        <li><a href="#stocks">Stocks</a></li>
    </ul>

<div class="tab-content">
    <div id="item" class="tab-pane active">

        <div id="msg"></div>

        <form id="product-form" method="post" action="<?php echo $base_url ?>cms/inventory/product/process_form/<?php if(isset($product)) echo Helper_Helper::encrypt($product->product_id) ?>">
    
            <table class="form">
                <?php if( isset($product) ) { ?>
                <input type="hidden" name="product_id" id="product_id" value="<?php echo Helper_Helper::encrypt($product->product_id); ?>" />
                <?php } ?>
                <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
        
                <tr>
                    <td colspan="3" class="table-section">product information</td>
                </tr>
                <tr>
                    <td style="width:20%" class="text-right"><span class="required">&ast;</span>Product Name</td>
                <td>
                <input class="dd-input" value="<?php if(isset($product)) echo $product->name ?>" name="name" type="text" id="name" />
                </td>
                <td style="width:40%">&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-right">Product Description</td>
                    <td>
                        <textarea name="description" id="description" class="fullWidth"><?php if(isset($product)) echo $product->description ?></textarea>
                    </td>
                    <td style="width:40%">&nbsp;</td>
                </tr>
  
                <tr>
                    <td class="text-right"><span class="required">&ast;</span>Category</td>
                    <td>
                        <span id="award">
                            <select name="material_category_id" id="parentcat">
                                <?php foreach($parentcat as $cat) :?>
                                    <option value="<?php echo Helper_Helper::encrypt($cat->pk()) ?>" <?php if($cat->pk() == $product->material_category_id) echo 'selected'; ?>><?php echo $cat->description ?></option>
                                <?php endforeach ?>
                            </select>
                        </span> 
                    </td>
                    <td style="width:40%">&nbsp;</td>
                 </tr>
                 <tr>
                    <td>&nbsp;</td>
                    <td>
                            <input name="btn_submit" type="submit" value="Save Product" />
                            <input name="btn_cancel" type="button" onclick="cancel_product()" value="Cancel" />
                    </td>
                    <td style="width:40%">&nbsp;</td>
                </tr>
        
            </table>
        </form>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/product.js" type="text/javascript"></script>

<form enctype="multipart/form-data" method="post" action="<?php echo str_replace('oneraimol/', '', $base_url)?>uploadprod.php">
    <table class="form">
        <tr>
            <td colspan="3" class="table-section">Product Image</td>
        </tr>
        
        <?php if(isset($product) && !is_null($product->picture) && ($product->picture != '') ) : ?>
        <tr>
            <td class="text-right">Current Uploaded Picture</td>
            <td><img src="<?php echo str_replace('oneraimol/', '', $base_url)?>productsthumbs/<?php echo $product->picture ?>" /></td>
            <td style="width:40%">&nbsp;</td>
        </tr>
        <?php endif ?>
        
        <tr>
            <td class="text-right" style="width:38%">
                <?php if(isset($product) && !is_null($product->picture) && ($product->picture != '')) : ?>
                    Replace Picture
                <?php else : ?>
                    Upload Picture
                <?php endif ?>
            </td>
            <td><input class="dd-input" id="file1" type="file" name="file"/><br/>
            <input type="hidden" name="record" value="<?php if(isset($product)) echo $product->pk() ?>" />
            <input type="hidden" name="url" value="<?php echo isset($url) ? $base_url . $url : ' '?>" />
            <input id="submit" type="submit" name="submit" value="Upload Picture"/> 
            </td>
            <td style="width:40%">&nbsp;</td>
        </tr>
       
    </table>
</form>

    </div>
    <div id="price" class="tab-pane">
 <div id="msg"></div>
        <?php echo isset($success) ? '<span class="alert-message success"><p>Product successfully ' . $success . '</p></span>' : ''; ?>
        
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                        <a href="<?php echo $base_url ?>cms/inventory/product/addprice/<?php echo Helper_Helper::encrypt($product->product_id) ?>">add price</a> |
                        <a href="javascript:void(0)" onclick="delete_productprice()">delete</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <!--sort by category -->
                        <!--sort by unit -->
                          <tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th>Name</th>
                            <th>Package Size</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>SKU</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($productprice as $result) :?>
                        <?php $record_count++;?>
                          <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->product_price_id); ?>" id="chk<?php echo $result->product_id ?>"/></td>
                            <td><?php echo $result->products->name ?></td>
                            <td><?php echo $result->package_size ?></td>
                            <td><?php echo $result->price ?></td>
                            <td><?php echo $result->unitmaterials->description ?></td>
                            <td><?php echo $result->sku ?></td>
                            <td><a href="<?php echo $base_url ?>cms/inventory/product/editprice/<?php echo Helper_Helper::encrypt($result->product_price_id)?>">Edit</a></td>
                          </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
    </div>        
    <div id="stocks" class="tab-pane">
 
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="alert-message success"><p>Product successfully ' . $success . '</p></span>' : ''; ?>
        
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                        <a href="<?php echo $base_url ?>cms/inventory/product/addstock/<?php echo Helper_Helper::encrypt($product->product_id) ?>">add stock</a> |
                        <a href="javascript:void(0)" onclick="delete_productstock()">delete</a>
                    </div>
                </div>
        <table class="fullWidth condensed-table zebra-striped">
            <thead>
            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
            <th>Liters</th>
            <th>Stock Date</th>
            <th>Expiration Date</th>
            <th>&nbsp;</th>
            </thead>
            <tbody>
                <?php $record_count = 0;?>
                <?php foreach($productstock as $result) :?>
                <?php $record_count++;?>
                <tr>
                    <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->product_stock_id); ?>" id="chk<?php echo $result->product_stock_id ?>"/></td>
                    <td><?php echo $result->liters ?></td>
                    <td><?php echo $result->stock_taking_date ?></td>
                    <td><?php echo $result->expiration_date ?></td>
                    <td><a href="<?php echo $base_url ?>cms/inventory/product/editstock/<?php echo Helper_Helper::encrypt($result->product_stock_id)?>">Edit</a></td>
                </tr>
                <?php endforeach ?>
                <?php if($record_count == 0) : ?>
                    <tr><td colspan="4" style="text-align: center; font-style: italic">No records found.</td></tr>
                <?php endif ?>
            </tbody>
        </table>

    </div>
</div>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/productprice.js" type="text/javascript"></script>