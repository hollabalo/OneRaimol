<table id="award" class="bordered-table condensed-table">
    <thead>
        <tr>
            <th>Raw Material</th>
            <th>Dosage x Price</th>
        </tr>
    </thead>
    
    <?php $dmc = 0 ?>
    
    <?php for($i=0;$i<count($desc);$i++) : ?>
    <tr>
        <td><?php echo $desc[$i] ?></td>
        <td><?php echo $dosage[$i] * $price[$i]?></td>
        <?php $dmc += $dosage[$i] * $price[$i] ?>
    </tr>
    <?php endfor ?>
</table>

<p><strong>Direct Material Cost: </strong><?php echo $dmc ?></p>
<input type="hidden" name="direct_material_cost" value="<?php echo $dmc?>" />

<p><strong>OPEX:</strong><?php if($opex == 0) echo "0" ?><?php  if($opex != 0) echo $dmc + $opex?></p>
<input type="hidden" name="opex" value="<?php echo $dmc + $opex?>" />

<p><strong>Selling Price:</strong> <?php echo $ps?></p>
<input type="hidden" name="ps" value="<?php echo $ps?>" />

<p><strong>Net Price:</strong> <?php echo $dmc - $ps?></p>
<input type="hidden" name="pn" value="<?php echo $dmc - $ps?>" />
