<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/so.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <div id="msg"></div>
    
       <?php echo isset($success) ? '<span class="success">Sales Order successfully ' . $success . '</span>' : ''; ?>
 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#general">General</a></li>
        <li><a href="#items">Items</a></li>
    </ul>
    
    <input type="hidden" id="so_id_encrypt" value="<?php echo Helper_Helper::encrypt($salesorder->so_id) ?>" />
    
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData"> 
                     
                    <?php $approveflag = FALSE ?>  
                        
                    <?php if(in_array(Constants_UserType::PRESIDENT, Session::instance()->get('roles'))) : ?>
                            <?php if(is_null($salesorder->ceo_approved_status)) : ?>
                            <div class="alert-message block-message notice">
                                <p>You are a <strong>Chief Executive Officer</strong>. What do you want to do?</p>
                                <div class="alert-actions">
                                    <a class="btn small" data-backdrop="static" data-controls-modal="ceoapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::PRESIDENT ?>)">Approve as (CEO)</a>
                                    <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::PRESIDENT ?>)">Disapprove as (CEO)</a>
                                    <input type="hidden" id="role_ceo" value="<?php echo Helper_Helper::encrypt(Constants_UserType::PRESIDENT) ?>" /> 
                                </div>
                            </div>   
                            <?php $approveflag = TRUE ?>
                            <?php endif ?>
                    <?php endif ?>
                                                
                    <?php if(in_array(Constants_UserType::SALES_COORDINATOR, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($salesorder->sc_approved_status)) : ?>
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
                        <?php if(is_null($salesorder->gm_approved_status)) : ?>
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
                        
                    <?php if(in_array(Constants_UserType::ACCOUNTANT, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($salesorder->accountant_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Accountant</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::ACCOUNTANT ?>)">Approve as (AC)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::ACCOUNTANT ?>)">Disapprove as (AC)</a>
                                <input type="hidden" id="role_acc" value="<?php echo Helper_Helper::encrypt(Constants_UserType::ACCOUNTANT) ?>" /> 
                            </div>
                        </div> 
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(! $approveflag) : ?>
                        
                        <?php if($salesorder->ceo_approved_status == 2) : ?>
                            <div class="alert-message block-message notice">
                                <p>This Sales Order is disapproved by the <strong>Chief Executive Officer</strong>.</p>
                            </div>
                        <?php else : ?>
                            <div class="alert-message block-message success">
                                <p>This Sales Order does not have pending signatories.</p>
                            </div>
                        <?php endif ?>
                        
                    <?php endif?>    
                        
                    </td>
                    
                    <td class="half borderless formData">
                        
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Approved to SO:</td>
                                <td colspan="2"><?php echo $salesorder->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Chief Executive Officer:</td>
                                <td style="color: <?php echo $salesorder->color_status('ceo_approved_status') ?>; font-weight: bold;"><?php echo $salesorder->role_status('ceo_approved_status') ?></td>
                                <td><?php echo $salesorder->ceo_approved_date ?></td>
                                <td><?php echo $salesorder->ceo->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>General Manager:</td>
                                <td style="color: <?php echo $salesorder->color_status('gm_approved_status') ?>; font-weight: bold;"><?php echo $salesorder->role_status('gm_approved_status') ?></td>
                                <td><?php echo $salesorder->gm_approved_date ?></td>
                                <td><?php echo $salesorder->approved->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $salesorder->color_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $salesorder->role_status('sc_approved_status') ?></td>
                                <td><?php echo $salesorder->sc_approved_date ?></td>
                                <td><?php echo $salesorder->prepared->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Accountant:</td>
                                <td style="color: <?php echo $salesorder->color_status('accountant_approved_status') ?>; font-weight: bold;"><?php echo $salesorder->role_status('accountant_approved_status') ?></td>
                                <td><?php echo $salesorder->accountant_approved_date ?></td>
                                <td><?php echo $salesorder->checked->full_name() ?></td>
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
                                    <td><?php echo $salesorder->date_created ?></td>
                                </tr>
                                <tr>
                                    <td>Order #:</td>
                                    <td><?php echo $salesorder->so_id_string ?></td>
                                </tr>
                                <tr>
                                    <td>Terms:</td>
                                    <td><?php echo $salesorder->purchaseorders->terms ?></td>
                                </tr>
                                <tr>
                                    <td>PO #:</td>
                                    <td><?php echo $salesorder->purchaseorders->po_id_string  ?></td>
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
                                    <td><?php echo $salesorder->purchaseorders->payment_method ?></td>
                                </tr>
                                <tr>
                                    <td>Ship Date:</td>
                                    <td><?php echo $salesorder->purchaseorders->delivery_date ?></td>
                                </tr>
                                <tr>
                                    <td>Bill To:</td>
                                    <td><?php echo $salesorder->purchaseorders->deliveryaddresses->complete_address() ?></td>
                                </tr>
                                <tr>
                                    <td>Ship To:</td>
                                    <td><?php echo $salesorder->purchaseorders->deliveryaddresses->complete_address() ?></td>
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
                                <?php foreach($salesorder->soitems->find_all() as $item) : ?>
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
                                <?php foreach($salesorder->soitems->find_all() as $item) : ?>
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
              </tbody>
            </table>
            
            <input style="display:none" id="buttonclicked" />
            <input style="display:none" id="type" />
        </div>
        
    </div>
    
<!--    MODALS-->
<!--approve modal for ceo    -->
    <div class="modal hide fade in" id="ceoapprove-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Approve Sales Order</h2>
        </div>
        <div class="modal-body">
          <p>Do you want to approve?</p>
          <textarea class="fullWidth" name="ceocomment" id="ceocomment">Reason</textarea>
        </div>
        <div class="modal-footer">
           <a class="btn secondary" href="javascript:void(0)" onclick="close_ceoapprovemodal()">Cancel</a>
          <a class="btn primary" href="javascript:void(0)" onclick="determine_signatory($('#buttonclicked').val(), 'APPROVE')">Yes</a>
        </div>
      </div>


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
          <a class="btn primary" href="javascript:void(0)" onclick="determine_signatory($('#buttonclicked').val(),'APPROVE')">Yes</a>
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
          <a class="btn danger" href="javascript:void(0)" onclick="determine_signatory($('#buttonclicked').val(), 'DISAPPROVE')">Yes</a>
        </div>
      </div>