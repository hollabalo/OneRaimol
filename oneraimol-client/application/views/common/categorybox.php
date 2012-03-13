<select id="subcatbox<?php echo $subcatno?>" name="subcat<?php echo $subcatno?>" onchange="populate_cat(<?php echo $subcatno + 1?>)">
    <?php foreach($record as $item) : ?>
        <option value="<?php echo Helper_Helper::encrypt($item->pk()) ?>"><?php echo $item->description?></option>
    <?php endforeach; ?>
</select>