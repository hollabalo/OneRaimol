<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/pwo.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <div id="msg"></div>
      <?php echo isset($success) ? '<span class="success">Production Work Order successfully ' . $success . '</span>' : ''; ?>
 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#items">Items</a></li>
    </ul>
    
    <input type="hidden" id="pwo_id_encrypt" value="<?php echo Helper_Helper::encrypt($productionworkorder->pwo_id) ?>" />
    
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData">
                        
                    <?php $approveflag = FALSE ?>    
                        
                    <?php if(in_array(Constants_UserType::HEAD_CHEMIST, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionworkorder->hc_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Head Chemist (HC)</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::HEAD_CHEMIST ?>)">Approve as (HC)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::HEAD_CHEMIST ?>)">Disapprove as (HC)</a>
                                <input type="hidden" id="role_hc" value="<?php echo Helper_Helper::encrypt(Constants_UserType::HEAD_CHEMIST) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(in_array(Constants_UserType::SALES_COORDINATOR, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionworkorder->sc_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Sales Coordinator (SC)</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::SALES_COORDINATOR ?>)">Approve as (SC)</a>
                               <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::SALES_COORDINATOR ?>)">Disapprove as (SC)</a>
                                <input type="hidden" id="role_sc" value="<?php echo Helper_Helper::encrypt(Constants_UserType::SALES_COORDINATOR) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(in_array(Constants_UserType::ACCOUNTANT, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionworkorder->accountant_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Accountant</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::ACCOUNTANT ?>)">Approve as (ACC)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::ACCOUNTANT ?>)">Disapprove as (ACC)</a>
                                <input type="hidden" id="role_acc" value="<?php echo Helper_Helper::encrypt(Constants_UserType::ACCOUNTANT) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                              
                    <?php if(! $approveflag) : ?>
                        <div class="alert-message block-message success">
                            <p>This Production Work Order does not have pending signatories.</p>
                        </div>
                    <?php endif?>    
                        
                    </td>
                    
                    <td class="half borderless formData">
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Accountant:</td>
                                <td style="color: <?php echo $productionworkorder->color_status('accountant_approved_status') ?>; font-weight: bold;"><?php echo $productionworkorder->role_status('accountant_approved_status') ?></td>
                                <td><?php echo $productionworkorder->accountant_approved_date ?></td>
                                <td><?php echo $productionworkorder->noted->full_name()?></td>
                            </tr>
                            <tr>
                                <td>Head Chemist:</td>
                                <td style="color: <?php echo $productionworkorder->color_status('hc_approved_status') ?>; font-weight: bold;"><?php echo $productionworkorder->role_status('hc_approved_status') ?></td>
                                <td><?php echo $productionworkorder->hc_approved_date ?></td>
                                <td><?php echo $productionworkorder->approved->full_name()?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $productionworkorder->color_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $productionworkorder->role_status('sc_approved_status') ?></td>
                                <td><?php echo $productionworkorder->sc_approved_date ?></td>
                                <td><?php echo $productionworkorder->prepared->full_name()?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
      
        <div id="items" class="tab-pane">
            <table class="fullWidth condensed-table zebra-striped ">
                <thead>
                    <tr>
                        <th>SO #</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>U/M</th>
                        <th>Customer</th>
                        <th>PO #</th>
                        <th>Terms</th>
                        <th>Batch #</th>
                        <th>Delivery Date</th>
<!--                        <th>DR</th>
                        <th>Remarks</th>-->
                    </tr>
                </thead>
                <tbody> 
                     <?php $record_count = 0;?>
                     <?php foreach($productionworkorder->pwoitems->find_all() as $result) :?>
                     <?php $record_count++;?>   
                    
                    <?php if($result->soitems->salesorders->purchaseorders->store_flag == "1") : ?>
                        <tr>
                            <td><?php echo $result->soitems->salesorders->so_id_string  ?></td>
                            <td><?php echo $result->soitems->poitems->product_description ?></td>
                            <td><?php echo $result->soitems->poitems->qty ?></td>
                            <td><?php echo $result->soitems->poitems->variants->unitmaterials->get_description() ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->customers->full_name(); ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->terms ?></td>
                            <td><?php echo $result->batch_no ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->delivery_date ?></td>
<!--                            <td><?php // echo $result->pwoitems->find()->dr_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->invoice_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->remarks ?></td>-->
                        </tr>
                    <?php elseif ($result->soitems->salesorders->purchaseorders->store_flag == "2") : ?>
                        <tr>
                            <td><?php echo $result->soitems->salesorders->so_id_string  ?></td>
                            <td><?php echo $result->soitems->poitems->product_description ?></td>
                            <td><?php echo $result->soitems->poitems->qty ?></td>
                            <td><?php echo $result->soitems->poitems->unitmaterials->get_description() ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->customers->full_name(); ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->po_id_string ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->terms ?></td>
                            <td><?php echo $result->batch_no ?></td>
                            <td><?php echo $result->soitems->salesorders->purchaseorders->delivery_date ?></td>
<!--                            <td><?php // echo $result->pwoitems->find()->dr_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->invoice_flag ?></td>
                            <td><?php // echo $result->pwoitems->find()->remarks ?></td>-->
                        </tr>
                     <?php endif ?>
                        <?php endforeach ?>
                     <?php //endforeach ?>
                     

                     <?php if($record_count == 0) : ?>
                        <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>
            
                        
            <input style="display:none" id="buttonclicked" />
        </div>
        
    </div>
    
<!--    MODALS-->
    
    <div class="modal hide fade in" id="approve-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Approve Production Work Order</h2>
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
          <h2>Disapprove Production Work Order</h2>
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