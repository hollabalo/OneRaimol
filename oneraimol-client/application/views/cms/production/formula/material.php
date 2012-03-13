    <tr>
        <td colspan="3">
            <table class="borderless condensed-table">
                <input type="hidden" name="id[]" />
                <tbody>
                    <tr>
                        <td>
                            <select name="material[]" id="material">
            <!--                    <option></option>-->
                                <?php foreach($materialstocklevel as $result) : ?>
                                <option class="fullWidth" value="<?php if(isset($result)) echo Helper_Helper::encrypt($result->materialsupply->materials->material_id) ?>"><?php echo $result->materialsupply->materials->description ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td><input name="dosage[]" class="fullWidth" type="text" /></td>
                        <td><input name="price[]" class="fullWidth" type="text" /></td>
                        <td><input name="liters[]" class="fullWidth" type="text" /></td>
                    </tr>
                </tbody>
            </table>
            <table id="details">
                
            </table>
        </td>
        
        <td><a style="margin-left:10px;" href="#" id="del" onclick="delete_row()">delete</a></td>
    </tr>


    <script>

//    $("select").change(function () {
//    var str = "";
//    $("select option:selected").each(function() {
//            str += $(this).text() + " ";
//        });
//        alert(str);
//    })
//    .change();
    
    $("select").change(function () {
        $.post(
            base_url + 'cms/production/formula/populate_materialinfo/' + $('#material').val(), {},
             function(data) {
                $('#details').html(data); 
            }
        );
    });

    
    
    </script>