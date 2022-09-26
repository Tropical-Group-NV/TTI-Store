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
                <div style="overflow-x: auto">
                    <div style="overflow-x: auto">
                        <table style="margin: auto" class="table-auto" id="dataTable">
                            <thead class="bg-gray-100">
                            <tr>
                                <th style="width: 350px" class="border border-slate-600">
                                    Date
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
                                        <a href="{{ route('order', $order->id) }}">
                                            <button style="background-color: #0069AD; color: white" class="btn ">
                                                View
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-20">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
</div>

