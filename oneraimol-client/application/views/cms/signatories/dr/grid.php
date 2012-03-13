<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/dr.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Delivery Receipt successfully ' . $success . '</span>' : ''; ?>

                 <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <th>DR #</th>
                            <th>SO #</th>
                            <th>PO #</th>
                            <th>Customer</th>
                            <th>Company</th>
                            <th>Delivery Date</th>
                            <th>&nbsp;</th>

                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($deliveryreceipt as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><?php echo $result->dr_id_string ?></td>
                            <td><?php echo $result->salesorders->so_id_string ?></td>
                            <td><?php echo $result->salesorders->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->salesorders->purchaseorders->customers->full_name() ?></td>
                            <td><?php echo $result->salesorders->purchaseorders->customers->company ?></td>
                            <td><?php echo $result->salesorders->purchaseorders->delivery_date ?></td>
                            <td><a href="<?php echo $base_url ?>cms/signatories/dr/details/<?php echo Helper_Helper::encrypt($result->dr_id)?>">Details</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="7" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>