<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/sales/po.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#delivery_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        
        $('#order_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        
        $('.tabs').tabs();
    });
</script>

<div id="msg"></div>

    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#customerinfo">Customer Information</a></li>
        <li><a href="#poinfo">PO Information</a></li>
        <li><a href="#items">Items</a></li>
    </ul>

<form id="po-form" method="post" 
      de
      action="
       <?php if($formStatus == Constants_FormAction::ADD) : ?>
            <?php echo $base_url ?>cms/sales/po/process_form/<?php if(isset($purchaseorder)) echo Helper_Helper::encrypt($purchaseorder->po_id) ?>
       <?php else :?>
            <?php echo $base_url ?>cms/sales/po/approve/<?php if(isset($purchaseorder)) echo Helper_Helper::encrypt($purchaseorder->po_id) ?>
       <?php endif ?>
       ">

    <input type="hidden" name="id" id="id" value="<?php if(isset($purchaseorder)) echo Helper_Helper::encrypt($purchaseorder->po_id) ?>"/> 
    
<div class="tab-content">
    
    <div id="customerinfo" class="tab-pane active">
        
<!--        <table class="fullWidth borderless">-->
<!--            <tr>
                <td class="half">
                    <table class="fullWidth">
                        <tr>
                            <td class="right"><span class="required">&ast;</span>Customer:</td>
                            <td>-->
                                <input id="custid_val" name="customer_id" style="display:none"/>
                                <input style="display:none" id="customer" class="dd-input" value="<?php if(isset($purchaseorder)) echo $purchaseorder->customers->company ?>" name="company" id="company" type="text" <?php if(isset($purchaseorder)) echo 'disabled="disabled"' ?>/>
<!--                            </td>
                        </tr>
                    </table>
                </td>-->
                
