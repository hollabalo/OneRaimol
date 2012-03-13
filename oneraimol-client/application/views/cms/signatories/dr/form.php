<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/dr.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <div id="msg"></div>
    
       <?php echo isset($success) ? '<span class="success">Delivery Receipt successfully ' . $success . '</span>' : ''; ?>
 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#general">General</a></li>
        <li><a href="#items">Items</a></li>
    </ul>
    
    <input type="hidden" id="dr_id_encrypt" value="<?php echo Helper_Helper::encrypt($deliveryreceipt->dr_id) ?>" />
    
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData"> 
                     
                    <?php $approveflag = FALSE ?>  
                        
                    <?php if(in_array(Constants_UserType::PRODUCT_MANAGER, Session::instance()->get('roles'))) : ?>
                        
                            <?php if(is_null($deliveryreceipt->pm_approved_status)) : ?>
                            <div class="alert-message block-message notice">
                                <p>You are a <strong>Production Manager</strong>. What do you want to do?</p>
                                <div class="alert-actions">
                                    <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::PRODUCT_MANAGER ?>)">Approve as (PM)</a>
                                    <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::PRODUCT_MANAGER ?>)">Disapprove as (PM)</a>
                                    <input type="hidden" id="role_pm" value="<?php echo Helper_Helper::encrypt(Constants_UserType::PRODUCT_MANAGER) ?>" /> 
                                </div>
                            </div>   
                            <?php $approveflag = TRUE ?>
                            <?php endif ?>
                    <?php endif ?>
                                                
                    <?php if(in_array(Constants_UserType::SALES_COORDINATOR, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($deliveryreceipt->sc_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Sales Coordinator</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::SALES_COORDINATOR ?>)">Approve as (SC)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::SALES_COORDINATOR ?>)">Disapprove as (SC)</a>
                                <input type="hidden" id="role_sc" value="<?php echo Helper_Helper::encrypt(Constants_UserType::SALES_COORDINATOR) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                     
                    <?php if(in_array(Constants_UserType::GENERAL_MANAGER, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($deliveryreceipt->gm_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>General Manager</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::GENERAL_MANAGER ?>)">Approve as (GM)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::GENERAL_MANAGER ?>)">Disapprove as (GM)</a>
                                <input type="hidden" id="role_gm" value="<?php echo Helper_Helper::encrypt(Constants_UserType::GENERAL_MANAGER) ?>" /> 
                            </div>
                        </div> 
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(in_array(Constants_UserType::INVENTORY_CONTROLLER, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($deliveryreceipt->ic_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are an <strong>Inventory Controller</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::INVENTORY_CONTROLLER ?>)">Approve as (IC)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::INVENTORY_CONTROLLER ?>)">Disapprove as (IC)</a>
                                <input type="hidden" id="role_ic" value="<?php echo Helper_Helper::encrypt(Constants_UserType::INVENTORY_CONTROLLER) ?>" /> 
                            </div>
                        </div> 
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                        <?php if(in_array(Constants_UserType::LABORATORY_ANALYST, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($deliveryreceipt->labanalyst_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are an <strong>Laboratory Analyst</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::LABORATORY_ANALYST ?>)">Approve as (LA)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::LABORATORY_ANALYST ?>)">Disapprove as (LA)</a>
                                <input type="hidden" id="role_labanalyst" value="<?php echo Helper_Helper::encrypt(Constants_UserType::LABORATORY_ANALYST) ?>" /> 
                            </div>
                        </div>
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(! $approveflag) : ?>
                        
                            <div class="alert-message block-message success">
                                <p>This Delivery Receipt does not have pending signatories.</p>
                            </div>
                        
                    <?php endif?>    
                        
                    </td>
                    
                    <td class="half borderless formData">
                        
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Created DR:</td>
                                <td colspan="2"><?php echo $deliveryreceipt->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Production Manager:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('pm_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('pm_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->pm_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->received->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>General Manager:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('gm_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('gm_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->gm_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->approved->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('sc_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->sc_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->prepared->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Inventory Contoller:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('ic_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('ic_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->ic_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->received->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Laboratory Analyst:</td>
                                <td style="color: <?php echo $deliveryreceipt->colorrole_status('labanalyst_approved_status') ?>; font-weight: bold;"><?php echo $deliveryreceipt->role_status('labanalyst_approved_status') ?></td>
                                <td><?php echo $deliveryreceipt->labanalyst_approved_date ?></td>
                                <td><?php echo $deliveryreceipt->checked->full_name() ?></td>
                            </tr>
                        </table>
                        
                    </td>
                    
                </tr>
            </table>
           
        </div>
        
        <div id="general" class="tab-pane">
            <table class="fullWidth formData">
                <tr>
                    <td class="half borderless formData">
<fieldset>
                            <legend>Base Information</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td class="half">Date:</td>
                                    <td><?php echo $deliveryreceipt->date_created ?></td>
                                </tr>
                                <tr>
                                    <td>Order #:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->so_id_string ?></td>
                                </tr>
                                <tr>
                                    <td>Terms:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->terms ?></td>
                                </tr>
                                <tr>
                                    <td>PO #:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->po_id_string  ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>

                    <td class="half borderless formData">  
                        <fieldset>
                            <legend>Billing and Shipping</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td>Payment Method:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->payment_method ?></td>
                                </tr>
                                <tr>
                                    <td>Ship Date:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->delivery_date ?></td>
                                </tr>
                                <tr>
                                    <td>Bill To:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->deliveryaddresses->complete_address() ?></td>
                                </tr>
                                <tr>
                                    <td>Ship To:</td>
                                    <td><?php echo $deliveryreceipt->salesorders->purchaseorders->deliveryaddresses->complete_address() ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </div>
      
        <div id="items" class="tab-pane">
            <table class="fullWidth condensed-table zebra-striped ">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit of Material</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                        <th>Tax Rate</th>
                        <th>Gross Amount</th>
                        <th>Tax Amount</th>
                    </tr>
                </thead>
             <tbody>
                  <?php if($purchaseorder->store_flag == "1") : ?>
                                <?php $record_count = 0;?>                 
                                <?php foreach($deliveryreceipt->salesorders->soitems->find_all() as $item) : ?>
                                <?php $record_count++;?>        
                                <tr>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td><?php echo $item->poitems->qty ?></td>
                                    <td><?php echo $item->poitems->variants->unitmaterials->get_description() ?></td>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td>PhP <?php echo number_format($item->poitems->variants->price, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                                    <td><?php echo $item->taxcodes->description ?></td>
                                    <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                                </tr>
                                <?php endforeach ?>
                    <?php elseif ($purchaseorder->store_flag == "2") :?>
                                <?php $record_count = 0;?>                 
                                <?php foreach($deliveryreceipt->salesorders->soitems->find_all() as $item) : ?>
                                <?php $record_count++;?>        
                                <tr>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td><?php echo $item->poitems->qty ?></td>
                                    <td><?php echo $item->poitems->unitmaterials->get_description() ?></td>
                                    <td><?php echo $item->poitems->product_description ?></td>
                                    <td>PhP <?php echo number_format($item->poitems->unit_price, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                                    <td><?php echo $item->taxcodes->description ?></td>
                                    <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                                    <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                                </tr>
                                <?php endforeach ?>
                    <?php endif ?>
                                    <?php if($record_count == 0) : ?>
                                        <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                                    <?php endif ?>

              </tbody> 
            </table>
            
            <input style="display:none" id="buttonclicked" />
            <input style="display:none" id="type" />
        </div>
        
    </div>
    
<!--    MODALS-->
    
    <div class="modal hide fade in" id="approve-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Approve Sales Order</h2>
        </div>
        <div class="modal-body">
          <p>Do you want to approve?</p>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_approvemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="determine_signatory($('#buttonclicked').val(), 'APPROVE',$('#type').val())">Yes</a>
        </div>
      </div>

    <div class="modal hide fade in" id="disapprove-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Disapprove Sales Order</h2>
        </div>
        <div class="modal-body">
          <p>Do you want to disapprove?</p>
          <textarea class="fullWidth" name="comment" id="comment">Reason</textarea>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_disapprovemodal()">Cancel</a>
          <a class="btn danger" href="javascript:void(0)" onclick="determine_signatory($('#buttonclicked').val(), 'DISAPPROVE',$('#type').val())">Yes</a>
        </div>
      </div>