<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/address.js" type="text/javascript"></script>


<h4>Delivery Address Entry</h4>
<div class="span-18 clearfix last" id="errorcontainer">
    <div id="msg"></div>
</div>
<div class="span-18 last">
    <form id="address-form" method="post" action="<?php echo $base_url?>account/addresses/process_form/<?php echo isset($address) ? Helper_Helper::encrypt($address->pk()) : ''?>">
        <input type="hidden" name="formstatus" value="<?php echo $formstatus?>"/>
        <input type="hidden" name="customer_id" value="<?php echo Helper_Helper::decrypt($_SESSION['userid'])?>"/>

        <table class="clearErrorFormat tablenozebra ">
            <tr>
                <td class="text-right" style="width:60px;">Street</td>
                <td><input name="address" id="address" value="<?php echo isset($address) ? $address->address : ''?>"/></td>
            </tr>
            <tr>
                <td class="text-right">City</td>
                <td><input name="city" id="city" value="<?php echo isset($address) ? $address->city : ''?>"/></td>
            </tr>
            <tr>
                <td class="text-right">Province</td>
                <td><input name="province" id="province" value="<?php echo isset($address) ? $address->province : ''?>"/></td>
            </tr>
            <tr>
                <td class="text-right">Country</td>
                <td><input name="country" id="country" value="<?php echo isset($address) ? $address->country : ''?>"/></td>
            </tr>
            <tr>
                <td class="text-right">Type</td>
                <td>
                    <select name="type_address" id="type_address">
                        <option>&nbsp;</option>
                        <option value="Economic Processing Zone" <?php echo (isset($address) && ($address->type_address == 'Economic Processing Zone')) ? 'selected="selected"' : ''?>>Economic Processing Zone</option>
                        <option value="Non-Economic Processing Zone" <?php echo (isset($address) && ($address->type_address == 'Non-Economic Processing Zone')) ? 'selected="selected"' : ''?>>Non-Economic Processing Zone</option>
                        <option value="Zero Rated Processing Zone" <?php echo (isset($address) && ($address->type_address == 'Zero Rated Processing Zone')) ? 'selected="selected"' : ''?>>Zero Rated Processing Zone</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" class="button button-text" value="Submit" style="width:90px;"/>
        <input type="button" class="button button-text" value="Cancel" onclick="cancel_address()" style="width:90px;"/>
    </form>
</div>

<script src="<?php echo $base_url . $config['js'] ?>/store/accounts/form/address.js" type="text/javascript"></script>