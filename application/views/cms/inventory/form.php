<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/inventory.js" type="text/javascript"></script>

    <div id="msg"></div>
<form id="inventory-form" method="post" action="<?php echo $base_url ?>cms/inventory/inventory/process_form/<?php if(isset($product)) echo Helper_Helper::encrypt($product->product_id) ?>">
    <table class="form">
        <?php if( isset($product) ) { ?>
            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product->product_id; ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
        <tr>
            <td colspan="3" class="table-section">product information</td>
        </tr>
        <tr>
            <td class="right" style="width: 200px;">
                <span class="required">&ast;</span>Product Name
            </td>
            <td>
                <label for="productname"></label>
                <input class="dd-input" value="<?php if(isset($product)) echo $product->name ?>" name="productname" type="text" id="productname" maxlength="20" <?php if(isset($product)) echo 'disabled="disabled"' ?>/>
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>
        
        <tr>
              
             <?php
             $categoryproducts = ORM::factory('categoryproduct')
                            ->find_all();
             ?>
               <td class="right" width="83">Category</td>
                          <td width="101"><select name="category_id" id="category" size="7">
                 <?php foreach($categoryproducts as $category) : ?>
                    <option class="dd-input" value="<?php if(isset($category)) echo $category->category_id_1 ?>" <?php if(isset($category) && isset($product) && $category->category_id_1 == $product->category_id) echo 'selected';?>><?php echo $category->name ?></option>
                     <?php endforeach ?>
                    </select>
                  </td>
               
                
                                               
                                                                 
        </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
                    <input name="btn_submit" type="submit" value="Save Product" />
                    <input name="btn_cancel" type="button" onclick="cancel_product()" value="Cancel" />
            </td>
        </tr>
  </table>
</form>

<script type="text/javascript">
$( document ).ready(
    function() {
        $( '#inventory-form' ).validate(
            {
                rules : {
                    name           : 'required',
                    category       : 'required'
                
                },
                messages : {
                    name             : message.required,
                    category          : message.required

                },
                submitHandler : function() {
                    submit_product();
                },
                errorPlacement: function( error, element ) {
                    element.closest('tr')
                           .find('span:last')
                           .append( error );
                }
            }
        );
    }
);
</script>