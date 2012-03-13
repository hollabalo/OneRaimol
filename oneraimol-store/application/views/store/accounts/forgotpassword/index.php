<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/store/logincustomer.js" type="text/javascript"></script>

<h4>Forgot Password</h4>

<p>Enter the primary email address you used to register an account to Raimol&trade; Energized Lubricants Purchase Order Site.</p>

<p>We will send a reset password link on the email.</p>
<div class="span-18 clearfix last" id="errorcontainer">
        <div id="msg"></div>
</div>

<div class="span-12">
    <form id="customer-forgotpw-form" class="login tablenozebra clearErrorFormat" method="post" action="<?php echo $base_url ?>auth/process_preparereset/">   
        <table class="fullWidth">
            <tr>
                <td><label>Email</label><input type="text" id="email" name="email"/></td>
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
                    email  : 'required'
                },
                messages : {
                    email  : message.missing
                },
                submitHandler : function() {
                    submit_forgotpass();
                },
                errorPlacement: function( error ) {
                    $('#msg').html(error);
                }
            }
        );
    }
);
</script>