<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)) echo $title ?></title>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/plugins/liquid/reset.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/src/forms.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/print.css" type="text/css" media="print" />
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/blueprint/ie.css" type="text/css" media="screen, projection" />
<![endif]-->

<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/customstore.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/jquery.ui.css" type="text/css" media="screen, projection" />
<script src="<?php echo $base_url . $config['js'] ?>/jquery-1.6.2.min.js" type="text/javascript"></script>
<script type="text/javascript">var base_url = '<?php echo $base_url ?>';</script>

<script src="<?php echo $base_url . $config['js'] ?>/global_actions.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/jquery.fancybox.pack.js?v=2.0.5"></script>
<link rel="stylesheet" href="<?php echo $base_url . $config['css'] ?>/jquery.fancybox.css?v=2.0.5" type="text/css" media="screen" />

<script type="text/javascript">
    var message = {<?php if(isset($formmessages)) echo $formmessages; ?>};
</script>
</head>

<body>

    <div class="container">
        
        <div id="headerContainer" class="span-24 last">
            <div id="logoContainer"><a href="<?php echo $base_url ?>" id="logo"></a></div>
            <div id="headerNavContainer" class="span-8 last">
                <div id="headerNav">
                    <ul id="headerNavMenu" class="list horizontal">
                        <li><a href="<?php echo $base_url ?>">Home</a></li>
                    <?php if(! Session::instance()->get('userid')) :?>
                        <li><a href="<?php echo $base_url?>register">Register</a></li>
                    <?php endif ?>
                    <?php if(! Session::instance()->get('userid')) : ?>
                        <li><a href="<?php echo $base_url?>auth">Login</a></li>
                    <?php else : ?>
                        <?php if(Session::instance()->get('items')) : ?>
                        <li><a href="<?php echo $base_url?>catalog/list/cart">Cart&nbsp(<?php echo Session::instance()->get('items') ? count(Session::instance()->get('items')) : '0' ?>)</a></li>
                        <?php endif ?>
                        <li><a href="<?php echo $base_url?>account">Account (<?php echo Session::instance()->get('username')?>)</a></li>
                        <li><a href="javascript:void(0)" onclick="logout()">Logout</a></li>
                    <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div id="bodyContainer" class="span-24 last">
            <div id="sideBarLeft" class="span-6">
                <div id="search" style="display:block;">
                    <h4>Search Catalog</h4>
                    <form method="get" action="<?php echo $base_url?>catalog/list/search">
                        <table>
                            <tr>
                                <td style="width:70%"><input name="query" value="<?php echo Request::initial()->query('query') ?>"/></td>
                                <td><input type="submit" value="Search"/></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="clearfix"></div>
                
                <hr style="margin:7px 0;background-color: #858282;"/>
                
                
                <h4>Categories</h4>
                <ul id="sideNav" class="">
                <?php foreach($categories as $cat) : ?>
                    <li><a href="<?php echo $base_url?>catalog/list/index/<?php echo Helper_Helper::encrypt($cat->pk())?>"><?php echo $cat->description ?></a>&nbsp;(<?php echo $cat->products->find_all()->count()?>)</li>
                <?php endforeach ?>
                    <li class="endList"><a href="<?php echo $base_url?>catalog">Show all products</a></li>
                </ul>
            </div>
            
            <div id="bodyContents" class="span-18 last">
                <?php if(isset($bodyContents)) echo $bodyContents ?>
            </div>
            
        </div>
        
        <div id="footerContainer" class="span-24 last">
            <div id="footerText" class="span-10 right">Copyright <?php echo date('Y') ?>. RAIMOL™ Energized Lubricants. All Rights Reserved.</div>
        </div>
        
    </div>
    
</body>
</html>
