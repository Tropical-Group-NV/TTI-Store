<div>
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Your Orders
    </h1>

    {{--    <div class="bg-white shadow-xl sm:rounded-lg">--}}
    {{--        <div style="" class="py-12 md:px-6  2xl:px-20 ">--}}
    {{--            <form class="" id="searchform" action="{{ route('orders') }}">--}}
    {{--                <ul class="flex">--}}
    {{--                    <input onkeyup="searchItem2()" style="height:50px;" id="search_input2" placeholder="Search..." name="search" class="w-full rounded-md flex-shrink-0" autocomplete="false" type="search">--}}
    {{--                    <button class="btn w-full" style="background-color: #0069AD; height: 50px">--}}
    {{--                        <img style="width: 40px; height: 40px" src="{{ asset('search_glass.svg') }}" alt="">--}}
    {{--                    </button>--}}
    {{--                </ul>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="bg-white shadow-xl sm:rounded-lg">



        <div style="overflow-x: auto" class="  py-12 2xl:px-20 md:px-6 px-4">
            <form action="{{ route('orders') }}">
                <div class="flex">
                    <div class="relative w-full">
                        <input value="{{ $search }}" name="search" type="search" id="search-dropdown" class="rounded-l-lg block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Orders" required>
                        <button style="background-color: #0069ad" type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 ">
                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div style="overflow-x: auto">
                <div style="overflow-x: auto">
                    <table style="margin: auto" class="table-auto" id="dataTable">
                        <thead class="bg-gray-100">
                        <tr>
                            <th style="width: 350px" class="border border-slate-600">
                                Delivery date
                            </th>
                            <th  style="width: 350px" class="border border-slate-600">
                                Customer
                            </th>
                            <th style="width: 350px" class="border border-slate-600 ">
                                Adres
                            </th>
                            <th style="width: 350px" class="border border-slate-600">
                                Terms
                            </th>
                            <th style="width: 350px" class="border border-slate-600">
                                Total Items
                            </th>
                            <th style="width: 350px" class="border border-slate-600">
                                Amount
                            </th>
                            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 1 or \Illuminate\Support\Facades\Auth::user()->users_type_id == 5)
                                <th style="width: 150px" class="border border-slate-600">
                                    In QB
                                </th>
                                <th style="width: 150px" class="border border-slate-600">
                                    In QB Date
                                </th>
                            @endif
                            <th style="width: 150px" class="border border-slate-600">
                                Reorder
                            </th>
                            <th style="width: 150px" class="border border-slate-600">
                                View
                            </th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($orders as $order)
                            @php($customer = \App\Models\Customer::query()->where('ListID', $order->CustomerRefListID)->first())
                            @php($items = \App\Models\SalesOrderItem::query()->where('sales_order_id', $order->id)->get())
                            <tr class="bg-gray-50">
                                <td class="border">
                                    {{ $order->TxnDate }}
                                </td>
                                <td class="border border-slate-700">
                                    {{ $customer->Name }}
                                </td>
                                <td class="border border-slate-700">
                                    {{ $customer->BillAddressBlockAddr1 . ' ' .  $customer->BillAddressBlockAddr2 . ' ' . $customer->BillAddressBlockAddr3 . ' ' . $customer->BillAddressBlockAddr4 . ' ' . $customer->BillAddressBlockAddr5}}
                                </td>
                                <td class="border border-slate-700">
                                    {{ $order->TermsRefFullName }}
                                </td>
                                <td class="border border-slate-700">
                                    @php($itemQty = 0)
                                    @php($subTotal = 0)
                                    @foreach($items as $item)
                                        @php($itemQty = $itemQty + $item->SalesOrderLineQuantity)
                                        @php($subTotal = $subTotal + $item->SalesOrderLineAmount)
                                    @endforeach
                                    {{ $itemQty }}
                                </td>
                                <td class="border border-slate-700">
                                    SRD {{ $subTotal }}
                                </td>
                                @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 1 or \Illuminate\Support\Facades\Auth::user()->users_type_id == 5)
                                    <td class="border border-slate-700" style="margin: auto">
                                        @if($order->write_to_quickbook == 1)
                                            <span>
                                                 <button style="background-color: rgb(22 163 74)" type="button" class="rounded-full px-4 mr-2 bg-green-600 text-white p-2 rounded  leading-none flex items-center">
                                                     <b style="font-family: sfsemibold">
                                                         YES
                                                     </b>

                                                 </button>
                                            </span>
                                        @else
                                            <span>
                                                 <button type="button" class="rounded-full px-4 mr-2 bg-red-600 text-white p-2 rounded  leading-none flex items-center">
                                                     <b style="font-family: sfsemibold">
                                                     NO
                                                     </b>
                                                 </button>
                                            </span>
                                        @endif
                                        {{--                                        SRD {{ $subTotal }}--}}
                                    </td>
                                    <td class="border border-slate-700">
                                        @if($order->datetime_to_quickbook != null)
                                            {{ date('Y-m-d', strtotime($order->datetime_to_quickbook)) }}
                                        @endif
                                    </td>
                                @endif
                                <td class="border border-indigo-400">
                                    <button wire:click="reorder('{{ $order->id }}')" style="background-color: #0069AD; color: white" class="btn ">
                                        Reorder
                                    </button>
                                </td>
                                <td class="border" style="margin: auto">
                                    <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                        <!-- Trigger for Modal -->
                                        <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">
                                            View
                                        </button>

                                        <!-- Whatsapp Modal -->
                                        <div x-show="showModal"
                                             class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                             x-transition.opacity x-transition:leave.duration.500ms >
                                            <!-- Modal inner -->
                                            <div x-show="showModal" x-transition:enter.duration.500ms
                                                 x-transition:leave.duration.400ms
                                                 class="max-w-3xl px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg"
                                                 @click.away="showModal = false"
                                            >
                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-between">
                                                    <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                            <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- content -->
                                                <div>
                                                    <?php
                                                    $model = \App\Models\SalesOrderItem::query()->where('id', $order->id)->first();
                                                    $c = \App\Models\QbCustomer::query()->where('ListID', $model->CustomerRefListID)->first();
                                                    $logo = asset('tti-new_email.jpg');
                                                    $qrLogo = asset('tti-email-qr');
                                                    $currency = 'SRD';

                                                    ?>
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
                                                                                                <td colspan="2" style="margin: 0px 0px 15px 0px;padding: 0px 0px 15px 0px;"><h1><b><?=$currency=='USD'?'Order Confirmation':'Order Confirmation'?></b></h1></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="padding-bottom: 5px;width: 80px">S.O. No.</td>
                                                                                                <td style="padding-bottom: 5px"><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->RefNumber?:'&nbsp;'?></div></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td style="width: 80px"><?=$currency=='USD'?'Date':'Datum'?></td>
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
                                                                                                            <td style="text-align:left;height: 25px;font-weight: bold"><?=$currency=='USD'?'Bill To':'Afnemer'?></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td style="text-align:left;vertical-align: top;">
                                                                                                                {{ $model->BillAddressAddr1 }}
                                                                                                                {{ $model->BillAddressAddr2 }}
                                                                                                                {{ $model->BillAddressAddr3}}
                                                                                                                {{ $model->BillAddressAddr4 }}
                                                                                                                {{ $model->BillAddressAddr5 }}
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
                                                                                                            <td style="text-align:left;height: 25px;font-weight: bold"><?=$currency=='USD'?'Ship To':'Leveringsadres'?></td>
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
                                                                                    <td style="width: 180px;border: none; vertical-align: top"><img src="{{ $logo }}" style="width:180px"></td>
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
                                                                                                <td style="text-align: center"><?=$currency=='USD'?'Ship&nbsp;Date':'Leveringsdatum'?></td>
                                                                                                <td style="text-align: center"><?=$currency=='USD'?'Terms':'Voorwaarde'?></td>
                                                                                                <td style="text-align: center"><?=$currency=='USD'?'Vert.':'Vert.'?></td>
                                                                                                <td style="text-align: center"><?=$currency=='USD'?'Customer&nbsp;Type':'Klanttype'?></td>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->PONumber?:'&nbsp;'?></div></td>
                                                                                                <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?php echo $model->ShipDate?></div></td>
                                                                                                <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->TermsRefFullName?:'&nbsp;'?></div></td>
                                                                                                <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->SalesRepRefFullName?:'&nbsp;'?></div></td>
                                                                                                <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldKlanttype?:'&nbsp;'?></div></td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                </thead>
                                                                                <thead>
                                                                                <tr style="background-color: #DDD">
                                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Item&nbsp;#':'Artikel&nbsp;Code'?></th>
                                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Description':'Omschrijving'?></th>
                                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Quantity':'Aantal'?></th>
                                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Unit&nbsp;of&nbsp;Measure':'Eeheid'?></th>
                                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Rate':'Prijs&nbsp;per&nbsp;stuk'?></th>
                                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Total':'Totaal'?></th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php
                                                                                $total = 0.00000;
                                                                                $salesOrderItems = \App\Models\SalesOrderItem::query()->where('sales_order_id', $model->id)->get();
                                                                                foreach ($salesOrderItems as $salesOrderItem)
                                                                                {
                                                                                    $item = \App\Models\Item::query()->where('ListID', $salesOrderItem->SalesOrderLineItemRefListID)->first();
                                                                                    echo '<tr><td style="padding: 2px;text-align: left;border: 1px solid #ddd;">'.$item->Name.'</td>'.
                                                                                        '<td style="padding: 2px;text-align: left;border: 1px solid #ddd;">'.$salesOrderItem->SalesOrderLineDesc.'</td>'.
                                                                                        '<td style="padding: 2px;text-align: center;border: 1px solid #ddd;">'.$salesOrderItem->SalesOrderLineQuantity.'</td>'.
                                                                                        '<td style="padding: 2px;text-align: center;border: 1px solid #ddd;">'.$item->UnitOfMeasureSetRefFullName.'</td>'.
                                                                                        '<td style="padding: 2px;text-align: right;border: 1px solid #ddd;">'.number_format((float)$salesOrderItem->SalesOrderLineRate, 2, '.', '').'</td>'.
                                                                                        '<td style="padding: 2px;text-align: right;border: 1px solid #ddd">' . $salesOrderItem->SalesOrderLineAmount . '</td></tr>';
                                                                                    $total = $total + $salesOrderItem->SalesOrderLineAmount;
                                                                                }
                                                                                ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                <tr>
                                                                                    <td colspan="4" style="text-align: left;padding-top: 5px">
                                                                                        <?=$model->CustomerMsgRefListID?\app\models\QbCustomerMsg::findOne($model->CustomerMsgRefListID)->Name.'<br>':''?>
                                                                                        <?=$model->Memo?nl2br($model->Memo).'<br>':''?>
                                                                                        <br><br>
                                                                                        <?=$currency=='USD'?'Scan the QR code to go to':'Scan de code om direct naar'?><br>
                                                                                        www.ttistore.com <?=$currency=='USD'?'':'te gaan'?>.<br>
                                                                                        <img src="{{ asset('tti-email-qr.png') }}"><br>
                                                                                        Fabrikant van voedings- en farmaceutische producten.<br>
                                                                                        Manufacturer of Food and Pharmaceutical products.
                                                                                    </td>
                                                                                    <th style="padding: 2px;text-align: right;vertical-align: top">Totaal&nbsp;<?=$currency?></th>
                                                                                    <th style="padding: 2px;text-align: right;vertical-align: top"><?php echo number_format((float)$total, 2, '.', '');?></th>
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

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                        <a href="{{ route('order', $order->id) }}">--}}
                                    {{--                                            <button style="background-color: #0069AD; color: white" class="btn ">--}}
                                    {{--                                                View--}}
                                    {{--                                            </button>--}}
                                    {{--                                        </a>--}}

                                </td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-20">
                {{ $orders->links('vendor.pagination.bootstrap-52') }}
            </div>
        </div>
    </div>
</div>

