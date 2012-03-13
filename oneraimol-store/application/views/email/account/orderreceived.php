    <p>Dear <strong><?php echo $receive['name']; ?></strong>,</p><br/>
    <p>You have successfully confirmed the arrival and receipt of your purchase order number <strong><?php echo $receive['po'] ?></strong>.</p>
    <br/>
    <p>This is the breakdown of your order process dates:</p>
    <ul>
        <li><strong>Approved to Sales Order:</strong> <?php echo Helper_Helper::date($receive['so_date'], 'D | M d, Y')?></li>
        <li><strong>Sales Order processed and readied for delivery:</strong> <?php echo Helper_Helper::date($receive['dr_creation_date'], 'D | M d, Y')?></li>
        <li><strong>Order dispatched and delivered:</strong> <?php echo Helper_Helper::date($receive['dr_delivery_date'], 'D | M d, Y')?></li>
        <li><strong>Order confirmed and received:</strong> <?php echo Helper_Helper::date($receive['dr_receive_date'], 'D | M d, Y')?></li>
    </ul>
    
    <p>By confirming your order arrival and receipt, you agree that you have received your order in good condition.</p>
    <br/>
    
    <p>
        Thank you for using Raimol&trade; Energized Lubricants Purchase Order Site.<br />
    </p><br/><br/>
    <p><em>Note: This is an auto-generated email.</em></p>