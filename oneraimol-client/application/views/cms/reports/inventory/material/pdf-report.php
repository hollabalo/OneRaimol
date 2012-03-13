<html>

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
            <td><img src="assets/images/raimol2.png" /></td>
        </tr>
        <tr>
            <td>Unit 5 8/f 20th Drive Corporate Ctr. 20th Drive McKinley Business Park Bonifacio Global City, Taguig MNLA 1634 PH</td>
        </tr>
    </table>
</div>    
    
<hr />
<center><h3>LIST OF MATERIALS</h3></center>
    
<table>
                <tr>
                    <td width="50px"><h3>ID</h3></td>
                    <td><h3>MATERIAL NAME</h3></td>
                </tr>
     
                        <?php $record_count = 0;?>
                        <?php foreach($material as $result) :?>
                        <?php $record_count++;?>
                <tr>
                    <td><?php echo $result->material_id ?></td>
                    <td><?php echo $result->description ?></td>
                </tr>
                        <?php endforeach ?>


            </table>
    </body>
    
</html>