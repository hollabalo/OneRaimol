<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/sales/so.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        
                 <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <th>Status</th>
                            <th>SO #</th>
                            <th>PO #</th>
                            <th>Customer</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($salesorder as $result) :?>
                        <?php $record_count++;?>
                        <tr>
                            <td style="color: <?php echo $result->doccolor_status() ?>; font-weight: bold;">
                            <?php echo $result->doc_status() ?></td>
                            <td><?php echo $result->so_id_string ?></td>
                            <td><?php echo $result->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->purchaseorders->customers->company ?></td>
                            <td><?php echo $result->purchaseorders->order_date ?></td>
                            <td><?php echo $result->purchaseorders->delivery_date ?></td>
                            <td><a href="<?php echo $base_url ?>cms/sales/so/details/<?php echo Helper_Helper::encrypt($result->so_id)?>">Details</a></td>
                            <td><a href="<?php echo $base_url ?>cms/sales/so/viewreport/<?php echo Helper_Helper::encrypt($result->so_id)?>">View</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="7" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>