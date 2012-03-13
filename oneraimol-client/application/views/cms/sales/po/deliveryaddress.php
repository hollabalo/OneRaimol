                <table class="fullWidth condensed-table bordered-table">
                    <thead>
                    	<tr>
                            <th>&nbsp;</th>
                            <th>Delivery Address</th>
                            <th>Type</th>
                        </tr>
                        <?php $record_count = 0;?>
                    </thead>
                    <tbody>
                        <?php foreach($deliveryaddress as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><input class="id" name="delivery_id[]" type="radio" value ="<?php echo Helper_Helper::encrypt($result->delivery_address_id); ?>" id="chk<?php echo $result->delivery_address_id ?>"/></td>
                            <td><?php echo $result->complete_address() ?><input type="hidden" name="da_text" value="<?php echo $result->pk() ?>"/></td>
                            <td><?php echo $result->type_address ?></td> 
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="3" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>