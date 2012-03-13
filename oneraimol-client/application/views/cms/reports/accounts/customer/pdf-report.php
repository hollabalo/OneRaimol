<html>
    
<head>
    
    <style type="text/css">
        #header{
            height:130px;
            width:190px;
            font-size:12px;
        }
    </style>

</head>

<body>
    
<div id="header">
  <table>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td><img src="assets/images/raimol2.png" /></td>
    </tr>
    <tr>
      <td>Unit 5 8/f 20th Drive Corporate Ctr. 20th Drive McKinley Business Park Bonifacio Global City, Taguig MNLA 1634 PH</td>
    </tr>
  </table>  
  
</div>
<hr />
<strong><center>CUSTOMER INFORMATION</center></strong>

<table style="width:100%">
        
        
        
        <tr>
            <td><h3>LOGIN INFORMATION</h3></td>           
        </tr>
        <tr>
            <td style="width:50%">Username</td>
            <td style="width:50%"><?php echo $customer->username ?></td>
        </tr>
        <tr>
            <td><h3>BASIC INFORMATION</h3></td>
        </tr>
        <tr>
            <td class="right">First Name</td>
            <td><?php echo $customer->first_name ?></td>
        </tr>
        
        <tr>
            <td class="right">Middle Name</td>
            <td><?php echo $customer->middle_name ?></td>
        </tr>
        
        <tr>
             <td class="right">Last Name</td>
             <td><?php if(isset($customer)) echo $customer->last_name ?></td>
        </tr>
        
        <tr>
          <td class="right">Sex</td>
          <td><?php echo strtoupper($customer->sex) ?></td>
         </tr>

        
        <tr>
          <td class="right">Primary Email Address</td>
          <td><?php echo $customer->primary_email ?></td>
        </tr>
        
        <tr>
          <td class="right">Secondary Email Address</td>
          <td><?php echo $customer->secondary_email ?></td>
        </tr>
        
        <tr>
          <td class="right">Birth Date</td>
          <td><?php echo $customer->birth_date ?></td>
        </tr>
        
        <tr>
          <td class="right">Telephone Number</td>
          <td><?php echo $customer->telephone_no ?></td>
        </tr>
        
        <tr>
          <td class="right">Mobile Number</td>
          <td><?php echo $customer->mobile_no ?></td>
        </tr>
        
        <tr>
          <td class="right">Company</td>
          <td><?php echo $customer->company ?></td>
        </tr>
  </table>
    
</body>

</html>