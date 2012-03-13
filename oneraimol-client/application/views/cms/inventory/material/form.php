<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/material.js" type="text/javascript"></script>

    

<div id="msg"></div>

<form id="material-form" method="post" action="<?php echo $base_url ?>cms/inventory/material/process_form/<?php if(isset($material)) echo Helper_Helper::encrypt($material->material_id) ?>">
    <table class="form">
        <?php if( isset($material) ) { ?>
            <input type="hidden" name="material_id" id="material_id" value="<?php echo Helper_Helper::encrypt($material->material_id); ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />

            <tr>
                <td colspan="3" class="table-section">material information</td>
            </tr>

            <tr>
                <td class="right">
                    <span class="required">&ast;</span>Material Name
                </td>
                <td>
                    <label for="description"></label>
                    <input class="dd-input" value="<?php if(isset($material)) echo $material->description ?>" name="description" type="text" id="description" />
                </td>
                <td style="width:40%;"><span id="msg"></span></td>
            </tr>
       
            <tr>
                <td class="right"><span class="required">&ast;</span>Type</td>
                <td>
                    <select name="category" id="category">
                         <?php foreach($category as $result) :?>
                        <option class="dd-input" value="<?php echo Helper_Helper::encrypt($result->category_id)?>"><?php echo $result->description?></option>
                        <?php endforeach ?>
                    </select> 
                    

                </td>
                <td style="width:40%;"><span id="msg"></span></td>
            </tr>
            <tr>
                <td class="right"><span class="required">&ast;</span>Critical Level</td>
                <td>
                    <input class="dd-input" value="<?php if(isset($material)) echo $material->critical_level ?>" name="critical_level" type="text" id="critical_level" />
                </td>
                <td style="width:40%;"><span id="msg"></span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input name="btn_submit" type="submit" value="Save Material" />
                    <input name="btn_cancel" type="button" onclick="cancel_material()" value="Cancel" />
                </td>
            </tr>
    </table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/material.js" type="text/javascript"></script>