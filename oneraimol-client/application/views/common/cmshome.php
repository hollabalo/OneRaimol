<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)) echo $title ?></title>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/print.css" type="text/css" media="print" />
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/ie.css" type="text/css" media="screen, projection" />
<![endif]-->

<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/global.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/custom.css" type="text/css"/>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<script src="<?php echo $base_url . $config['js'] ?>/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/Segoe_UI_Light.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/Segoe_UI_Semibold.js" type="text/javascript"></script>

<script type="text/javascript">
        Cufon.replace('#mainMenu-box', { fontFamily: 'Segoe UI Light', hover: true });
        Cufon.replace('#footerContents',  { fontFamily: 'Segoe UI Light' }); 
        Cufon.replace('#dashboardcontrol',  { fontFamily: 'Segoe UI Semibold', hover: true });
</script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery-1.6.2.min.js" type="text/javascript"></script>
<script type="text/javascript">var base_url = '<?php echo $base_url ?>';</script>

<script src="<?php echo $base_url . $config['js'] ?>/global_actions.js" type="text/javascript"></script>

<script type="text/javascript">
    var message = {<?php if(isset($formmessages)) echo $formmessages; ?>};
</script>
</head>

<body>
    <div id="bghead-bg">
            <div id="bgfooter-bg">
        <div id="bghead">
            <div id="bgfooter">
                <div id="container">
	<?php if(isset($body)) echo $body ?>
    
        <div class="block" id="footerContainer">
            <div class="span-8 clearfix" id="footerContents">
                <p>Copyright <?php echo date('Y') ?> Rainchem International, Inc.</p>
            </div>
        </div>
                </div> 
            </div>
        </div>
            </div>
    </div>
    
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
