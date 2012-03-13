<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/unit.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

   <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
         <div id="msg"></div>
        <?php echo isset($success) ? '<span class="success"><p>Unit successfully ' . $success . '</p></span>' : ''; ?>
           
         <?php 
                $accessflag = FALSE;
                
                $stockaccesslevel = array (
                Constants_UserType::ADMIN,
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::INVENTORY_CONTROLLER
                );
                
                foreach($stockaccesslevel as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) :
                ?>
            
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                    	<a href="<?php echo $base_url ?>cms/inventory/unit/add">add</a> |
<!--                        <a data-keyboard="true" data-controls-modal="delete-modal" data-backdrop="true">delete</a> |-->
                        <a href="<?php echo $base_url ?>cms/inventory/unit/generatepdf">Save as PDF</a>
                    </div>
                </div>
                <?php endif ?>
         
           <table class="fullWidth condensed-table zebra-striped">
               <thead>
              <tr>
                <?php if($accessflag) : ?>
                <th style="width:2%"><input type="checkbox" onclick="check_all(this);" /></th>
                <?php endif ?>
                <th>ID</th>
                <th>Unit</th>
                <th>&nbsp;</th>
              </tr>
               </thead>
               <tbody>
                      <?php $record_count = 0;?>
                      <?php foreach($unit as $result) :?>
                      <?php $record_count++;?>
              <tr>
                  <?php if($accessflag) : ?>
                <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->um_id); ?>" id="chk<?php echo $result->um_id ?>"/></td>
                 <?php endif ?>
                <td><?php echo $result->get_pk() ?></td>
                <td><?php echo $result->get_description() ?></td>
                <td><a href="<?php echo $base_url ?>cms/inventory/unit/edit/<?php echo Helper_Helper::encrypt($result->um_id)?>">Edit</td>
              </tr>
              </tbody>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="<?php echo ($accessflag == true) ? '4' : '3'?>" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
             
            </table>

         <?php if(isset($pageselector)) echo $pageselector ?>

