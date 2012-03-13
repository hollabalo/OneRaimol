<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/product.js" type="text/javascript"></script>


<div id="msg"></div>
<form id="product-form" method="post" action="<?php echo $base_url ?>cms/inventory/product/process_form/<?php if(isset($product)) echo Helper_Helper::encrypt($product->product_id) ?>">
    <table class="form">
        <?php if( isset($product) ) { ?>
            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product->product_id; ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
        <tr>
            <td colspan="3" class="table-section">product information</td>
        </tr>
        <tr>
            <td class="text-right"><span class="required">&ast;</span>Product Name</td>
            <td>
                <input class="dd-input" value="<?php if(isset($product)) echo $product->name ?>" name="name" type="text" id="name" maxlength="50" />
            </td>
            <td style="width:40%">&nbsp;</td>
        </tr>
        <tr>
            <td class="text-right">Product Description</td>
            <td>
                <textarea name="description" class="fullWidth" id="description"><?php if(isset($product)) echo $product->description ?></textarea>
            </td>
            <td style="width:40%">&nbsp;</td>
        </tr>
        <tr>
            <td class="text-right"><span class="required">&ast;</span>Category Name</td>
            <td>
                <span id="catholder0">
                    <select name="material_category_id" id="subcatbox0" onchange="populate_cat(1)">
                        <?php foreach($parentcat as $cat) :?>
                            <option value="<?php echo Helper_Helper::encrypt($cat->pk()) ?>"><?php echo $cat->description ?></option>
                        <?php endforeach ?>
                    </select>
                </span>
                <span id="catholder1"></span>
                <span id="catholder2"></span>
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

    <script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/product.js" type="text/javascript"></script>