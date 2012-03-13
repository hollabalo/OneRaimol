<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/inventory/stock/generatepdf"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<table class="fullWidth condensed-table">
                    <thead>
                          <tr>
                            <th>ID</th>
                            <th>Material Name</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Liters</th>
                            <th>Date Stock</th>
                            <th>Expiration Date</th>
                            <th>&nbsp;</th>
                          </tr>
                    </thead>
                    
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($materialstocklevel as $result) :?>
                            <?php $record_count++;?>
                          <tr>
                            <td><?php echo $result->get_pk() ?></td>
                            <td><?php echo $result->materialsupply->materials->description ?></td>
                            <td>PhP <?php echo number_format($result->materialsupply->price, 2) ?></td>
                            <td><?php echo $result->materialsupply->suppliers->company_name ?></td> 
                            <td><?php echo $result->liters ?></td>
                            <td><?php echo $result->stock_taking_date ?></td>
                            <td><?php echo $result->expiration_date ?></td>
                          </tr>
                    
                        <?php endforeach ?>

                     </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>