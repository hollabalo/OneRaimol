 <script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
  <script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/staff.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

   <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
         <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success"><p>Account successfully ' . $success . '</p></span>' : ''; ?>
         <?php 
                $accessflag = FALSE;
                
                $staffaccesslevel = array (
                Constants_UserType::ADMIN
                );
                
                foreach($staffaccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
        
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                    	<a href="<?php echo $base_url ?>cms/accounts/staff/add">Add</a> |
                        <a href="javascript:void(0)" onclick="enable_staff()">Activate</a> |
                        <a href="javascript:void(0)" onclick="disable_staff()">Deactivate</a> |
                        <a data-keyboard="true" data-controls-modal="delete-modal" data-backdrop="true">Delete</a> |
                <?php endif ?>
                        <a href="<?php echo $base_url ?>cms/accounts/staff/generatepdflist">save lists as pdf</a>
                    </div>
                </div>
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <tr>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th style="width:5%">Status</th>
                            <th style="width:35%">Role</th>
                            <th style="width:28%">Name</th>
                            <th style="width:15%">Username</th>
                            <th style="width:6%">&nbsp;</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($staffs as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->staff_id); ?>" id="chk<?php echo $result->staff_id ?>"/></td>
                            <td style="color: <?php echo $result->color_status(); ?>; font-weight: bold;">
                                <?php echo $result->status(); ?>
                            </td>
                            <td>
                                <ul class="roleList">
                                <?php foreach($result->roles->find_all() as $role) : ?>
                                   <li><?php echo $role->roles->name ?></li>
                                <?php endforeach ?>
                                </ul>
                            </td>
                            <td><?php echo $result->full_name() ?></td>
                            <td><?php echo $result->username ?></td>
                            <td><a href="<?php echo $base_url ?>cms/accounts/staff/edit/<?php echo Helper_Helper::encrypt($result->staff_id)?>">Edit</a></td>
                            <td><a href="<?php echo $base_url ?>cms/accounts/staff/viewreport/<?php echo Helper_Helper::encrypt($result->staff_id)?>">View</a></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="7" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>

<!--         MODAL-->

    <div class="modal hide fade in" id="delete-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Delete Staff Record</h2>
        </div>
        <div class="modal-body">
          <p>Do you really want to delete? This operation is irreversible.</p>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_deletemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="delete_staff()">Yes</a>
        </div>
      </div>