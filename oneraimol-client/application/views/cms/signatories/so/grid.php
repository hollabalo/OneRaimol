<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/so.js" type="text/javascript"></script>


    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Sales Order successfully ' . $success . '</span>' : ''; ?>
        
                <table class="fullWidth condensed-table zebra-striped" id="table">
                    <thead>
                        <tr>
                            <th style="width:60px;">SO #</th>
                            <th>PO #</th>
                            <th>Client</th>
                            <th style="width:20%;">Contact Person</th>
                            <th style="width:12%;">Order Date</th>
                            <th style="width:12%;">Delivery Date</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($salesorder as $result) :?>
                            <?php $record_count++;?>
                        <tr id="row<?php echo $record_count ?>">                           
                            <td><?php echo $result->so_id_string ?></td>
                            <td><?php echo $result->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->purchaseorders->customers->company ?></td> 
                            <td><?php echo $result->purchaseorders->customers->full_name() ?></td>
                            <td><?php echo $result->purchaseorders->order_date ?></td> 
                            <td><?php echo $result->purchaseorders->delivery_date ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/signatories/so/details/<?php echo Helper_Helper::encrypt($result->so_id)?>">Details</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>
