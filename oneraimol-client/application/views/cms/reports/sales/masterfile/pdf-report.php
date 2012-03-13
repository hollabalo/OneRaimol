<html>
    
    <body>
<table>
    <tr>
      <td><img src="assets/images/raimol2.png" /></td>
    </tr>
    <tr>
      <td>Unit 5 8/f 20th Drive Corporate Ctr. 20th Drive McKinley Business Park Bonifacio Global City, Taguig MNLA 1634 PH</td>
    </tr>
  </table>  
<hr/>
<table>
    <tr>
        <td style="width:15%"><strong>Purchase Order #</strong></td>
        <td><?php echo $purchaseorder->po_id_string ?></td>
    </tr>
    <tr>
        <td><strong>Sales Order #</strong></td>
        <?php if(!is_null($purchaseorder->salesorders->so_id_string)) :?>
        <td><?php echo $purchaseorder->salesorders->so_id_string ?></td>
        <?php else : ?>
        <td>PURCHASE ORDER NOT YET APPROVED</td>
        <?php endif ?>
    </tr>
    <tr>
        <td><strong>Delivery Receipt #</strong></td>
        <?php if(!is_null($purchaseorder->deliveryreceipts->dr_id_string)) : ?>
        <td><?php echo $purchaseorder->deliveryreceipts->dr_id_string ?></td>
        <?php else :?>
        <td>OTHER DOCUMENTS MUST BE APPROVED FIRST</td>
        <?php endif ?>
    </tr>
</table>


<table border="1" width:"300">
    <thead>
  <tr>
                    <th>PWO #</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
  </tr>
    </thead>
  <tbody>
                     <?php foreach($purchaseorder->poitems->find_all() as $record) : ?>
                              <?php if($purchaseorder->store_flag == "1") : ?>
                        <tr>
                            <?php if(!is_null($record->productionworkorders->pwo_id_string)) :?>
                            <td><?php echo $record->productionworkorders->pwo_id_string ?></td>
                            <?php else : ?>
                            <td>NO PWO YET</td>
                            <?php endif ?>
                            <td><?php echo $record->product_description ?></td>
                            <td><?php echo $record->qty ?></td>
                            <td><?php echo $record->variants->unitmaterials->get_description() ?></td>
                            <td>PhP <?php echo number_format($record->variants->price, 2) ?></td>
                            <td>PhP <?php echo number_format(($record->qty * $record->variants->price),2) ?></td>
                        </tr>
                        <?php elseif ($purchaseorder->store_flag == "2") :?>
                        <tr>
                            <?php if(!is_null($record->productionworkorders->pwo_id_string)) :?>
                            <td><?php echo $record->productionworkorders->pwo_id_string ?></td>
                            <?php else : ?>
                            <td>NO PWO YET</td>
                            <?php endif ?>
                            <td><?php echo $record->product_description ?></td>
                            <td><?php echo $record->qty ?></td>
                            <td><?php echo $record->unitmaterials->get_description() ?></td>
                            <td>PhP <?php echo number_format($record->unit_price, 2) ?></td>
                            <td>PhP <?php echo number_format(($record->qty * $record->unit_price), 2) ?></td>
                        </tr>
                        <?php endif ?>

                   <?php endforeach ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>PhP <?php echo number_format($purchaseorder->order_amount, 2) ?> TOTAL</strong></td>
                    </tr>
  </tbody>
  
</table>

