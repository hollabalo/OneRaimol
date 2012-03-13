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
    <td><?php echo $purchaseorder->po_id_string?></td>
  </tr>
</table>
</div>


<div id="address">
<table>
    
  <tr><td><strong>Company</strong></td>
      <td><?php echo $purchaseorder->customers->company ?></td>
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
<table width="500" border="1">
    <thead>
  <tr>
                    <th>Item</th>
                    <th style="width:25px">Qty</th>
                    <th style="width:77px">UOM</th>
                    <th style="width:100px">Unit</th>
                    <th style="width:100px">Total</th>
                    <th style="width:120px">Total*Qty</th>
  </tr>
    </thead>
  <tbody>
                     <?php foreach($purchaseorder->poitems->find_all() as $record) : ?>
                    <tr>
                        <td><?php echo $record->product_description ?></td>
                        <td><?php echo $record->qty ?></td>
                        <td><?php echo $record->variants->unitmaterials->get_description()?></td>
                        <td>PhP <?php echo number_format($record->variants->price, 2) ?></td>
                        <td>PhP <?php echo number_format($record->variants->price * $record->variants->sku, 2)?></td>
                        <td>PhP <?php echo number_format(($record->variants->price * $record->variants->sku) * $record->qty, 2) ?></td>
                    </tr>
                   <?php endforeach ?>
  </tbody>
  
          <tfoot>
            <tr>
                <td style="text-align:right; font-weight: bold;" colspan="5">Total Estimated Cost:</td>
                <td>PhP <?php echo number_format($purchaseorder->order_amount, 2) ?></td>
            </tr>
        </tfoot>
  
</table>
</div>

</div>
</body>
</html>
