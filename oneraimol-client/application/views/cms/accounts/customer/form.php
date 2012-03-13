<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/customer.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#birth_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        
        $('.tabs').tabs();
    });
</script>


<div id="msg"></div>
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#custinfo">Customer Information</a></li>
        <li><a href="#address">Address</a></li>
        <li><a href="#bankdetails">Bank Details</a></li>
    </ul>

<form id="customer-form" method="post" action="<?php echo $base_url ?>cms/accounts/customer/process_form/<?php if(isset($customer)) echo Helper_Helper::encrypt($customer->customer_id) ?>">

<div class="tab-content">         
 
    <div id="custinfo" class="tab-pane active">
    <div id="msg"></div>
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
                <select name="sex" id="sex">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                </select>
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
          <td><input name="birth_date" id="birth_date" value="<?php if(isset($customer)) echo $customer->birth_date ?> "maxlength="10" /></td>
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
  </table>

    </div>  
    <div id="address" class="tab-pane">
        <input id="add" name="btn_add" type="button" onclick="add_row('deliveryaddress')" value="add address" />
                <table id="deliveryaddress"class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                        <input type="hidden" name="id[]"/>
                        <td><input name="address[]" type="text" id="address" maxlength="100" class="fullWidth"/></td>
                        <td><input name="province[]" type="text" id="province" maxlength="100" class="fullWidth"/></td>
                        <td><input name="city[]" type="text" id="city" maxlength="100" class="fullWidth"/></td>
                        <td><input name="country[]" type="text" id="country" maxlength="100" class="fullWidth"/></td>
                        <td><a style="margin-left:10px;" href="#" id="del" onclick="delete_row()">delete</a></td>
                        </tr>
                    </tbody>
                      
                </table>
        
    </div>
    
    <div id="bankdetails" class="tab-pane">
        <table class="form">
        <tr>
            <td class="right" style="width: 200px;">
                <span class="required">&ast;</span>Bank
            </td>
            <td>
                <label for="bank_name"></label>
                <input class="dd-input" value="<?php if(isset($customer)) echo $customer->bank_name ?>" name="bank_name" type="text" id="bank_name" maxlength="50" />
            </td>
            <td style="width:40%;"><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Account Number</td>
          <td><label for="bank_account_no"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->bank_account_no ?>" name="bank_account_no" type="bank_account_no" id="bank_account_no" maxlength="50" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
        <tr>
          <td class="right"><span class="required">&ast;</span>Credit Limit</td>
          <td><label for="credit_limit"></label>
          <input class="dd-input" value="<?php if(isset($customer)) echo $customer->credit_limit ?>" name="credit_limit" type="credit_limit" maxlength="10" />
          </td>
          <td><span id="msg"></span></td>
        </tr>
            
        </table>
    </div>
    
<input name="btn_submit" type="submit" value="Save Account" />
                    <input name="btn_cancel" type="button" onclick="cancel_customer()" value="Cancel" />   

</div>
    
 </form>   

<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/form/customer.js" type="text/javascript"></script>