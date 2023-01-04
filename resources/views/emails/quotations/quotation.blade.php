<?php
    /** @var $message */
?>
<head>
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
</head>
<p>
    {{$desc}}
</p>
<div style="padding-top: 100px; font-family: sfsemibold" id="printDiv">
    <div class="card">
        <div class="card-body">
            <table width="100%">
                <tr>
                    <td style="padding: 10px">
{{--                        @php($model = $quotation)--}}
{{--                        @if(session()->has('currency'))--}}
{{--                            @php($currency = session()->get('currency'))--}}
{{--                        @else--}}
{{--                            @php($currency = 'SRD')--}}
{{--                        @endif--}}
                        @php($currency = 'SRD')
                        <table width="100%" style="border: none;margin-bottom: 2px" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="border: none; vertical-align: top;">
                                    <table style="border: none;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td colspan="2" style="margin: 0px 0px 15px 0px;padding: 0px 0px 15px 0px;"><h1><b><?=$currency=='USD'?'Quotation':'Offerte'?></b></h1></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 5px">Q. No.</td>
                                            <td style="padding-bottom: 5px"><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$quotation->RefNumber?:'&nbsp;'?></div></td>
                                        </tr>
                                        <tr>
                                            <td><?=$currency=='USD'?'Date':'Datum'?></td>
                                            <td><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">
                                                    {{ $quotation->TxnDate}}</div></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table width="100%" style="border: none;" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td style="width: 50%;border: none; vertical-align: top">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <td style="height: 25px;font-weight: bold"><?=$currency=='USD'?'Bill To':'Afnemer'?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top;">
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
                                                        <td style="height: 25px;font-weight: bold"><?=$currency=='USD'?'Ship To':'Leveringsadres'?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <?php
                                                            $shipTo = $model->ShipAddressAddr1?$model->ShipAddressAddr1.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr2?$model->ShipAddressAddr2.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr3?$model->ShipAddressAddr3.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr4?$model->ShipAddressAddr4.'<br>':'';
                                                            $shipTo .= $model->ShipAddressAddr5?$model->ShipAddressAddr5.'<br>':'';
                                                            //                                                $shipTo .= $model->ShipAddressCity?$model->ShipAddressCity.'<br>':'';
                                                            //                                                $shipTo .= $model->ShipAddressState?$model->ShipAddressState.'<br>':'';
                                                            //                                                $shipTo .= $model->ShipAddressPostalCode?$model->ShipAddressPostalCode.'<br>':'';
                                                            //                                                $shipTo .= $model->ShipAddressCountry?$model->ShipAddressCountry.'<br>':'';
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
                                <td style="width: 180px;border: none; vertical-align: top"><img src="<?= $message->embed($logo); ?>" style="width:180px"></td>
                                {{--                                                            <td style="width: 145px;border: none; vertical-align: top"><img src="<?= $logo; ?>" width="145px"></td>--}}
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="border: none;padding: 0px; margin: 0px;">
                                    <table style="border: none; margin-bottom: 10px" cellpadding="1" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <td style="text-align: center">P.O. No.</td>
                                            <td style="text-align: center"><?=$currency=='USD'?'Ship&nbsp;Date':'Leveringsdatum'?></td>
                                            <td style="text-align: center"><?=$currency=='USD'?'Terms':'Voorwaarde'?></td>
                                            <td style="text-align: center"><?=$currency=='USD'?'Vert.':'Vert.'?></td>
                                            <td style="text-align: center"><?=$currency=='USD'?'Customer&nbsp;Type':'Klanttype'?></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center">FIN</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->PONumber?:'&nbsp;'?></div></td>
                                            <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">
                                                    {{$model->ShipDate}}</div></td>
                                            <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->TermsRefFullName?:'&nbsp;'?></div></td>
                                            @php($customer = \App\Models\Customer::query()->where('ListID', $quotation->CustomerRefListID)->first())
                                            <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->SalesRepRefFullName?:'&nbsp;'?></div></td>
                                            <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldKlanttype?:'&nbsp;'?></div></td>
                                            <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldROUTE?:'&nbsp;'?></div></td>
                                            <td><div class="div" style="width: auto;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">2000005993</div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table style="white-space: normal" width="100%" cellpadding="0" cellspacing="0" class="whitespace-normal">
                            <thead>
                            <tr style="background-color: #DDD">
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Item&nbsp;#':'Artikel&nbsp;Code'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Description':'Omschrijving'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Quantity':'Aantal'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Unit&nbsp;of&nbsp;Measure':'Eenheid'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Rate':'Prijs&nbsp;p/eenheid'?></th>
                                <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Total':'Totaal'?></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($total = 0.00000)
                            @php($btwTotal = 0.00000)
                            @php($quotationItems = \App\Models\QuotationItem::query()->where('quotation_id', $quotation->id)->get())

                            @foreach($quotationItems as $salesOrderItem)
                                @php($item = \App\Models\Item::query()->where('ListID', $salesOrderItem->SalesOrderLineItemRefListID)->first())
                                <tr>
                                    <td style="padding: 2px;text-align: left;border: 1px solid #ddd;">
                                        {{$item->Name}}</td>
                                    <td style="padding: 2px;text-align: left;border: 1px solid #ddd;">{{$salesOrderItem->SalesOrderLineDesc}}</td>
                                    <td style="padding: 2px;text-align: center;border: 1px solid #ddd;">
                                        {{number_format($salesOrderItem->SalesOrderLineQuantity, 2)}}</td>
                                    <td style="padding: 2px;text-align: center;border: 1px solid #ddd;">{{$item->UnitOfMeasureSetRefFullName}}</td>
                                    <td style="padding: 2px;text-align: right;border: 1px solid #ddd;">
                                        {{$salesOrderItem->SalesOrderLineRatePercent ?
                                                                     number_format($salesOrderItem->SalesOrderLineRatePercent, 2)
                                                                     .'%':
                                                                     number_format($salesOrderItem->SalesOrderLineRate, 2)
                                                                    }} </td>
                                    <td style="padding: 2px;text-align: right;border: 1px solid #ddd;">{{$salesOrderItem->SalesOrderLineAmount}}</td>
                                </tr>
                                @if($item->SalesTaxCodeRefFullName != 'Non')
                                    @php($total = $total + $salesOrderItem->SalesOrderLineAmount)
                                    @php($btwTotal = $btwTotal + ( 0.1 * ($salesOrderItem->SalesOrderLineAmount)))
                                @else
                                    @php($total = $total + $salesOrderItem->SalesOrderLineAmount)
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: left;padding-top: 5px">
                                </td>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency=='USD'?'Subtotal':'Subtotaal'?>&nbsp;<?=$currency?></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top">
                                    {{number_format($total, 2)}}</th>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;padding-top: 5px">
                                </td>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency=='USD'?'Total VAT(10.0%)':'Totaal BTW(10.0%)'?>&nbsp;<?=$currency?></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top">
                                    {{number_format($btwTotal, 2)}}</th>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: left;padding-top: 5px">
                                    {{ $model->CustomerMsgRefFullName }}
                                    <br>
                                    <?=$model->Memo?nl2br($model->Memo).'<br>':''?><br><br>
                                    @if($model->signature_id != null)
                                        @php($signature = \App\Models\Signature::query()->where('id', $model->signature_id)->first())
                                        <img class="w-3/4" src="{{ asset('storage/signatures/' . $signature->image) }}" alt="{{ $signature->name }}">
                                    @endif
                                    <?=$currency=='USD'?'Scan the QR code to go to':'Scan de code om direct naar'?><br>
                                    www.ttistore.com <?=$currency=='USD'?'':'te gaan'?>.<br>
                                    <img src="<?= $message->embed($qrLogo); ?>">
                                    <br>
                                    Fabrikant van voedings- en farmaceutische producten.<br>
                                    Manufacturer of Food and Pharmaceutical products.
                                </td>
                                <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency=='USD'?'Total incl. VAT':'Totaal incl. BTW'?>&nbsp;<?=$currency?></th>
                                <th style="padding: 2px;text-align: right;vertical-align: top">
                                    {{number_format($total + $btwTotal, 2)}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
