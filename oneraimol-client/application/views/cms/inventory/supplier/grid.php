<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/supplier.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>
   
            <?php if(isset($pageSelectionLabel)) : ?>
        <p> <?php echo $pageSelectionLabel ?></p>
            <?php endif ?>
         
        <div id="msg"></div>
            <?php echo isset($success) ? '<span class="success"><p>Supplier successfully ' . $success . '</p></span>' : ''; ?>
        <?php 
                $accessflag = FALSE;
                $supplieraccesslevel = array (
                Constants_UserType::ADMIN,
                Constants_UserType::HEAD_CHEMIST
                );
                
                foreach($supplieraccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
        
        <div class="span-24 last pull-right" id="formMenu">
            <div class=" pull-right">
                <a href="<?php echo $base_url ?>cms/inventory/supplier/add">add</a> |
                <a data-keyboard="true" data-controls-modal="delete-modal" data-backdrop="true">delete</a>
            </div>
        </div>
        <?php endif ?>
        <table class="fullWidth condensed-table zebra-striped">
            <thead>
                <tr>
                    <?php if($accessflag) : ?>
                    <th><input type="checkbox" onclick="check_all(this);" /></th>
                    <?php endif ?>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
            <!--<td>Contact Personssss</td>-->
                    <th>Telephone</th>
                    <th>Mobile</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

    
            <tbody>
                <?php $record_count = 0;?>
                <?php foreach($supplier as $result) :?>
                <?php $record_count++;?>

            <tr>
                <?php if($accessflag) : ?>
                <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->supplier_id); ?>" id="chk<?php echo $result->supplier_id ?>"/></td>
                <?php endif ?>
                <td><?php echo $result->get_pk() ?></td>
                <td><?php echo $result->company_name ?></td>
                <td><?php echo $result->full_name(); ?></td>
                <td><?php echo $result->telephone_no ?></td>
                <td><?php echo $result->mobile_no ?></td>
                <td><?php echo $result->email ?></td>
                <td><?php echo $result->address ?></td>
                <td><a href="<?php echo $base_url ?>cms/inventory/supplier/edit/<?php echo Helper_Helper::encrypt($result->supplier_id)?>">Edit</td>
                <td><a href="<?php echo $base_url ?>cms/inventory/suppliersupplies/view/<?php echo Helper_Helper::encrypt($result->supplier_id)?>">Supplies</td>
                <td><a href="<?php echo $base_url ?>cms/inventory/supplier/viewreport/<?php echo Helper_Helper::encrypt($result->supplier_id)?>">View</td>
            </tr>
            
                    <?php endforeach ?>
                    <?php if($record_count == 0) : ?>
            
            <tr>
                <td colspan="<?php echo ($accessflag == true) ? '9' : '8'?>" style="text-align: center; font-style: italic">No records found.</td>
            </tr>
                    <?php endif ?>
            
                </tbody>
            </table>

    <?php if(isset($pageselector)) echo $pageselector ?>

        <!--                MODALS-->

    <div class="modal hide fade in" id="delete-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Delete Supplier Record</h2>
        </div>
        <div class="modal-body">
          <p>Do you really want to delete? This operation is irreversible.</p>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_deletemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="delete_supplier()">Yes</a>
        </div>
      </div>