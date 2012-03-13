            <table class="fullWidth condensed-table bordered-table">
                <thead>
                <th>Username</th>
                <th>Actions Performed</th>
                </thead>
                
                <tbody>
                    <?php $record_count = 0;?>
                    <?php foreach($stafflog as $result) :?>
                    <?php $record_count++;?>
                    <tr>
                        <td><?php echo $result->staffs->username ?></td>
                        <td><?php echo $result->action ?></td>
                        </tr>
                    <?php endforeach ?>
                    <?php if($record_count == 0) : ?>
                        <tr>
                            <td colspan="2" style="text-align: center; font-style: italic">No records found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>

                            <?php if(isset($pageselector)) echo $pageselector ?>