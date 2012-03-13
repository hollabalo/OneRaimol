<div id="orderHistory">
    <div class="span-18 last">
    
        <h4>Order History</h4>
        <p>All your previous purchase orders are listed here including the approved, disapproved, and pending.</p>
    </div>
    
    <div class="span-18 last">
        <table>
            <thead>
                <tr>
                    <th>PO #</th>
                    <th>Products</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
    <?php foreach($purchaseorder as $po) :?>
                <tr>
                    <td><?php echo $po->po_id_string ?></td>
                    <td><?php echo $po->poitems->find_all()->count()?></td>
                    <td><?php echo $po->order_date?></td>
                    <td><?php echo $po->delivery_date ?></td>
                    <td><a href="<?php echo $base_url?>account/history/vieworder/<?php echo Helper_Helper::encrypt($po->pk()) ?>">View</a></td>
                </tr>
    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="span-6 right"><?php echo isset($pagination) ? $pagination : ''?></div>