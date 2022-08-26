<div>
    <div>
        <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
            Your Order <span style="color: #0069AD">{{ $order->RefNumber }}</span>
        </h1>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div style="overflow-x: auto" class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                <div style="overflow-x: auto">
                    <div class="grid md:grid-cols-3">
                        <div>
                            <label style="font-family: sflight; font-size: 20px" for="">
                                <br>
                                <input disabled value="{{ $order->BillAddressAddr1 }}" style="width: 500px" class="ring-2 ring-blue-500 form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
                            </label>
                        </div>
                        <div style="width: 600px">
                            <label style="font-family: sflight; font-size: 20px" for="">Date
                                <br>
                                <input disabled value="{{ $order->TxnDate }}" name="date" id="date" style="width: 500px" type="text" class=" border form-control border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >

                            </label>
                        </div>
                        <div>
                            <label style="font-family: sflight; font-size: 20px" for="">Term
                                <br>
                                <input disabled value="{{ $order->TermsRefFullName }}" type="text" style="width: 500px" class="ring-2 ring-blue-500 form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="grid grid-cols-3 md:grid-cols-3">
                        <div>
                            <label  style="font-family: sflight; font-size: 20px" for="">Adress
                                <br>
                                <textarea disabled readonly style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500" name="adress" id="adress" cols="30" rows="6"></textarea>
                            </label>
                        </div>
                        <div>
                            <label style="font-family: sflight; font-size: 20px" for="">Ship to
                                <br>
                                <textarea disabled readonly style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="shipto" id="shipto" cols="30" rows="6"></textarea>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="bg-white shadow-xl sm:rounded-lg">
            <div style="overflow-x: auto" class="  py-12 2xl:px-20 md:px-6 px-4">
                <div style="overflow-x: auto">

                    <br>
                    <table  style="overflow-x: auto" class=" sm:rounded-lg w-full">
                        <thead>
                        <tr class="">
                            <th class="">
                                Item
                            </th>
                            <th class="">
                                Description
                            </th>
                            <th class="">
                                Ordered
                            </th>
                            <th class="">
                                Rate
                            </th>
                            <th class="">
                                Amount
                            </th>

                        </tr>
                        </thead>
                        <tbody class="border" style="overflow-y: auto; height: 300px">
                        @php($subTotal = 0)
                            @foreach($order_items as $order_item)
                                @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $order_item->SalesOrderLineItemRefListID)->get()->first())
                                @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                                @php($subTotal = $subTotal + ($order_item->SalesOrderLineAmount))
                                <tr class="border-b">
                                    <td class="p-6" style="font-family: sfsemibold">
                                        {{ $item->BarCodeValue }}
                                    </td>
                                    <td>
                                        <div class="flex">
                                            @if($image != null)
                                                <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 150px; width: auto" alt="Card image cap">
                                            @else
                                                <img class="card-img-top" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 150px" alt="Card image cap">
                                            @endif
                                            <span class="hidemobile" style="margin-top: auto;margin-bottom: auto; margin-left: 0; font-family: sfsemibold">{{ $item->Description }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ round($order_item->SalesOrderLineQuantity, 2)  }}X
                                    </td>
                                    <td>
                                        SRD {{ substr($item->SalesPrice, 0, -3) }}
                                    </td>
                                    <td>
                                        SRD {{ $order_item->SalesOrderLineAmount  }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="p-6">
                                Total
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td class="">
                                SRD {{ $subTotal }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="p-6" style="margin-left: auto; margin-right: 0">
                        <button style="margin-left: auto; margin-right: 0; float: right; font-family: sfsemibold" class="btn btn-primary">
                            Reorder
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('adress').value = "{{ $order->BillAddressAddr1 }}" + '\r\n' + "{{ $order->BillAddressAddr2 }}" + '\r\n' + "{{ $order->BillAddressAddr3 }}" + '\r\n' + "{{ $order->BillAddressAddr4 }}" + '\r\n' + "{{ $order->BillAddressAddr5 }}";
            document.getElementById('shipto').value = "{{ $order->BillAddressAddr1 }}" + '\r\n' + "{{ $order->BillAddressAddr2 }}" + '\r\n' + "{{ $order->BillAddressAddr3 }}" + '\r\n' + "{{ $order->BillAddressAddr4 }}" + '\r\n' + "{{ $order->BillAddressAddr5 }}";
        </script>
    </div>
</div>
