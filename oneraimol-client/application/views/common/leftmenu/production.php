<?php   

            
            $production = array(
             Constants_UserType::PRESIDENT,
             Constants_UserType::HEAD_CHEMIST
            );
            
            
            $typedoc = array();
            $accessflag = FALSE;   
            foreach($production as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) break;
            }
?>




<li><a href="<?php echo $base_url . $moduleURL ?>/pwo" <?php if(isset($leftSelection) && $leftSelection == 'pwo') echo 'class="selected"'?>>production work orders</a></li>

<?php if($accessflag) : ?>
<li><a href="<?php echo $base_url . $moduleURL ?>/formula" <?php if(isset($leftSelection) && $leftSelection == 'formula') echo 'class="selected"'?>>formula</a></li>
<li><a href="<?php echo $base_url . $moduleURL ?>/pbt" <?php if(isset($leftSelection) && $leftSelection == 'pbt') echo 'class="selected"'?>>production batch ticket</a></li>
<?php endif ?>