<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/production/pwo.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
    
</script>

    <div id="msg"></div>
    <?php echo isset($success) ? '<span class="success">Production Work Order successfully ' . $success . '</span>' : ''; ?>
 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#items">Items</a></li>
    </ul>
<form id="pwo-form" method="post" action="<?php echo $base_url ?>cms/production/pwo/process_form/<?php if(isset($productionworkorder)) echo Helper_Helper::encrypt($productionworkorder->pwo_id) ?>">
    <?php if( isset($productionworkorder) ) { ?>
    <input type="hidden" id="pwo_id_encrypt" value="<?php echo Helper_Helper::encrypt($productionworkorder->pwo_id) ?>" />
    <?php } ?>
    
    <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
    <div class="tab-content">
       
        <div id="#items" class="tab-pane active">
            <table class="fullWidth">
                <tr>
                    <td class="borderless formData" style="width:45%">
                        <fieldset>
                            <legend>Production Work Order Items</legend>
                            

                            <table class="fullWidth condensed-table zebra-striped" id="pwo_grid">
                                <thead>
                                    <tr>
                                        <th class="borderless">&nbsp;</th>
                                        <th class="borderless">Item</th>
                                        <th class="borderless">UOM</th>
                                        <th class="borderless">Qty</th>
                                        <th class="borderless" style="width:25%">Delivery Date</th>
                                    </tr>
                                </thead>
                                <tbody class="resetpadding">
                                </tbody>
                            </table>
                            
                        </fieldset>
                    </td>
                    
                    <td class="borderless formData" style="width:5%; padding-left:10px;">
                        &nbsp;
                    </td>
                    
                    <td class="borderless formData" style="width:50%">
                        <fieldset>
                            <legend>Approved Items in Sales Orders</legend>
                            
                            
                            <table class="fullWidth condensed-table zebra-striped" id="tableso">
                                <thead class="formData">
                                    <tr>
                                        <th class="borderless">&nbsp;</th>
                                        <th class="borderless">Item</th>
                                        <th class="borderless">UOM</th>
                                        <th class="borderless">Qty</th>
                                        <th class="borderless" style="width:25%">Delivery Date</th>
                                    </tr>
                                </thead>
                                
                                
                                <tbody class="resetpadding">
                                
                                    <?php $ctr = 0; ?>
                                    <?php foreach($salesorder as $result) :?>
                                    <?php $ctr++; ?>
                                    
                                        <?php if($result->purchaseorders->store_flag == "1") : ?>
                                            <tr id="sohead<?php echo $ctr?>">
                                            <td class="borderless" colspan="5"><?php echo $result->so_id_string ?></td>
                                            </tr>
                                                <?php foreach($result->soitems->where('pwo_id', '=', NULL)->find_all() as $item) : ?>
                                                    <tr>
                                                        <td class="borderless" style="width:2%"><a href="#" id="item" onclick="add_row(<?php echo $ctr ?>,<?php echo $item->so_item_id ?>)">add</a></td>
                                                        <td class="borderless" style="width:50%"><?php echo $item->poitems->product_description ?></td>
                                                        <td class="borderless" style="width:15%"><?php echo $item->poitems->variants->unitmaterials->get_description() ?></td>
                                                        <td class="borderless" style="width:10%"><?php echo $item->poitems->qty ?></td>
                                                        <td class="borderless" style="width:12%"><?php echo $item->poitems->purchaseorders->delivery_date ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                         <?php endif ?>
                                        <?php endforeach ?>
                                
                                    <?php $ctr = 0; ?>
                                    <?php foreach($salesorder as $result) :?>
                                    <?php $ctr++; ?>
                                    <?php if ($result->purchaseorders->store_flag == "2") :?>
                                    <tr id="sohead<?php echo $ctr?>">
                                    <td class="borderless"><?php echo $result->so_id_string ?></td>
                                    </tr>
                                    <?php foreach($result->soitems->where('pwo_id', '=', NULL)->find_all() as $item) : ?>
                                        <tr>
                                            <td class="borderless" style="width:2%"><a href="#" id="item" onclick="add_row(<?php echo $ctr ?>,<?php echo $item->so_item_id ?>)">add</a></td>
                                            <td class="borderless" style="width:50%"><?php echo $item->poitems->product_description ?></td>
                                            <td class="borderless" style="width:15%"><?php echo $item->poitems->unitmaterials->get_description() ?></td>
                                            <td class="borderless" style="width:10%"><?php echo $item->poitems->qty ?></td>
                                            <td class="borderless" style="width:12%"><?php echo $item->poitems->purchaseorders->delivery_date ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <?php if($ctr == 0) : ?>
                                        <tr><td colspan="5" style="text-align: center; font-style: italic">No records found.</td></tr>
                                    <?php endif ?>
                                 
                                </tbody>
                            </table>
                            
                            
                        </fieldset>
                    </td>
                </tr>
            </table>
        </div>
        <input name="btn_submit" type="submit" value="Save" class="btn"/>
    </div>
</form>
    
    <script src="<?php echo $base_url . $config['js'] ?>/cms/production/form/pwo.js" type="text/javascript"></script>