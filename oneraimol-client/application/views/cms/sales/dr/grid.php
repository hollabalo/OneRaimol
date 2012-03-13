<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/sales/dr.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Delivery Receipt successfully ' . $success . '</span>' : ''; ?>
      <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
                <div class="span-24 last" id="formMenu">
                	<ul>
                        <li><a href="javascript:void(0)" onclick="create_dr()">Create Delivery Receipt</a></li>
                    </ul>
                </div>
                 <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <th><input type="checkbox" onclick="check_all(this);"/></th>
                            <th>SO #</th>
                            <th>Number of Items Ordered</th>
<!--                            <th>Items Done</th>-->
                            <th>&nbsp;</th>

                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($purchaseorder as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->so_id); ?>" id="chk<?php echo $result->so_id ?>"/></td>
                            <td><?php echo $result->so_id_string ?></td>
                            <td><?php echo $result->total_items ?></td>
<!--                            <td>&nbsp;</td>-->
                            <td><a href="<?php echo $base_url ?>cms/sales/dr/details/<?php echo Helper_Helper::encrypt($result->so_id)?>">Details</a></td>
                         </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="5" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>