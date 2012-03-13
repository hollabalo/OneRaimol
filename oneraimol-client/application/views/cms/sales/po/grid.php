<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/sales/so.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/sales/po.js" type="text/javascript"></script>


    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Purchase Order successfully ' . $success . '</span>' : ''; ?>
                
            <!-- filter pending, approval, disapprove       -->
                <div class="span-24 last" id="gridBottom">
                    <div class="column span-14 left" id="recordLimit">
                        Filter&nbsp;
                        <select id="filterpo" name="showrecord" 
                                onchange="filter_record()">
                            <option value="<?php echo Helper_Helper::encrypt('0'); ?>" <?php if(isset($selected)) echo ($selected == '0') ? 'selected="selected"' : '' ?>>Pending</option>
                            <option value="<?php echo Helper_Helper::encrypt('1'); ?>" <?php if(isset($selected)) echo ($selected == '1') ? 'selected="selected"' : '' ?>>Approved</option>
                            <option value="<?php echo Helper_Helper::encrypt('2'); ?>" <?php if(isset($selected)) echo ($selected == '2') ? 'selected="selected"' : '' ?>>Disapproved</option>
                            <option value="all" <?php  if(!isset($selected)) echo 'selected="selected"'  ?>>All</option>
                        </select>
                    </div>
                </div>
                <div class="span-24 last">
                    <div class="column span-6 last pull-right" id="formMenu">
                        <div class="pull-right">
                            <a href="<?php echo $base_url ?>cms/sales/po/add">new purchase order</a>
<!--                            <a onclick="approve_po()" href="javascript:void(0)" class="btn small">approve</a>
                            <a onclick="disapprove_po()" href="javascript:void(0)" class="btn small">disapprove</a>-->
                        </div>
                    </div>
                </div>

                <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th>Status</th>
                            <th>PO #</th>
                            <th>Company</th>
                            <th>Delivery Address</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th style="width:6%">&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php $record_count = 0;?>
                    </thead>
                    <tbody>
                        <?php foreach($purchaseorder as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->po_id); ?>" id="chk<?php echo $result->po_id ?>"/></td>
                            <td style="color: <?php echo $result->color_status(); ?>; font-weight: bold;">
                                <?php echo $result->status(); ?>
                            </td>
                            <td><?php echo $result->po_id_string ?></td>
                            <td><?php echo $result->customers->company ?></td>
                            <td><?php echo $result->deliveryaddresses->complete_address()?></td>
                            <td><?php echo $result->order_date ?></td>
                            <td><?php echo $result->delivery_date  ?></td> 
                            <td><a href="<?php echo $base_url ?>cms/sales/po/edit/<?php  echo Helper_Helper::encrypt($result->po_id)?>">Edit</a></td>
                            <td><a href="<?php echo $base_url ?>cms/sales/po/viewreport/<?php echo Helper_Helper::encrypt($result->po_id)?>">View</a></td>
                            <td><a href="<?php echo $base_url ?>cms/sales/po/masterfile/<?php echo Helper_Helper::encrypt($result->po_id)?>">View Master File</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
        <?php if(isset($pageselector)) echo $pageselector ?>