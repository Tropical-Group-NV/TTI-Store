<div>
    @php($terms = \App\Models\Term::all())
    @php($messages = \App\Models\CustomerMessage::query()->where('IsActive', 1)->get())
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Your Cart
    </h1>
    <form onkeydown="return event.key != 'Enter';" wire:submit.prevent="createSalesOrder">


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
            <div style="overflow-x: auto">
                <div class="grid md:grid-cols-3">
                    <div>
                        <label style="font-family: sflight; font-size: 20px" for="">Customer(please type in atleast 3 characters to search)
                            <br>
                            <input wire:model="customer_id" type="hidden" name="customer_id" id="customer_id">
                            <input id="search" onclick="@this.srch_sw= 1" wire:keydown="search" wire:model="search_customer"  style="width: 500px" class="ring-2 ring-blue-500 form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
                            <div id="searchWrap" style="position: absolute; width: 500px;overflow-y: auto; max-height: 400px; z-index: 10;@if($srch_sw == 0) display: none @endif" class="block appearance-none  border border-blue-500 text-gray-700 rounded leading-tight focus:outline-none bg-gray-50 focus:border-gray-500">
                                <div wire:loading="search" wire:target="search" style="border-radius: 50px">
                                    <img src="{{ asset('ttistore_loading.gif') }}" style="height: 100px; margin: 0px;">
                                </div>
                                <div wire:loading.remove>
                                    @if($search_sw == 1)
                                        @foreach($customers as $customer)
                                            @if(is_array($customer))
                                                <a onclick='addAddress("{{$customer['BillAddressBlockAddr1']}}", "{{$customer['BillAddressBlockAddr2']}}", "{{$customer['BillAddressBlockAddr3']}}", "{{$customer['BillAddressBlockAddr4']}}", "{{$customer['BillAddressBlockAddr5']}}", "{{$customer['ListID']}}", "{{ $customer['Name'] }}")' href="#">
                                                    <br>
                                                    <div class="border-b">
                                                        <span>{{ $customer['Name'] }}</span>
                                                    </div>
                                                </a>
                                            @else
                                                <a href="#" onclick='addAddress("{{$customer->BillAddressBlockAddr1}}", "{{$customer->BillAddressBlockAddr2}}", "{{$customer->BillAddressBlockAddr3}}", "{{$customer->BillAddressBlockAddr4}}", "{{$customer->BillAddressBlockAddr5}}", "{{$customer->ListID}}", "{{ $customer->Name }}")'>
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
                            <input wire:model="date" name="date" id="date" style="width: 500px" type="date" class=" border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >

                        </label>
                    </div>
                    <div>
                        <label style="font-family: sflight; font-size: 20px" for="">Term
                            <br>
                            <select wire:model="term_id" name="term" id="term" style="width: 500px" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
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
                            <textarea readonly style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500" name="adress" id="adress" cols="30" rows="6"></textarea>
                        </label>
                    </div>
                    <div>
                        <label style="font-family: sflight; font-size: 20px" for="">Ship to
                            <br>
                            <textarea style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="shipto" id="shipto" cols="30" rows="6"></textarea>
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
                        <th class="hidemobile">
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
                    @if($cartItemExist)
                        @foreach($cartItems as $cartItem)
                            @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $cartItem->prod_id)->get()->first())
                            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                            @php($subTotal = $subTotal + ($cartItem->qty * $item->SalesPrice))
                            <tr class="border-b">
                                <td class="p-6 hidemobile"  style="font-family: sfsemibold">
                                    <span>
                                        {{ $item->BarCodeValue }}
                                    </span>

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
                                    <div class="flex">
                                        <input wire:loading.attr="disabled" wire:keydown.debounce.1100ms="changeQuantity( '{{ $cartItem->id }}', document.getElementById('{{ $cartItem->id }}').value)" class="form-control border-indigo-400 w-1/4" value="{{ $cartItem->qty }}" id="{{ $cartItem->id }}" name="qty">
                                        <button type="button" onclick="Livewire.emit('updateCart')" wire:loading.attr="disabled" wire:click="removeFromCart('{{$cartItem->id}}')" class="btn btn-danger bg-danger ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>
                                        </button>
                                    </div>

                                </td>
                                <td>
                                    <span class="hidemobile">SRD</span> {{ substr($item->SalesPrice, 0, -3) }}
                                </td>
                                <td class="p-6">
                                    <span class="hidemobile">SRD</span> {{ $cartItem->qty * $item->SalesPrice  }}
                                </td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                    @endif
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
                        <td class="hidemobile">
                        </td>
                        <td class="p-6">
                            <span class="hidemobile">SRD</span> {{ $subTotal }}
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
                    <select wire:model="msg_id" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="msg" id="msg">
                        <option value="">Select message</option>
                        @foreach($messages as $message)
                            <option value="{{ $message->ListID }}">
                                {{ $message->Name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <h2 style="font-family: sflight; font-size: 20px">Memo</h2>
                    <input wire:model="memo" name="memo" id="memo" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                </div>
                <div class="flex">
                    <div class="p-6">
                        <button  style="right: 0; background-color: #0069AD; color: white" class=" btn">
                        <img wire:loading wire:target="createSalesOrder" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                        Submit order
                    </button>
                    </div>
                    <div style="" class="p-6">
                        <a href="{{ route('dashboard') }}">
                            <button type="button"  style="right: 0; background-color: #0069AD; color: white;" class="btn">
                                Keep shopping
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // document.getElementById('searchWrap').style.display = 'none';
        document.getElementById('date').value = {{ date('Y-m-d') }};
        function addAddress(adr1, adr2, adr3, adr4, adr5, id, name)
        {
            document.getElementById('adress').value = adr1 + '\r\n' +adr2 + '\r\n' +adr3 + '\r\n' + adr4 + '\r\n' +adr5;
            document.getElementById('shipto').value = adr1 + '\r\n' +adr2 + '\r\n' +adr3 + '\r\n' + adr4 + '\r\n' +adr5;
            document.getElementById('shipto').value = adr1 + '\r\n' +adr2 + '\r\n' +adr3 + '\r\n' + adr4 + '\r\n' +adr5;
            document.getElementById('customer_id').value = id;
            document.getElementById('search').value = name;
            @this.search_customer = name;
            @this.customer_id = id;
            @this.srch_sw = 0;
            document.getElementById('searchWrap').style.display = 'none';
        }
    </script>
    </form>


</div>
