<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/loginstaff.js" type="text/javascript"></script>


<div class="container" id="container">
    	<div id="top-spacer"></div>
    	<div class="span-24">
            <div class="span-24" id="mainMenu-wrap">
                <div class="append-3 prepend-3">
                    <form id="login-form" action="<?php echo $base_url ?>auth/login"  method="post">
                        <table class="form">
                            <tr><td><span id="msg"></span></td></tr>
                            <tr><th><label>Username</label><input type="text" name="username" id="username" /></th></tr>
                            <tr><th><label>Password</label><input type="password" name="password" id="password" /></th></tr>
                            <tr><td><input name="btn_submit" type="submit" value="Login" /></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
$( document ).ready(
    function() {
        $( '#login-form' ).validate(
            {
                submitHandler : function() {
                    submit_loginstaff();
                }
            }
        );
    }
);
</script>