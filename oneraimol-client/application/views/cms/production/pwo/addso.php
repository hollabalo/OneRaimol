
<?php if($salesorderitem->salesorders->purchaseorders->store_flag == "1") : ?>
<tr>
<!--    <input type="hidden" name="id[]" value="<?php //echo $salesorder->soitems->find()->po_item_id ?>"/>-->
    <input type="hidden" name="so_item_id[]" value="<?php echo $salesorderitem->so_item_id ?>"/>
    <td class="borderless" id="so_id_string"><?php echo $salesorderitem->salesorders->so_id_string ?></td>
    <td class="borderless" id="item"><?php echo $salesorderitem->poitems->product_description ?></td>
    <td class="borderless" id="uom"><?php echo $salesorderitem->poitems->variants->unitmaterials->get_description() ?></td>
    <td class="borderless" id="qty"><?php echo $salesorderitem->poitems->qty ?></td>
    <td class="borderless" id="delivery_date"><?php echo $salesorderitem->poitems->purchaseorders->delivery_date ?></td>
    <td class="borderless" style="width:2%"><a href="#" id="itemremove" onclick="remove_row(<?php echo $salesorderitem->so_item_id ?>)">remove</a></td>
</tr>

<?php elseif ($salesorderitem->salesorders->purchaseorders->store_flag == "2") : ?>

<tr>
<!--    <input type="hidden" name="id[]" value="<?php //echo $salesorder->soitems->find()->po_item_id ?>"/>-->
    <input type="hidden" name="so_item_id[]" value="<?php echo $salesorderitem->so_item_id ?>"/>
    <td class="borderless" id="so_id_string"><?php echo $salesorderitem->salesorders->so_id_string ?></td>
    <td class="borderless" id="item"><?php echo $salesorderitem->poitems->product_description ?></td>
    <td class="borderless" id="uom"><?php echo $salesorderitem->poitems->unitmaterials->get_description() ?></td>
    <td class="borderless" id="qty"><?php echo $salesorderitem->poitems->qty ?></td>
    <td class="borderless" id="delivery_date"><?php echo $salesorderitem->poitems->purchaseorders->delivery_date ?></td>
    <td class="borderless" style="width:2%"><a href="#" id="itemremove" onclick="remove_row(<?php echo $salesorderitem->so_item_id ?>)">remove</a></td>
</tr>

<?php endif ?>