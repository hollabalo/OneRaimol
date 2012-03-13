<html>
    <title>        
    </title>
    <head>       
    </head>
    <body>
        <a class="floatRight" href="<?php echo $base_url?>cms/inventory/supplies/generatepdf"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

        <table>
            <thead>
                <tr>                 
                    <th>Material Name</th>
                    <th>Suppliers</th>
                    <th>Price</th>              
                </tr>
            </thead>
            <tbody>
                <?php $record_count = 0;?>
                <?php foreach($materialsupply as $result) :?>
                <?php $record_count++;?>
            <tr>
                <td><?php echo $result->materials->description ?></td>
                <td><?php echo $result->suppliers->company_name ?></td>
                <td>PhP <?php echo number_format($result->price, 2) ?></td>
            </tr>            
                <?php endforeach ?>     
            </tbody>
        </table>     
    </body>
</html>