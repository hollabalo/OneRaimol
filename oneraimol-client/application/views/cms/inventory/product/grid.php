 <script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
  <script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/product.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

   <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
         <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success"><p>Product successfully ' . $success . '</p></span>' : ''; ?>
         <?php 
                $accessflag = FALSE;
                
                $productaccesslevel = array (
                Constants_UserType::ADMIN,
                Constants_UserType::HEAD_CHEMIST
                );
                
                foreach($productaccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                    	<a href="<?php echo $base_url ?>cms/inventory/product/add">add</a> |
                        <a data-keyboard="true" data-controls-modal="delete-modal" data-backdrop="true">delete</a>
                    </div>
                </div>
                <?php endif ?>
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <!--sort by category -->
                        <!--sort by unit -->
                          <tr>
                            <?php if($accessflag) : ?>
                            <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <?php endif ?>
                            <th>ID</th>
                            <th>Name</th>
                           </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($product as $result) :?>
                            <?php $record_count++;?>
                          <tr>
                             <?php if($accessflag) : ?>
                             <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->product_id); ?>" id="chk<?php echo $result->product_id ?>"/></td>
                             <?php endif ?>
                             <td><?php echo $result->get_pk() ?></td>
                             <td><?php echo ucwords($result->name)?></td>
                            <td><a href="<?php echo $base_url ?>cms/inventory/product/details/<?php echo Helper_Helper::encrypt($result->product_id)?>">Details</a></td>
                          </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="<?php echo ($accessflag == true) ? '3' : '2' ?>" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                        </table>
         
 <?php if(isset($pageselector)) echo $pageselector ?>

         <!--                MODALS-->

    <div class="modal hide fade in" id="delete-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Delete Product Record</h2>
        </div>
        <div class="modal-body">
          <p>Do you really want to delete? This operation is irreversible.</p>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_deletemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="delete_product()">Yes</a>
        </div>
      </div>