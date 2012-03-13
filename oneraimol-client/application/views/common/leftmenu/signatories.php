<?php   

            
            $so = array(
             Constants_UserType::PRESIDENT,
             Constants_UserType::SALES_COORDINATOR,
             Constants_UserType::GENERAL_MANAGER,
             Constants_UserType::ACCOUNTANT
            );
            
            $pwo = array (
            Constants_UserType::HEAD_CHEMIST,
             Constants_UserType::SALES_COORDINATOR,
             Constants_UserType::ACCOUNTANT
            );
            
            $pbt = array (
            Constants_UserType::LABORATORY_ANALYST,
             Constants_UserType::QUALITY_ASSURANCE,
             Constants_UserType::QUALITY_ASSURANCE_HEAD,
             Constants_UserType::HEAD_CHEMIST
            );
            $formula = array (
            Constants_UserType::PRESIDENT,
             Constants_UserType::HEAD_CHEMIST
            );
            $dr = array (
                Constants_UserType::SALES_COORDINATOR,
             Constants_UserType::GENERAL_MANAGER,
             Constants_UserType::PRODUCT_MANAGER,
             Constants_UserType::INVENTORY_CONTROLLER,
             Constants_UserType::LABORATORY_ANALYST
            );
            
            $typedoc = array();
            
            foreach($so as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($typedoc, Constants_DocType::SALES_ORDER);
            }
            
            foreach($pwo as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($typedoc, Constants_DocType::PRODUCTION_WORK_ORDER);
            }
            
            foreach($pbt as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) {
                    array_push($typedoc, Constants_DocType::PRODUCTION_BATCH_TICKET);
                }
            }
            
            foreach($formula as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($typedoc, Constants_DocType::FORMULA);
            }
            foreach($dr as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($typedoc, Constants_DocType::DELIVERY_RECEIPT); 
            }
            
            
            
?>

    
<?php if(in_array(Constants_DocType::SALES_ORDER, $typedoc)) : ?> 
<li><a href="<?php echo $base_url . $moduleURL ?>/so" <?php if(isset($leftSelection) && $leftSelection == 'so') echo 'class="selected"'?>>sales order</a></li>
<?php endif ?>

    <?php if(in_array(Constants_DocType::PRODUCTION_WORK_ORDER, $typedoc)) : ?>    
<li><a href="<?php echo $base_url . $moduleURL ?>/pwo" <?php if(isset($leftSelection) && $leftSelection == 'pwo') echo 'class="selected"'?>>production work order</a></li>
<?php endif ?>

    <?php if(in_array(Constants_DocType::PRODUCTION_BATCH_TICKET, $typedoc)) : ?>               
<li><a href="<?php echo $base_url . $moduleURL ?>/pbt" <?php if(isset($leftSelection) && $leftSelection == 'pbt') echo 'class="selected"'?>>production batch ticket</a></li>
<?php endif ?>

    <?php if(in_array(Constants_DocType::FORMULA, $typedoc)) : ?>         
<li><a href="<?php echo $base_url . $moduleURL ?>/formula" <?php if(isset($leftSelection) && $leftSelection == 'formula') echo 'class="selected"'?>>formula</a></li>
<?php endif ?>

    <?php if(in_array(Constants_DocType::DELIVERY_RECEIPT, $typedoc)) : ?> 
<li><a href="<?php echo $base_url . $moduleURL ?>/dr" <?php if(isset($leftSelection) && $leftSelection == 'dr') echo 'class="selected"'?>>delivery receipt</a></li>
<?php endif ?>