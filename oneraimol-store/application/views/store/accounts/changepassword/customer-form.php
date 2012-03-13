<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/changepassword.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/form/changepassword.js" type="text/javascript"></script>

<?php if(Session::instance()->get('userid')) : ?>
    <?php if(ORM::factory('customer')->where('customer_id', '=', Helper_Helper::decrypt(Session::instance()->get('userid')))->find()->deliveryaddresses->find_all()->count() == 0) : ?>
        <div class="notice">
            <p style="margin: 0;">You currently don't have any delivery address saved on your account. To make successful purchase orders, add a delivery address
              on your account via the <a href="<?php echo $base_url?>account/addresses/add">delivery address entry page</a>.</p>
        </div>
    <?php endif ?>
<?php endif ?>

<div class="span-18 last">
    <h4>Change Account Password</h4>
</div>
<div class="span-4 right text-emphasize last"><span class="required">*</span> Required field</div>

<div id="errorcontainer" class="span-18 clearfix last">
    <div id="msg">

        <?php if(isset($success)) : ?>
            <label for="terms" generated="true" class="success">Password successfully changed.</label>
        <?php endif ?>
    </div>
</div>
                 
<div class="span-18 last">
    <form id="formcustomer-change-password" method="post" action="<?php echo $base_url ?>/account/info/process_changepassword">
        <table id="passwordform" class="tablenozebra clearErrorFormat">
            <?php if( isset($customer) ) { ?>
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo Helper_Helper::encrypt($customer->customer_id); ?>" />
            <?php } ?>

            <tr>
                <td class="right" >
                    <span class="required">*</span>Type old password:
                </td>
                <td>
                    <input value="" class="text-input" name="old_password" id="old_password" type="password" maxlength="15" />
                </td>
            </tr>

            <tr>
                <td class="right">
                    <span class="required">*</span>New password:
                </td>
                <td>
                    <input value="" class="text-input" name="password" id="password" type="password" maxlength="15" />
                </td>
            </tr>

            <tr>
                <td class="right" >
                    <span class="required">*</span>Retype new password:
                </td>
                <td>
                    <input value="" class="text-input" name="retype_password" id="retype_password" type="password" maxlength="15" />
                </td>
            </tr>
        </table>
        <input class="button button-text" name="btn_change" type="submit" value="Change" style="width:90px;"/>
        <input class="button button-text" name="btn_cancel" type="button" onclick="cancel_changepasswordcustomer()" value="Cancel" style="width:90px;"/>
    </form>
</div>