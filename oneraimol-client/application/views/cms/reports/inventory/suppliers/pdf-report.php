<html>
<head>


<style type="text/css">

	#wrapper {
		margin:0 auto;
		width: 870px;
		height: 980px;
	}	
        #header {
		width:190px;
		height:130px;
		left: 0px;
                font-size:12px;
	}
	#order  {
	
		position:absolute;
		left: 400px;
                width: 150px;
	}
	
	#address  {
	
		position:absolute;
		top: 320px;
	}
	#items  {
	
		position:absolute;
		top: 460px;
		width:100%;
	}
	#sign {
	
		position:absolute;
		top: 500px;
		width:100%;
	}
	
	


</style>

</head>

<body>
   <div id="header">
    <table>
        <tr>
            <td><img src="assets/images/raimol2.png" /></td>
        </tr>
        <tr>
            <td>Unit 5 8/f 20th Drive Corporate Ctr. 20th Drive McKinley Business Park Bonifacio Global City, Taguig MNLA 1634 PH</td>
        </tr>
    </table>
</div>  
    
<hr />
   
   <div id="spacer"></div> 
    
<center><h3>SUPPLIER INFORMATION</h3></center>
    
   <table class="form">
  <tr>
    <td class="right">
        Company Name
    </td>
    <td>
        <?php echo $supplier->company_name ?>
         </td>
   </tr>
  <tr>
    <td class="right">
        First Name
    <td>
        <?php echo $supplier->first_name ?>
        </td>
   </tr>
  <tr>
    <td class="right">
    Middle Name
    <td>
        <?php echo $supplier->middle_name ?>
    </td>
  </tr>
  <tr>
    <td class="right">
        Last Name
    <td>
        <?php echo $supplier->last_name ?>
     </td>
  </tr>
  <tr>
    <td class="right">
    Telephone Number
    <td>
        <?php echo $supplier->telephone_no ?>
    </td>
  </tr>
  <tr>
    <td class="right">
    Mobile Number
    <td>
         <?php echo $supplier->mobile_no ?>
    </td>
  </tr>
  <tr>
    <td class="right">
    Email
    <td>
        <?php echo $supplier->email ?>
     </td>
  </tr>
  <tr>
    <td class="right">
    Address
    <td>
       <?php echo $supplier->address ?> 
    </td>
  </tr
  <tr>
   <td class="right">
   City
    <td>
       <?php echo $supplier->city ?> 
    </td>
  </tr>
  <tr>
  <td class="right">
  Province
    <td>
       <?php echo $supplier->province ?>
     </td>
  </tr>
   <tr>
    <td class="right">
    Country
    <td>
        <?php echo $supplier->country ?> 
   </td>
  </tr>
          
</table>

</body>
</html>
