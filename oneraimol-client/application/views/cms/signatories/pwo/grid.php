<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/so.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Production Work Order successfully ' . $success . '</span>' : ''; ?>
        
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <tr>
                            <th>PWO #</th>
                            <th>Date Created</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($productionworkorder as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><?php echo $result->pwo_id_string ?></td>
                            <td><?php echo $result->date_created ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/signatories/pwo/details/<?php echo Helper_Helper::encrypt($result->pwo_id)?>">Details</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="4" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>