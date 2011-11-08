<!-- HEADER -->
    	<div class="block clearfix" id="headerContainer">
            <div class="column" id="logoContainer"><a href="<?php echo $base_url?>cms"></a></div>
            <div class="column span-14 last" id="headerMenuContainer">
                <ul>
                    <li><a href="<?php echo $base_url ?>cms/accounts" <?php if(isset($topSelection) && $topSelection == 'accounts') echo 'class="selected"'?>>accounts</a></li>
                    <li><a href="<?php echo $base_url ?>cms/inventory" <?php if(isset($topSelection) && $topSelection == 'inventory') echo 'class="selected"'?>>inventory</a></li>
                    <li><a href="<?php echo $base_url ?>cms/sales" <?php if(isset($topSelection) && $topSelection == 'sales') echo 'class="selected"'?>>sales</a></li>
                    <li><a href="<?php echo $base_url ?>cms/signatories" <?php if(isset($topSelection) && $topSelection == 'signatories') echo 'class="selected"'?>>signatories</a></li>
                    <li><a href="<?php echo $base_url ?>cms/production" <?php if(isset($topSelection) && $topSelection == 'production') echo 'class="selected"'?>>production</a></li>
                    <li><a href="<?php echo $base_url ?>cms/reports" <?php if(isset($topSelection) && $topSelection == 'reports') echo 'class="selected"'?>>reports</a></li>
                </ul>
            </div>
        </div>
        <!-- HEADER -->
        
        <!-- BREADCRUMBS -->
        
        <div class="block clearfix" id="crumbContainer">
        	<div class="column span-10"><a href="<?php if(isset($moduleURL)) echo $base_url . $moduleURL ?>"><img src="<?php echo $base_url . $imgpath ?>/<?php echo $img ?>"/></a><h1><a href="<?php if(isset($moduleURL)) echo $base_url . $moduleURL ?>"><?php echo $pageDesc ?></a></h1></div>
        </div>
        
        <!-- BREADCRUMBS -->
        