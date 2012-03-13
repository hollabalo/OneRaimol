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
            #spacer {
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
    <center><strong>MATERIAL SUPPLIES</strong></center>
    <div id="spacer"></div>
        <table>
                <tr>                 
                    <td width="200px"><strong>Material Name</strong></td>
                    <td width="150px"><strong>Suppliers</strong></td>
                    <td width="100px"><strong>Price</strong></td>              
                </tr>
            
                <?php $record_count = 0;?>
                <?php foreach($materialsupply as $result) :?>
                <?php $record_count++;?>
            <tr>
                <td><?php echo $result->materials->description ?></td>
                <td><?php echo $result->suppliers->company_name ?></td>
                <td>PhP <?php echo number_format($result->price, 2) ?></td>
            </tr>            
                <?php endforeach ?>                
        </table>     
    </body>
</html>