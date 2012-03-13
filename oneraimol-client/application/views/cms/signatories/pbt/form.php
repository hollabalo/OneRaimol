<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/pbt.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <div id="msg"></div>
    
           <?php echo isset($success) ? '<span class="success">Production Batch Ticket successfully ' . $success . '</span>' : ''; ?>
  
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#details">Details</a></li>
        <li><a href="#formula">Formula</a></li>
    </ul>
    
    <input type="hidden" id="pbt_id_encrypt" value="<?php echo Helper_Helper::encrypt($productionbatchticket->pbt_id) ?>" />
    
    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData">
                        
                    <?php $approveflag = FALSE ?>    
                        
                    <?php if(in_array(Constants_UserType::HEAD_CHEMIST, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionbatchticket->hc_approved_status)) : ?>
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
                        
                    <?php if(in_array(Constants_UserType::LABORATORY_ANALYST, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionbatchticket->labanalyst_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Laboratory Analyst (LA)</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::LABORATORY_ANALYST ?>)">Approve as (LA)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::LABORATORY_ANALYST ?>)">Disapprove as (LA)</a>
                                <input type="hidden" id="role_labanalyst" value="<?php echo Helper_Helper::encrypt(Constants_UserType::LABORATORY_ANALYST) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(in_array(Constants_UserType::QUALITY_ASSURANCE, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionbatchticket->qa_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Quality Assurance (QA)</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::QUALITY_ASSURANCE ?>)">Approve as (QA)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::QUALITY_ASSURANCE ?>)">Disapprove as (QA)</a>
                                <input type="hidden" id="role_qa" value="<?php echo Helper_Helper::encrypt(Constants_UserType::QUALITY_ASSURANCE) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                        
                    <?php if(in_array(Constants_UserType::QUALITY_ASSURANCE_HEAD, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($productionbatchticket->qa_head_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>Quality Assurance - Head (QA-H)</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::QUALITY_ASSURANCE_HEAD ?>)">Approve as (QA-H)</a>
                                <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::QUALITY_ASSURANCE_HEAD ?>)">Disapprove as (QA-H)</a>
                                <input type="hidden" id="role_qah" value="<?php echo Helper_Helper::encrypt(Constants_UserType::QUALITY_ASSURANCE_HEAD) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
                              
                    <?php if(! $approveflag) : ?>
                        <div class="alert-message block-message success">
                            <p>This Production Batch Ticket does not have pending signatories.</p>
                        </div>
                    <?php endif?>    
                        
                    </td>
                    
                    <td class="half borderless formData">
                        
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Approved to PBT:</td>
                                <td colspan="2"><?php echo $productionbatchticket->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Head Chemist:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('hc_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('hc_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->hc_approved_date ?></td>
                                <td><?php echo $productionbatchticket->checked_two->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Quality Assurance Head:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('qa_head_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('qa_head_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->qa_head_approved_date ?></td>
                                <td><?php echo $productionbatchticket->noted->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Quality Assurance:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('qa_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('qa_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->qa_approved_date ?></td>
                                <td><?php echo $productionbatchticket->checked_one->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Laboratory Analyst:</td>
                                <td style="color: <?php echo $productionbatchticket->color_status('labanalyst_approved_status') ?>; font-weight: bold;"><?php echo $productionbatchticket->role_status('labanalyst_approved_status') ?></td>
                                <td><?php echo $productionbatchticket->labanalyst_approved_date ?></td>
                                <td><?php echo $productionbatchticket->prepared->full_name() ?></td>
                            </tr>
                        </table>
                        
                    </td>
                    
                </tr>
            </table>
           
        </div>
      
        <div id="formula" class="tab-pane">
            <table class="fullWidth condensed-table">
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Liters</th>
                        <th>Dosage</th>
                        <th>&nbsp;</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $record_count = 0;?>                  
                    <?php foreach($productionbatchticket->formulas->formuladetails->find_all() as $result) : ?>
                    <?php $record_count++;?>
                   <tr>
                      
                        <td><?php echo $result->materialstocklevels->materialsupply->materials->description ?></td>
                        <td><?php echo $result->liters ?>L</td>
                        <td><?php echo $result->dosage ?></td>
                        <td>x</td>
                        <td><?php echo $result->price ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php endforeach ?>


                    
                    <?php if($record_count == 0) : ?>
                        <tr><td colspan="6" style="text-align: center; font-style: italic">No formula components found.</td></tr>
                     <?php endif ?>
                </tbody>
            </table>
    
            <div class="span-6 right">
                <strong>Direct Material Cost (DMC):</strong> PhP <?php echo number_format($productionbatchticket->formulas->direct_material_cost, 2) ?> <br/>
                <strong>Selling Price (PS):</strong> PhP <?php echo number_format($productionbatchticket->formulas->selling_price, 2) ?> <br/>
                <strong>Net Price (PN):</strong> PhP <?php echo number_format($productionbatchticket->formulas->net_price, 2) ?> <br/>
                <strong>OPEX:</strong> <?php echo $productionbatchticket->formulas->opex ?> <br/>
              <strong>Quantity:</strong> <?php echo $productionbatchticket->formulas->poitems->qty ?> Pcs<br/>
                
                <strong>Total Liters:</strong>
                        
                
                <?php 
                    
                    if(is_null($productionbatchticket->formulas->poitems->product_price_id)) {
                       echo $productionbatchticket->formulas->poitems->unitmaterials->size_liters;
                    }
                    else {
                        echo $productionbatchticket->formulas->poitems->variants->package_size;
                    }
                
                ?>
                <br/>
                
                <strong>Total Volume:</strong> 
                
                <?php 
                    
                    if(is_null($productionbatchticket->formulas->poitems->product_price_id)) {
                        echo ($productionbatchticket->formulas->direct_material_cost * $productionbatchticket->formulas->poitems->unitmaterials->size_liters) * $productionbatchticket->formulas->poitems->qty;
                    }
                    else {
                        echo ($productionbatchticket->formulas->direct_material_cost * $productionbatchticket->formulas->poitems->variants->package_size) * $productionbatchticket->formulas->poitems->qty;
                    }
                
                ?>

    </div>
            
            <input style="display:none" id="buttonclicked" />
        </div>
                <div id="details" class="tab-pane">
                    
           <table class="fullWidth formData">
                <tr>
                    <td class="half borderless formData">
<fieldset>
                            <legend>Base Information</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td class="half">Product Code:</td>
                                    <td><?php echo $productionbatchticket->product_code ?></td>
                                </tr>
                                <tr>
                                    <td>Batch #:</td>
                                    <td><?php echo $productionbatchticket->formulas->pwoitems->batch_no ?></td>
                                </tr>
                                <tr>
                                    <td>Blending Time Required:</td>
                                    <td><?php echo $productionbatchticket->blending_time_required ?></td>
                                </tr>
                                <tr>
                                    <td>Product Description:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->product_description ?></td>
                                </tr>
                                <tr>
                                    <td>Customer:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->customers->full_name()  ?></td>
                                </tr>
                                <tr>
                                    <td>Quantity Required:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->qty  ?></td>
                                </tr>
                                <tr>
                                    <td>Required Delivery Date:</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->delivery_date  ?></td>
                                </tr>
                                <tr>
                                    <td>Packaging Required:</td>
                                    <?php if($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "1") : ?>
                                    <td><?php echo $productionbatchticket->formulas->poitems->variants->unitmaterials->description ?> </td>
                                    <?php elseif ($productionbatchticket->formulas->poitems->purchaseorders->store_flag == "2") : ?>
                                    <td><?php echo $productionbatchticket->formulas->poitems->unitmaterials->description ?></td>
                                    <?php endif ?>
                                </tr>
                                <tr>
                                    <td>Reference P.W.O. #:</td>
                                    <td><?php echo $productionbatchticket->formulas->pwoitems->productionworkorders->pwo_id_string  ?></td>
                                </tr>
                                <tr>
                                    <td>Reference P.O. #</td>
                                    <td><?php echo $productionbatchticket->formulas->poitems->purchaseorders->po_id_string  ?></td>
                                </tr>
                                <tr>
                                    <td>Performed By:</td>
                                    <td><?php echo $productionbatchticket->production_performed_by  ?></td>
                                </tr>
                                <tr>
                                    <td>Date Produced:</td>
                                    <td><?php echo $productionbatchticket->date_produced  ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>

                    <td class="half borderless formData">  
                        <fieldset>
                            <legend>Raw Material Volume Composition</legend>

                            <table class="fullWidth nomargin formcontent">
                                <tr>
                                    <td>Theoretical:</td>
                                    <td><?php echo $productionbatchticket->py_theoretical ?></td>
                                </tr>
                                <tr>
                                    <td>Actual:</td>
                                    <td><?php echo $productionbatchticket->py_actual ?></td>
                                </tr>
                                <tr>
                                    <td>Variance:</td>
                                    <td><?php echo $productionbatchticket->variance ?></td>
                                </tr>
                                <tr>
                                    <td>Machine No. / Description:</td>
                                    <td><?php echo $productionbatchticket->machine_desc ?></td>
                                </tr>
                                <tr>
                                    <td>Blending Time</td>
                                    <td><?php echo $productionbatchticket->blending_time ?></td>
                                </tr>
                                <tr>
                                    <td>Overall Comments/Remarks:</td>
                                    <td><?php echo $productionbatchticket->remarks ?></td>
                                </tr>                       
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
                </div>
        
    </div>
    
<!--    MODALS-->
    
    <div class="modal hide fade in" id="approve-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Approve Production Batch Ticket</h2>
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
          <h2>Disapprove Production Batch Ticket</h2>
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