<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/inventory.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Product successfully ' . $success . '</span>' : ''; ?>
        
                <div class="span-24 last" id="formMenu">
                	<ul>
                    	<li><a href="<?php echo $base_url ?>cms/inventory/inventory/add">add</a></li>
                        <li><a href="javascript:void(0)" onclick="delete_product()">delete</a></li>
                    </ul>
                </div>
                <table class="fullWidth">
                    <tbody>
                    	<tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                        
                        <?php
//                        foreach($cats as $key => $value) {
//                            if(is_array($key)) {
//                                foreach($value as $keys => $values) {
//                                    if(is_array($keys)) {
//                                        foreach($keys as $val) {
//                                            
//                                        }
//                                    }
//                                }
//                            }
//                        }
                        
                        ?>
                        
                        <?php $record_count = 0;?>
                        <?php foreach($products as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->product_id); ?>" id="chk<?php echo $result->product_id ?>"/></td>
                            <td><?php echo $result->name ?></td>
                            <td><?php echo $result->categories->name ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/inventory/inventory/edit/<?php echo Helper_Helper::encrypt($result->product_id)?>">Edit</a></td>
                        </tr>
                        <?php endforeach ?>                        
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
        <div class="pagination-container">
                 <?php echo $pagelinks; ?>
            </div>