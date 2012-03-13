<html>
    <title>
        
    </title>
    <head>
        
        <style type="text/css">
            #header {
		width:190px;
		height:130px;
		left: 0px;
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
            <td><img src="assets/images/raimol2.png" /></td>
        </tr>
        <tr>
            <td>Unit 5 8/f 20th Drive Corporate Ctr. 20th Drive McKinley Business Park Bonifacio Global City, Taguig MNLA 1634 PH</td>
        </tr>
    </table>
</div>  
    <hr />  
    <div id="spacer"></div>
    <center><strong>UNIT OF MEASURE LIST</strong></center>
    <div id="spacer"></div>
        
       <table class="fullWidth condensed-table zebra-striped">
              
              <tr>
                <td style="width:2%"><input type="checkbox" onclick="check_all(this);" /></td>
                <td width="50px"><strong>ID</strong></td>
                <td width="100px"><strong>Unit</strong></td>
                <td>&nbsp;</td>
              </tr>
               
                      <?php $record_count = 0;?>
                      <?php foreach($unit as $result) :?>
                      <?php $record_count++;?>
              <tr>
                <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->um_id); ?>" id="chk<?php echo $result->um_id ?>"/></td>
                <td><?php echo $result->get_pk() ?></td>
                <td><?php echo $result->get_description() ?></td> 
              </tr>
             
                        <?php endforeach ?>
                        
            </table> 
    </body>
</html>