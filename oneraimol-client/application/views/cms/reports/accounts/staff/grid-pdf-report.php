<html>
    
    <title></title>
        <head>
    
    <style type="text/css">
        #header{
            height:130px;
            width:190px;
            font-size:12px;
        }
        #spacer{
            height:50px;
        }
    </style>
</head>

<body>
    
<div id="header">
  <table>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td><img src="assets/images/raimol2.png" /></td>
    </tr>
    <tr>
      <td>Unit 5 8/f 20th Drive Corporate Ctr. 20th Drive McKinley Business Park Bonifacio Global City, Taguig MNLA 1634 PH</td>
    </tr>
  </table>    
</div>
    
<hr />

<div id="spacer"></div>
    
    <body>
        
                <table class="fullWidth condensed-table zebra-striped">              
                        <tr>
                            <td><strong>Status</strong></td>
                            <td width="180"><strong>Role</strong></td>
                            <td width="200"><strong>Name</strong></td>
                            <td><strong>Username</strong></td>
                            </tr>
                        <?php $record_count = 0;?>
                        <?php foreach($staff as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td style="color: <?php echo $result->color_status(); ?>; font-weight: bold;">
                                <?php echo $result->status(); ?>
                            </td>
                            <td>
                                <ul class="roleList">
                                <?php foreach($result->roles->find_all() as $role) : ?>
                                   <li><?php echo $role->roles->name ?></li>
                                <?php endforeach ?>
                                </ul>
                            </td>
                            <td><?php echo $result->full_name() ?></td>
                            <td><?php echo $result->username ?></td>
                            </tr>
                        <?php endforeach ?>
                </table>
    </body>
        
</html>