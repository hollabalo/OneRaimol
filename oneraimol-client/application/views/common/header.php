<?php 

$acct = array (
                Constants_UserType::ADMIN
            );
            
            $inventory = array (
                Constants_UserType::PRESIDENT,
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::GENERAL_MANAGER,
                Constants_UserType::ACCOUNTANT,
                Constants_UserType::PRODUCT_MANAGER,
                Constants_UserType::PRODUCTION_STAFF,
                Constants_UserType::INVENTORY_CONTROLLER,
                Constants_UserType::ADMIN,
            );
            
            $sales = array (
                Constants_UserType::PRESIDENT, 
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::GENERAL_MANAGER,
                Constants_UserType::ACCOUNTANT,
                Constants_UserType::ADMIN
            );
            
            $sig = array (
                Constants_UserType::PRESIDENT, 
                Constants_UserType::VICE_PRESIDENT,
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::HEAD_CHEMIST,
                Constants_UserType::GENERAL_MANAGER,
                Constants_UserType::QUALITY_ASSURANCE_HEAD,
                Constants_UserType::QUALITY_ASSURANCE,
                Constants_UserType::INVENTORY_CONTROLLER,
                Constants_UserType::ACCOUNTANT,
                Constants_UserType::LABORATORY_ANALYST,
                Constants_UserType::PRODUCT_MANAGER
            );
            
            $prod = array (
                Constants_UserType::PRESIDENT,
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::HEAD_CHEMIST,
                Constants_UserType::GENERAL_MANAGER,
                Constants_UserType::ACCOUNTANT,
                Constants_UserType::INVENTORY_CONTROLLER,
                Constants_UserType::ADMIN
            );
            
            $rep = array (
                Constants_UserType::PRESIDENT, 
                Constants_UserType::VICE_PRESIDENT,
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::HEAD_CHEMIST,
                Constants_UserType::GENERAL_MANAGER,
                Constants_UserType::PRODUCT_MANAGER,
                Constants_UserType::QUALITY_ASSURANCE_HEAD,
                Constants_UserType::QUALITY_ASSURANCE,
                Constants_UserType::INVENTORY_CONTROLLER,
                Constants_UserType::ADMIN,
                Constants_UserType::ACCOUNTANT
            );
            
            
            $module = array();
            
            foreach($acct as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($module, 'ACCOUNTS');
            }
            
            foreach($inventory as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($module, 'INVENTORY');
            }
            
            foreach($sales as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($module, 'SALES');
            }
            
            foreach($sig as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($module, 'SIGNATORIES');
            }
            
            foreach($prod as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($module, 'PRODUCTION');
            }
            
            foreach($rep as $position) {
                $accessflag = Helper_Helper::check_access_right(Session::instance()->get('roles'), $position);
                if($accessflag == TRUE) array_push($module, 'REPORTS');
            }

?>


