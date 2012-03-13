<script src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/regcustomer.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#birth_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: 'c-80:c+00'
        });
    }); 
</script>

<form id="customer-form" method="post" action="<?php echo $base_url ?>register/process_form">
       
    <div class="span-18">
        <h4>Register to RAIMOL&trade; Energized Lubricants PO Site</h4>
        <p>Register now to start making purchase orders!</p>
    </div>
    <div class="span-4 right text-emphasize last"><span class="required">*</span> Required field</div>
    <div class="clearfix">&nbsp;</div>
    <div id="errorcontainer" class="span-18 clearfix last">
        <div id="msg">
            
            <?php if(isset($success)) : ?>
                <label for="terms" generated="true" class="success">Account successfully updated.</label>
            <?php endif ?>
        </div>
    </div>
    
    <table id="register" class="tablenozebra clearErrorFormat">
        <?php if( isset($customer) ) { ?>
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer->customer_id; ?>" />
        <?php } ?>
            
            <input type="hidden" name="formstatus" id="formstatus" value="<?php echo isset($formStatus) ? $formStatus : ''?>"/>
        <tr>
            <td class="text-right"><span class="required">*</span>Username</td>
            <td><input class="dd-input" value="<?php if(isset($customer)) echo $customer->username ?>" <?php if(isset($customer)) echo 'disabled="disabled"' ?> id="username" name="username" /></td>
        </tr>    
        <tr>
          <td class="text-right"><span class="required">*</span>Password</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->password ?>" name="password" type="password" id="password" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="text-right"><span class="required">*</span>Retype Password</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->password ?>" name="retype_password" type="password" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
            <td class="text-right" style="width:200px;"><span class="required">*</span>First Name</td>
             <td>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->first_name ?>" name="first_name" type="text" id="first_name" maxlength="20" />
            </td>
        </tr>
        <tr>
            <td class="text-right">Middle Name</td>
            <td>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->middle_name ?>" name="middle_name" type="text" id="middle_name" maxlength="20" />
            </td>
        </tr>
        <tr>
             <td class="text-right"><span class="required">*</span>Last Name</td>
                <td>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->last_name ?>" name="last_name" type="text" id="last_name" maxlength="20" />
                </td>
        </tr>
        <tr>
          <td class="text-right"><span class="required">*</span>Sex</td>
          <td>
                <select name="sex" id="sex">
                    <option value="Male" <?php echo (isset($customer) && ($customer->sex == 'Male')) ? 'selected="selected"' : ''?>>Male</option>
                    <option value="Female" <?php echo (isset($customer) && ($customer->sex == 'Female')) ? 'selected="selected"' : ''?>>Female</option>
                </select>
            </td>
        </tr>
        <tr>
          <td class="text-right"><span class="required">*</span>Primary Email Address</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->primary_email ?>" name="primary_email" type="text" id="primary_email" maxlength="50" />
          </td>
        </tr>
        <tr>
          <td class="text-right">Secondary Email Address</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->secondary_email ?>" name="secondary_email" type="text" id="secondary_email" maxlength="50" />
          </td>
        </tr>
        <tr>
          <td class="text-right">Birth Date</td>
          <td><input name="birth_date" id="birth_date" value="<?php if(isset($customer)) echo $customer->birth_date ?> "maxlength="10" /></td>
        </tr>
        <tr>
          <td class="text-right"><span class="required">*</span>Telephone Number</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->telephone_no ?>" name="telephone_no" type="text" id="telephone" maxlength="50" />
          </td>
        </tr>
        <tr>
          <td class="text-right">Mobile Number</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->mobile_no ?>" name="mobile_no" type="text" id="mobile" maxlength="50" />
          </td>
        </tr>
        <tr>
          <td class="text-right"><span class="required">*</span>Company</td>
          <td>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->company ?>" name="company" type="text" id="company" maxlength="100" />
          </td>
        </tr>
        <tr>
            <td class="text-right">Bank Account Number</td>  
            <td><input class="dd-input" value="<?php if(isset($customer)) echo $customer->bank_account_no ?>" name="bank_account_no" type="bank_account_no" id="bank_account_no" maxlength="50" /></td>  
        </tr>
        <tr>
            <td class="text-right">Bank</td>  
            <td><input class="dd-input" value="<?php if(isset($customer)) echo $customer->bank_name ?>" name="bank_name" type="text" id="bank_name" maxlength="50" /></td>  
        </tr>
        <tr>
            <td class="text-right">Credit Limit</td>  
            <td><input class="dd-input" value="<?php if(isset($customer)) echo $customer->credit_limit ?>" name="credit_limit" type="credit_limit" maxlength="10" /></td>  
        </tr>
  </table>

<input class="button" name="btn_submit" type="submit" value="Save Account" style="width:150px;" />
<input class="button" name="btn_cancel" type="button" onclick="cancel_customer()" value="Cancel" style="width:150px;" />   

    
 </form>   

<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/form/regcustomer.js" type="text/javascript"></script>