<br/><br/>
<hr/>
<br/><br/>


                        <table>
                            <tr>
                            <td><strong>SALES ORDER APPROVALS</strong></td>
                            </tr>
                            <tr>
                                <td style="width:15%">Date Approved to SO:</td>
                                <td colspan="2"><?php echo $purchaseorder->salesorders->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Chief Executive Officer:</td>
                                <td style="width:6%; color: <?php echo $purchaseorder->salesorders->color_status('ceo_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('ceo_approved_status') ?></td>
                                <td style="width:10%"><?php echo $purchaseorder->salesorders->ceo_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->ceo->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>General Manager:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('gm_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('gm_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->gm_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->approved->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('sc_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->sc_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->prepared->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Accountant:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->color_status('accountant_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->role_status('accountant_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->accountant_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->checked->full_name() ?></td>
                            </tr>

                        </table>

                        <table>
                            <tr>
                            <td><strong>DELIVERY RECEIPT APPROVALS</strong></td>
                            </tr>
                            <tr>
                                <td style="width:15%">Date Created DR:</td>
                                <td colspan="2"><?php echo $purchaseorder->salesorders->deliveryreceipts->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Production Manager:</td>
                                <td style="width:6%; color: <?php echo $purchaseorder->salesorders->deliveryreceipts->colorrole_status('pm_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->deliveryreceipts->role_status('pm_approved_status') ?></td>
                                <td style="width:10%"><?php echo $purchaseorder->salesorders->deliveryreceipts->pm_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->received->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>General Manager:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->deliveryreceipts->colorrole_status('gm_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->deliveryreceipts->role_status('gm_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->gm_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->approved->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->deliveryreceipts->colorrole_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->deliveryreceipts->role_status('sc_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->sc_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->prepared->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Inventory Contoller:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->deliveryreceipts->colorrole_status('ic_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->deliveryreceipts->role_status('ic_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->ic_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->received->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Laboratory Analyst:</td>
                                <td style="color: <?php echo $purchaseorder->salesorders->deliveryreceipts->colorrole_status('labanalyst_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->salesorders->deliveryreceipts->role_status('labanalyst_approved_status') ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->labanalyst_approved_date ?></td>
                                <td><?php echo $purchaseorder->salesorders->deliveryreceipts->checked->full_name() ?></td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                            <td><strong>FORMULA APPROVAL</strong></td>
                            </tr>
                            <tr>
                                <td style="width:15%">Date Created to FORMULA:</td>
                                <td colspan="2"><?php echo $purchaseorder->poitems->formulas->date_created ?></td>
                            </tr>
                            <tr>
                                <td>President:</td>
                                <td style="width:6%; color: <?php echo $purchaseorder->poitems->formulas->color_status('ceo_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->formulas->role_status('ceo_approved_status') ?></td>
                                <td style="width:10%"><?php echo $purchaseorder->poitems->formulas->ceo_approved_date ?></td>
                                <td ><?php echo $purchaseorder->poitems->formulas->approved->full_name() ?></td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                            <td><strong>PRODUCTION WORK ORDER APPROVALS</strong></td>
                            </tr>
                            <tr>
                                <td style="width:15%">Accountant:</td>
                                <td style="width:6%; color: <?php echo $purchaseorder->poitems->productionworkorders->color_status('accountant_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->productionworkorders->role_status('accountant_approved_status') ?></td>
                                <td style="width:10%"><?php echo $purchaseorder->poitems->productionworkorders->accountant_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->productionworkorders->noted->full_name()?></td>
                            </tr>
                            <tr>
                                <td>Head Chemist:</td>
                                <td style="color: <?php echo $purchaseorder->poitems->productionworkorders->color_status('hc_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->productionworkorders->role_status('hc_approved_status') ?></td>
                                <td><?php echo $purchaseorder->poitems->productionworkorders->hc_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->productionworkorders->approved->full_name()?></td>
                            </tr>
                            <tr>
                                <td>Sales Coordinator:</td>
                                <td style="color: <?php echo $purchaseorder->poitems->productionworkorders->color_status('sc_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->productionworkorders->role_status('sc_approved_status') ?></td>
                                <td><?php echo $purchaseorder->poitems->productionworkorders->sc_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->productionworkorders->prepared->full_name()?></td>
                            </tr>
                        </table>

                        <table>
                            <tr>
                            <td><strong>PRODUCTION BATCH TICKET APPROVALS</strong></td>
                            </tr>
                            <tr>
                                <td style="width:15%">Date Approved to PBT:</td>
                                <td colspan="2"><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->date_created ?></td>
                            </tr>
                            <tr>
                                <td>Head Chemist:</td>
                                <td style="width:6%; color: <?php echo $purchaseorder->poitems->formulas->productionbatchtickets->color_status('hc_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->role_status('hc_approved_status') ?></td>
                                <td style="width:10%"><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->hc_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->checked_two->full_name() ?></td>
                            <tr>
                                <td>Quality Assurance Head:</td>
                                <td style="color: <?php echo $purchaseorder->poitems->formulas->productionbatchtickets->color_status('qa_head_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->role_status('qa_head_approved_status') ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->qa_head_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->noted->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Quality Assurance:</td>
                                <td style="color: <?php echo $purchaseorder->poitems->formulas->productionbatchtickets->color_status('qa_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->role_status('qa_approved_status') ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->qa_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->checked_one->full_name() ?></td>
                            </tr>
                            <tr>
                                <td>Laboratory Analyst:</td>
                                <td style="color: <?php echo $purchaseorder->poitems->formulas->productionbatchtickets->color_status('labanalyst_approved_status') ?>; font-weight: bold;"><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->role_status('labanalyst_approved_status') ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->labanalyst_approved_date ?></td>
                                <td><?php echo $purchaseorder->poitems->formulas->productionbatchtickets->prepared->full_name() ?></td>
                            </tr>
                        </table>

    </body>
</html>