<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
 <script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/stock.js" type="text/javascript"></script>

   <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>

       
        <?php if($materialstockusage->count() > 0) : ?>
        <?php 
            $pk = '';

            foreach($materialstockusage as $result) {
                $pk = $result->stock_id;
                break;
            }
        ?>
        
        <div class="span-24 last pull-right" id="formMenu">
            <div class=" pull-right">
                <a href="<?php echo $base_url ?>cms/inventory/stockusage/viewreport/<?php echo Helper_Helper::encrypt($pk) ?>">View List</a>
            </div>
        </div>
        <?php endif ?>
                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                          <tr>
                          
                            <th>Material Name</th>
                            <th>Liters Used</th>
                            <th>Date Used</th>
                          </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0; ?>
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
                <?php if(isset($pageselector)) echo $pageselector ?>
