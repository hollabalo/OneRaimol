<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/production/pwo.js" type="text/javascript"></script>


    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Production Work Order successfully ' . $success . '</span>' : ''; ?>
         <?php 
                $accessflag = FALSE;
                
                $pwoaccesslevel = array (
                Constants_UserType::ADMIN,
                Constants_UserType::HEAD_CHEMIST,
                Constants_UserType::SALES_COORDINATOR
                );
                
                foreach($pwoaccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
                <div class="span-24 last">
                    <div class="column span-6 last pull-right" id="formMenu">
                        <div class="pull-right">
                            <a href="<?php echo $base_url ?>cms/production/pwo/add">new</a>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <?php if($accessflag) : ?>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <?php endif ?>
                            <th>Status</th>
                            <th>PWO #</th>
                            <th>Creation Date</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                        <?php $record_count = 0;?>
                    </thead>
                    <tbody>
                        <?php foreach($productionworkorder as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <?php if($accessflag):?>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->pwo_id); ?>" id="chk<?php echo $result->pwo_id ?>"/></td>
                            <?php endif ?>
                            <td style="color: <?php echo $result->doccolor_status() ?>; font-weight: bold;">
                            <?php echo $result->doc_status() ?></td>
                            <td><?php echo $result->pwo_id_string; ?></td>
                            <td><?php echo $result->date_created ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/production/pwo/details/<?php echo Helper_Helper::encrypt($result->pwo_id)?>">Details</a></td>
                            <td><a href="<?php echo $base_url ?>cms/production/pwo/viewreport/<?php echo Helper_Helper::encrypt($result->pwo_id)?>">View</a></td>
                       
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="<?php if($accessflag) echo '5'; else echo '4';?>" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>