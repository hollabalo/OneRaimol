<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/accounts/customer/generatepdf/<?php echo Helper_Helper::encrypt($customer->customer_id)?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<table class="borderless leftmargin formcontent">
        <tr>
            <td class="strong redFontColor">LOGIN INFORMATION</td>           
        </tr>
        <tr>
            <td width="200px">Username</td>
            <td><?php echo $customer->username ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="strong redFontColor">BASIC INFORMATION</td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><?php echo $customer->first_name ?></td>
        </tr>
        
        <tr>
            <td>Middle Name</td>
            <td><?php echo $customer->middle_name ?></td>
        </tr>
        
        <tr>
             <td>Last Name</td>
             <td><?php if(isset($customer)) echo $customer->last_name ?></td>
        </tr>
        
        <tr>
          <td>Sex</td>
          <td><?php echo strtoupper($customer->sex) ?></td>
         </tr>

        
        <tr>
          <td>Primary Email Address</td>
          <td><?php echo $customer->primary_email ?></td>
        </tr>
        
        <tr>
          <td>Secondary Email Address</td>
          <td><?php echo $customer->secondary_email ?></td>
        </tr>
        
        <tr>
          <td>Birth Date</td>
          <td><?php echo $customer->birth_date ?></td>
        </tr>
        
        <tr>
          <td>Telephone Number</td>
          <td><?php echo $customer->telephone_no ?></td>
        </tr>
        
        <tr>
          <td>Mobile Number</td>
          <td><?php echo $customer->mobile_no ?></td>
        </tr>
        
        <tr>
          <td>Company</td>
          <td><?php echo $customer->company ?></td>
        </tr>        
  </table>