<!--                <td class="half border">-->
                    
                    <?php if(isset($customers)) : ?>
                    
                    <table class="fullWidth bordered-table condensed-table">
                        <thead class="">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Customer Name</th>
                                <th>Company</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php $record_count = 0;?>
                            <?php foreach($customers as $result) :?>
                                <?php $record_count++;?>
                            <tr>
                                <input type="hidden" id="custid<?php echo $result->customer_id ?>" value="<?php echo $result->customer_id ?>" />
                                <td width="4%"><input onclick="display_customer('<?php echo $result->customer_id ?>')" class="id" name="id" type="radio" id="rad<?php echo $result->customer_id ?>"/></td>
                                <td id="name<?php echo $result->customer_id ?>"><?php echo $result->full_name() ?></td>
                                <td id="company<?php echo $result->customer_id ?>"><?php echo $result->company ?></td> 
                            </tr>
                            <?php endforeach ?>
                            <?php if($record_count == 0) : ?>
                                <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <div class="column span-14 last pull-right" id="pagination">
                        <?php if(isset($pagination)) echo $pagination ?>
                    </div>
                    
                    
                    <?php else : ?>


            <table class="borderless">

                <tr>
                    <td class="borderless" style="width:10%"><strong>Company:</strong></td>
                    <td><?php echo $purchaseorder->customers->company ?></td>
                </tr>
                <tr>
                    <td class="borderless" style="width:10%"><strong>Customer:</strong></td>
                    <td><?php echo $purchaseorder->customers->full_name() ?></td>
                </tr>
                <tr>
                    <td class="borderless" style="width:10%"><strong>Address:</strong></td>
                    <td><?php echo $purchaseorder->deliveryaddresses->complete_address() ?></td>
                </tr>

            </table>

                     <?php endif ?>
        <table>
            <tr>
                <td class="borderless"id="cust-da"></td>
            </tr>
        </table>
    </div>
    
    
    <div id="poinfo" class="tab-pane">
        <table class="form">
      <?php if( isset($purchaseorder) ) { ?>
        <input type="hidden" name="po_id_encrypt" id="po_id_encrypt" value="<?php echo Helper_Helper::encrypt($purchaseorder->po_id); ?>" />
            <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />

      <tr>
          <td colspan="3" class="table-section">basic information</td>
      </tr>
      <tr>
        <td class="right">
            <span class="required">&ast;</span>Purchase Order #
        </td>
        <td>
            <label for="po_id"></label>
            <input class="dd-input" value="<?php echo (isset ($purchaseorder)) ? $purchaseorder->po_id_string : Helper_Helper::set_pk(1)?>" name="po_id_string" type="text" id="po_id" maxlength="" <?php echo (isset($purchaseorder)) ?  'disabled="disabled"' : 'readonly="readonly"'?>/>
        </td>
        <td style="width:40%;"><span id="msg"></span></td>
      </tr>
            <tr>
                <td colspan="3" class="table-section">delivery information</td>
            </tr>
      <tr>
        <td class="right"><span class="required">&ast;</span>Delivery Date</td>
        <td>
            <label for="delivery_date"></label>
            <input class="dd-input" data-date-format="mm/dd/yy" value="<?php if(isset($purchaseorder)) echo $purchaseorder->delivery_date ?>" name="delivery_date" id="delivery_date" type="text"/>
        </td>
        <td style="width:40%;"><span id="msg"></span></td>
      </tr>
      
      <tr>
        <td class="right"><span class="required">&ast;</span>Order Date</td>
        <td>
             <label for="order_date"></label>
            <input class="dd-input" value="<?php if(isset($purchaseorder)) echo $purchaseorder->order_date ?>" name="order_date" id="order_date" type="text" <?php if(isset($purchaseorder)) echo 'disabled="disabled"' ?>/>
        </td>
        <td style="width:40%;"><span id="msg"></span></td>
      </tr>
      <tr>
        <td class="right"><span class="required">&ast;</span>Terms</td>
        <td>
             <label for="terms"></label>
            <input class="dd-input" value="<?php if(isset($purchaseorder)) echo $purchaseorder->terms ?>" name="terms" id="terms" type="text" <?php if(isset($purchaseorder)) echo 'disabled="disabled"' ?>/>
        </td>
        <td style="width:40%;"><span id="msg"></span></td>
      </tr>
      
      <tr>
          <td class="right"><span class="required">&ast;</span>Payment Method</td>
          <td>
               <select class="fullWidth" id="payment_method" name="payment_method">
                            <option></option>
                            <option value="Cash/COD" <?php echo (isset($purchaseorder) && ( $purchaseorder->payment_method == 'Cash/COD')) ? 'selected="selected"' : ''?> >Cash/COD</option>
                            <option value="Check" <?php echo (isset($purchaseorder) && ( $purchaseorder->payment_method == 'Check')) ? 'selected="selected"' : ''?> >Check</option>
               </select>
          </td>
      </tr>

    </table>
    </div>
    
    <div id="items" class="tab-pane">
        <div class="right">
            <?php if($formStatus == Constants_FormAction::ADD) : ?>
            <input id="add" name="btn_add" type="button" onclick="add_row('poitems')" value="add item" />
            <?php endif ?>
        </div>
        <br/>
        <table id="poitems" class="fullWidth zebra-striped condensed-table">
            <thead>
                <tr>
                    <?php if($formStatus == Constants_FormAction::ADD) : ?>
                    <?php endif ?>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>Unit Price</th>
                    <?php if($formStatus == Constants_FormAction::EDIT) : ?>
                    <th>Tax</th>
                    <?php endif ?>
                    <th style="width:5%">&nbsp;</th>
                </tr>
            </thead>
            
            <tbody>
                
                <?php if($formStatus == Constants_FormAction::EDIT) : ?>
                
                   <?php foreach($purchaseorder->poitems->find_all() as $record) : ?>
                    <tr>
                        <?php if($purchaseorder->store_flag == "1") : ?>
                                <td><?php echo $record->product_description ?></td>
                                <td><?php echo $record->qty ?></td>
                                <td><?php echo $record->variants->unitmaterials->get_description() ?></td>
                                <td><?php echo number_format($record->variants->price, 2) ?></td>
                                <td>
                                    <?php $tax = ORM::factory('taxcode')
                                                    ->find_all();?>
                                    <select name="tax[]" id="tax">
                                        <?php foreach($tax as $result) :?>
                                        <option value="<?php if(isset($result)) echo $result->tax_code_id ?>"><?php echo $result->description ?></option>>
                                        <?php endforeach ?>
                                    </select></td>
                         <?php elseif ($purchaseorder->store_flag == "2") : ?>
                                <td><?php echo $record->product_description ?></td>
                                <td><?php echo $record->qty ?></td>
                                <td><?php echo $record->unitmaterials->get_description() ?></td>
                                <td><?php echo number_format($record->unit_price, 2) ?></td>
                                <td>
                                    <?php $tax = ORM::factory('taxcode')
                                                    ->find_all();?>
                                    <select name="tax[]" id="tax">
                                        <?php foreach($tax as $result) :?>
                                        <option value="<?php if(isset($result)) echo $result->tax_code_id ?>"><?php echo $result->description ?></option>>
                                        <?php endforeach ?>
                                    </select></td>
                         <?php endif ?>
                    </tr>
                   <?php endforeach ?>
                
                <?php else : ?>
                
                
                <?php $uom = ORM::factory('unitmaterialtype')
                                ->find_all(); ?>
                <tr>
                    <input type="hidden" name="id[]"/>
                    <td><input name="item[]" class="fullWidth"/></td>
                    <td><input name="qty[]" class="fullWidth"/></td>
                    <td><select name="uom[]" id="uom"/>
                    <?php foreach($uom as $result) : ?>
                    <option class="fullWidth" value="<?php if(isset($result)) echo $result->um_id ?>"><?php echo $result->get_description() ?></option>
                    <?php endforeach ?>
                    </select></td>
                    <td><input name="unitprice[]" class="fullWidth"/></td>
                    <td>&nbsp;</td>
                    <td><a style="margin-left:10px;" href="#" id="del" onclick="bullshrek()">delete</a></td>
                </tr>
                
                <?php endif ?>
            </tbody>
        </table>
        
    </div>
    
</div>
    
    <?php if($formStatus == Constants_FormAction::ADD) :?>
        <input name="btn_submit" type="submit" value="Save Purchase Order" class="btn "/>
    <?php else : ?>
        <a onclick="delivery_date()" href="javascript:void(0)" class="btn">Save Delivery Date</a>
        <input name="btn_submit" type="submit" value="Approve" class="btn"/>
        <a onclick="disapprove_po()" href="javascript:void(0)" class="btn">Disapprove</a>
    <?php endif ?>
    
    <input name="btn_cancel" type="button" onclick="cancel_purchaseorder()" value="Cancel" class="btn" />
    
</form>


     <?php if($formStatus == Constants_FormAction::ADD) : ?>
        <script src="<?php echo $base_url . $config['js'] ?>/cms/sales/form/po.js" type="text/javascript"></script>
     <?php else :?>
      <script src="<?php echo $base_url . $config['js'] ?>/cms/sales/form/po2.js" type="text/javascript"></script>
      <?php endif ?>

<!--                MODALS-->

    <div class="modal hide fade in" id="delete-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Delete Customer Record</h2>
        </div>
        <div class="modal-body">
          <p>Do you really want to delete? This operation is irreversible.</p>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_deletemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="delete_customer()">Yes</a>
        </div>
      </div>