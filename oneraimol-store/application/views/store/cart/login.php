<script src="<?php echo $base_url . $config['js'] ?>/store/logincustomer.js" type="text/javascript"></script>
<h5>Add to Purchase Order:</h5>
<em>(Login to add item to Purchase Order)</em>
<div id="msg"></div>

            <div class="cartInputs">
                <form method="post" id="customer-login-form" action="<?php echo $base_url?>auth/process_login?source=<?php echo Helper_Helper::encrypt(substr(Request::current()->detect_uri(), 1)) ?>">
                <table class="cartInputTable">
                    <tr>
                        <td style="text-align:right">Username:</td>
                        <td style="width:80%" class="inputFullWidth"><input name="username" /></td>
                    </tr>
                    <tr>
                        <td style="text-align:right">Password:</td>
                        <td class="inputFullWidth"><input name="password" type="password" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="inputHalfWidth submit"><div class="right fullWidth"><input class="button" type="submit" value="Login" /></div></td>
                    </tr>
                </table>
                </form>
            </div>
<em><a href="<?php echo $base_url?>register">No account yet? Register here.</a></em>

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