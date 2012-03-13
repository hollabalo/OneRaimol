<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/signatories/formula.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <div id="msg"></div>
    
      <?php echo isset($success) ? '<span class="success">Formula successfully ' . $success . '</span>' : ''; ?>
 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#approvals">Approvals</a></li>
        <li><a href="#components">Components</a></li>
    </ul>
    
    <input type="hidden" id="formula_id_encrypt" value="<?php echo Helper_Helper::encrypt($formula->formula_id) ?>" />

    <div class="tab-content">
        
        <div id="approvals" class="tab-pane active">

            <table class="fullWidth">
                <tr>
                    
                    <td class="half borderless formData">
                        
                    <?php $approveflag = FALSE ?>    
                        
                    <?php if(in_array(Constants_UserType::PRESIDENT, Session::instance()->get('roles'))) : ?>
                        <?php if(is_null($formula->ceo_approved_status)) : ?>
                        <div class="alert-message block-message notice">
                            <p>You are a <strong>President (CEO)</strong>. What do you want to do?</p>
                            <div class="alert-actions">
                                 <a class="btn small" data-backdrop="static" data-controls-modal="approve-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::PRESIDENT ?>)">Approve as (CEO)</a>
                                 <a class="btn small" data-backdrop="static" data-controls-modal="disapprove-modal" data-keyboard="true" onclick="button_clicked(<?php echo Constants_UserType::PRESIDENT ?>)">Disapprove as (CEO)</a>
                                <input type="hidden" id="role_ceo" value="<?php echo Helper_Helper::encrypt(Constants_UserType::PRESIDENT) ?>" /> 
                            </div>
                        </div>   
                        <?php $approveflag = TRUE ?>
                        <?php endif ?>
                    <?php endif ?>
        
                    <?php if(! $approveflag) : ?>
                        <div class="alert-message block-message success">
                            <p>This Formula does not have pending signatories.</p>
                        </div>
                    <?php endif?>    
                        
                    </td>
                    
                    <td class="half borderless formData">
                        
                        <table class="fullWidth leftmargin formcontent">
                            <tr>
                                <td>Date Created to FORMULA:</td>
                                <td colspan="2"><?php echo $formula->date_created ?></td>
                            </tr>
                            <tr>
                                <td>President:</td>
                                <td style="color: <?php echo $formula->color_status('ceo_approved_status') ?>; font-weight: bold;"><?php echo $formula->role_status('ceo_approved_status') ?></td>
                                <td><?php echo $formula->ceo_approved_date ?></td>
                                <td><?php echo $formula->approved->full_name() ?></td>
                            </tr>
                        </table>
                        
                    </td>
                    
                </tr>
            </table>
           
        </div>
      
        <div id="components" class="tab-pane">
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
                    <?php foreach($formuladetail as $result) : ?>
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
                <strong>Direct Material Cost (DMC):</strong> PhP <?php echo number_format($formula->direct_material_cost, 2) ?> <br/>
                <strong>Selling Price (PS):</strong> PhP <?php echo number_format($formula->selling_price, 2) ?> <br/>
                <strong>Net Price (PN):</strong> PhP <?php echo number_format($formula->net_price, 2) ?> <br/>
                <strong>OPEX:</strong> <?php echo $formula->opex ?> <br/>
                <strong>Quantity:</strong> <?php echo $formula->poitems->qty ?> <br/>
                
                <strong>Total Liters:</strong>
                
                <?php 
                    
                    if(is_null($formula->poitems->product_price_id)) {
                        echo $formula->poitems->unitmaterials->size_liters;
                    }
                    else {
                        echo $formula->poitems->variants->package_size;
                    }
                
                ?>
                <br />
                <strong>Total Volume:</strong> 
                        
                
                <?php 
                    
                    if(is_null($formula->poitems->product_price_id)) {
                        echo ($formula->direct_material_cost * $formula->poitems->unitmaterials->size_liters) * $formula->poitems->qty;
                    }
                    else {
                        echo ($formula->direct_material_cost * $formula->poitems->variants->package_size) * $formula->poitems->qty;
                    }
                
                ?>
  

                
                <br/>
            </div>
            <input style="display:none" id="buttonclicked" />
        </div>
        
    </div>
    
   
<!--    MODALS-->
    
    <div class="modal hide fade in" id="approve-modal">
        <div class="modal-header">
          <a class="close" href="#">×</a>
          <h2>Approve Formula</h2>
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
          <h2>Disapprove Formula</h2>
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