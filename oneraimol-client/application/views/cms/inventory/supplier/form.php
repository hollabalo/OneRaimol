<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/supplier.js" type="text/javascript"></script>


<div id="msg"></div>
<form id="supplier-form" method="post" action="<?php echo $base_url ?>cms/inventory/supplier/process_form/<?php if(isset($supplier)) echo Helper_Helper::encrypt($supplier->supplier_id) ?>">
<table class="form">
  <?php if( isset($supplier) ) { ?>
            <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier->supplier_id; ?>" />
        <?php } ?>
            <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
  <tr>
      <td colspan="3" class="table-section">supplier information</td>
  </tr>
  <tr>
    <td class="right">
        <span class="required">&ast;</span>Company Name
    </td>
    <td>
        <label for="company_name"></label>
        <input class="dd-input" value="<?php if (isset ($supplier)) echo $supplier->company_name ?>" name="company_name" type="text" id="name" maxlength="" <?php if(isset($supplier)) echo 'disabled="disabled"' ?>/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right">
        <span class="required">&ast;</span>First Name</td>
    <td>
        <label for="first_name"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->first_name ?>" name="first_name" id="first_name" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right">Middle Name</td>
    <td>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->middle_name ?>" name="middle_name" id="middle_name" type="text"/>
    </td>
  </tr>
  <tr>
    <td class="right">
        <span class="required">&ast;</span>Last Name</td>
    <td>
        <label for="last_name"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->last_name ?>" name="last_name" id="last_name" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right">Telephone Number</td>
    <td>
        <label for="telephone_no"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->telephone_no ?>" name="telephone_no" id="telephone_no" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right">Mobile Number</td>
    <td>
         <label for="mobile_no"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->mobile_no ?>" name="mobile_no" id="mobile_no" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right"><span class="required">&ast;</span>Email</td>
    <td>
         <label for="email"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->email ?>" name="email" id="email" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right"><span class="required">&ast;</span>Address</td>
    <td>
       <label for="address"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->address ?>" name="address" id="address" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr
  <tr>
    <td class="right"><span class="required">&ast;</span>City</td>
    <td>
       <label for="address"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->city ?>" name="city" id="city" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
  <tr>
    <td class="right"><span class="required">&ast;</span>Province</td>
    <td>
       <label for="address"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->province ?>" name="province" id="province" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
   <tr>
    <td class="right"><span class="required">&ast;</span>Country</td>
    <td>
       <label for="address"></label>
        <input class="dd-input" value="<?php if(isset($supplier)) echo $supplier->country ?>" name="country" id="country" type="text"/>
    </td>
    <td style="width:40%;"><span id="msg"></span></td>
  </tr>
            <tr>
            <td>&nbsp;</td>
            <td>
                    <input name="btn_submit" type="submit" value="Save Supplier" />
                    <input name="btn_cancel" type="button" onclick="cancel_supplier()" value="Cancel" />
            </td>
        </tr>
</table>

</form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/form/supplier.js" type="text/javascript"></script>