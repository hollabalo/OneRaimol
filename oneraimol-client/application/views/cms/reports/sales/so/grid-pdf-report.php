<html>
    <title></title>
    
    <head>
        
    </head>
    <body>
                 <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <th>SO #</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($salesorder as $result) :?>
                        <?php $record_count++;?>
                        <tr>
                            <td><?php echo $result->so_id_string ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
    </body>
    
</html>