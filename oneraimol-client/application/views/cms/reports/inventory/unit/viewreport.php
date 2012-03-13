<!-- @author Panganiban, John Alvin Simon -->

<a class="floatRight" href="<?php echo $base_url?>cms/inventory/unit/generatepdf"><img src="<?php echo $base_url?>assets/images/usb.png" /><br></br>Save as PDF</a>

<table class="fullWidth condensed-table zebra-striped">
               <thead>
              <tr>
                 <th>ID</th>
                <th>Unit</th>
              </tr>
               </thead>
               <tbody>
                      <?php $record_count = 0;?>
                      <?php foreach($unit as $result) :?>
                      <?php $record_count++;?>
              <tr>
                 <td><?php echo $result->get_pk() ?></td>
                <td><?php echo $result->get_description() ?></td> 
              </tr>
              </tbody>
                        <?php endforeach ?>
                        
            </table> 

                        <?php if(isset($pageselector)) echo $pageselector ?>
