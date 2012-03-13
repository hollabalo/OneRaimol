    
            <table id="pwoitemstable" class="fullWidth bordered-table condensed-table zebra-striped ">
                <thead>
                    <tr>
                        <th style="width:2%">&nbsp;</th>
                        <th>Description</th>
                        <th>API Class</th>
                        <th>Qty</th>
                        <th>U/M</th>
                    </tr>
                </thead>
                <tbody> 
                     <?php $record_count = 0;?>
                     <?php foreach($pwoitems as $result) :?>
                     <?php $record_count++;?>  
                    <?php if($result->soitems->poitems->purchaseorders->store_flag == "1") :?>
                    <tr>
                        <input type="hidden" name="pwoitemid[]" id="pwoitemid" value="<?php echo Helper_Helper::encrypt($result->pwo_item_id) ?>"/>
                        <td><input type="radio" name="pwoitem[]" id="pwoitem" value="<?php echo Helper_Helper::encrypt($result->soitems->poitems->po_item_id) ?>"/></td>
                        <td><?php echo $result->soitems->poitems->product_description ?></td>
                        <td><?php echo $result->soitems->poitems->product_description ?></td>
                        <td><?php echo $result->soitems->poitems->qty ?></td>
                        <td><?php echo $result->soitems->poitems->variants->unitmaterials->description ?></td>
                    </tr>   
                    <?php elseif($result->soitems->poitems->purchaseorders->store_flag == "2") :?>
                    <tr>
                        <input type="hidden" name="pwoitemid[]" id="pwoitemid" value="<?php echo Helper_Helper::encrypt($result->pwo_item_id) ?>"/>
                        <td><input type="radio" name="pwoitem[]" id="pwoitem" value="<?php echo Helper_Helper::encrypt($result->soitems->poitems->po_item_id) ?>"/></td>
                        <td><?php echo $result->soitems->poitems->product_description ?></td>
                        <td><?php echo $result->soitems->poitems->product_description ?></td>
                        <td><?php echo $result->soitems->poitems->qty ?></td>
                        <td><?php echo $result->soitems->poitems->unitmaterials->description ?></td>
                    </tr>  
                    <?php endif ?>
                        <?php endforeach ?>


                     <?php if($record_count == 0) : ?>
                        <tr><td colspan="5" style="text-align: center; font-style: italic">No records found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>