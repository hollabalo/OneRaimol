<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>

<?php $form_js = Compress::instance('javascripts')->scripts(array($config['js'] . '/cms/accounts/customer.js'));
       echo HTML::script($form_js); ?>

    <div id="msg"></div>
<form id="customer-form" method="post" action="<?php echo $base_url ?>cms/accounts/customer/process_form/<?php if(isset($customer)) echo Helper_Helper::encrypt($customer->customer_id) ?>">
    <table class="form">
        <?php if( isset($customer) ) { ?>
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer->customer_id; ?>" />
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
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->username ?>" name="username" type="text" id="username" maxlength="20" <?php if(isset($customer)) echo 'disabled="disabled"' ?>/>
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Password</td>
          <td><label for="password"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->password ?>" name="password" type="password" id="password" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Retype Password</td>
          <td><label for="retypepassword"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->password ?>" name="retype_password" type="password" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr><td colspan="3" class="table-section">Basic Information</td></tr>
        <tr>
            <td class="right"><span class="required">&ast;</span>First Name</td>
             <td><label for="first_name"></label>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->first_name ?>" name="first_name" type="text" id="first_name" maxlength="20" />
            </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="right">Middle Name</td>
            <td><label for="middle_name"></label>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->middle_name ?>" name="middle_name" type="text" id="middle_name" maxlength="20" />
            </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
             <td class="right"><span class="required">&ast;</span>Last Name</td>
                <td><label for="last_name"></label>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->last_name ?>" name="last_name" type="text" id="last_name" maxlength="20" />
                </td>
                <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Sex</td>
          <td>
              <input <?php echo isset($customer) && strtolower( $customer->sex ) == 'male' ? 'checked="TRUE"' : ''; ?> type="radio" name="sex" value="male" id="sex_0" />
              <label for="sex_0">Male</label>
                <input <?php echo isset($customer) && strtolower( $customer->sex ) == 'female' ? 'checked="TRUE"' : ''; ?> type="radio" name="sex" value="female" id="sex_1" />
                <label for="sex_1">Female</label>
            </td>
            <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Address</td>
          <td><label for="address"></label>
          <textarea class="dd-textarea" name="address" id="address"><?php if(isset($customer)) echo $customer->company_address ?></textarea>
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Delivery Address</td>
          <td><label for="delivery_address"></label>
          <textarea class="dd-textarea" name="delivery_address" id="delivery_address"><?php if(isset($customer)) echo $customer->company_address ?></textarea>
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Primary Email Address</td>
          <td><label for="primary_email"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->primary_email ?>" name="primary_email" type="text" id="primary_email" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right">Secondary Email Address</td>
          <td><label for="secondary_email"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->secondary_email ?>" name="secondary_email" type="text" id="secondary_email" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right">Birth Date</td>
          <td>
              
              </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Telephone Number</td>
          <td><label for="telephone"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->telephone_no ?>" name="telephone_no" type="text" id="telephone" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right">Mobile Number</td>
          <td><label for="mobile"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->mobile_no ?>" name="mobile_no" type="text" id="mobile" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Company</td>
          <td><label for="company"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->company ?>" name="company" type="text" id="company" maxlength="100" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
                    <input name="btn_submit" type="submit" value="Save Account" />
                    <input name="btn_cancel" type="button" onclick="cancel_customer()" value="Cancel" />
            </td>
        </tr>
  </table>
</form>

<?php $form_validation = Compress::instance('javascripts')->scripts(array($config['js'] . '/cms/accounts/form/customer.js'));
       echo HTML::script($form_validation); ?>