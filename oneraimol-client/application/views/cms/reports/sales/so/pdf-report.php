<?php //ob_start();

   ?>

<html>
<head>


<style type="text/css">

	#wrapper {
		margin:0 auto;
		width: 870px;
		height: 980px;
	}
        #spacer {
                height:70px;
        }
        #container{
                height:270px;
        }
	#header {
		width:190px;
		height:130px;
		left: 0 px;
                font-size:12px;		
	}
	#order  {	
		position:absolute;
		right: 80px;
                width: 150px;
	}
	
	#address  {	
		position:absolute;
		left:0px;
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
<strong><center>SALES ORDER INFORMATION</center></strong>
<div id="container">
<div id="order">
<table width="264">
  <tr>
    <td width="92"><strong>Date</strong></td>
    <td width="156"><?php echo $salesorder->date_created ?></td>
  </tr>
  <tr>
    <td><strong>Order #</strong></td>
    <td><?php echo $salesorder->so_id_string ?></td>
  </tr>
  <tr>
    <td><strong>Payment Method</strong></td>
    <td><?php echo $salesorder->purchaseorders->payment_method ?></td>
  </tr>
  <tr>
    <td><strong>Terms</strong></td>
    <td><?php echo $salesorder->purchaseorders->terms ?></td>
  </tr>
  <tr>
    <td><strong>PO #</strong></td>
    <td><?php echo $salesorder->purchaseorders->po_id_string  ?></td>
  </tr>
  <tr><td><strong>Company</strong></td>
      <td><?php echo $salesorder->purchaseorders->customers->company ?></td>
  </tr>
  <tr>
      <td><strong>Customer Name</strong></td>
      <td><?php echo $salesorder->purchaseorders->customers->full_name() ?></td>
  </tr>  
  <tr>
    <td><strong>Ship Date:</strong></td>
    <td><?php echo $salesorder->purchaseorders->delivery_date ?></td>
  </tr>
</table>
</div>


<div id="address">
<table width="300" height="60">
  <tr>
    <td><strong>Bill to:</strong></td>
    <td><strong>Ship to:</strong></td>
  </tr>
  <tr>
    <td><?php echo $salesorder->purchaseorders->deliveryaddresses->complete_address() ?></td>
    <td><?php echo $salesorder->purchaseorders->deliveryaddresses->complete_address() ?></td>
  </tr>
</table>
</div>
</div>
<br/><br/>
<div id="items">
<table width="520" border="1">
    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit of Material</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                        <th>Tax Rate</th>
                        <th>Gross Amount</th>
                        <th>Tax Amount</th>
                    </tr>
    </thead>
   <tbody>
      <?php if($salesorder->purchaseorders->store_flag == "1") : ?>
                    <?php $record_count = 0;?>                 
                    <?php foreach($salesorder->soitems->find_all() as $item) : ?>
                    <?php $record_count++;?>        
                    <tr>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td><?php echo $item->poitems->qty ?></td>
                        <td><?php echo $item->poitems->variants->unitmaterials->get_description() ?></td>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td>PhP <?php echo number_format($item->poitems->variants->price, 2) ?></td>
                        <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                        <td><?php echo $item->taxcodes->description ?></td>
                        <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                        <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                    </tr>
                    <?php endforeach ?>
        <?php elseif ($salesorder->purchaseorders->store_flag == "2") :?>
                    <?php $record_count = 0;?>                 
                    <?php foreach($salesorder->soitems->find_all() as $item) : ?>
                    <?php $record_count++;?>        
                    <tr>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td><?php echo $item->poitems->qty ?></td>
                        <td><?php echo $item->poitems->unitmaterials->get_description() ?></td>
                        <td><?php echo $item->poitems->product_description ?></td>
                        <td>PhP <?php echo number_format($item->poitems->unit_price, 2) ?></td>
                        <td>PhP <?php echo number_format($item->amount, 2) ?></td>
                        <td><?php echo $item->taxcodes->description ?></td>
                        <td>PhP <?php echo number_format($item->gross_amount, 2) ?></td>
                        <td>PhP <?php echo number_format($item->tax_amount, 2) // = $item->unit_price - $item->amount //taxamt = unitprice - amount ?></td>
                    </tr>
                    <?php endforeach ?>
        <?php endif ?>
  </tbody>  
</table>
    <table>
          <tr>
      <td width="600"><strong>PhP <?php echo number_format($salesorder->purchaseorders->order_amount, 2) ?> TOTAL</strong>
</td>
  </tr>
    </table>

</div>


<div id="sign">
<table style="width:690px">
  <tr>
    <td><strong>Prepared By:</strong></td>
    <td><strong>Checked By:</strong></td>
  </tr>
  <tr><?php $staff = ORM::factory('staff')->where('staff_id', '=', $salesorder->sc_approved)?>
    <td>
        <center>
        <?php if(!is_null($salesorder->prepared->signature) && ($salesorder->prepared->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->prepared->signature ?>" />
            <hr/>
            <?php echo $salesorder->prepared->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->prepared->full_name() ?>
        <?php endif ?>
        </center> 
    </td>
    
    <td>
        <center>
        <?php if(!is_null($salesorder->checked->signature) && ($salesorder->checked->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->checked->signature ?>" />
            <hr/>
            <?php echo $salesorder->checked->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->checked->full_name() ?>
        <?php endif ?>
        </center>
    </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Approved By:</strong></td>
    <td><strong>CEO:</strong></td>
  </tr>
  <tr>
      <td>
        <center>
        <?php if(!is_null($salesorder->approved->signature) && ($salesorder->approved->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->approved->signature ?>" />
            <hr/>
            <?php echo $salesorder->approved->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->approved->full_name() ?>
        <?php endif ?>
        </center>
         
      </td>
      <td>
        <center>
        <?php if(!is_null($salesorder->ceo->signature) && ($salesorder->ceo->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $salesorder->ceo->signature ?>" />
            <hr/>
            <?php echo $salesorder->ceo->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $salesorder->ceo->full_name() ?>
        <?php endif ?>
        </center>  
            
      </td>
  </tr>

</table>
</div>
</div>
</body>
</html>
