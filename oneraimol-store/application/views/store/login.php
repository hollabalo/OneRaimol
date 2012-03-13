<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/logincustomer.js" type="text/javascript"></script>

<h4>Login</h4>

<p>Login to RAIMOL&trade; Energized Lubricants Purchase Order Site.</p>

<div class="span-18 clearfix last" id="errorcontainer">
        <div id="msg"></div>
</div>

<div class="span-12">
    <form id="customer-login-form" class="login tablenozebra" method="post" action="<?php echo $base_url ?>auth/process_login/<?php if(isset($customer)) echo Helper_Helper::encrypt($customer->customer_id) ?>">   
        <table class="fullWidth">
            <tr>
                <td><label>Username</label><input type="text" id="username" name="username"/></td>
            </tr>
            <tr>
                <td><label>Password</label><input type="password" id="password" name="password" /></td>
            </tr>
        </table>
        <input class="button" type="submit" value="Login" onClick="submit_logincustomer()"/>	
    </form><br/>
    <p class="text-emphasize"><a href="<?php echo $base_url ?>auth/forgotpass">Forgot Password? Recover your account here.</a></p>
</div>
    
<script type="text/javascript">
$( document ).ready(
    function() {
        $( '#customer-login-form' ).validate(
            {
                submitHandler : function() {
                    submit_logincustomer();
                }
            }
        );
    }
);
</script>