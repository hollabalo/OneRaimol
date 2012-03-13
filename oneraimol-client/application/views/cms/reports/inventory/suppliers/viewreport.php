<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/inventory/supplier/generatepdf/<?php echo Helper_Helper::encrypt($supplier->supplier_id) ?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>
    
<table class="borderless formcontent">
    <thead>
  <tr>
       <th>SUPPLIER INFORMATION</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td width="200px">
        Company Name
    </td>
    <td>
        <?php echo $supplier->company_name ?>
         </td>
   </tr>
  <tr>
    <td>
        First Name
    <td>
        <?php echo $supplier->first_name ?>
        </td>
   </tr>
  <tr>
    <td>
    Middle Name
    <td>
        <?php echo $supplier->middle_name ?>
    </td>
  </tr>
  <tr>
    <td>
        Last Name
    <td>
        <?php echo $supplier->last_name ?>
     </td>
  </tr>
  <tr>
    <td>
    Telephone Number
    <td>
        <?php echo $supplier->telephone_no ?>
    </td>
  </tr>
  <tr>
    <td>
    Mobile Number
    <td>
         <?php echo $supplier->mobile_no ?>
    </td>
  </tr>
  <tr>
    <td>
    Email
    <td>
        <?php echo $supplier->email ?>
     </td>
  </tr>
  <tr>
    <td>
    Address
    <td>
       <?php echo $supplier->address ?> 
    </td>
  </tr
  <tr>
   <td>
   City
    <td>
       <?php echo $supplier->city ?> 
    </td>
  </tr>
  <tr>
  <td>
  Province
    <td>
       <?php echo $supplier->province ?>
     </td>
  </tr>
   <tr>
    <td>
    Country
    <td>
        <?php echo $supplier->country ?> 
   </td>
  </tr>  
  </tbody>
</table>

