<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/production/pbt.js" type="text/javascript"></script>


    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Production Batch Ticket successfully ' . $success . '</span>' : ''; ?>
        <?php 
                $accessflag = FALSE;
                
                $pbtaccesslevel = array (
                Constants_UserType::ADMIN,
                Constants_UserType::HEAD_CHEMIST,
                Constants_UserType::SALES_COORDINATOR
                );
                
                foreach($pbtaccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
                <div class="span-24 last">
                    <div class="column span-6 last pull-right" id="formMenu">
                        <div class="pull-right">
                           <a onclick="release_pbt()" href="javascript:void(0)">release pbt</a>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <?php if($accessflag): ?>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <?php endif ?>
                            <th>Status</th>
                            <th>PBT #</th>
                            <th>Formula #</th>
                            <th>Product</th>
                            <th>Creation Date</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php $record_count = 0;?>
                    </thead>
                    <tbody>
                        <?php foreach($productionbatchticket as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <?php if($accessflag) : ?>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->pbt_id); ?>" id="chk<?php echo $result->pbt_id ?>"/></td>
                            <?php endif ?>
                            <td style="color: <?php echo $result->doccolor_status() ?>; font-weight: bold;">
                            <?php echo $result->doc_status() ?></td>
                            <td><?php echo $result->pbt_id_string; ?></td>
                            <td><?php echo $result->formulas->formula_id_string ?></td>
                            <td><?php echo $result->formulas->poitems->product_description ?></td>
                            <td><?php echo $result->date_created ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/production/pbt/update/<?php echo Helper_Helper::encrypt($result->pbt_id)?>">Edit</a></td>
                            <td><a href="<?php echo $base_url ?>cms/production/pbt/details/<?php echo Helper_Helper::encrypt($result->pbt_id)?>">Details</a></td>
                            <td><a href="<?php echo $base_url ?>cms/production/pbt/viewreport/<?php echo Helper_Helper::encrypt($result->pbt_id)?>">View</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="<?php if($accessflag) echo '9'; else echo '8' ?>" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>