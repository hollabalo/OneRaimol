<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/product.js" type="text/javascript"></script>


<div id="msg"></div>
<form id="productprice-form" method="post" action="<?php echo $base_url ?>cms/inventory/product/process_formprice/<?php if(isset($productprice)) echo Helper_Helper::encrypt($productprice->product_price_id) ?>">
<table class="form">
   
    <?php if(isset($productprice)) { ?>
    <input type="hidden" name="product_id" id="product_id" value="<?php echo Helper_Helper::encrypt($productprice->products->product_id); ?>" />
    <?php } ?>
    
    <?php if(isset($product)) { ?>
    <input type="hidden" name="product_id" id="product_id" value="<?php echo Helper_Helper::encrypt($product->product_id); ?>" />
    <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
        <tr>
            <td colspan="3" class="table-section">price information</td>
        </tr>
  <tr>
    <td class="right"><span class="required">&ast;</span>
        Price</td>
    <td>
        <label for="price"></label>
            <input class="dd-input" value="<?php if(isset($productprice)) echo $productprice->price ?>" name="price" type="text" id="productprice" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
  </tr> 
  <tr>
    <td class="right"><span class="required">&ast;</span>Package Size</td>
    <td>
        <label for="package_size"></label>
        <input class="dd-input" value="<?php if(isset($productprice)) echo $productprice->package_size ?>" name="package_size" type="text" id="description" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  
    <tr>
    <td class="right"><span class="required">&ast;</span>SKU</td>
    <td>
        <label for="sku"></label>
        <input class="dd-input" value="<?php if(isset($productprice)) echo $productprice->sku ?>" name="sku" type="text" id="sku" maxlength="11" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  
 
  <tr>
       <?php 
  $units = ORM::factory('unitmaterialtype')
      ->find_all();
  ?>
                  <td class="right">Unit</td>
                          <td><select name="um_id" id="um_id" size="4" multiple="single">
                 <?php foreach($units as $unit) : ?>
                    <option class="dd-input" value="<?php if(isset($units)) echo $unit->um_id ?>"><?php echo $unit->get_description() ?></option>
                     <?php endforeach ?>
                    </select>
                  </td>
  </tr>
  
            <tr>
            <td>&nbsp;</td>
            <td>
                    <input name="btn_submit" type="submit" value="Save Price" />
                    <input name="btn_cancel" type="button" onclick="cancel_productprice()" value="Cancel" />
            </td>
        </tr>
</table>
    
    <script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/productprice.js" type="text/javascript"></script>