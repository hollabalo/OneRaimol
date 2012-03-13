<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/accounts/staff/generatepdf/<?php echo Helper_Helper::encrypt($staff->staff_id)?>"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>
    
<table class="borderless formcontent">
<input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff->staff_id; ?>" style="display:none" />
        <tr>
            <td class="strong redFontColor">LOGIN INFORMATION</td>
        </tr>
        <tr>
            <td width="200px">Username</td>
            <td><?php echo $staff->username ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="strong redFontColor">BASIC INFORMATION</td>
        </tr>        
        <tr>
            <td>First Name</td>
            <td><?php echo $staff->first_name ?></td>
        </tr>
        
        <tr>
            <td>Middle Name</td>
            <td><?php echo $staff->middle_name ?></td>
        </tr>
        
        <tr>
             <td>Last Name</td>
             <td><?php if(isset($staff)) echo $staff->last_name ?></td>
        </tr>
        
        <tr>
          <td>Sex</td>
          <td><?php echo strtoupper($staff->sex) ?></td>
         </tr>

        
        <tr>
          <td>Primary Email Address</td>
          <td><?php echo $staff->primary_email ?></td>
        </tr>
        
        <tr>
          <td>Secondary Email Address</td>
          <td><?php echo $staff->secondary_email ?></td>
        </tr>
        
        <tr>
          <td>Birth Date</td>
          <td><?php echo $staff->birth_date ?></td>
        </tr>
        
        <tr>
          <td>Telephone Number</td>
          <td><?php echo $staff->telephone_no ?></td>
        </tr>
        
        <tr>
          <td>Mobile Number</td>
          <td><?php echo $staff->mobile_no ?></td>
        </tr>
  </table>
    
