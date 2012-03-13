<html>
    <body style="background-color:#EBEBEB">
        <table width="646" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto; border:1px solid;">
            <tr><td style="height:107px; background: url('http://raimol.com/images/e_header.png') #EBEBEB top no-repeat;"></td></tr>
            <tr>
                <td style="background-color:#EBEBEB; color: #272727; padding:10px; font-size:11px; font-family:'Segoe UI'">
                    <?php echo $mail_content ?>
                </td>
            </tr>
            <tr>
                <td style="background-color:#EBEBEB; text-align:right; color:#272727; font-size:11px; padding:5px 2px 5px 0;font-family:'Segoe UI'">
                    <p>Copyright &copy; <?php echo date('Y')?> <a style="color:#272727; text-decoration:underline;" href="<?php echo $base_url ?>">RAIMOL&trade; Energized Lubricants</a>. All rights reserved.</p>
                </td>
            </tr>
        </table>
    </body>
</html>