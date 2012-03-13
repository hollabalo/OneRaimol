<html>
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
        
        
        <?php 
        
            $company = '';
            $description = '';
            
            foreach($materialstockusage as $res) {
                $company = $res->materialstocklevels->materialsupply->suppliers->company_name;
                $description = $res->materialstocklevels->materialsupply->materials->description;
                break;
            }
        
        ?>
        
        
        <h3><center>LIST OF STOCKS USED</center></h3>
        <h4><center><?php echo $company ?></center></h4>
        <h5><center><?php echo $description ?></center></h5>
                        <table>
                    <thead>
                          <tr>
                          
                            <th>Material Name</th>
                            <th>Liters Used</th>
                            <th>Date Used</th>
                          </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($materialstockusage as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><?php echo $result->materialstocklevels->materialsupply->materials->description ?></td>
                            <td><?php echo $result->liters ?></td>
                            <td><?php echo $result->date ?></td>
                        </tr>
                    
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="3" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                         
                     </tbody>
                </table>
    </body>
</html>