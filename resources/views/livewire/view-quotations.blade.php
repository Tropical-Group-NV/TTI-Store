<div>
    <div class="flex justify-between">
        <div>
            <div class="">
               <h1>
                   <h1 style="font-family: sfsemibold; font-size: 35px" class="p-4">
                       Quotations
                   </h1>
               </h1>
            </div>
        </div>
        <div>
            <div class="">
               <h1>
                   <div style="font-family: sfsemibold; font-size: 35px; text-align: right" class="p-4">
                       <a href="{{ route('quotations.create') }}" style="background-color: #0069AD; color: white" class="btn">
                           <b>
                               +
                           </b>
                       </a>
                   </div>
               </h1>
            </div>
        </div>
    </div>
    <div style="overflow-x: auto">
        <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 border rounded whitespace-nowrap" id="dataTable">
            <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="rounded text-xs text-gray-700 uppercase bg-gray-50">
            <th class="py-3 px-6">
                Date
            </th>
            <th class="py-3 px-6">
                Q. Number
            </th>
            <th class="py-3 px-6">
                Customer
            </th>
            <th class="py-3 px-6">
                Address1
            </th>
            <th class="py-3 px-6">
                Address2
            </th>
            <th class="py-3 px-6">
                P.O. Nummer
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
            <th class="py-3 px-6">
                Created By
            </th>
            <th class="py-3 px-6">
                Email sent
            </th>
            <th class="py-3 px-6">
                View
            </th>
            <th class="py-3 px-6">
                Is SO
            </th>
            <th class="py-3 px-6">
                Action
            </th>
            </thead>
            <tbody>
            @foreach($quotations as $quotation)
                @php($user = \App\Models\User::query()->where('id', $quotation->uid)->first())
                @php($qItems = \App\Models\QuotationItem::query()->where('quotation_id', $quotation->id)->get())
                @php($qItemsCount = count($qItems))

            <tr id="row-{{$quotation->id}}" style="color: black" class="bg-white border-b">
                <td class="py-4 px-6" >
                    {{date("d-m-Y", strtotime($quotation->TxnDate))}}
                </td>
                <td class="py-4 px-6" >
                    {{$quotation->RefNumber ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    {{$quotation->BillAddressAddr1 ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    {{$quotation->BillAddressAddr1 ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    {{$quotation->BillAddressAddr2 ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    {{$quotation->PONumber ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    {{$quotation->TermsRefFullName ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    {{$qItemsCount ?? ''}}
                </td>
                <td class="py-4 px-6" >
                    @php($subTotal = 0)
                    @foreach($qItems as $item)
                        @php($subTotal = $subTotal + $item->SalesOrderLineAmount)
                    @endforeach
                    Srd {{ $subTotal }}
{{--                    {{$user->name ?? ''}}--}}
                </td>
                <td class="py-4 px-6" >
                    {{$user->name ?? '' . $user->last_name ?? ''}}
                </td>
                <td>
                    @php($lastMail = \App\Models\QuotationMail::query()->where('quotation_id', $quotation->id)->first())
                    @if($lastMail != null)
                        {{date("d-m-Y H:i:s", strtotime( $lastMail->datetime_sent))}}
                    @endif
                </td>
                <td class="py-4 px-6" >
{{--                    <button class="btn" style="color: white; background-color: #0069ad">--}}
{{--                        <i class="fa fa-eye">--}}

{{--                        </i>--}}
{{--                    </button>--}}
                    <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                        <!-- Trigger for Modal -->
                        <button @click="showModal =  ! showModal" style="color: white; background-color: #0069ad" class="btn">
                            <i class="fa fa-eye">

                            </i>
                        </button>
                        {{--                        <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">--}}
                        {{--                            <b>--}}
                        {{--                                <i class="fa fa-pencil"></i>--}}
                        {{--                            </b>--}}
                        {{--                        </button>--}}
                        <div  style="z-index: 99999999" x-show="showModal"
                              class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                              x-transition.opacity x-transition:leave>
                            <br>
                            <br>
                            <br>
                            <!-- Modal inner -->
                            <div @click.away="showModal = false"style="padding-top: 100px" class="p-4" id="printDiv">
                                <div class="card">
                                    <div class="card-body">
                                        <table width="100%">
                                            <tr>
                                                <td style="padding: 10px">
                                                    @php($model = $quotation)
                                                    @if(session()->has('currency'))
                                                        @php($currency = session()->get('curency'))
                                                    @else
                                                        @php($currency = 'SRD')
                                                    @endif
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
                                                                                {{date("d-m-Y", strtotime( $quotation->TxnDate))}}</div></td>
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
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->PONumber?:'&nbsp;'?></div></td>
                                                                        <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">
                                                                                {{date("d-m-Y", strtotime( $model->ShipDate))}}</div></td>
                                                                        <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$model->TermsRefFullName?:'&nbsp;'?></div></td>
                                                                        @php($customer = \App\Models\Customer::query()->where('ListID', $quotation->CustomerRefListID)->first())
                                                                        <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->SalesRepRefFullName?:'&nbsp;'?></div></td>
                                                                        <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldKlanttype?:'&nbsp;'?></div></td>
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
                                                            <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Total excl. VAT':'Totaal excl. BTW'?></th>
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
                                                                <td style="padding: 2px;text-align: right;border: 1px solid #ddd;">{{$salesOrderItem->SalesOrderLineAmount}}{{ ($item->SalesTaxCodeRefFullName != 'Non'? 'T':'') }}</td>
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
                                                            <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency=='USD'?'Total VAT(10.0%)':'Totaal BTW(10.0 %)'?>&nbsp;<?=$currency?></th>
                                                            <th style="padding: 2px;text-align: right;vertical-align: top">
                                                                {{number_format($btwTotal, 2)}}</th>
                                                        </tr>
                                                        <tr>
                                                            @php($logo = asset('tti-new_email.jpg'))
                                                            @php($qrLogo = asset('tti-email-qr.png'))
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
                                                                <img src="<?= $qrLogo; ?>"><br>
                                                                Fabrikant van voedings- en farmaceutische producten.<br>
                                                                Manufacturer of Food and Pharmaceutical products.
                                                            </td>
                                                            <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency=='USD'?'Total incl. VAT':'Totaal incl. BTW'?>&nbsp;<?=$currency?></th>
                                                            <th style="padding: 2px;text-align: right;vertical-align: top">
                                                                {{number_format($total + $btwTotal, 2)}}</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                    <hr>
                                                    <div class="flex justify-between p-4">
                                                        <div>
                                                            <button @click="showModal = false" class="btn btn-danger">Cancel</button>
                                                        </div>
                                                        <div class="flex">
                                                            <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                                                <!-- Trigger for Modal -->
                                                                <button @click="showModal =  ! showModal" class="btn btn-success">
                                                                    Send mail
                                                                </button>
                                                                <div  style="z-index: 99999999" x-show="showModal"
                                                                      class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                                                      x-transition.opacity x-transition:leave>
                                                                    <br>
                                                                    <br>
                                                                    <br>
                                                                    <!-- Modal inner -->
                                                                    <div @click.away="showModal = false"style="padding-top: 100px" class="p-4" id="printDiv">
                                                                        <div class="card">
                                                                            <h1 class="card-header">
                                                                                <b class="text-2xl">
                                                                                    Email quotation for {{ $customer->FullName }}
                                                                                </b>
                                                                            </h1>
                                                                            <div class="card-body">
                                                                                <div class="">
                                                                                    <label for=""><b class="">Reply to</b></label>
                                                                                    @php($adUser = \Illuminate\Support\Facades\DB::connection('tgncloud')->table('users')->where('username', \Illuminate\Support\Facades\Auth::user()->username)->first())
                                                                                        <input value="{{ $adUser->email }}" id="from-{{$quotation->id}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                                                </div>
                                                                                <div class="">
                                                                                    <label for=""><b class="">To email</b></label>
                                                                                        <input value="{{ $customer->Email }}" id="to-{{$quotation->id}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                                                </div>
                                                                                <div class="">
                                                                                    <label for=""><b class="">Cc email</b></label>
                                                                                        <input value="verkoop@tropicalgroupnv.com" id="cc-{{$quotation->id}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                                                </div>
                                                                                <div class="">
                                                                                    <label for=""><b class="">Subject</b></label>
                                                                                        <input value="ttistore.com Quotation {{ $quotation->RefNumber }}" id="subject-{{$quotation->id}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                                                </div>
                                                                                <label class="" for=""><b>Description</b></label>
                                                                                <textarea name="" id="textArea-{{$quotation->id}}" cols="30"
                                                                                          rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                                                                                <br>
                                                                                <select onchange="changeDescription('description-{{$quotation->id}}', 'textArea-{{$quotation->id}}')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="" id="description-{{$quotation->id}}">
                                                                                    <option value="">Choose default description</option>
                                                                                    <option value="1">Beste heer/mevrouw</option>
                                                                                    <option value="2">Dear Mr/Mrs</option>
                                                                                </select>
                                                                                <div class="py-3 flex justify-between">
                                                                                    <button @click="showModal = false" class="btn btn-danger">Cancel</button>
                                                                                    <button @click="showModal = false" wire:click="sendMail(document.getElementById('from-{{$quotation->id}}').value,document.getElementById('to-{{$quotation->id}}').value,document.getElementById('cc-{{$quotation->id}}').value,document.getElementById('subject-{{$quotation->id}}').value,document.getElementById('textArea-{{$quotation->id}}').value, '{{$quotation->id}}')" class="btn btn-primary">Send</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button wire:click="exportPDF('{{$quotation->id}}')" class="btn btn-primary">
                                                                <img wire:loading wire:target="exportPDF" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                                                <span wire:loading.remove wire:target="exportPDF">
                                                                    Print
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="py-4 px-6" >
                    @if($quotation->is_so == 1)
{{--                        @php($SO = \App\Models\SalesOrder::query()->where('id', $quotation->so_id)->first('RefNumber'))--}}
                        <div class="btn btn-success" >
{{--                            {{ $SO->RefNumber }}--}}
                            TTI-{{$quotation->so_id}}
                        </div>
                    @else
                        <div wire:click="createSo('{{ $quotation->id }}')" class="btn" style="background-color: #0069ad; color: white">
                            <img wire:loading wire:target="createSo('{{ $quotation->id }}')" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                            <span wire:loading.remove wire:target="createSo('{{ $quotation->id }}')">
                                Create SO
                            </span>
                        </div>
                    @endif

                </td>
                <td class="py-4 px-6" >
                    @if($quotation->is_so != 1)
                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                            <!-- Trigger for Modal -->
                            <button @click="showModal =  ! showModal" class="btn btn-danger">
                                <i class="fa fa-trash">

                                </i>
                            </button>
                            {{--                        <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">--}}
                            {{--                            <b>--}}
                            {{--                                <i class="fa fa-pencil"></i>--}}
                            {{--                            </b>--}}
                            {{--                        </button>--}}
                            <div  style="z-index: 99999999" x-show="showModal"
                                  class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                  x-transition.opacity  x-transition:leave>
                                <!-- Modal inner -->
                                <div x-show="showModal"
                                     class="px-6 py-4 text-left bg-white border rounded-lg shadow-lg"
                                     @click.away="showModal = false">
                                    <!-- Title / Close-->
                                    <div class="flex items-center justify-between">
                                        <div class="px-8">
                                            <h1 style="font-family: sfsemibold">
                                                Delete Quotation {{ $quotation->RefNumber }}?
                                            </h1>

                                        </div>
                                        <button id="closeTicketModal-{{ $quotation->id }}" type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- content -->
                                    <div class="py-8 px-8">
                                        <div class="flex justify-between">
                                            <button @click="showModal = false" class="btn btn-secondary">
                                                Cancel
                                            </button>
                                            <button @click="showModal = false" wire:click="delete('{{ $quotation->id }}')" onclick="document.getElementById('row-{{$quotation->id}}').remove()" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <div class="  2xl:px-20 md:px-6 px-4">
            {{ $quotations->links('vendor.pagination.bootstrap-unscroll') }}
        </div>
        <script>
            window.addEventListener('deletedQuotation', (e) => {
                toastr.success("Deleted Quotation");
                // document.getElementById('closeTicketModal-' + e.detail.qID).click()
            });
        </script>
        <br>
        <br>
    </div>
    <script>
        @if(session()->has('Q1'))
            toastr.success("{{ session()->get('Q1') }}");

        @endif
        window.addEventListener('createdSo', (e) => {
            toastr.success("Successfully created sales order");
        });
        window.addEventListener('sentMail', (e) => {
            toastr.success("Successfully sent email");
        });
        window.addEventListener('failedMail', (e) => {
            toastr.warning("Failed to send email");
        });
        window.addEventListener('failedSo', (e) => {
            toastr.warning("Failed to create sales order because some items are not in stock.");
        });
    </script>
    <script>
        function changeDescription(elId, descId)
        {
            if (document.getElementById(elId).value === '1')
                {
                    document.getElementById(descId).value = 'Beste heer/mevrouw,\r\n\r\nHartelijk dank voor uw aanvraag.\r\nHierbij doen wij u de offerte voor de aangevraagde producten toekomen\r\nU kunt mij terugbellen of e-mailen als ik u nog ergens mee van dienst kan zijn.\r\nWij hopen u hiermee een passende offerte te hebben gedaan en kijken uit naar uw bevestiging.'
                }
            if (document.getElementById(elId).value === '2')
                {
                    document.getElementById(descId).value = 'Dear Mr / Mrs,\r\n\r\nThank you for your inquiry,\r\nPlease find attached the quotation for the requested products.\r\nIf there is anything else we can help you with, please don’t hesitate to call or email me.\r\nWe hope this quotation meets your expectation and look forward to your confirmation.'
                }

        }
    </script>
</div>