<!-- HEADER -->
<div class="topbar" data-dropdown="dropdown">
      <div class="topbar-inner">
        <div class="container-fluid">
          <h3><a id="raimolLogo" href="<?php echo $base_url ?>/cms"></a></h3>
          <ul class="nav" id="navLinks">
            <?php if(in_array('ACCOUNTS', $module)) : ?> 
            <li <?php if(isset($topSelection) && $topSelection == 'accounts') echo 'class="active"'?>><a href="<?php echo $base_url ?>cms/accounts">accounts</a></li>
            <?php endif ?>
            
            <?php if(in_array('INVENTORY', $module)) : ?> 
            <li <?php if(isset($topSelection) && $topSelection == 'inventory') echo 'class="active"'?>><a href="<?php echo $base_url ?>cms/inventory">inventory</a></li>
            <?php endif ?>
            
            <?php if(in_array('SALES', $module)) : ?> 
            <li <?php if(isset($topSelection) && $topSelection == 'sales') echo 'class="active"'?>><a href="<?php echo $base_url ?>cms/sales">sales</a></li>
            <?php endif ?>
            
            <?php if(in_array('SIGNATORIES', $module)) : ?>
            <li <?php if(isset($topSelection) && $topSelection == 'signatories') echo 'class="active"'?>><a href="<?php echo $base_url ?>cms/signatories">signatories</a></li>
            <?php endif ?>
            
            <?php if(in_array('PRODUCTION', $module)) : ?> 
            <li <?php if(isset($topSelection) && $topSelection == 'production') echo 'class="active"'?>><a href="<?php echo $base_url ?>cms/production">production</a></li>
            <?php endif ?>
            
            <?php if(in_array('REPORTS', $module)) : ?> 
            <li <?php if(isset($topSelection) && $topSelection == 'reports') echo 'class="active"'?>><a href="<?php echo $base_url ?>cms/reports">reports</a></li>
            <?php endif ?>
          </ul>
          <?php if(isset($searchbox)) :?>
          <script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
          <script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
          <form class="pull-left" id="search-form" action="search">
            <input id="searchbox" type="text" placeholder="Search" class="span-8 span-24"/>
            <input type="hidden" id="searchrefURL" value="<?php echo $searchbox ?>"/>
          </form>
          
<script src="<?php echo $base_url . $config['js'] ?>/cms/search.js" type="text/javascript"></script>

          <?php endif ?>
          <ul class="nav secondary-nav">
            <li class="dropdown" id="navDrop">
                <?php 
//                        $role = ORM::factory('staff')
//                                ->where('role_id', '=', $role)
//                                ->find_all();
                        
                        $role = ORM::factory('staff')
                                       ->where('staff_id', '=', $_SESSION['userid'])
                                       ->find()
                                       ->roles
                                       ->find_all();
                
                        $rolestr = '';
                        $adminflag = FALSE;
                        
                        if($role->count() > 1) {
                            foreach($role as $r) {
                                if($r->role_id == Constants_UserType::ADMIN) {
                                    $adminflag = TRUE; 
                                    break;
                                }
                            }
                            if($adminflag) {
                                $rolestr = '(Super Admin) Multiple Roles';
                            }
                            else {
                                $rolestr = 'Multiple Roles';
                            }
                        }
                        else {
                            foreach($role as $r) {
                                if($r->role_id == Constants_UserType::ADMIN) {
                                    $rolestr = 'Super Admin';
                                }
                                else {
                                    $rolestr = $r->roles->description;
                                }
                                
                            }
                        }
                        ?>
                
                <a id="topbarsettingmenu" href="#" class="dropdown-toggle"><?php echo $rolestr ?> <?php echo ($role->count() > 1) ? '['.$role->count().']' : ' '?>: <?php echo $_SESSION['username']; ?></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $base_url ?>cms/profile">Profile</a></li>
                <?php 
                $accessflag = FALSE;
                
                $systemsettings = array (
                Constants_UserType::ADMIN
                );
                
                foreach($systemsettings as $position) {
                    $accessflag = Helper_Helper::check_access_right($_SESSION['roles'], $position);
                    if($accessflag == TRUE) break;
                }
                if($accessflag) {
                ?>
                <li><a href="<?php echo $base_url ?>cms/systemsettings">System Settings</a></li>
                <?php } ?>
                <li class="divider"></li>
                <li><a href="javascript:void(0)" onclick="logout()">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

        <!-- HEADER -->
        
        <!-- BREADCRUMBS -->
        
        <div class="block clearfix" id="crumbContainer">
        	<div class="column span-10"><a href="<?php if(isset($moduleURL)) echo $base_url . $moduleURL ?>"><img src="<?php echo $base_url . $imgpath ?>/<?php echo $img ?>" alt="modulelogo"/></a><h1><a href="<?php if(isset($moduleURL)) echo $base_url . $moduleURL ?>"><?php echo $pageDesc ?></a></h1></div>
        </div>
        
        <!-- BREADCRUMBS -->
        