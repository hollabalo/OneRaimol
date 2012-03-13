<html>
<head>


<style type="text/css">

	#wrapper {
		margin:0 auto;
		width: 870px;
		height: 980px;
	}
        #spacer{
                height:70px;
        }
        #dspacer{
                height:150px;
        }
	#header {
		width:190px;
		height:130px;
		left: 0px;
                font-size:12px;
	}
        #container {
                width:400px;
        }
	#order  {
               	position:absolute;
		right: 80px;
                width: 150px;
	}
	
	#address  {
                position:absolute;
		left: 0px;
                width: 300px;
                
	}
	#items  {
                                          		
	}
	#sign {
              	
	}
        .floatRight{
            position:absolute;
            right:0px;
        }
        
	
	


</style>

</head>

<body>

<div id="wrapper">

<!--header-->
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
<h3><center>PURCHASE ORDER INFORMATION</center></h3>

<div id="spacer"></div>

<div id="container">

<div id="order">
<table width="264">
  <tr>
    <td width="92"><strong>Date</strong></td>
    <td width="156"><?php echo $purchaseorder->date_created ?></td>
  </tr>
  <tr>
    <td><strong>Purchase Order #</strong></td>
    <td><?php echo $purchaseorder->po_id_string ?></td>
  </tr>
</table>
</div>


<div id="address">
<table>
    
  <tr><td><strong>Company</strong></td>
      <td><?php echo $purchaseorder->customers->company ?></td>
  </tr>
  <tr>
      <td><strong>Customer Name</strong></td>
      <td><?php echo $purchaseorder->customers->full_name() ?></td>
  </tr>  
  <tr><td><strong>Address</strong></td>
      <td><?php echo $purchaseorder->deliveryaddresses->complete_address() ?></td>
  </tr>
  <tr><td><strong>Contact Number</strong></td>
       <td><?php echo $purchaseorder->customers->telephone_no ?></td>
  </tr>
</table>
</div>
    
</div>

<div id="dspacer">
</div>

<div id="items">
<table width="500"border="1">
    <thead>
  <tr>
                    <th width="100">Item</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
  </tr>
    </thead>
  <tbody>
                     <?php foreach($purchaseorder->poitems->find_all() as $record) : ?>
                              <?php if($purchaseorder->store_flag == "1") : ?>
                        <tr>
                            <td><?php echo $record->product_description ?></td>
                            <td><?php echo $record->qty ?></td>
                            <td><?php echo $record->variants->unitmaterials->get_description() ?></td>
                            <td>PhP <?php echo number_format($record->variants->price, 2) ?></td>
                            <td>PhP <?php echo number_format(($record->qty * $record->variants->price),2) ?></td>
                        </tr>
                        <?php elseif ($purchaseorder->store_flag == "2") :?>
                        <tr>
                            <td><?php echo $record->product_description ?></td>
                            <td><?php echo $record->qty ?></td>
                            <td><?php echo $record->unitmaterials->get_description() ?></td>
                            <td>PhP <?php echo number_format($record->unit_price, 2) ?></td>
                            <td>PhP <?php echo number_format(($record->qty * $record->unit_price), 2) ?></td>
                        </tr>
                        <?php endif ?>

                   <?php endforeach ?>
  </tbody>
  
</table>
</div>

   <div class="floatRight"><strong>PhP <?php echo $purchaseorder->order_amount, 2 ?> TOTAL</strong></div>



</div>
</body>
</html>
