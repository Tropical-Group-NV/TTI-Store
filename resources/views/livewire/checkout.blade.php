<div>
    @php($terms = \App\Models\Term::all())
    @php($messages = \App\Models\CustomerMessage::query()->where('IsActive', 1)->get())
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Your Cart
    </h1>
    <form onkeydown="return event.key != 'Enter';" wire:submit.prevent="createSalesOrder">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div style="overflow-x: auto" class="items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                <div class="px-4" style="overflow-x: auto">
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                        @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)
                        <div  >
                            <label style="font-family: sflight; font-size: 20px" for="">Search Customers
                                <br>
                                <input wire:model="customer_id" type="hidden" name="customer_id" id="customer_id">
                                <input id="search" onclick="@this.srch_sw= 1" wire:keydown="search" wire:model="search_customer"  style="width: 300px" class="ring-2 ring-blue-500 form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
                                <div id="searchWrap" style="position: absolute; width: 500px;overflow-y: auto; max-height: 400px; z-index: 10;@if($srch_sw == 0) display: none @endif" class="block appearance-none  border border-blue-500 text-gray-700 rounded leading-tight focus:outline-none bg-gray-50 focus:border-gray-500">
                                    <div wire:loading="search" wire:target="search" style="border-radius: 50px">
                                        <img src="{{ asset('ttistore_loading.gif') }}" style="height: 100px; margin: 0px;">
                                    </div>
                                    <div wire:loading.remove>
                                        @if($search_sw == 1)
                                            @foreach($customers as $customer)
{{--                                                @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 3)--}}
                                                @if(is_array($customer))
                                                    <a wire:click="addCustomer('{{ $customer['ListID'] }}')" onclick='addAddress("{{$customer['BillAddressBlockAddr1']}}", "{{$customer['BillAddressBlockAddr2']}}", "{{$customer['BillAddressBlockAddr3']}}", "{{$customer['BillAddressBlockAddr4']}}", "{{$customer['BillAddressBlockAddr5']}}", "{{$customer['ListID']}}", "{{ $customer['Name'] }}", "{{ $customer['TermsRefListID'] }}")' href="#">
                                                        <br>
                                                        <div class="border-b">
                                                            <span>{{ $customer['Name'] }}, {{$customer['BillAddressBlockAddr1']}} {{$customer['BillAddressBlockAddr2']}} {{$customer['BillAddressBlockAddr3']}} {{$customer['BillAddressBlockAddr4']}} {{$customer['BillAddressBlockAddr5']}}</span>
                                                        </div>
                                                    </a>
                                                @else
                                                    <a wire:click="addCustomer('{{ $customer->ListID }}')" href="#" onclick='addAddress("{{$customer->BillAddressBlockAddr1}}", "{{$customer->BillAddressBlockAddr2}}", "{{$customer->BillAddressBlockAddr3}}", "{{$customer->BillAddressBlockAddr4}}", "{{$customer->BillAddressBlockAddr5}}", "{{$customer->ListID}}", "{{ $customer->Name }}", "{{$customer->TermsRefListID}}")'>
                                                        <br>
                                                        <div class="border-b">
                                                            <span>{{ $customer->Name }}, {{$customer->BillAddressBlockAddr1}} {{$customer->BillAddressBlockAddr2}} {{$customer->BillAddressBlockAddr3}} {{$customer->BillAddressBlockAddr4}}, {{$customer->BillAddressBlockAddr5}}</span>
                                                        </div>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endif

                        <div style="width: 600px">
                            <label style="font-family: sflight; font-size: 20px" for="">Date
                                <br>
                                <input wire:model="date" name="date" id="date" style="width: 300px" type="date" class=" border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >

                            </label>
                        </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)

                            <div>
                            <label style="font-family: sflight; font-size: 20px" for="">Term
                                <br>
                                <select required wire:model="term_id" name="term" id="term" style="width: 300px" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                    <option value="">Select term</option>
                                    @foreach($terms as $term)
                                        <option value="{{ $term->ListID }}">{{ $term->Name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                            @endif

                    </div>
                    <br>

                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                        @if(Auth::user()->users_type_id != 3)
                        <input type="text" required name="custname" id="custname" style="width: 300px; display: none" class=" border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        @endif
                        <div>
                            <label  style="font-family: sflight; font-size: 20px" for="">Adress
                                <br>
                                <textarea readonly style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500" name="adress" id="adress" cols="30" rows="6"></textarea>
                            </label>
                        </div>
                        <div class="@if(Auth::user()->users_type_id == 3) hidden @endif">
                            <label style="font-family: sflight; font-size: 20px" for="">Ship to
                                <br>
                                <textarea style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block border border-gray-200 text-gray-700 rounded focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="checkShipping()" name="shipto" id="shipto" cols="30" rows="6"></textarea>
                            </label>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="bg-white shadow-xl sm:rounded-l">
            <div class="px-8">
                <div style=" width: 100%" class="w-60">
                    @if($boEnabled == 1)
{{--                    <span class="text-red-600">The quantity of items that are currently not in stock will automatically be added to backorders</span>--}}
                    @endif
                    <br>
                    <br>
                    <div style="overflow-x: auto" class="overflow-auto">
                        <table style="overflow-x: auto; width: 100%" class="sm:rounded-lg whitespace-nowrap">
                            <thead>
                            <tr class="">
                                <th class="">
                                    Item
                                </th>
                                <th class="hidden 2xl:block">
                                    Description
                                </th>
                                <th class="">
                                    Ordered
                                </th>
                                <th class="">
                                    Backordered
                                </th>
                                <th class="px-4">
                                    Rate(excl. BTW)
                                </th>
                                <th class="px-4">
                                    Amount(excl. BTW)
                                </th>
                            </tr>
                            </thead>
                            <tbody class="border" style="overflow-y: auto; height: 300px">
                            @php($totalBtw = 0)
                            @php($subTotal = 0)
                            @if($cartItemExist)
                                @foreach($cartItems as $cartItem)
                                    @php($item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->get()->first())
                                    @php($itemdesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $cartItem->prod_id)->get()->first())
                                    @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                                    @if($customer_id == '410000-1128694047' or $retail == 1)
                                        @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                                            @if($item->SalesTaxCodeRefFullName != 'Non')
                                                @php($subTotal = $subTotal + ((($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice)))
                                                @php($totalBtw = $totalBtw + (0.1 * (($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice)))
                                            @else
                                                @php($subTotal = $subTotal + (($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice))
                                            @endif
                                        @else
                                            @if($item->SalesTaxCodeRefFullName != 'Non')
                                                @php($subTotal = $subTotal + (($cartItem->qty * $item->CustomBaliPrice)))
                                                @php($totalBtw = $totalBtw + (0.1 * ($cartItem->qty * $item->CustomBaliPrice)))
                                            @else
                                                @php($subTotal = $subTotal + ($cartItem->qty * $item->CustomBaliPrice))
                                            @endif
                                        @endif
                                    @else
                                    @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                                        @if($item->SalesTaxCodeRefFullName != 'Non')
                                            @php($subTotal = $subTotal + ( (($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice)))
                                            @php($totalBtw = $totalBtw + (0.1 * (($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice)))
                                        @else
                                            @php($subTotal = $subTotal + (($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice))
                                        @endif
                                    @else
                                        @if($item->SalesTaxCodeRefFullName != 'Non')
                                            @php($subTotal = $subTotal + (($cartItem->qty * $item->SalesPrice)))
                                            @php($totalBtw = $totalBtw + (0.1 * ($cartItem->qty * $item->SalesPrice)))
                                        @else
                                            @php($subTotal = $subTotal + ($cartItem->qty * $item->SalesPrice))
                                        @endif
                                    @endif
                                    @endif
                                    @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                                        <tr>

                                        </tr>
                                    @endif
                                    <tr class="border-b">
                                        <td class="p-6 hidden 2xl:block"  style="font-family: sfsemibold">
                                    <span>
                                        @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                                        <div class="whitespace-normal" style="white-space: normal">
                                                <span class="text-red-600">The quantity of items that are currently not in stock will automatically be added to backorders</span>
                                            </div>
                                        @endif
                                        {{ $item->FullName }}
                                    </span>
                                        </td>
                                        <td>
                                            <div class="flex">
                                                @if($image != null)
                                                    {{--                                                <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 150px; width: auto" alt="Card image cap">--}}
                                                    <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                                        <!-- Trigger for Modal -->
                                                        <button type="button"  @click="showModal =  ! showModal">
                                                            <img class="" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 200px" alt="Card image cap">
                                                            {{--                                                        <i class="fa fa-whatsapp active:text-white my-float"></i>--}}
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
                                                                    <div class="flex justify-center">
                                                                        <img class="w-3/4" style="width: 300px" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" alt="">
                                                                    </div>
                                                                    <br>
                                                                    <div class="">
                                                                        <p class="text-base leading-4 text-gray-800">{!! $item->FullName !!}  </p>
                                                                        <br>
                                                                        <h1>
                                                                            {{ $item->Description }}
                                                                        </h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <img class="card-img-top" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 150px" alt="Card image cap">
                                                @endif
                                                <span class="hidden 2xl:block" style="margin-top: auto;margin-bottom: auto; margin-left: 0; font-family: sfsemibold">{{ $item->Description }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex">
                                                <input type="number" value="1" wire:loading.attr="disabled" wire:keyup.debounce.500ms="changeQuantity( '{{ $cartItem->id }}', document.getElementById('ordered-{{ $cartItem->id }}').value)" style="width:70px" class="form-control border-indigo-400 w-full rounded-l" id="ordered-{{ $cartItem->id }}" name="qty"/>
                                                <button type="button" onclick="Livewire.emit('updateCart')" wire:loading.attr="disabled" wire:click="removeFromCart('{{$cartItem->id}}')" class="btn btn-danger bg-danger ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex">
                                                <input style="width: 70px" class="form-control border-indigo-400 w-1/4" readonly disabled id="backordered-{{ $cartItem->id }}" name="">
                                            </div>
                                        </td>
                                        <td class="px-4">
                                            @if($customer_id == '410000-1128694047' or $retail == 1)
                                                @if(session()->has('currency'))
                                                    <span class="hidemobile">{{session()->get('currency')}}</span> {{number_format($item->CustomBaliPrice / session()->get('exchangeRate'), 2) }}
                                                @else
                                                    <span class="hidemobile">SRD</span> {{number_format($item->CustomBaliPrice, 2) }}
                                                @endif
                                            @else
                                                @if(session()->has('currency'))
                                                    <span class="hidemobile">{{session()->get('currency')}}</span> {{number_format($item->SalesPrice / session()->get('exchangeRate'), 2) }}
                                                @else
                                                    <span class="hidemobile">SRD</span> {{number_format($item->SalesPrice, 2) }}
                                                @endif
                                            @endif
                                        </td>

                                        <td class="px-4">
                                            @if($customer_id == '410000-1128694047' or $retail == 1)
                                                @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                                                    <div wire:init="enableBo">
                                                    </div>
                                                    <script>
                                                        alert('more')
                                                    </script>
                                                    @php($boEnabled = 1)
                                                    @if(session()->has('currency'))
                                                        <span class="hidemobile">{{ session()->get('currency') }}</span> {{ number_format((($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice) / session()->get('exchangeRate') , 2)  }}
                                                    @else
                                                        <span class="hidemobile">SRD</span> {{ number_format(($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice , 2)  }}
                                                    @endif
                                                @else
                                                    @if(session()->has('currency'))
                                                        <span class="hidemobile">{{ session()->get('currency') }}</span> {{ number_format(($cartItem->qty * $item->CustomBaliPrice) / session()->get('exchangeRate') , 2)  }}
                                                    @else
                                                        <span class="hidemobile">SRD</span> {{ number_format($cartItem->qty * $item->CustomBaliPrice , 2)  }}
                                                    @endif
                                                @endif
                                            @else
                                            @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                                                <div wire:init="enableBo">
                                                </div>
                                                    @if(session()->has('currency'))
                                                        <span class="hidemobile">{{ session()->get('currency') }}</span> {{ number_format((($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice) / session()->get('exchangeRate') , 2)  }}
                                                    @else
                                                        <span class="hidemobile">SRD</span> {{ number_format(($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice , 2)  }}
                                                    @endif
                                            @else
                                                    @if(session()->has('currency'))
                                                        <span class="hidemobile">{{ session()->get('currency') }}</span> {{ number_format(($cartItem->qty * $item->SalesPrice) / session()->get('exchangeRate') , 2)  }}
                                                    @else
                                                        <span class="hidemobile">SRD</span> {{ number_format($cartItem->qty * $item->SalesPrice, 2)  }}
                                                    @endif
                                            @endif
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                                @if($saleCustomer != '')
                                    @if($saleCustomer->PriceLevelRefListID == '60000-1139229677')
                                        <tr class="border-b">
                                            <td class="p-6 hidden 2xl:block"  style="font-family: sfsemibold">
                                                Korting(Discount)
                                            </td>
                                            <td>
                                                Korting(Discount)
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                -10%
                                            </td>
                                            <td class="p-6">
                                                -@if(session()->has('currency'))
                                                    <span class="hidemobile">{{session()->get('currency')}}</span> {{number_format(($subTotal * 0.1 )/ session()->get('exchangeRate'), 2) }}
                                                @else
                                                    <span class="hidemobile">SRD</span> {{number_format($subTotal * 0.1, 2) }}
                                                @endif
                                                @php($subTotal = $subTotal - ($subTotal * 0.1))
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="p-6">

                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td class="hidden 2xl:block">
                                </td>
                                <td class="px-4 border-l border-b">
                                    Subtotal
                                </td>
                                <td class="px-4 border-b border-r">
                                    @if(session()->has('currency'))
                                        <span class="hidemobile">{{session()->get('currency')}}</span> {{ number_format($subTotal / session()->get('exchangeRate'), 2) }}
                                    @else
                                        <span class="hidemobile">SRD</span> {{ number_format($subTotal, 2) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-6">

                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td class="hidden 2xl:block">
                                </td>
                                <td class="px-4 border-l border-b">
                                    Total BTW(10.0%)
                                </td>
                                <td class="px-4 border-b border-r">
                                    @if(session()->has('currency'))
                                        <span class="hidemobile">{{session()->get('currency')}}</span> {{ number_format($totalBtw / session()->get('exchangeRate'), 2) }}
                                    @else
                                        <span class="hidemobile">SRD</span> {{ number_format($totalBtw, 2) }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="p-6">

                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td class="hidden 2xl:block">
                                </td>
                                <td class="px-4 border-l border-b">
                                    Total incl. BTW
                                </td>
                                <td class="px-4 border-r border-b">
                                    @if(session()->has('currency'))
                                        <span class="hidemobile">{{session()->get('currency')}}</span> {{ number_format($subTotal + $totalBtw / session()->get('exchangeRate'), 2) }}
                                    @else
                                        <span class="hidemobile">SRD</span> {{ number_format($subTotal + $totalBtw, 2) }}
                                    @endif
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div style="" class="items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                <div style="overflow-x: auto">
                    @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)
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
                    @endif
                    <br>
                    <div>
                        <h2 style="font-family: sflight; font-size: 20px">Memo</h2>
                        <input wire:model="memo" name="memo" id="memo" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                    </div>
                        <br>
                        <div class="flex justify-between whitespace-nowrap">
                            <div class="">
                                <div class="p-6">
                                    <a href="{{ route('dashboard') }}">
                                        <button onclick="checkCustomers()" type="button"  style="background-color: gray; color: white; font-family: sfsemibold" class="btn ">
                                            Keep shopping
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="">

                                <div style="" class="p-6">
                                    <button style="right: 0; background-color: #0069AD; color: white; font-family: sfsemibold" class=" btn btn-info">
                                        <img wire:loading wire:target="createSalesOrder" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                        Submit order
                                    </button>
{{--                                    @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)--}}
{{--                                        <a href="{{ route('quotations.create') }}?fromcart=1&customer={{$customer_id}}" style="right: 0; color: white; font-family: sfsemibold" class=" btn btn-success">--}}
{{--                                            Create quotation--}}
{{--                                        </a>--}}
{{--                                        <button style="right: 0; background-color: #0069AD; color: white; font-family: sfsemibold" class=" btn btn-info">--}}
{{--                                            <img wire:loading wire:target="createSalesOrder" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">--}}
{{--                                            Submit order--}}
{{--                                        </button>--}}
{{--                                        @else--}}
{{--                                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">--}}
{{--                                            <!-- Trigger for Modal -->--}}
{{--                                            <button style="right: 0; background-color: #0069AD; color: white; font-family: sfsemibold" class="btn btn-info" type="button"  @click="showModal =  ! showModal">--}}
{{--                                                Submit order--}}
{{--                                            </button>--}}

{{--                                            <!-- Whatsapp Modal -->--}}
{{--                                            <div x-show="showModal"--}}
{{--                                                 class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"--}}
{{--                                                 x-transition.opacity x-transition:leave.duration.500ms >--}}
{{--                                                <!-- Modal inner -->--}}
{{--                                                <div x-show="showModal" x-transition:enter.duration.500ms--}}
{{--                                                     x-transition:leave.duration.400ms--}}
{{--                                                     class="max-w-3xl px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg"--}}
{{--                                                     @click.away="showModal = false"--}}
{{--                                                >--}}
{{--                                                    <!-- Title / Close-->--}}
{{--                                                    <div class="flex items-center justify-between">--}}
{{--                                                        <button type="button" class="z-50 cursor-pointer" @click="showModal = false">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">--}}
{{--                                                                <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                        <br>--}}

{{--                                                    </div>--}}
{{--                                                    <!-- content -->--}}
{{--                                                    <div>--}}
{{--                                                        <div class="flex justify-center">--}}
{{--                                                            <h1 style="font-family: sfsemibold">--}}
{{--                                                                <b style="text-align: center">Select payment option.</b>--}}
{{--                                                            </h1>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex justify-between">--}}
{{--                                                            <div class="p-5">--}}
{{--                                                                <div @if($paymentMethod != 1)wire:click="selectPayment('1')" @endif class="card bg-gray-100 @if($paymentMethod == 1)border-blue-400 @else cursor-pointer @endif">--}}
{{--                                                                    <img wire:loading.remove wire:target="selectPayment('1')" style="width: 100px" src="{{ asset('Uni5Pay+/Logo.png') }}" alt="">--}}
{{--                                                                    <img wire:loading wire:target="selectPayment('1')" style="width: 100px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif" alt="">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="card-title">--}}
{{--                                                                    Uni5Pay+--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="p-5">--}}
{{--                                                                <div @if($paymentMethod != 2)wire:click="selectPayment('2')" @endif class="card bg-gray-100 @if($paymentMethod == 2)border-blue-400 @else cursor-pointer @endif">--}}
{{--                                                                    <img wire:loading.remove wire:target="selectPayment('2')" style="width: 100px" src="{{ asset('Icons/cash1.png') }}" alt="">--}}
{{--                                                                    <img wire:loading wire:target="selectPayment('2')" style="width: 100px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif" alt="">--}}
{{--                                                                </div>--}}
{{--                                                                <div class="card-title">--}}
{{--                                                                    Cash--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <br>--}}
{{--                                                        @if($paymentMethod != null)--}}
{{--                                                            <div class="flex justify-end">--}}
{{--                                                                <button class="btn " type="button" wire:click="pay" style="color: white; background-color: #0069ad">Create Order</button>--}}
{{--                                                            </div>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}

                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <script>
            @this.ship1 = document.getElementById('shipto').value
            function checkShipping()
            {
               @this.ship1 = document.getElementById('shipto').value
            }
        </script>
        <script>
            function checkCustomers()
            {
                if (document.getElementById('customer_id').value === '')
                {
                    alert('Please Select Customer')
                }
            }

        </script>

        <script>
            // document.getElementById('searchWrap').style.display = 'none';
            document.getElementById('date').value = {{ date('Y-m-d') }};
            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 3)
                @if($saleCustomer != '')
            @php($customerUser = \App\Models\UserCustomer::query()->where('user_id', Auth::user()->id)->first())
            @this.saleCustomer = '{{ \App\Models\QbCustomer::query()->where('ListID', $customerUser->customer_ListID)->first() }}';
            document.getElementById('adress').value = '{{ $saleCustomer->BillAddressBlockAddr1 }},' + '\r\n' +'{{ $saleCustomer->BillAddressBlockAddr2 }},' + '\r\n' +'{{ $saleCustomer->BillAddressBlockAddr3 }},' + '\r\n' + '{{ $saleCustomer->BillAddressBlockAddr4 }},' + '\r\n' +'{{ $saleCustomer->BillAddressBlockAddr5 }}';
            document.getElementById('shipto').value = '{{ $saleCustomer->BillAddressBlockAddr1 }},' + '\r\n' +'{{ $saleCustomer->BillAddressBlockAddr2 }},' + '\r\n' +'{{ $saleCustomer->BillAddressBlockAddr3 }},' + '\r\n' + '{{ $saleCustomer->BillAddressBlockAddr4 }},' + '\r\n' +'{{ $saleCustomer->BillAddressBlockAddr5 }}';
            document.getElementById('customer_id').value = '{{ $saleCustomer->ListID }}';
            document.getElementById('custname').value = '{{ $saleCustomer->ListID }}';

            @this.customer_id = {{ $customerUser->customer_ListID }}
                @endif
            @endif
            @if(isset($_REQUEST['customerid']))
            @php($customerBO = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('ListID', $_REQUEST['customerid'])->first())
            document.getElementById('adress').value = '{{ $customerBO->BillAddressBlockAddr1 }},' + '\r\n' +'{{ $customerBO->BillAddressBlockAddr2 }},' + '\r\n' +'{{ $customerBO->BillAddressBlockAddr3 }},' + '\r\n' + '{{ $customerBO->BillAddressBlockAddr4 }},' + '\r\n' +'{{ $customerBO->BillAddressBlockAddr5 }}';
            document.getElementById('shipto').value = '{{ $customerBO->BillAddressBlockAddr1 }},' + '\r\n' +'{{ $customerBO->BillAddressBlockAddr2 }},' + '\r\n' +'{{ $customerBO->BillAddressBlockAddr3 }},' + '\r\n' + '{{ $customerBO->BillAddressBlockAddr4 }},' + '\r\n' +'{{ $customerBO->BillAddressBlockAddr5 }}';
            document.getElementById('customer_id').value = '{{ $_REQUEST['customerid'] }}';
            document.getElementById('custname').value = '{{ $customerBO->Name }}';
            {{--@this.customer_id = '{{ $_REQUEST['customerid'] }}';--}}
            document.getElementById('custname').value = 'name';
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 3)
                @php($customerAccount = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_customer')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first() )
                @php($customer = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('ListID', $customerAccount->customer_ListID)->first())
            document.getElementById('adress').value = '{{ $customer->ShipAddressBlockAddr1 }},' + '\r\n' +'{{ $customer->ShipAddressBlockAddr2 }},' + '\r\n' +'{{ $customer->ShipAddressBlockAddr3 }},' + '\r\n' + '{{ $customer->ShipAddressBlockAddr4 }},' + '\r\n' +'{{ $customer->ShipAddressBlockAddr5 }}';
            document.getElementById('shipto').value = '{{ $customer->ShipAddressBlockAddr1 }},' + '\r\n' +'{{ $customer->ShipAddressBlockAddr2 }},' + '\r\n' +'{{ $customer->ShipAddressBlockAddr3 }},' + '\r\n' + '{{ $customer->ShipAddressBlockAddr4 }},' + '\r\n' +'{{ $customer->ShipAddressBlockAddr5 }}';
            {{--document.getElementById('customer_id').value = '{{ $customerAccount->customer_ListID }}';--}}
            {{--@this.customer_id = '{{ $_REQUEST['customerid'] }}';--}}
            document.getElementById('custname').value = 'name';
            @endif

            function addAddress(adr1, adr2, adr3, adr4, adr5, id, name, term)
            {
                document.getElementById('adress').value = adr1 + ',\r\n' +adr2 + ',\r\n' +adr3 + ',\r\n' + adr4 + ',\r\n' +adr5;
                document.getElementById('shipto').value = adr1 + ',\r\n' +adr2 + ',\r\n' +adr3 + ',\r\n' + adr4 + ',\r\n' +adr5;
                document.getElementById('shipto').value = adr1 + ',\r\n' +adr2 + ',\r\n' +adr3 + ',\r\n' + adr4 + ',\r\n' +adr5;
                document.getElementById('customer_id').value = id;
                document.getElementById('custname').value = name;
                document.getElementById('search').value = name;
                document.getElementById('term').value = term;
            @this.search_customer = name;
            @this.customer_id = id;
            @this.srch_sw = 0;
            @this.term_id = term;
                document.getElementById('searchWrap').style.display = 'none';
            }
        </script>
        <script>
            @foreach($cartItems as $cartItem)
            @php($item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->get()->first())
            @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
            document.getElementById('ordered-{{ $cartItem->id }}').value = '{{ number_format($item->QuantityOnHand - $item->QuantityOnSalesOrder)  }}'
            document.getElementById('backordered-{{ $cartItem->id }}').value = '{{ $cartItem->qty - ($item->QuantityOnHand - $item->QuantityOnSalesOrder)  }}'
            @else
            document.getElementById('ordered-{{ $cartItem->id }}').value = '{{ number_format($cartItem->qty)  }}'
            document.getElementById('backordered-{{ $cartItem->id }}').value = '0'
            @endif
            @endforeach
        </script>
        <script>
            window.addEventListener('updateCartQty', (e) => {
                if (event.detail.addBO === 1)
                {
                    document.getElementById('ordered-' + event.detail.prodID).value = event.detail.inStock;
                    document.getElementById('backordered-' + event.detail.prodID).value = event.detail.BO;
                }
                else
                {
                    document.getElementById('ordered-' + event.detail.prodID).value = event.detail.Qty;
                    document.getElementById('backordered-' + event.detail.prodID).value = '0';
                }
            });
        </script>
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
