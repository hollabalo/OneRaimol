<html>
   <head>
    
    <style type="text/css">
        #header{
            height:130px;
            width:190px;
            font-size:12px;
        }
        #spacer{
            height:70px;
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
<div id="spacer"></div>

    <body>
        
                    <table class="fullWidth condensed-table">
        
                    <tr>
                        <td width="150"><strong>Material Name</strong></td>
                        <td width="70"><strong>Dosage</strong></td>
                        <td>&nbsp;</td>
                        <td width="70"><strong>Price</strong></td>
                    </tr>
        
                    <?php $record_count = 0;?>                  
                    <?php foreach($formuladetail as $result) : ?>
                    <?php $record_count++;?>
                   <tr>
                      
                        <td><?php echo $result->materialstocklevels->materialsupply->materials->description ?></td>
                        <td><?php echo $result->dosage ?></td>
                        <td>x</td>
                        <td>PhP <?php echo number_format($result->price, 2) ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php endforeach ?>


                    
                    <?php if($record_count == 0) : ?>
                        <tr><td colspan="9" style="text-align: center; font-style: italic">No records found.</td></tr>
                     <?php endif ?>
        
            </table>
<div id="spacer"></div>
<hr />
<div id="spacer"></div>
                <strong>Direct Material Cost (DMC):</strong> PhP <?php echo number_format($formula->direct_material_cost, 2) ?> <br/>
                <strong>Selling Price (PS):</strong> PhP <?php echo number_format($formula->selling_price, 2) ?> <br/>
                <strong>Net Price (PN):</strong> PhP <?php echo number_format($formula->net_price, 2) ?> <br/>
                <strong>OPEX:</strong> <?php echo $formula->opex ?> <br/>
              <strong>Quantity:</strong> <?php echo $formula->poitems->qty ?> Pcs<br/>
                
                <strong>Total Liters:</strong>
                        
                
                <?php 
                    
                    if(is_null($formula->poitems->product_price_id)) {
                       echo $formula->poitems->unitmaterials->size_liters;
                    }
                    else {
                        echo $formula->poitems->variants->package_size;
                    }
                
                ?>
                <br/>
                
                <strong>Total Volume:</strong> 
                
                <?php 
                    
                    if(is_null($formula->poitems->product_price_id)) {
                        echo ($formula->direct_material_cost * $formula->poitems->unitmaterials->size_liters) * $formula->poitems->qty;
                    }
                    else {
                        echo ($formula->direct_material_cost * $formula->poitems->variants->package_size) * $formula->poitems->qty;
                    }
                
                ?>
<br/><br/><br/><br/>
<table>
  <tr>
    <td style="width:30%"><strong>Approved By:</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
        <center>
        <?php if(!is_null($formula->approved->signature) && ($formula->approved->signature != '' )) : ?>
            <img src="<?php echo $base_url?>/assets/thumbs/<?php echo $formula->approved->signature ?>" />
            <hr/>
            <?php echo $formula->approved->full_name() ?>
        <?php else : ?>
            <em>No signature image</em>
            <hr/>
            <?php echo $formula->approved->full_name() ?>
        <?php endif ?>
        </center> 
    </td>
    
    <td>&nbsp;</td>
  </tr>
</table>
                
                
    </body>
</html>