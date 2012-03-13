<script src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/systemsettings/rolelimit.js" type="text/javascript"></script>


    <div id="msg"></div>

<form id="role-form" method="post" action="<?php echo $base_url ?>cms/systemsettings/rolelimit/process_form/<?php if(isset($rolelimit)) echo Helper_Helper::encrypt($rolelimit->role_id) ?>">
    <table class="form">
        <?php if( isset($rolelimit) ) { ?>
            <input type="hidden" name="role_limit_id" id="role_limit_id" value="<?php echo $rolelimit->role_limit_id; ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />

        <tr>
            <td class="right" style="width: 200px;">
                <span class="required">&ast;</span>Role Name
            </td>
            <td>
                <label for="name"></label>
                <input class="dd-input" value="<?php if(isset($rolelimit)) echo $rolelimit->roles->name ?>" name="name" type="text" id="name" maxlength="20" <?php if(isset($rolelimit)) echo 'disabled="disabled"' ?>/>
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Limit</td>
          <td><label for="limit"></label>
          <input class="dd-input" value="<?php if(isset($rolelimit)) echo $rolelimit->limit ?>" name="limit" type="limit" id="limit" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
       
          <tr>
            <td>&nbsp;</td>
            <td>
                    <input name="btn_submit" type="submit" value="Save Role" />
                    <input name="btn_cancel" type="button" onclick="cancel_role()" value="Cancel" />
            </td>
        </tr>
  </table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/systemsettings/form/rolelimit.js" type="text/javascript"></script>