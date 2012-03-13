
<?php if($item->productprice->find_all()->count() > 0) : ?>
        <h5>Add to Purchase Order:</h5>
        
        <div class="clearfix last" id="errorcontainer">
            <div id="msg"></div>
        </div>
        
            <div class="cartInputs">
                <table class="cartInputTable">
                    <tr>
                        <td style="text-align:right">Size:</td>
                        <td style="width:80%" class="inputFullWidth">
                            <select name="product">
                            <?php foreach($item->productprice->find_all() as $size) : ?>
                                <option value="<?php echo Helper_Helper::encrypt($size->pk())?>"><?php echo $size->unitmaterials->get_description() ?></option>
                            <?php endforeach ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right">Quantity:</td>
                        <td class="inputFullWidth"><input name="qty" maxlength="4" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="inputHalfWidth submit"><div class="right fullWidth"><input class="button" type="submit" value="Add Item" /></div></td>
                    </tr>
                </table>
            </div>
        
<?php else : ?>
        <h5>No prices yet</h5>
        <div class="cartInputs">
            <table class="cartInputTable">
                <tr><td><em>Prices not yet available. Check back this item later.</em></td></tr>
            </table>
        </div>
<?php endif ?>