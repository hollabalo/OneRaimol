<?php if(ORM::factory('customer')->where('customer_id', '=', Helper_Helper::decrypt(Session::instance()->get('userid')))->find()->deliveryaddresses->find_all()->count() == 0) : ?>
    <div class="notice">
        <p style="margin: 0;">You currently don't have any delivery address saved on your account. To make successful purchase orders, add a delivery address
          on your account via the <a href="<?php echo $base_url?>account/addresses/add">delivery address entry page</a>.</p>
    </div>
<?php endif ?>

<h4>Howdy, <?php echo $_SESSION['username']?>!</h4>

<p>This is your account dashboard. You can do a couple of things on your account listed on the menu below.</p>

<ul class="removeunderline">
    <li><a href="<?php echo $base_url?>account/info">View or change your account information.</a></li>
    <li><a href="<?php echo $base_url?>account/addresses">Add or edit your delivery addresses.</a></li>
    <li><a href="<?php echo $base_url?>account/info/changepassword">Change your account password.</a></li>
    <li><a href="<?php echo $base_url?>account/history">View your account history.</a></li>
</ul>