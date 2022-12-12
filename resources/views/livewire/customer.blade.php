<div>
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Orders
    </h1>
    <div class="px-8">
        <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 whitespace-nowrap border" id="dataTable">
            <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="py-3 px-6">
                    Delivery date
                </th>
                <th class="py-3 px-6">
                    S.O. No.
                </th>
                <th class="py-3 px-6">
                    Terms
                </th>
                <th class="py-3 px-6">
                    Total Items
                </th>
                <th class="py-3 px-6">
                    Amount
                </th>
                @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 1 or \Illuminate\Support\Facades\Auth::user()->users_type_id == 5)
                    <th class="py-3 px-6">
                        In QB
                    </th>
                    <th class="py-3 px-6">
                        In QB Date
                    </th>
                @endif
                <th class="py-3 px-6">
                    Reorder
                </th>
                <th class="py-3 px-6">
                    View
                </th>
            </tr>
            </thead>
            <tbody wire:init="showOrders" class="">
            @foreach($orders as $order)
                @php($salesRep = \App\Models\User::query()->where('id', $order->uid)->first())
                @php($items = \App\Models\SalesOrderItem::query()->where('sales_order_id', $order->id)->get())
                <tr style="color: black" class="bg-white border-b">
                    <td class="py-4 px-6" >
                        {{ $order->TxnDate }}
                    </td>
                    <th style="color: #0069ad" scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        <b>{{ $order->RefNumber }}</b>
                    </th>
                    <td class="py-4 px-6">
                        {{ $order->TermsRefFullName }}
                    </td>
                    <td class="py-4 px-6">
                        @php($itemQty = 0)
                        @php($subTotal = 0)
                        @foreach($items as $item)
                            @php($itemQty = $itemQty + $item->SalesOrderLineQuantity)
                            @php($subTotal = $subTotal + $item->SalesOrderLineAmount)
                        @endforeach
                        {{ $itemQty }}
                    </td>
                    <td class="py-4 px-6">
                        @if(session()->has('currency'))
                            {{ session()->get('currency') }} {{ number_format($subTotal / $rate, 2) }}
                        @else
                            SRD {{ $subTotal }}
                        @endif
                    </td>
                    @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 1 or \Illuminate\Support\Facades\Auth::user()->users_type_id == 5)
                        <td class="py-4 px-6">
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
                        <td class="py-4 px-6">
                            @if($order->datetime_to_quickbook != null)
                                {{ date('Y-m-d', strtotime($order->datetime_to_quickbook)) }}
                            @endif
                        </td>
                    @endif
                    <td class="py-4 px-6">
                        <button wire:click="reorder('{{ $order->id }}')" style="background-color: #0069AD; color: white" class="btn ">
                            Reorder
                        </button>
                    </td>

                    <td class="py-4 px-6">
                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                            <!-- Trigger for Modal -->
                            <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">
                                View
                            </button>

                            <div  style="z-index: 99999999" x-show="showModal"
                                  class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                  x-transition.opacity x-transition:leave.duration.500ms >
                                <!-- Modal inner -->
                                <div x-show="showModal"
                                     class="px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg scale-50 sm:scale-100"
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
                                    @if($showOrder == 1)
                                        <div class="h-3/4">
                                            <?php
                                            $model = \App\Models\SalesOrderItem::query()->where('id', $order->id)->first();
                                            $c = $customer;
                                            $logo = asset('tti-new_email.jpg');
                                            $qrLogo = asset('tti-email-qr');
                                            if (session()->has('currency'))
                                            {
                                                $currency = session()->get('currency');
                                                $rate = session()->get('exchangeRate');
                                            }
                                            else
                                            {
                                                $currency = 'SRD';
                                                $rate = 1;
                                            }


                                            ?>
                                            <br><br>
                                            <table width="100%">
                                                <tr>
                                                    <td style="text-align: center">
                                                        <table width="95%" style="">
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
                                                                                        <td style="padding-bottom: 5px"><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$order->RefNumber?:'&nbsp;'?></div></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="width: 80px"><?=$currency!='SRD'?'Date':'Datum'?></td>
                                                                                        <td><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?php echo $order->TxnDate ?></div></td>
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
                                                                                                        {{ $order->BillAddressAddr1 }}
                                                                                                        <br>
                                                                                                        {{ $order->BillAddressAddr2 }}
                                                                                                        <br>
                                                                                                        {{ $order->BillAddressAddr3 }}
                                                                                                        <br>
                                                                                                        {{ $order->BillAddressAddr4 }}
                                                                                                        <br>
                                                                                                        {{ $order->BillAddressAddr5 }}
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
                                                                                                        $shipTo = $order->ShipAddressAddr1?$order->ShipAddressAddr1.'<br>':'';
                                                                                                        $shipTo .= $order->ShipAddressAddr2?$order->ShipAddressAddr2.'<br>':'';
                                                                                                        $shipTo .= $order->ShipAddressAddr3?$order->ShipAddressAddr3.'<br>':'';
                                                                                                        $shipTo .= $order->ShipAddressAddr4?$order->ShipAddressAddr4.'<br>':'';
                                                                                                        $shipTo .= $order->ShipAddressAddr5?$order->ShipAddressAddr5.'<br>':'';
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
                                                                                        <td style="text-align: center; width: 250px"><?=$currency!='SRD'?'Ship&nbsp;Date':'Leveringsdatum'?></td>
                                                                                        <td style="text-align: center"><?=$currency!='SRD'?'Terms':'Voorwaarde'?></td>
                                                                                        <td style="text-align: center"><?=$currency!='SRD'?'Vert.':'Vert.'?></td>
                                                                                        <td style="text-align: center"><?=$currency!='SRD'?'Customer&nbsp;Type':'Klanttype'?></td>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td><div style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$order->PONumber?:'&nbsp;'?></div></td>
                                                                                        <td><div style="border-radius: 25px;padding: 5px;border: 1px solid #ddd"><?php echo $order->ShipDate?></div></td>
                                                                                        <td><div style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$order->TermsRefFullName?:'&nbsp;'?></div></td>
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
                                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Item&nbsp;#':'Artikel&nbsp;Code'?></th>
                                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Description':'Omschrijving'?></th>
                                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Quantity':'Aantal'?></th>
                                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Unit&nbsp;of&nbsp;Measure':'Eeheid'?></th>
                                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Rate':'Prijs&nbsp;per&nbsp;stuk'?></th>
                                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency!='SRD'?'Total':'Totaal'?></th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $total = 0.00000;
                                                                        $salesOrderItems = \App\Models\SalesOrderItem::query()->where('sales_order_id', $model->id)->get();
                                                                        foreach ($salesOrderItems as $salesOrderItem)
                                                                        {
                                                                            if (\App\Models\Item::query()->where('ListID', $salesOrderItem->SalesOrderLineItemRefListID)->exists())
                                                                            {
                                                                                $item = \App\Models\Item::query()->where('ListID', $salesOrderItem->SalesOrderLineItemRefListID)->first();
                                                                                echo '<tr><td style="padding: 2px;text-align: left;border: 1px solid #ddd;">'.$item->Name.'</td>'.
                                                                                    '<td style="padding: 2px;text-align: left;border: 1px solid #ddd;">'.$salesOrderItem->SalesOrderLineDesc.'</td>'.
                                                                                    '<td style="padding: 2px;text-align: center;border: 1px solid #ddd;">'.$salesOrderItem->SalesOrderLineQuantity.'</td>'.
                                                                                    '<td style="padding: 2px;text-align: center;border: 1px solid #ddd;">'.$item->UnitOfMeasureSetRefFullName.'</td>'.
                                                                                    '<td style="padding: 2px;text-align: right;border: 1px solid #ddd;">'. number_format((float)$currency!='SRD'?$salesOrderItem->SalesOrderLineRate / $rate: $salesOrderItem->SalesOrderLineRate, 2, '.', '').'</td>'.
                                                                                    '<td style="padding: 2px;text-align: right;border: 1px solid #ddd">' . number_format((float)$currency!='SRD'?$salesOrderItem->SalesOrderLineAmount / $rate: $salesOrderItem->SalesOrderLineAmount, 2, '.', '')  . '</td></tr>';
                                                                                $total = $total + $salesOrderItem->SalesOrderLineAmount;
                                                                            }

                                                                        }
                                                                        ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                        <tr>
                                                                            <td colspan="4" style="text-align: left;padding-top: 5px">
                                                                                <?=$model->CustomerMsgRefListID?\app\models\QbCustomerMsg::findOne($model->CustomerMsgRefListID)->Name.'<br>':''?>
                                                                                <?=$model->Memo?nl2br($model->Memo).'<br>':''?>
                                                                                <br><br>
                                                                                <?=$currency!='SRD'?'Scan the QR code to go to':'Scan de code om direct naar'?><br>
                                                                                www.ttistore.com <?=$currency!='SRD'?'':'te gaan'?>.<br>
                                                                                <img src="{{ asset('tti-email-qr.png') }}"><br>
                                                                                Fabrikant van voedings- en farmaceutische producten.<br>
                                                                                Manufacturer of Food and Pharmaceutical products.
                                                                            </td>
                                                                            <th style="padding: 2px;text-align: right;vertical-align: top">Totaal&nbsp;<?=$currency?></th>
                                                                            <th style="padding: 2px;text-align: right;vertical-align: top"><?php echo number_format((float)($total / $rate) , 2, '.', '');?></th>
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
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--                                                                            <a href="{{ route('order', $order->id) }}">--}}
                        {{--                                                                                <button style="background-color: #0069AD; color: white" class="btn ">--}}
                        {{--                                                                                    View--}}
                        {{--                                                                                </button>--}}
                        {{--                                                                            </a>--}}

                    </td>
                </tr>
            @endforeach



            </tbody>
        </table>
        <br>
        <div class="  2xl:px-20 md:px-6 px-4">
            {{ $orders->links('vendor.pagination.bootstrap-unscroll') }}
        </div>
        <br>
    </div>
    <br>
    <hr>
    <br>
</div>
<br>
<div class="  2xl:px-20 md:px-6 px-4">
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Location
    </h1>
    @include('map.map')
    {{--                <div id="gmap" style="height: 400px"></div>--}}
    {{--                <div id="googleMap" style="width:100%;height:1000px;"></div>--}}

    {{--                <script>--}}
    {{--                    function myMap() {--}}
    {{--                        var mapProp= {--}}
    {{--                            center:new google.maps.LatLng(51.508742,-0.120850),--}}
    {{--                            zoom:2,--}}
    {{--                        };--}}
    {{--                        var map = new google.maps.Map(document.getElementById("gmap"),mapProp);--}}
    {{--                    }--}}
    {{--                    infowindow = new google.maps.InfoWindow();--}}
    {{--                </script>--}}

    {{--                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkoN03H7_AhO26uAnkBiwO88zjd6mufEc&callback=myMap&v=3"></script>--}}
    {{--                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkoN03H7_AhO26uAnkBiwO88zjd6mufEc&callback=myMap&v=3" async defer></script>--}}
</div>


