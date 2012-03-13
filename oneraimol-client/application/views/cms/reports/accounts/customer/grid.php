 <?php if(isset($pageSelectionLabel)) : ?>
        <p><?php echo $pageSelectionLabel ?></p>
    <?php endif ?>

                <table class="fullWidth condensed-table zebra-striped">
                    <thead>
                        <tr>
                            <th style="width:5%">Status</th>
                            <th style="width:37%">Name</th>
                            <th style="width:35%">Company</th>
                            <th style="width:15%">Username</th>
                            <th style="width:6%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $record_count = 0;?>
                        <?php foreach($customers as $result) :?>
                            <?php $record_count++;?>
                        <tr>
                            <td style="color: <?php echo $result->color_status(); ?>; font-weight: bold;">
                                <?php echo $result->status(); ?>
                            </td>
                            <td><?php echo $result->full_name() ?></td>
                            <td><?php echo $result->company ?></td> 
                            <td><?php echo $result->username ?></td>
                            <td><a href="<?php echo $base_url ?>cms/reports/customer/view/<?php echo Helper_Helper::encrypt($result->customer_id)?>">View</a></td>
                            <td></td>
                        </tr>
                        <?php endforeach ?>
                        <?php if($record_count == 0) : ?>
                            <tr><td colspan="5" style="text-align: center; font-style: italic">No records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(isset($pageselector)) echo $pageselector ?>