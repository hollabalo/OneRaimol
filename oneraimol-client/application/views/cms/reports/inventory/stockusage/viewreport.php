<a class="floatRight" href="<?php echo $base_url?>cms/inventory/stockusage/generatepdf/<?php echo $stock?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<table class="fullWidth condensed-table zebra-striped">
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