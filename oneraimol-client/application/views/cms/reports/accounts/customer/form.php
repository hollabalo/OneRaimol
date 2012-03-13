<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>

<div id="msg"></div>
 <table class="form">

            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer->customer_id; ?>" />


        <tr>
            <td>
                <select>
                    <option value="1">Active</option>
                    <option value="0">InActive</option>
                    <option>All</option>
                </select>
            </td>
        </tr>


        <tr>
              <td><a href="<?php echo $base_url ?>cms/reports/customer/test/<?php echo Helper_Helper::encrypt($customer->customer_id) ?>">PDF</a></td>
        </tr>
  </table>
