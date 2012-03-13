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