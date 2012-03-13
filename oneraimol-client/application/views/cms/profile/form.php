                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                        <a href="<?php echo $base_url ?>cms/profile/staff/edit">Edit</a> |
                        <a href="<?php echo $base_url ?>cms/profile/staff/generatepdf">Save as PDF</a>
                    </div>
                </div>
<table class="form">
        <tr>
            <td colspan="2" class="table-section">login information</td>
        </tr>
        <tr>
            <td class="text-right" style="width:35%">Username</td>
            <td><?php echo $staff->username ?></td>
        </tr>
        <tr>
            <td class="text-right">Password</td>
            <td>
                [<strong><a href="<?php echo $base_url ?>cms/profile/staff/changepassword">change password</a></strong>]
            </td>
        </tr>
        <tr><td colspan="2" class="table-section">Basic Information</td></tr>
        <tr>
           <td class="text-right">First Name</td>
           <td><?php echo $staff->first_name ?></td>
        </tr>
        <tr>
            <td class="text-right">Middle Name</td>
            <td><?php echo $staff->middle_name ?></td>
        </tr>
        <tr>
             <td class="text-right">Last Name</td>
            <td><?php echo $staff->last_name ?></td> 
        </tr>
        <tr>
            <td class="text-right">Sex</td>
            <td><?php echo $staff->sex ?></td> 
        </tr>
        <tr>
          <td class="text-right">Address</td>
            <td><?php echo $staff->address ?></td> 
        </tr>
        <tr>
          <td class="text-right">Province</td>
          <td><?php echo $staff->province ?></td> 
        </tr>
        <tr>
          <td class="text-right">City</td>
          <td><?php echo $staff->city ?></td>
        </tr>
        <tr>
           <td class="text-right">Country</td>
          <td><?php echo $staff->country ?></td>
        <tr>
           <td class="text-right">Primary Email Address</td>
          <td><?php echo $staff->primary_email ?></td>
        </tr>
        <tr>
           <td class="text-right">Secondary Email Address</td>
          <td><?php echo $staff->secondary_email ?></td>
        </tr>
        <tr>
           <td class="text-right">Birthday</td>
          <td><?php echo $staff->birth_date?></td>
        </tr>
        <tr>
           <td class="text-right">Telephone Number</td>
          <td><?php echo $staff->telephone_no ?></td>
        </tr>
        <tr>
           <td class="text-right">Mobile Number</td>
          <td><?php echo $staff->mobile_no ?></td>
        </tr>
          <tr>
              <td class="text-right">Roles</td>
          
          
              <td>
              <ul class="roleList">
            <?php foreach($staff->roles->find_all() as $result) : ?>
              <li><?php echo $result->roles->name ?></li>
            <?php endforeach ?>
              </ul>
              </td>
        
          </tr>
  </table>
