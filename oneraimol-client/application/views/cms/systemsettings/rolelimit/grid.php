<div id="msg"></div>
        <?php echo isset($success) ? '<span class="success">Role successfully ' . $success . '</span>' : ''; ?>
 

                <table class="fullWidth condensed-table bordered-table">
                    <thead>
                        <th>Position</th>
                        <th>Limit</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        <?php foreach($rolelimit as $result) : ?>
                        <tr>
                            <td><?php echo $result->roles->name ?></td>
                            <td><?php echo $result->limit?></td>
                             <td><a href="<?php echo $base_url ?>cms/systemsettings/rolelimit/edit/<?php echo Helper_Helper::encrypt($result->role_limit_id) ?>">Edit</a></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                            <?php if(isset($pageselector)) echo $pageselector ?>

        