<!--<tr>
    <td><strong>Liters in Stock</strong></td>
    <td><strong>Date Stocked</strong></td>
    <td><strong>Supplier</strong></td>
</tr>-->

<tr>
            <td><?php echo $materialinfo->liters - $materialusage->liters ?></td>
            <td><?php echo $materialinfo->stock_taking_date ?></td>
            <td><?php echo $materialinfo->materialsupply->suppliers->company_name ?></td>

</tr>

