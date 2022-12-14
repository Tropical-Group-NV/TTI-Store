<?php

/* @var $model  */
/* @var $customer  */
/* @var $message */
/* @var $logo */
/* @var $currency */

?>
<?=$currency!='SRD'?
    'Dear '.(trim($customer->FirstName.' '.$customer->LastName)!=''?($customer->FirstName.' '.$customer->LastName):$customer->FullName).',<br><br>
Thank you for your order.<br>
Your order is being processed and will be delivered as soon as possible<br>
For questions, please contact our customer service on WhatsApp +597 8691600 or call +597 458666.':
    'Beste '.(trim($customer->FirstName.' '.$customer->LastName)!=''?($customer->FirstName.' '.$customer->LastName):$customer->FullName) .',<br><br>
Bedankt voor uw bestelling.<br>
De bestelling wordt verwerkt en zo snel mogelijk geleverd.<br>
Voor vragen kunt u contact opnemen met onze klantenservice op WhatsApp +597 8691600 of bellen naar +597 458666.'?>
<br><br>
<table width="100%">
    <tr>
        <td style="text-align: center">
            <table width="95%" style="border: 1px solid #ddd;">
                <tr>
                    <td style="padding: 10px">
                        <table width="100%" style="border: none;margin-bottom: 2px" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="border: none; vertical-align: top;">
                                    <table style="border: none;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td colspan="2" style="margin: 0px 0px 15px 0px;padding: 0px 0px 15px 0px;"><h1><b><?=$currency!='SRD'?'Order Confirmation':'Order Confirmation'?></b></h1></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 5px;width: 80px">S.O. No.</td>
                                            <td style="padding-bottom: 5px"><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->RefNumber?:'&nbsp;'?></div></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 80px"><?=$currency!='SRD'?'Date':'Datum'?></td>
                                            <td><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?php echo $model->TxnDate ?></div></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table width="100%" style="border: none;" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td style="width: 50%;border: none; vertical-align: top">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align:left;height: 25px;font-weight: bold"><?=$currency!='SRD'?'Bill To':'Afnemer'?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left;vertical-align: top;">
                                                            <?php
                                                            $bill = $model->BillAddressAddr1?$model->BillAddressAddr1.'<br>':'';
                                                            $bill .= $model->BillAddressAddr2?$model->BillAddressAddr2.'<br>':'';
                                                            $bill .= $model->BillAddressAddr3?$model->BillAddressAddr3.'<br>':'';
                                                            $bill .= $model->BillAddressAddr4?$model->BillAddressAddr4.'<br>':'';
                                                            $bill .= $model->BillAddressAddr5?$model->BillAddressAddr5.'<br>':'';
                                                            echo $bill;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="width: 50%;border: none; vertical-align: top">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td style="text-align:left;height: 25px;font-weight: bold"><?=$currency!='SRD'?'Ship To':'Leveringsadres'?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left;vertical-align: top;">
                                                            <?php
                                                            $shipTo = $model->ShipAddressAddr1?$model->ShipAddressAddr1.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr2?$model->ShipAddressAddr2.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr3?$model->ShipAddressAddr3.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr4?$model->ShipAddressAddr4.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr5?$model->ShipAddressAddr5.'<br>':'';
                                                            //                                                            $shipTo .= $customer->ShipAddressCity?$customer->ShipAddressCity.'<br>':'';
                                                            //                                                            $shipTo .= $customer->ShipAddressState?$customer->ShipAddressState.'<br>':'';
                                                            //                                                            $shipTo .= $customer->ShipAddressPostalCode?$customer->ShipAddressPostalCode.'<br>':'';
                                                            //                                                            $shipTo .= $customer->ShipAddressCountry?$customer->ShipAddressCountry.'<br>':'';
                                                            echo $shipTo;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="width: 180px;border: none; vertical-align: top"><img src="<?= $message->embed($logo); ?>" style="width:140px"></td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <thead>
                            <tr>
                                <td colspan="6" style="border: none;padding: 0px; margin: 0px;">
                                    <table style="border: none; margin-bottom: 10px" cellpadding="1" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <td style="text-align: center">P.O. No.</td>
                                            <td style="text-align: center"><?=$currency!='SRD'?'Ship&nbsp;Date':'Leveringsdatum'?></td>
                                            <td style="text-align: center"><?=$currency!='SRD'?'Terms':'Voorwaarde'?></td>
                                            <td style="text-align: center"><?=$currency!='SRD'?'Vert.':'Vert.'?></td>
                                            <td style="text-align: center"><?=$currency!='SRD'?'Customer&nbsp;Type':'Klanttype'?></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">FIN</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->PONumber?:'&nbsp;'?></div></td>
                                            <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?php echo $model->ShipDate?></div></td>
                                            <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->TermsRefFullName?:'&nbsp;'?></div></td>
                                            <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->SalesRepRefFullName?:'&nbsp;'?></div></td>
                                            <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldKlanttype?:'&nbsp;'?></div></td>
                                            <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldROUTE?:'&nbsp;'?></div></td>
                                            <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">2000005993</div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </thead>
                            <thead>
                            <tr style="background-color: #DDD">
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Item&nbsp;#':'Artikel&nbsp;Code'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Description':'Omschrijving'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Quantity':'Aantal'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Unit&nbsp;of&nbsp;Measure':'Eenheid'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Rate':'Prijs&nbsp;p/eenheid'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Total excl. VAT':'Totaal excl. BTW'?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0.00000;
                            $btwTotal = 0;
                            $salesOrderItems = \App\Models\SalesOrderItem::query()->where('sales_order_id', $model->id)->get();
                            foreach ($salesOrderItems as $salesOrderItem)

                            {
                                $item = \App\Models\Item::query()->where('ListID', $salesOrderItem->SalesOrderLineItemRefListID)->first();
                                if ($item->SalesTaxCodeRefFullName != 'Non')
                                {
                                    $btwTotal = $btwTotal + (0.1 * $salesOrderItem->SalesOrderLineAmount);

                                }
                                else
                                {

                                }
                                echo '<tr><td style="padding: 2px;text-align: left;border: 1px solid #ddd;">'.$item->Name.'</td>'.
                                    '<td style="padding: 2px;text-align: left;border: 1px solid #ddd;">'.$salesOrderItem->SalesOrderLineDesc.'</td>'.
                                    '<td style="padding: 2px;text-align: center;border: 1px solid #ddd;">'. number_format($salesOrderItem->SalesOrderLineQuantity, 2).'</td>'.
                                    '<td style="padding: 2px;text-align: center;border: 1px solid #ddd;">'.$item->UnitOfMeasureSetRefFullName.'</td>'.
                                    '<td style="padding: 2px;text-align: right;border: 1px solid #ddd;">'. number_format((float)$currency!='SRD'?$salesOrderItem->SalesOrderLineRate / $rate: $salesOrderItem->SalesOrderLineRate, 2, '.', '') . '</td>'.
                                    '<td style="padding: 2px;text-align: right;border: 1px solid #ddd">' . number_format((float)$currency!='SRD'?$salesOrderItem->SalesOrderLineAmount / $rate: $salesOrderItem->SalesOrderLineAmount, 2, '.', '') . ($salesOrderItem->SalesTaxCodeRefFullName!='Non'?'T':'') . '</td></tr>';
                                    $total = $total + $salesOrderItem->SalesOrderLineAmount;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: left;padding-top: 5px"></td>
                                <th style="padding: 2px;text-align: right;vertical-align: top"></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency!='SRD'?'Subtotal':'Subtotaal'?>&nbsp;<?=$currency?></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?php echo number_format((float)$total / $rate, 2, '.', '');?></th>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: left;padding-top: 5px"></td>
                                <th style="padding: 2px;text-align: right;vertical-align: top"></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency!='SRD'?'Total BTW(10.0%)':'Totaal BTW(10.0%)'?>&nbsp;<?=$currency?></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?php echo number_format((float)$btwTotal / $rate, 2, '.', '');?></th>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: left;padding-top: 5px"></td>
                                <th style="padding: 2px;text-align: right;vertical-align: top"></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency!='SRD'?'Total incl. BTW':'Totaal incl. BTW'?>&nbsp;<?=$currency?></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?php echo number_format((float)($total + $btwTotal) / $rate, 2, '.', '');?></th>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;padding-top: 5px">
                                    <?=$model->CustomerMsgRefListID?\app\models\QbCustomerMsg::findOne($model->CustomerMsgRefListID)->Name.'<br>':''?>
                                    <?=$model->Memo?nl2br($model->Memo).'<br>':''?>
                                    <br><br>
                                    <?=$currency!='SRD'?'Scan the QR code to go to':'Scan de code om direct naar'?><br>
                                    www.ttistore.com <?=$currency!='SRD'?'':'te gaan'?>.<br>
                                    <img src="<?= $message->embed($qrLogo); ?>"><br>
                                    Fabrikant van voedings- en farmaceutische producten.<br>
                                    Manufacturer of Food and Pharmaceutical products.
                                </td>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br>
<?=$currency!='SRD'?
    'Thank you for choosing Tropical Trade & Industries NV as your trusted partner and supplier.':
    'Bedankt voor het kiezen van Tropical Trade & Industries NV als uw partner en leverancier.'?>
