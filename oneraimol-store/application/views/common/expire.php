<div class="span-18 last">
    
    <h4>Page Expired</h4>
    
    <?php if(isset($url)) : ?>
        <p><strong>Your access to <a href="<?php echo $url ?>">this page</a> has been denied.</strong></p>
    <?php else :?>
        <p><strong>Your access has been denied.</strong></p>
    <?php endif ?>
    
    <p>This might be caused by one or more of these reasons:</p>

    <ul>
        <li>Your session has expired because you did not log out of the site when closing the web browser.</li>
        <li>You went idle off the site too long, causing your session to expire.</li>
        <li>You are not yet signed in when you tried to access the page.</li>
        <li>You might have intentionally removed a part of the URL which caused the denial of access.</li>
        <li>You have tried to access a page in which you do not have any access permission.</li>
    </ul>

    <p>
        Sorry for the inconvenience.
        <?php if(! isset($_SESSION['userid'])) : ?>
            To try again, <a href="<?php echo $base_url?>auth">login first</a>.
        <?php endif ?>
    </p>
    
    <p>For the mean time, you may want to go back to <a href="<?php echo $base_url?>">Raimol&trade; Energized Lubricants Purchase Order home page</a>.</p>
    
</div>