
<?php if($salesorderitem->salesorders->purchaseorders->store_flag == "1") : ?>

<tr>
    <?php $ctr=0;?>
    <?php $ctr++;?>
    <td class="borderless" style="width:2%"><a href="#" id="item" onclick="add_row(<?php echo $ctr ?>,<?php echo $salesorderitem->so_item_id ?>)">add</a></td>
    <td class="borderless" id="item"><?php echo $salesorderitem->poitems->product_description ?></td>
    <td class="borderless" id="uom"><?php echo $salesorderitem->poitems->variants->unitmaterials->get_description() ?></td>
    <td class="borderless" id="qty"><?php echo $salesorderitem->poitems->qty ?></td>
    <td class="borderless" id="delivery_date"><?php echo $salesorderitem->poitems->purchaseorders->delivery_date ?></td>
</tr>

<?php elseif ($salesorderitem->salesorders->purchaseorders->store_flag == "2") : ?>
<tr>
    <?php $ctr=0;?>
    <?php $ctr++;?>
    <td class="borderless" style="width:2%"><a href="#" id="item" onclick="add_row(<?php echo $ctr ?>,<?php echo $salesorderitem->so_item_id ?>)">add</a></td>
    <td class="borderless" id="item"><?php echo $salesorderitem->poitems->product_description ?></td>
    <td class="borderless" id="uom"><?php echo $salesorderitem->poitems->unitmaterials->get_description() ?></td>
    <td class="borderless" id="qty"><?php echo $salesorderitem->poitems->qty ?></td>
    <td class="borderless" id="delivery_date"><?php echo $salesorderitem->poitems->purchaseorders->delivery_date ?></td>
</tr>
<?php endif ?>
