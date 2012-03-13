<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/inventory/material.js" type="text/javascript"></script>

<script src="<?php echo $base_url . $config['js'] ?>/bootstrap/bootstrap-tabs.js" type="text/javascript"></script>

<script type="text/javascript">
    $('.tabs').tabs();
</script>

    <div id="msg"></div>
 
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#item">Item Description</a></li>
        <li><a href="#stock">Stock</a></li>
    </ul>
    
    <div class="tab-content">
        
        <div id="item" class="tab-pane active">

    <div id="msg"></div>
<form id="material-form" method="post" action="<?php echo $base_url ?>cms/inventory/material/process_form/<?php if(isset($material)) echo Helper_Helper::encrypt($material->material_id) ?>">
    <table class="form">
         <?php if( isset($material) ) { ?>
        <input type="hidden" name="material_id" id="material_id" value="<?php echo Helper_Helper::encrypt($material->material_id); ?>" />
        <?php } ?>
             <input type="hidden" name="formstatus" value="<?php echo $formStatus; ?>" />
        <tr>
            <td colspan="3" class="table-section">material information</td>
        </tr>
        
        <tr>
               <td class="right">
                <span class="required">
                    &ast;
                </span>Material Name
               </td>
           
               <td>
                   <label for="description"></label>
                   <input class="dd-input" value="<?php if(isset($material)) echo $material->description ?>" name="description" type="text" id="description" />
               </td>
          </tr>
          
          <tr>
              <td class="right"><span class="required">&ast;</span>Category</td>
              <td>
                  <select>
                      <option>Sample A</option>
                  </select>
                  <select>
                      <option>Sample B</option>
                  </select>
                  <select>
                      <option>Sample C</option>
                  </select>
              </td>
          </tr>
            
          <tr>
              <td class="right"><span class="required">&ast;</span>Re-Order Level</td>
              <td>
                  <input class="dd-input" value="<?php if(isset($material)) echo $material->reorder_level ?>" name="reorder_level" type="text" id="reorder_level" />
              </td>
          </tr>

          <tr>
              <td>&nbsp;</td>
              <td>
                  <input name="btn_submit" type="submit" value="Save Material" />
                  <input name="btn_cancel" type="button" onclick="cancel_material()" value="Cancel" />
              </td>
          </tr>
    </table>

<?php $form_validation = Compress::instance('javascripts')->scripts(array($config['js'] . '/cms/inventory/form/material.js'));
      echo HTML::script($form_validation); ?>
        
        </div>

<!-- STOCKS --> 
        

<div id="stock" class="tab-pane">
            
<?php $form_js = Compress::instance('javascripts')->scripts(array($config['js'] . '/cms/inventory/material.js'));
       echo HTML::script($form_js); ?>


<?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>
         <div id="msg"></div>
        <?php echo isset($success) ? '<span class="alert-message success"><p>Material successfully ' . $success . '</p></span>' : ''; ?>

                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                        <a class="btn small" href="<?php echo $base_url ?>cms/inventory/material/addstock/<?php echo Helper_Helper::encrypt($material->material_id) ?>">add stock</a>
                    </div>
                </div>         
        
<table class="fullWidth condensed-table zebra-striped">

 
<thead>
    
    <td colspan="3" class="table-section"><?php echo $material->description ?></td>
  <tr>
    <th style="width:2%"><input type="checkbox" onclick="check_all(this);"/></th>
    <th>Price</th>
    <th>Supplier</th>
    <th>Liters</th> 
    <th>Date</th>
    <th>Expiration Date</th>
    <th>&nbsp;</th>
  </tr>

</thead>

<tbody>

       
      <tr>
    <?php $record_count = 0;?>
         <?php foreach($materialstocklevel as $result) :?>
             <?php $record_count++;?>       
    <td><input class="id" name="id[]" type="checkbox" value ="<?php echo Helper_Helper::encrypt($result->stock_id); ?>" id="chk<?php echo $result->stock_id ?>"/></td>
    <td><?php echo $result->materialsupply->price ?></td>
    <td><?php echo $result->materialsupply->suppliers->name ?></td> 
    <td><?php echo $result->liters ?></td>
    <td><?php echo $result->stock_taking_date ?></td>
    <td><?php echo $result->expiration_date ?></td>
    <td><a href="<?php echo $base_url ?>cms/inventory/material/edit/<?php echo Helper_Helper::encrypt($result->stock_id)?>">Edit</a></td>
  </tr>
      <?php endforeach ?>
            <?php if($record_count == 0) : ?>
            <tr><td colspan="6" style="text-align: center; font-style: italic">No records found.</td></tr>
       <?php endif ?>
</tbody>
</table>
         </div>
             <?php if(isset($pageselector)) echo $pageselector ?>