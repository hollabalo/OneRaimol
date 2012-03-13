<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/customer.js" type="text/javascript"></script>


<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

    <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
        <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Account successfully ' . $success . '</span>' : ''; ?>
        <?php 
                $accessflag = FALSE;
                
                $customeraccesslevel = array (
                Constants_UserType::ADMIN
                );
                
                foreach($customeraccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                        <a href="<?php echo $base_url ?>cms/accounts/customer/add">add</a> |
                        <a data-keyboard="true" data-controls-modal="delete-modal" data-backdrop="true">delete</a> |
                        <?php endif ?>
                        <a href="<?php echo $base_url ?>cms/accounts/customer/generatepdflist">Save Lists as PDF</a>
                    </div>
                </div>
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th style="width:30%">Name</th>
                            <th style="width:35%">Company</th>
                            <th style="width:15%">Username</th>
                            <th style="width:6%">&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($customers as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->customer_id); ?>" id="chk<?php echo $result->customer_id ?>"/></td>
                            <td><?php echo $result->full_name() ?></td>
                            <td><?php echo $result->company ?></td> 
                            <td><?php echo $result->username ?></td>
                            <td><a href="<?php echo $base_url ?>cms/accounts/customer/edit/<?php echo Helper_Helper::encrypt($result->customer_id)?>">Edit</a></td>
                            <td><a href="<?php echo $base_url ?>cms/accounts/customer/viewreport/<?php echo Helper_Helper::encrypt($result->customer_id)?>">View</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>
        

<!--                MODALS-->

    <div class="modal hide fade in" id="delete-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Delete Customer Record</h2>
        </div>
        <div class="modal-body">
          <p>Do you really want to delete? This operation is irreversible.</p>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_deletemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="delete_customer()">Yes</a>
        </div>
      </div>