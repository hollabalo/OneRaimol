<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)) echo $title ?></title>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/plugins/liquid/reset.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/print.css" type="text/css" media="print" />
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/ie.css" type="text/css" media="screen, projection" />
<![endif]-->

<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/customstore.css" type="text/css" />

<!--<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/bootstrap.buttons.min.css" type="text/css" />-->

<script src="<?php echo $base_url . $config['js'] ?>/jquery-1.6.2.min.js" type="text/javascript"></script>
<script type="text/javascript">var base_url = '<?php echo $base_url ?>';</script>

<script src="<?php echo $base_url . $config['js'] ?>/global_actions.js" type="text/javascript"></script>


<script type="text/javascript">
    var message = {<?php if(isset($formmessages)) echo $formmessages; ?>};
</script>
</head>

<body>

    <div class="container">
        
        <div id="headerContainer" class="span-24 last">
            <div id="logoContainer"><div id="logo"></div></div>
                         <div id="headerNavContainer" class="span-6 last">
                <div id="headerNav">
                    <ul id="headerNavMenu" class="list horizontal">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div id="bodyContainer" class="span-24 last">
            <div id="sideBarLeft" class="span-6">
                <h3>Categories</h3>
                <ul id="sideNav" class="">
                <?php foreach($categories as $cat) : ?>
                    <li><a href="<?php echo $base_url?>store/catalog/list/index/<?php echo Helper_Helper::encrypt($cat->pk())?>"><?php echo $cat->description ?></a>&nbsp;(<?php echo $cat->products->find_all()->count()?>)</li>
                <?php endforeach ?>
                </ul>
            </div>
            
            <div id="bodyContents" class="span-18 last">
                <?php if(isset($bodyContents)) echo $bodyContents ?>
            </div>
            
        </div>
        
        <div id="footerContainer" class="span-24 last">
            <div id="footerText" class="span-10 right">Copyright 2012. RAIMOL™ Energized Lubricants. All Rights Reserved.</div>
        </div>
        
    </div>
    
</body>
</html>
