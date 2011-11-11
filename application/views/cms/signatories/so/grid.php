<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

 <?php $form_js = Compress::instance('javascripts')->scripts(array($config['js'] . '/cms/signatories/so.js'));
       echo HTML::script($form_js); ?>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Account successfully ' . $success . '</span>' : ''; ?>
        
                <div class="span-24 last" id="formMenu">
                    <div class="column span-6" id="formMenu">
                       <ul>
                           <li><a href="javascript:void(0)" onclick="approve_so()">approve</a></li>
                           <li><a href="javascript:void(0)" onclick="disapprove_so()">disapprove</a></li>
                       </ul> 
                    </div>
                </div>
                <table class="fullWidth">
                    <tbody>
                    	<tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th style="width:40px;">Status</th>
                            <th style="width:60px;">SO #</th>
                            <th style="width:60px;">Approved</th>
                            <th>Client</th>
                            <th style="width:20%;">Contact Person</th>
                            <th style="width:12%;">Order Date</th>
                            <th style="width:12%;">Delivery Date</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                        <?php $record_count = 0;?>
                        <?php foreach($salesorder as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->so_id); ?>" id="chk<?php echo $result->so_id ?>"/></td>
                            <td><?php echo $result->get_status(); ?></td>
                            <td><?php echo $result->so_id ?></td>
                            <td style="color: <?php echo $result->get_color() ?>"><?php echo $result->get_approval() ?></td>
                            <td><?php echo $result->purchaseorders->customers->company ?></td> 
                            <td><?php echo $result->purchaseorders->customers->full_name() ?></td>
                            <td><?php echo $result->purchaseorders->order_date ?></td> 
                            <td><?php echo $result->purchaseorders->delivery_date ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/signatories/so/details/<?php echo Helper_Helper::encrypt($result->so_id)?>">Details</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>