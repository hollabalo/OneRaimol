<h4>Delivery Addresses</h4>

<div class="span-18 clearfix last" id="errorcontainer">
    <div id="msg">
        <?php if(isset($msg)) :?>
            <?php if($msg == Constants_FormAction::ADD) :?>
            <label class="success">Successfully added delivery address.</label>
            <?php elseif($msg == Constants_FormAction::EDIT) : ?>
            <label class="success">Successfully edited delivery address.</label>
            <?php elseif($msg == Constants_FormAction::DELETE) : ?>
            <label class="success">Successfully deleted delivery address.</label>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>

<div class="span-18 last append-bottom">
    <div class="span-12">
        Add addresses to your account to be used in referencing the shipping address of your orders.
    </div>
    
    <div class="span-4 right last">
        <a class="button button-text" href="<?php echo $base_url?>account/addresses/add">New Address</a>
    </div>

</div>

<div class="span-18 last">
    <table class="tablenozebra">
        <thead>
            <th>Address</th>
            <th style="width:30px;"></th>
            <th style="width:30px;"></th>
        </thead>

        <tbody>
            <?php foreach($addresses as $address) : ?>
            <tr>
                <td><?php echo $address->complete_address()?></td>
                <td><a href="<?php echo $base_url?>account/addresses/edit/<?php echo Helper_Helper::encrypt($address->pk())?>">Edit</a></td>
                <td><a href="<?php echo $base_url?>account/addresses/delete/<?php echo Helper_Helper::encrypt($address->pk())?>">Delete</a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="span-8 right last">
        <?php echo isset($pagination) ? $pagination : '' ?>
    </div>
</div>