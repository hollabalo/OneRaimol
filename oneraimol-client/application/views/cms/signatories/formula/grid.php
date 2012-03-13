<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/formula.js" type="text/javascript"></script>


    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Formula successfully ' . $success . '</span>' : ''; ?>
        
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <tr>
                            <th style="width:60px;">Formula #</th>
                            <th style="width:60px;">PO #</th>
                            <th>Product</th>
                            <th style="width:20%;">Date Created</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($formula as $result) :?>
                            <?php $record_count++;?>
                        <tr>                            
                            <td><?php echo $result->formula_id_string ?></td>
                            <td><?php echo $result->poitems->purchaseorders->po_id_string ?></td> 
                            <td><?php echo $result->poitems->product_description ?></td>
                            <td><?php echo $result->date_created ?></td>
                            <td><a href="<?php echo $base_url ?>cms/signatories/formula/details/<?php echo Helper_Helper::encrypt($result->formula_id)?>">Details</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="5" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>