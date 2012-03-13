<script type="text/javascript" src="http://localhost/oneraimol/assets/js/jquery.ui.js"></script>
  <script src="<?php echo $base_url . $config['js'] ?>/cms/reports/pwo.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#from_date').datepicker({
            changeMonth: true,
            changeYear: true
        });
        $('#to_date').datepicker({
            changeMonth: true,
            changeYear: true
        });
    }); 
</script>
                <div class="span-24 last pull-right" id="formMenu">
                    <div class=" pull-right">
                        <select>
                            <option>Delivery Date</option>
                            <option>Order Date</option>
                        </select>
                        From<input name="from_date" id="from_date" readonly="readonly" maxlength="10" />
                        To<input name="to_date" id="to_date" readonly="readonly" maxlength="10" />
                        <a href="javascript:void(0)" onclick="generatepdf()">save lists as pdf</a>
                    </div>
                </div>
                <table class="fullWidth zebra-striped condensed-table">
                    <thead>
                    	<tr>
                            <th>PWO #</th>
                            <th>Creation Date</th>
                        </tr>
                        <?php $record_count = 0;?>
                    </thead>
                    <tbody>
                        <?php foreach($productionworkorder as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td><?php echo $result->pwo_id_string; ?></td>
                            <td><?php echo $result->date_created ?></td> 
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="2" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>