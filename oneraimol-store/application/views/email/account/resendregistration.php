    <p>Dear <strong><?php echo $registration['name']; ?></strong>,</p><br/>
    <p>You have used this email to register to Raimol&trade; Energized Lubricants Purchase Order Site. However,
    to begin making purchase orders, you need to verify your registration with us.</p><br/>
    <p>To verify your registration, follow the link below:</p>
    <p><a href="<?php echo $base_url?>register/verify/<?php echo $registration['confirmation']?>"><?php echo $base_url?>register/verify/<?php echo $registration['confirmation']?></a></p>
    <br/>
    
    <p>
        Thank you for using Raimol&trade; Energized Lubricants Purchase Order Site.<br />
    </p><br/><br/>
    <p><em>Note: This is an auto-generated email.</em></p>