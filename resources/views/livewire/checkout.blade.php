<div>
    @php($terms = \App\Models\Term::all())
    @php($messages = \App\Models\CustomerMessage::query()->where('IsActive', 1)->get())
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
            <div style="overflow-x: auto">
                <div class="grid md:grid-cols-3">
                    <div>
                        <label style="font-family: sflight; font-size: 20px" for="">Customer(please type in atleast 3 characters to search)
                            <br>
                            <input wire:keydown="search" wire:model="search_customer"  style="width: 500px" class="ring-2 ring-blue-500 form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
                            <div id="searchWrap" style="position: absolute; width: 500px;overflow-y: auto; max-height: 400px; z-index: 10" class="block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none bg-gray-50 focus:border-gray-500">
                                <div wire:loading style="border-radius: 50px">
                                    <img src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 100px; margin: 0px;">
                                </div>
                                <div wire:loading.remove>
                                    @if($search_sw == 1)
                                        @foreach($customers as $customer)
                                            @if(is_array($customer))
                                                <a onclick="addAddress('{{$customer['ShipAddressAddr1']}}', '{{$customer['ShipAddressAddr2']}}', '{{$customer['ShipAddressAddr3']}}', '{{$customer['ShipAddressAddr4']}}', '{{$customer['ShipAddressAddr5']}}')" href="#">
                                                    <br>
                                                    <div class="border-b">
                                                        <span>{{ $customer['Name'] }}</span>
                                                    </div>
                                                </a>
                                            @else
                                                <a href="#" onclick="addAddress('{{$customer->ShipAddressAddr1}}', '{{$customer->ShipAddressAddr2}}', '{{$customer->ShipAddressAddr3}}', '{{$customer->ShipAddressAddr4}}', '{{$customer->ShipAddressAddr4}}')">
                                                    <br>
                                                    <div class="border-b">
                                                        <span>{{ $customer->Name }}</span>
                                                    </div>
                                                </a>
                                            @endif

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </label>
                    </div>
                    <div style="width: 600px">
                        <label style="font-family: sflight; font-size: 20px" for="">Date
                            <br>
                            <input style="width: 500px" type="date" class=" border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                        </label>
                    </div>
                    <div>
                        <label style="font-family: sflight; font-size: 20px" for="">Term
                            <br>
                            <select style="width: 500px" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                <option value="">Select term</option>
                                @foreach($terms as $term)
                                <option value="{{ $term->ListID }}">{{ $term->Name }}</option>
                                    @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-3 md:grid-cols-3">
                    <div>
                        <label  style="font-family: sflight; font-size: 20px" for="">Adress
                            <br>
                            <textarea readonly style="width: 500px" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="adress" id="adress" cols="30" rows="10"></textarea>
                        </label>
                    </div>
                    <div>
                        <label style="font-family: sflight; font-size: 20px" for="">Ship to
                            <br>
                            <textarea style="width: 500px" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="" id="" cols="30" rows="10"></textarea>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
            <div style="overflow-x: auto">
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
                        {{--                    <th class="">--}}
                        {{--                        Delete--}}
                        {{--                    </th>--}}
                    </tr>
                    </thead>
                    <tbody class="border" style="overflow-y: auto; height: 300px">
                    @php($subTotal = 0)
                    @if($cartItemExist)
                        @foreach($cartItems as $cartItem)
                            @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $cartItem->prod_id)->get()->first())
                            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                            @php($subTotal = $subTotal + ($cartItem->qty * $item->SalesPrice))
                            <tr class="border-b">
                                <td>
                                    {{ $item->BarCodeValue }}
                                </td>
                                <td class="flex">
                                    @if($image != null)
                                        <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px; width: auto" alt="Card image cap">
                                    @else
                                        <img class="card-img-top" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 150px" alt="Card image cap">
                                    @endif
                                    {{ $item->Description }}
                                </td>
                                <td>
                                    {{ $cartItem->qty }}
                                </td>
                                <td>
                                    SRD {{ substr($item->SalesPrice, 0, -3) }}
                                </td>
                                <td>
                                    SRD {{ $cartItem->qty * $item->SalesPrice  }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>
                            Total
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            SRD {{ $subTotal }}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
            <div style="overflow-x: auto">
                <div>
                    <h2 style="font-family: sflight; font-size: 20px">Customer message</h2>
                    <select class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="" id="">
                        <option value="">Select message</option>
                        @foreach($messages as $message)
                            <option value="">
                                {{ $message->Name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <h2 style="font-family: sflight; font-size: 20px">Memo</h2>
                    <input class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                </div>
            </div>
        </div>
    </div>
    <script>
        function addAddress(adr1, adr2, adr3, adr4, adr5)
        {
            document.getElementById('adress').value = adr1 + '\r\n' +adr2 + '\r\n' +adr3 + '\r\n' + adr4 + '\r\n' +adr5;
            document.getElementById('searchWrap').style.display = 'none';

        }
    </script>


</div>
