<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/inventory/material/generatepdf"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<table class="borderless">
    <thead>            
    <tr>
                    <th width="50"><strong>ID</strong></th>
                    <th><strong>MATERIAL NAME</strong></th>
                </tr>
                </thead>
                <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($material as $result) :?>
                        <?php $record_count++;?>
                <tr>
                    <td><?php echo $result->material_id ?></td>
                    <td><?php echo $result->description ?></td>
                </tr>
                        <?php endforeach ?>
                </tbody>

</table>
                <?php if(isset($pageselector)) echo $pageselector ?>