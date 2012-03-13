<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/cms/production/formula.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-modal.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
    
    $('').bind('change', function (e) {
        e.target // activated tab
        e.relatedTarget // previous tab
    })
    
$('#pwoitemstable input[type="radio"]').live("click", function() {
//    if($(this).is(":checked")) {
//
//    }
    $('#msg').html('<span class="notice">Now go to Item Formula Tab to compose formula.</div>');
    document.getElementById('po_item_id').value = $(this).val();
    document.getElementById('pwo_item_id').value = $('#pwoitemid').val();
});  
</script>

    <form id="formula-form" method="post" action="<?php echo $base_url ?>cms/production/formula/process_form/<?php if(isset($formula)) echo Helper_Helper::encrypt($formula->formula_id) ?>">

            <table class="form">
                <tr>
                    <td>Select PWO:</td>
                <td><select name="pwo" id="filterpwo" onchange="populate_pwoitems()">
                        <option class="fullWidth"value=""></option>
                <?php foreach($productionworkorder as $result) : ?>
                        <option class="fullWidth" value="<?php if(isset($result)) echo Helper_Helper::encrypt ($result->pwo_id) ?>"><?php echo $result->pwo_id_string ?></option>
                <?php endforeach ?> 
                </select></td> 
                </tr>
            </table>
    
            <ul data-tabs="tabs" class="tabs">
                <li class="active"><a href="#items">PWO Items</a></li>
                <li><a href="#formula">Item Formula</a></li>
            </ul>
    
            <div class="tab-content">
                <div id="items" class="tab-pane active">
                    <div id="msg"></div>
                    <div id="pwoitemsgrid"></div>
                </div>
                
                <div id="formula" class="tab-pane">
                    
                    <table class="form">
                        <tr>
                            <th class="half">Formula</th>
                            <th class="half">Summary</th>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                
                                <input name="po_item_id" id="po_item_id" style="display:none"/>
                                <input name="pwo_item_id" id="pwo_item_id" style="display:none"/>
                                
                                OPEX:&nbsp;<input id="opex" class="small" />
                                &nbsp;&nbsp;PS:&nbsp;<input id="ps" class="small" />
                                <br/><br/>
                                <div class=""><input id="add" name="btn_add" class="btn mini" type="button" onclick="add_row('formulafield')" value="Add" /></div>
                                <table class="form condensed-table" id="formulafield">
                                    
                                <?php if( isset($formula) ) { ?>
                                    <input type="hidden" name="formula_id" id="formula_id" value="<?php echo $formula->formula_id; ?>" />
                                <?php } ?>
                                    <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />

                                    <thead>
                                        <tr>
                                            <th style="width:25%">Raw Material</th>
                                           
                                            <th>Dosage</th>
                                            <th>Price</th>
                                            <th>Liters</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>

                                    <tbody id="a">
                                    </tbody>

                                </table>
                            </td>
                            
                            <td style="vertical-align:top">
                                <div class=""><input id="compute" name="btn_compute" class="btn mini" type="button" onclick="compute_formula()" value="Compute" /></div>
                                <div id="formulasummary" class="border"></div>
                            </td>
                        </tr>
                    </table>
                    
                    <input name="btn_submit" type="submit" class="btn" value="Save Formula" />
                    <input name="btn_cancel" type="button" class="btn" onclick="cancel_formula()" value="Cancel" />
                </div>
            </div>

    </form>
    <script src="<?php echo $base_url . $config['js'] ?>/cms/production/form/formula.js" type="text/javascript"></script>