<tr>
    
<input type="hidden" name="id[]"/>

<td><input name="item[]" class="fullWidth"/></td>
<td><input name="qty[]" class="fullWidth"/></td>
<td><select name="uom[]" id="uom">
<?php foreach($uom as $result) : ?>
<option class="fullWidth" value="<?php if(isset($result)) echo $result->um_id ?>"><?php echo $result->get_description() ?></option>
<?php endforeach ?>
</select></td>
<td><input name="unitprice[]" class="fullWidth"/></td>
<td>&nbsp;</td>
<td><a style="margin-left:10px;" href="#" id="del" onclick="bullshrek()">delete</a></td>

</tr>