<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/logincustomer.js" type="text/javascript"></script>

<h4>Reset Password</h4>

<p>Enter a new password for your Raimol&trade; Energized Lubricants Purchase Order Site Account.</p>

<p>You will be logged in once the password reset is successful.</p>
<div class="span-18 clearfix last" id="errorcontainer">
        <div id="msg"></div>
</div>

<div class="span-12">
    <form id="customer-forgotpw-form" class="login tablenozebra clearErrorFormat" method="post" action="<?php echo $base_url ?>auth/process_resetpassword/<?php echo $token ?>">   
        <table class="fullWidth">
            <tr>
                <td><label>Password</label><input type="password" id="password" name="password"/></td>
            </tr>
            <tr>
                <td><label>Confirm Password</label><input type="password" id="password_confirm" name="password_confirm"/></td>
            </tr>
        </table>
        <input class="button" type="submit" value="Submit"/>	
    </form>
</div>
    
<script type="text/javascript">
$( document ).ready(
    function() {
        $( '#customer-forgotpw-form' ).validate(
            {
                rules : {
                    password        : {
                        required : true,
                        minlength : 8,
                        alphanumeric : true
                    },
                    password_confirm : {
                        required : true,
                        equalTo : "#password"
                    }
                },
                messages : {
                    password            : {
                        required    : message.missing,
                        minlength   : message.passwordshort
                    },
                    password_confirm     : {
                        required    : message.missing,
                        equalTo     : message.passwordnotmatch
                    }
                },
                submitHandler : function() {
                    submit_resetpassword();
                },
                errorPlacement: function( error ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);
</script>