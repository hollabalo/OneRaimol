Last 5 Staff Log Activites
            <table class="fullWidth condensed-table bordered-table">

                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Position</th>
                    <th>Action Performed</th>
                    <th>Time of Action</th>
                  </tr>
                </thead>

                <tbody>
                            <?php $record_count = 0;?>
                            <?php foreach($stafflog as $result) :?>
                            <?php $record_count++;?>
                                  <tr>
                                    <td><?php echo $result->staffs->full_name() ?>
                                    <td><?php echo $result->staffs->username ?></td>
                                    <td>                                
                                        <ul class="roleList">
                                            <?php foreach($result->staffs->roles->find_all() as $role) : ?>
                                               <li><?php echo $role->roles->name ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </td>
                                    <td><?php echo $result->action ?></td>
                                    <td><?php echo Helper_Helper::date($result->time_of_action, "M d, Y H:i"); ?></td>
                                  </tr>
                                <?php endforeach ?>
                                <?php if($record_count == 0) : ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; font-style: italic">No records found.</td>
                                    </tr>
                                <?php endif ?>
                </tbody>
            </table>

        Staff Log Activites

            <table class="fullWidth condensed-table bordered-table">
                <thead>
                <th>Username</th>
                <th>Position</th>
                <th>Actions Performed</th>
                <th>View all by admin</th>
                </thead>
                
                <tbody>
                    <?php $record_count = 0;?>
                    <?php foreach($stafflogcount as $result) :?>
                    <?php $record_count++;?>
                    <tr>
                        
                        <td><?php echo $result->username ?></td>
                        <td>
                            <ul class="roleList">
                                <?php //foreach($result as $role) : ?>
                                   <li><?php //echo $role->name ?></li>
                                <?php //endforeach ?>
                            </ul>
                        </td>
                        <td>
                            <?php echo $result->total_action ?>
                        </td>
                        <td><a href="<?php echo $base_url ?>cms/systemsettings/stafflogs/view/<?php echo Helper_Helper::encrypt($result->staff_id); ?>">View</a></td>
                   </tr>
                    <?php endforeach ?>
                    <?php if($record_count == 0) : ?>
                        <tr>
                            <td colspan="4" style="text-align: center; font-style: italic">No records found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
                            <?php if(isset($pageselector)) echo $pageselector ?>

        