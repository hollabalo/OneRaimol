<html>
    <title></title>
    <head>
    
    <style type="text/css">
        #header{
            height:130px;
            width:190px;
            font-size:12px;
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
<body>
    <hr />
        <h3></center>CUSTOMERS INFORMATION</center></h3>
        
        <table>
                    
            <tr>
                            <td width="100"><strong>Name</strong></td>
                            <td width="100"><strong>Company</strong></td>
                            <td width="100"><strong>Username</strong></td>
            </tr>                        
                        <?php $record_count = 0;?>
                        <?php foreach($customer as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><?php echo $result->full_name() ?></td>
                            <td><?php echo $result->company ?></td> 
                            <td><?php echo $result->username ?></td>
                        </tr>
                        <?php endforeach ?>
        </table>          
    </body>         
</html>
                        