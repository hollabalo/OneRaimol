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
        
        <h3><center>LIST OF STOCKS</center></h3>
        <table>
                    <thead>
                          <tr>
                          <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
                            <th>ID</th>
                            <th width="200px">Material Name</th>
                            <th width="70px">Price</th>
                            <th width="70px">Supplier</th>
                            <th width="70px">Liters</th>
                            <th width="120px">Date Stock</th>
                            <th width="120px">Expiration Date</th>
                            <th>&nbsp;</th>
                          </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($materialstocklevel as $result) :?>
                            <?php $record_count++;?>
                          <tr>
                            <td><center><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->stock_id); ?>" id="chk<?php echo $result->stock_id ?>"/></center></td>
                            <td><center><?php echo $result->get_pk() ?></center></td>
                            <td><center><?php echo $result->materialsupply->materials->description ?></center></td>
                            <td><center>PhP <?php echo number_format($result->materialsupply->price, 2) ?></center></td>
                            <td><center><?php echo $result->materialsupply->suppliers->company_name ?></center></td> 
                            <td><center><?php echo $result->liters ?></center></td>
                            <td><center><?php echo $result->stock_taking_date ?></center></td>
                            <td><center><?php echo $result->expiration_date ?></center></td>
                          </tr>
                    
                        <?php endforeach ?>
                      
                               
                          
                     </tbody>
                </table>
    </body>
</html>