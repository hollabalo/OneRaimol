<script src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/staff.js" type="text/javascript"></script>
<script  src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
    
    $(function() {
        $('#birth_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    }); 
    
</script>

<div id="msg"></div>
<form id="staff-form" method="post" action="<?php echo $base_url ?>cms/accounts/staff/process_form/<?php if(isset($staff)) echo Helper_Helper::encrypt($staff->staff_id) ?>">

    <table class="form">
        <?php if( isset($staff) ) { ?>
        <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff->staff_id; ?>" />
        <?php } ?>
        <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />

        <tr>
            <td colspan="3" class="table-section">login information</td>
        </tr>
        <tr>
            <td class="right" style="width: 200px;">
            <span class="required">&ast;</span>Username
        </td>
        <td>
            <label for="username"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->username ?>" name="username" type="text" id="username" maxlength="20" <?php if(isset($staff)) echo 'disabled="disabled"' ?>/>
        </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Password</td>
            <td><label for="password"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->password ?>" name="password" type="password" id="password" maxlength="50" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Retype Password</td>
            <td><label for="retypepassword"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->password ?>" name="retype_password" type="password" maxlength="50" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
            <tr><td colspan="3" class="table-section">Basic Information</td></tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>First Name</td>
            <td><label for="first_name"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->first_name ?>" name="first_name" type="text" id="first_name" maxlength="20" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right">Middle Name</td>
            <td><label for="middle_name"></label>
        <input class="dd-input" value="<?php if(isset($staff)) echo $staff->middle_name ?>" name="middle_name" type="text" id="middle_name" maxlength="20" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Last Name</td>
            <td><label for="last_name"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->last_name ?>" name="last_name" type="text" id="last_name" maxlength="20" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Sex</td>
        <td>
            <select name="sex" id="sex">
                <option class="dd-input" value="Male">Male</option>
                <option class="dd-input" value="Female">Female</option>
            </select>
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Address</td>
            <td><label for="address"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->address ?>" name="address" type="text" id="address" maxlength="100" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Province</td>
            <td><label for="province"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->province ?>" name="province" type="text" id="province" maxlength="100" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>City</td>
            <td><label for="city"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->city ?>" name="city" type="text" id="city" maxlength="100" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Country</td>
            <td><label for="country"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->country ?>" name="country" type="text" id="country" maxlength="100" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Primary Email Address</td>
            <td><label for="primary_email"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->primary_email ?>" name="primary_email" type="text" id="primary_email" maxlength="50" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right">Secondary Email Address</td>
            <td><label for="secondary_email"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->secondary_email ?>" name="secondary_email" type="text" id="secondary_email" maxlength="50" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right">Birth Date</td>
            <td><input class="dd-input" name="birth_date" id="birth_date" value="<?php if(isset($staff)) echo $staff->birth_date ?>" /></td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>Telephone Number</td>
            <td><label for="telephone"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->telephone_no ?>" name="telephone_no" type="text" id="telephone" maxlength="50" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right">Mobile Number</td>
            <td><label for="mobile"></label>
            <input class="dd-input" value="<?php if(isset($staff)) echo $staff->mobile_no ?>" name="mobile_no" type="text" id="mobile" maxlength="50" />
        </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>

            <?php
            $roles = ORM::factory('role')
            ->find_all();
            ?>
                <td class="right" width="83">Positions</td>
                <td width="101">
                    <select name="role[]" id="role" size="4" multiple="multiple">
                        <?php foreach($roles as $role) : ?>
                            <option class="dd-input" value="<?php if(isset($roles)) echo $role->role_id ?>"><?php echo $role->name ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        <td>
            <input name="btn_submit" type="submit" value="Save Account" />
            <input name="btn_cancel" type="button" onclick="cancel_staff()" value="Cancel" />
        </td>
        </tr>
</table>
</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/form/staff.js" type="text/javascript"></script>