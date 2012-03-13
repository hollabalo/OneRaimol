<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/sales/dr.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Delivery Receipt successfully ' . $success . '</span>' : ''; ?>
         <?php 
                $accessflag = FALSE;
                
                $drgridaccesslevel = array (
                Constants_UserType::ADMIN,
                Constants_UserType::SALES_COORDINATOR
                );
                
                foreach($drgridaccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
                <div class="span-24 last" id="formMenu">
                	<div class="pull-right">
                        <a href="<?php echo $base_url ?>cms/sales/dr/add">add</a> |

                        <a href="javascript:void(0)" onclick="readyfordelivery()">deliver</a>
                                 <?php endif ?>
                        </div>
                </div>
                 <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th>Status</th>
                            <th>DR #</th>
                            <th>SO #</th>
                            <th>PO #</th>
                            <th>Company</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Delivered Date</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($deliveryreceipt as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->dr_id); ?>" id="chk<?php echo $result->dr_id ?>"/></td>
                            <td style="color: <?php echo $result->color_status(); ?>; font-weight: bold;">
                                <?php echo $result->status(); ?>
                            </td>
                            <td><?php echo $result->dr_id_string ?></td>
                            <td><?php echo $result->salesorders->so_id_string ?></td>
                            <td><?php echo $result->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->purchaseorders->customers->company ?></td>
                            <td><?php echo $result->purchaseorders->order_date ?></td>
                            <td><?php echo $result->purchaseorders->delivery_date ?></td>
                            <td><?php echo $result->delivered_date ?></td>
<!--pagkaclick ng ready to deliver, lagay field ng date at magiiba status                            -->
                            <td><a href="<?php echo $base_url ?>cms/sales/dr/drdetails/<?php echo Helper_Helper::encrypt($result->dr_id)?>">Details</a></td>
                            <td><a href="<?php echo $base_url ?>cms/sales/dr/viewreport/<?php echo Helper_Helper::encrypt($result->dr_id)?>">View</a></td>
                       
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>