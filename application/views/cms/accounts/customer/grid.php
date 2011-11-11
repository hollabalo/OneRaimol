<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<?php $form_js = Compress::instance('javascripts')->scripts(array($config['js'] . '/cms/accounts/customer.js'));
       echo HTML::script($form_js); ?>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Account successfully ' . $success . '</span>' : ''; ?>
        
                <div class="span-24 last" id="formMenu">
                	<ul>
                    	<li><a href="<?php echo $base_url ?>cms/accounts/customer/add">add</a></li>
                        <li><a href="javascript:void(0)" onclick="enable_customer()">enable</a></li>
                        <li><a href="javascript:void(0)" onclick="disable_customer()">disable</a></li>
                        <li><a href="javascript:void(0)" onclick="delete_customer()">delete</a></li>
                    </ul>
                </div>
                <table class="fullWidth">
                    <tbody>
                    	<tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th style="width:5%">Status</th>
                            <th style="width:37%">Name</th>
                            <th style="width:35%">Company</th>
                            <th style="width:15%">Username</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                        <?php $record_count = 0;?>
                        <?php foreach($customers as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->customer_id); ?>" id="chk<?php echo $result->customer_id ?>"/></td>
                            <td style="color: <?php echo $result->color_status(); ?>; font-weight: bold;">
                                <?php echo $result->status(); ?>
                            </td>
                            <td><?php echo $result->full_name() ?></td>
                            <td><?php echo $result->company ?></td> 
                            <td><?php echo $result->username ?></td>
                            <td><a href="<?php echo $base_url ?>cms/accounts/customer/edit/<?php echo Helper_Helper::encrypt($result->customer_id)?>">Edit</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>