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
           
            $cssctr = 0;
?>


<div class="container" id="container">
    	<div id="top-spacer">
            <div id="dashboardcontrol" class="span-6 last right">
                <div class="controlcontainer">
                    <ul>
                        <li><a href="<?php echo $base_url?>cms/profile">Account</a></li>
                        <li><a href="javascript:void(0)" onclick="logout()">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    	<div class="span-24">
            <div class="span-24" id="mainMenu-wrap">
                <div class="append-3 prepend-3">
                    <?php if(in_array('ACCOUNTS', $module)) : ?>
                    <?php $cssctr++ ?>
                    <div class="span-6" id="mainMenu-box">
                            <span class="list1"><a href="<?php echo $base_url ?>cms/accounts">accounts management</a></span>
                    </div>
                    
                    <?php endif ?>
                    
                    <?php if(in_array('INVENTORY', $module)) : ?>
                    <?php $cssctr++ ?>
                    <div class="span-6" id="mainMenu-box">
                            <span class="list2"><a href="<?php echo $base_url ?>cms/inventory">inventory</a></span>
                    </div>
                    <?php endif ?>
                    
                    <?php if(in_array('SALES', $module)) : ?>
                    <?php $cssctr++ ?>
                    <div class="span-6 <?php echo ($cssctr%3 == 0) ? 'last' : ''?> <?php echo ($cssctr == 3) ? 'clearfix' : ''?>" id="mainMenu-box">
                            <span class="list3"><a href="<?php echo $base_url ?>cms/sales">sales</a></span>
                    </div>
                    <?php endif ?>
                    
                    <?php if(in_array('SIGNATORIES', $module)) : ?> 
                    <?php $cssctr++ ?>
                    <div class="span-6 <?php echo ($cssctr%3 == 0) ? 'last' : ''?> <?php echo ($cssctr == 3) ? 'clearfix' : ''?>" id="mainMenu-box">
                            <span class="list4"><a href="<?php echo $base_url ?>cms/signatories">signatories</a></span>
                    </div>
                    <?php endif ?>
                    
                    <?php if(in_array('PRODUCTION', $module)) : ?>
                    <?php $cssctr++ ?>
                    <div class="span-6 <?php echo ($cssctr%3 == 0) ? 'last' : ''?> <?php echo ($cssctr == 3) ? 'clearfix' : ''?>" id="mainMenu-box"> 
                            <span class="list5"><a href="<?php echo $base_url ?>cms/production">production</a></span>
                    </div>
                    <?php endif ?>
                    
                    <?php if(in_array('REPORTS', $module)) : ?>
                    <?php $cssctr++ ?>
                    <div class="span-6 <?php echo ($cssctr%3 == 0) ? 'last' : ''?>" id="mainMenu-box"> 
                            <span class="list6"><a href="<?php echo $base_url ?>cms/reports">reports</a></span>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>