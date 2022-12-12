<div>
    @php($terms = \App\Models\Term::query()->where('IsActive', 1)->orderBy('Name', 'Desc')->get())
    @php($messages = \App\Models\CustomerMessage::query()->where('IsActive', 1)->get())
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Create quotation
    </h1>
    <form onkeydown="return event.key != 'Enter';" wire:submit.prevent="createSalesOrder">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div style="overflow-x: auto" class="items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                <div style="overflow-x: auto">
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 pl-4">
                        @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)
                            <div  >
                                <label style="font-family: sflight; font-size: 20px" for="">Search Customers
                                    <div  @click.away="showModal = false" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                        <!-- Trigger for Modal -->
                                        <input @click="showModal = true" onkeyup="searchItem5()" style="height:50px; width: 300px" wire:model="customerSearch" wire:keyup="getCustomers" placeholder="Search customers..." class="w-full rounded-md border-gray-200" autocomplete="false" type="search">
                                        <br>
                                        @error('selectedCustomerID') <span class="text-red-500">Field is required</span> @enderror
                                        <div  style="" x-show="showModal"
                                              class=""
                                              x-transition >
                                            <!-- Modal inner -->
                                            <div x-show="showModal"
                                                 class="px-6 py-4 text-left bg-white border rounded-lg shadow-lg absolute"
                                                 style="">
                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-between">
                                                    <div class="px-8">
                                                        <h1 style="font-family: sfsemibold">
                                                            Search customers
                                                        </h1>
                                                    </div>
                                                    <button id="closeTicketModal-" type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                            <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- content -->
                                                <div class="py-8 px-8">
                                                    <div>
                                                        @foreach($customers as $customer)
                                                            @if(! is_array($customer))
                                                                <ul @click="showModal = false" class="flex hover:bg-gray-100 cursor-pointer" wire:click="selectCustomer('{{ $customer->ListID }}')">
                                                                    <li>
                                                                        {{ $customer->BillAddressAddr1 }}, {{ $customer->BillAddressAddr2 }}, {{ $customer->BillAddressAddr3 }}, {{ $customer->BillAddressAddr4 }}, {{ $customer->BillAddressAddr5 }},
                                                                    </li>
                                                                    <li>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <input wire:model="customer_id" type="hidden" name="customer_id" id="customer_id">
                                </label>
                            </div>
                        @endif

                        <div style="width: 600px">
                            <label style="font-family: sflight; font-size: 20px" for="">Date
                                <br>
                                <input wire:model="date" name="date" id="date" style="width: 300px" type="date" class=" border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                @error('date') <span class="text-red-500">Field is required</span> @enderror
                            </label>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)

                            <div>
                                <label style="font-family: sflight; font-size: 20px" for="">Term
                                    <br>
                                    <select wire:model="term_id" name="term" id="term" style="width: 300px" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                        <option value="">Select term</option>
                                        @foreach($terms as $term)
                                            <option value="{{ $term->ListID }}">{{ $term->Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('term_id') <span class="text-red-500">Field is required</span> @enderror
                                </label>
                            </div>
                        @endif

                    </div>
                    <br>

                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 pl-4">
                        @if(Auth::user()->users_type_id != 3)
                            <input type="text" required name="custname" id="custname" style="width: 300px; display: none" class=" border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        @endif
                            <div style="width: 600px">
                                <label style="font-family: sflight; font-size: 20px" for="">P.O. No.
                                    <br>
                                    <input name="po" id="po" wire:model="poNum" style="width: 300px" type="text" class=" border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                </label>
                            </div>
                        <div>
                            <label  style="font-family: sflight; font-size: 20px" for="">Adress
                                <br>
                                <textarea readonly style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500" name="adress" id="adress" cols="30" rows="6">
{{ $selectedCustomer->BillAddressAddr1 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr2 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr3 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr4 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr5 ?? '' . ','}}
                                </textarea>
                            </label>
                        </div>
                        <div class="@if(Auth::user()->users_type_id == 3) hidden @endif">
                            <label style="font-family: sflight; font-size: 20px" for="">Ship to
                                <br>
                                <textarea style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block border border-gray-200 text-gray-700 rounded focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="checkShipping()" name="shipto" id="shipto" cols="30" rows="6">
{{ $selectedCustomer->BillAddressAddr1 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr2 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr3 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr4 ?? '' . ','}}
{{ $selectedCustomer->BillAddressAddr5 ?? '' . ','}}
                                </textarea>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="bg-white shadow-xl sm:rounded-l">
            <div style="overflow-x: auto" class="">
                <div style="overflow-x: auto; width: 100%" class="w-60">
                    <div class="">
                        <div class="p-6">

                            <b>
                                Search for items
                            </b>
                            <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                <!-- Trigger for Modal -->
                                <input @click="showModal =  ! showModal" onkeyup="searchItem5()" style="height:50px;" wire:model="search" wire:keyup="searchItems" placeholder="Search items..." class="w-full rounded-md border-gray-200" autocomplete="false" type="search">
                                <div  style="" x-show="showModal"
                                      class=""
                                      x-transition.opacity  >
                                    <!-- Modal inner -->
                                    <div x-show="showModal"
                                         class="px-6 py-4 text-left bg-white border rounded-lg shadow-lg absolute"
                                         @click.away="showModal = false">
                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-between">
                                            <div class="px-8">
                                                <h1 style="font-family: sfsemibold">
                                                    Search items
                                                </h1>
                                            </div>
                                            <button id="closeTicketModal-" type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                    <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- content -->
                                        <div class="py-8 px-8">
                                            <div>
                                                {{--                                                <table>--}}
                                                @foreach($items as $item2)
                                                    @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item2->ListID)->first())
                                                    @php($put = 1)
                                                    @php($currentPrivateBranch = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('settings_branch_view_item_on_user')->where('branch', $item2->CustomFieldBranch)->get())
                                                    @foreach($currentPrivateBranch as $pb)
                                                        @php($put = 0)
                                                        @if(\Illuminate\Support\Facades\Auth::user() != null)
                                                            @if(\Illuminate\Support\Facades\Auth::user()->id == $pb->user_id)
                                                                @php($put = 1)
                                                                @break(1)
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @if($put == 1)
                                                        <ul @click="showModal = false" class="flex hover:bg-gray-100 cursor-pointer" wire:click="addItem('{{ $item2->ListID }}')">
                                                            @if($image != null)
                                                                <li>
                                                                    <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id . '.dat' ?? 'tti-noimage.png' }}" style="height: 50px; width: auto" alt="Card image cap">
                                                                </li>
                                                                <li>
                                                                    {{ $item2->Description }}
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <img class="card-img-top" src="https://www.ttistore.com/foto/{{ 'tti-noimage.png' }}" style="height: 50px; width: auto" alt="Card image cap">
                                                                </li>
                                                                <li>
                                                                    {{ $item2->Description ?? $item2->ItemDesc }}
                                                                </li>
                                                            @endif
                                                        </ul>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="overflow-auto p-6">
{{--                                                {{ print_r($QItems) }}--}}
                        <table style="overflow-x: auto; width: 100%" class="sm:rounded-lg">
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
                                    Rate
                                </th>
                                <th class="">
                                    Amount
                                </th>
                                <th class="">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody class="border" style="overflow-y: auto; height: 300px">
                            @php($subTotal = 0)
                            @foreach($QItems as $key => $qItem)
                                @php($item = \App\Models\Item::query()->where('ListID', $qItem['itemID'])->first(['SalesPrice', 'Description', 'FullName']))
{{--                                @php($itemdesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $qItem['itemID'])->get()->first())--}}
                                @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $qItem['itemID'])->get()->first())
                                <tr class="border-b">
                                    <td class="p-6 hidden 2xl:block"  style="font-family: sfsemibold">
                                    <span>
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
                                                        <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 150px; width: auto" alt="Card image cap">
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
                                        @if($qItem['itemID'] == '520000-1128115782')
                                            <div class="btn-group">
                                                <input type="number" value="{{ $qItem['rate'] }}" wire:loading.attr="disabled" wire:keyup.debounce.500ms="changeDiscountValue('{{$key}}', document.getElementById('discountValue-{{$key}}').value)" style="width: 100%" class="form-control border-indigo-400 rounded-l" id="discountValue-{{ $key }}" name="qty"/>
                                                <select wire:change="changeDiscountType('{{$key}}', document.getElementById('discountType-{{$key}}').value)" class="form-control border-indigo-400" style="border-top-left-radius: 0; border-bottom-left-radius: 0" name="" id="discountType-{{$key}}">
                                                    <option @if($qItem['rateType'] == 1) selected @endif value="1">Amount</option>
                                                    <option @if($qItem['rateType'] == 2) selected @endif value="2">Percentage</option>
                                                </select>
                                            </div>
                                        @endif
                                        @if($qItem['itemID'] == '520000-1128115782')

                                        @endif
                                            @if($qItem['itemID'] != '520000-1128115782' and $qItem['itemID'] != '530000-1128435487')
                                                <div class="flex">
                                                    <input type="number" value="{{ $qItem['qty'] }}" wire:loading.attr="disabled" wire:keyup.debounce.500ms="changeQuantity( '{{ $qItem['itemID'] }}', document.getElementById('ordered-{{ $qItem['itemID'] }}').value)" style="width: 100%" class="form-control border-indigo-400 rounded-l" id="ordered-{{ $qItem['itemID'] }}" name="qty"/>
                                                </div>
                                            @endif

                                    </td>
                                    {{--                                        <td>--}}
                                    {{--                                            <div class="flex">--}}
                                    {{--                                                <input class="form-control border-indigo-400 w-1/4" readonly disabled id="backordered-{{ $cartItem->id }}" name="">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </td>--}}
                                    <td class="p-6">
                                        {{--                                            @if($customer_id == '410000-1128694047' or $retail == 1)--}}
                                        {{--                                                @if(session()->has('currency'))--}}
                                        {{--                                                    <span class="hidemobile">{{session()->get('currency')}}</span> {{number_format($item->CustomBaliPrice / session()->get('exchangeRate'), 2) }}--}}
                                        {{--                                                @else--}}
                                        {{--                                                    <span class="hidemobile">SRD</span> {{number_format($item->CustomBaliPrice, 2) }}--}}
                                        {{--                                                @endif--}}
                                        {{--
                                                         @else--}}
                                        @if($qItem['itemID'] == '520000-1128115782')
                                            @if($qItem['rateType'] == 2)
                                                {{ $qItem['rate'] }}%
                                            @else
                                                @if(session()->has('currency'))
                                                    <span class="hidemobile">{{ session()->get('currency') }}</span> {{  number_format($qItem['rate'], 2)  }}
                                                @else
                                                    <span class="hidemobile">SRD</span> {{ number_format($qItem['rate'], 2)  }}
                                                @endif
                                            @endif
                                        @endif

                                        @if($qItem['itemID'] == '530000-1128435487')
                                                @if(session()->has('currency'))
                                                    <span class="hidemobile">{{ session()->get('currency') }}</span> {{  number_format($qItem['rate'], 2)  }}
                                                @else
                                                    <span class="hidemobile">SRD</span> {{ number_format($qItem['rate'], 2)  }}
                                                @endif
                                        @endif

                                        @if($qItem['itemID'] != '520000-1128115782' and $qItem['itemID'] != '530000-1128435487')
                                        @if(session()->has('currency'))
                                            <span class="hidemobile">{{session()->get('currency')}}</span> {{number_format($item->SalesPrice / session()->get('exchangeRate'), 2) }}
                                        @else
                                            <span class="hidemobile">SRD</span> {{number_format($item->SalesPrice, 2) }}
                                        @endif
                                        @endif
                                        {{--                                            @endif--}}
                                    </td>
                                    <td class="p-6">
                                        @if($qItem['itemID'] == '520000-1128115782')
                                            @php($lastItem = $key - 1)
                                            @if($qItem['rateType'] == 2)
                                            @if($lastItem > 0)
                                                @if($QItems[$lastItem]['itemID'] == '530000-1128435487')
                                                        @php($discount = ($QItems[$lastItem]['rate'] / 100)*$qItem['rate'])
                                                        @php($subTotal = $subTotal - $discount)
                                                        @if(session()->has('currency'))
                                                            -<span wire:init="changeDiscountRateValue('{{ $key }}', '{{ $discount }}')" class="hidemobile">{{ session()->get('currency') }}</span> {{  number_format($discount / session()->get('exchangeRate') , 2)  }}
                                                        @else
                                                            -<span wire:init="changeDiscountRateValue('{{ $key }}', '{{ $discount }}')" class="hidemobile">SRD</span> {{ number_format($discount, 2)  }}
                                                        @endif
                                                    @endif
                                                    @if($QItems[$lastItem]['itemID'] != '530000-1128435487')
                                                        @php($lastItemQb = \App\Models\Item::query()->where('ListID', $QItems[$lastItem]['itemID'])->first('SalesPrice'))
                                                        @php($discount = ($lastItemQb->SalesPrice / 100)*$qItem['rate'])
                                                        @php($subTotal = $subTotal - $discount)
                                                        @if(session()->has('currency'))
                                                            -<span wire:init="changeDiscountRateValue('{{ $key }}', '{{ $discount }}')" class="hidemobile">{{ session()->get('currency') }}</span> {{  number_format($discount / session()->get('exchangeRate') , 2)  }}
                                                        @else
                                                            -<span wire:init="changeDiscountRateValue('{{ $key }}', '{{ $discount }}')" class="hidemobile">SRD</span> {{ number_format($discount, 2)  }}
                                                        @endif
                                                @endif

                                            @endif
                                            @else
                                                @if($lastItem > 0)
                                                @if(session()->has('currency'))
                                                    @php($discount = $qItem['rate'])
                                                    @php($subTotal = $subTotal -  ($discount * session()->get('exchangeRate')) )
                                                    <span wire:init="changeDiscountRateValue('{{ $key }}', '{{ $discount }}')" class="hidemobile">-{{ session()->get('currency') }}</span> {{  number_format($discount, 2)  }}
                                                @else
                                                    @php($discount = $qItem['rate'])
                                                    @php($subTotal = $subTotal - $discount)
                                                    <span wire:init="changeDiscountRateValue('{{ $key }}', '{{ $discount }}')" class="hidemobile">-SRD</span> {{  number_format($discount, 2)  }}
                                                @endif
                                                @endif
                                            @endif
                                        @endif
                                        @if($qItem['itemID'] == '530000-1128435487')
                                            <div wire:init="changeSubTotalRate('{{ $subTotal }}', '{{ $key }}')">
                                            </div>
                                            @if(session()->has('currency'))
                                                <span class="hidemobile">{{ session()->get('currency') }}</span> {{  number_format($qItem['rate'] / session()->get('exchangeRate') , 2)  }}
                                            @else
                                                <span class="hidemobile">SRD</span> {{ number_format($qItem['rate'], 2)  }}
                                            @endif
                                        @endif
                                        @if($qItem['itemID'] != '520000-1128115782' and $qItem['itemID'] != '530000-1128435487')
                                        @php($subTotal = $subTotal  + ($qItem['qty'] * $item->SalesPrice))
                                        @if(session()->has('currency'))
                                            <span class="hidemobile">{{ session()->get('currency') }}</span> {{ number_format(($qItem['qty'] * $item->SalesPrice) / session()->get('exchangeRate') , 2)  }}
                                        @else
                                            <span class="hidemobile">SRD</span> {{ number_format($qItem['qty'] * $item->SalesPrice, 2)  }}
                                        @endif
                                        @endif

                                    </td>
                                    <td>
                                        <button type="button" onclick="Livewire.emit('updateCart')" wire:loading.attr="disabled" wire:click="removeItem('{{$key}}')" class="btn btn-danger bg-danger ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            {{--                                @if($saleCustomer != '')--}}
                            {{--                                    @if($saleCustomer->PriceLevelRefListID == '60000-1139229677')--}}
                            {{--                                        <tr class="border-b">--}}
                            {{--                                            <td class="p-6 hidden 2xl:block"  style="font-family: sfsemibold">--}}
                            {{--                                                Korting(Discount)--}}
                            {{--                                            </td>--}}
                            {{--                                            <td>--}}
                            {{--                                                Korting(Discount)--}}
                            {{--                                            </td>--}}
                            {{--                                            <td>--}}

                            {{--                                            </td>--}}
                            {{--                                            <td>--}}

                            {{--                                            </td>--}}
                            {{--                                            <td>--}}
                            {{--                                                -10%--}}
                            {{--                                            </td>--}}
                            {{--                                            <td class="p-6">--}}
                            {{--                                                -@if(session()->has('currency'))--}}
                            {{--                                                    <span class="hidemobile">{{session()->get('currency')}}</span> {{number_format(($subTotal * 0.1 )/ session()->get('exchangeRate'), 2) }}--}}
                            {{--                                                @else--}}
                            {{--                                                    <span class="hidemobile">SRD</span> {{number_format($subTotal * 0.1, 2) }}--}}
                            {{--                                                @endif--}}
                            {{--                                                @php($subTotal = $subTotal - ($subTotal * 0.1))--}}
                            {{--                                            </td>--}}
                            {{--                                            <td>--}}

                            {{--                                            </td>--}}
                            {{--                                        </tr>--}}
                            {{--                                    @endif--}}
                            {{--                                @endif--}}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="p-6">
                                    Total
                                </td>
                                <td >
                                </td>
                                <td>
                                </td>
                                {{--                                <td class="">--}}
                                {{--                                </td>--}}
                                <td class="hidden 2xl:block">
                                </td>
{{--                                {{ $total }}--}}
                                <td class="p-6">
                                    @if(session()->has('currency'))
                                        <span class="hidemobile">{{session()->get('currency')}}</span> {{ number_format($subTotal / session()->get('exchangeRate'), 2) }}
                                    @else
                                        <span class="hidemobile">SRD</span> {{ number_format($subTotal, 2) }}
                                    @endif
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div style="overflow-x: auto" class="items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
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
                        <select wire:change="setDefaultMemoTemplate" wire:model="memoTemplate" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                            <option value="0">Select default memo</option>
                            <option value="1">Prijzen: af Tropical Trade</option>
                            <option value="2">Prices ex-Warehouse Tropical Trade</option>
                        </select>
                        <br>
                        <textarea wire:model="memo" readonly style="width: 500px; font-family: sflight; font-size: 20px" class="w-full block appearance-none  border border-gray-200 bg-gray-50 text-gray-700 rounded leading-tight focus:outline-none focus:border-gray-500" name="memoText" id="memoText" cols="30" rows="6"></textarea>

                    </div>
                        <br>
                        <div>
                            @php($signatures = \App\Models\Signature::query()->orderBy('id')->get())
                        <h2 style="font-family: sflight; font-size: 20px">Signature</h2>
                        <select wire:model="signature" name="signature" id="signature" class="w-full block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                            @foreach($signatures as $signature2)
                                <option value="">
                                    Select signature
                                </option>
                                <option value="{{ $signature2->id }}">
                                    {{ $signature2->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="flex float-left">
                        <div class="p-6">
                            <a href="{{ route('quotations.index') }}">
                                <button type="button"  style="background-color: gray; color: white; font-family: sfsemibold" class="btn ">
                                    Cancel
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="flex float-right">

                        <div style="text-align: right" class="p-6">
                            <button wire:click="createQuotation" style="right: 0; background-color: #0069AD; color: white; font-family: sfsemibold" class=" btn btn-info">
                                <img wire:loading wire:target="createSalesOrder" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                Submit quotation
                            </button>
                            <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                <!-- Trigger for Modal -->
                                <button type="button" @click="showModal =  ! showModal" style="color: white; background-color: #0069ad" class="btn">
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
                                      x-transition.opacity >
                                    <br>
                                    <br>
                                    <br>
                                    <!-- Modal inner -->
                                    <div style="padding-top: 100px" class="p-4" @click.away="showModal = false" id="printDiv">
                                        <div class="card">
                                            <div class="card-body">
                                                <table width="100%">
                                                    <tr>
                                                        <td style="padding: 10px">
                                                            @php($lastQuotation)
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
                                                                                <td style="padding-bottom: 5px"><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"></div></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?=$currency=='USD'?'Date':'Datum'?></td>
                                                                                <td><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">
                                                                                        </div></td>
                                                                            </tr>
                                                                        </table>
                                                                        <hr>
                                                                        <table width="100%" style="border: none;" cellpadding="0" cellspacing="0">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="width: 50%;border: none; vertical-align: top; text-align: left">
                                                                                    <table width="100%" cellpadding="5" cellspacing="0">
                                                                                        <tr>
                                                                                            <td style="height: 25px;font-weight: bold"><?=$currency=='USD'?'Bill To':'Afnemer'?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="vertical-align: top; text-align: left">
                                                                                                {{ $selectedCustomer->BillAddressAddr1 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr2 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr3 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr4 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr5 ?? '' . ','}}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td style="width: 50%;border: none; vertical-align: top; text-align: left">
                                                                                    <table width="100%" cellpadding="5" cellspacing="0">
                                                                                        <tr>
                                                                                            <td style="height: 25px;font-weight: bold"><?=$currency=='USD'?'Ship To':'Leveringsadres'?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="vertical-align: top; text-align: left">
                                                                                                {{ $selectedCustomer->BillAddressAddr1 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr2 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr3 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr4 ?? '' . ','}}
                                                                                                <br>
                                                                                                {{ $selectedCustomer->BillAddressAddr5 ?? '' . ','}}
                                                                                                <br>
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
                                                                                <td><div class="div" style="width: 150px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?='&nbsp;'?></div></td>
                                                                                <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center">
{{--                                                                                        {{$model->ShipDate}}--}}
                                                                                    </div></td>
                                                                                <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?='&nbsp;'?></div></td>
{{--                                                                                @php($customer = $selectedCustomer)--}}
{{--                                                                                <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->SalesRepRefFullName?:'&nbsp;'?></div></td>--}}
{{--                                                                                <td><div class="div" style="width: 100px;border-radius: 25px;padding: 5px;border: 1px solid #ddd;text-align: center"><?=$customer->CustomFieldKlanttype?:'&nbsp;'?></div></td>--}}
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                                <thead>
                                                                <tr style="background-color: #DDD">
                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Item&nbsp;#':'Artikel&nbsp;Code'?></th>
                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Description':'Omschrijving'?></th>
                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Quantity':'Aantal'?></th>
                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Unit&nbsp;of&nbsp;Measure':'Eenheid'?></th>
                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Rate':'Prijs&nbsp;per&nbsp;stuk'?></th>
                                                                    <th style="border: 1px solid #ddd;padding: 2px;"><?=$currency=='USD'?'Total':'Totaal'?></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php($total = 0.00000)
{{--                                                                @php($quotationItems = \App\Models\QuotationItem::query()->where('quotation_id', $quotation->id)->get())--}}
                                                                @foreach($QItems as $key => $salesOrderItem)
                                                                    @php($item = \App\Models\Item::query()->where('ListID', $salesOrderItem['itemID'])->first())
                                                                    <tr>
                                                                        <td style="padding: 2px;text-align: left;border: 1px solid #ddd;">
                                                                            {{$item->Name}}
                                                                        </td>
                                                                        <td style="padding: 2px;text-align: left;border: 1px solid #ddd;">{{$salesOrderItem['description']}}</td>
                                                                        <td style="padding: 2px;text-align: center;border: 1px solid #ddd;">
                                                                            {{$salesOrderItem['qty']}}</td>
                                                                        <td style="padding: 2px;text-align: center;border: 1px solid #ddd;">{{$item->UnitOfMeasureSetRefFullName}}</td>
{{--                                                                        <td style="padding: 2px;text-align: right;border: 1px solid #ddd;">--}}
{{--                                                                            {{$salesOrderItem->SalesOrderLineRatePercent ?--}}
{{--                                                                            $salesOrderItem->SalesOrderLineRatePercent .'%':--}}
{{--                                                                            $salesOrderItem->SalesOrderLineRate}} </td>--}}
                                                                        <td style="padding: 2px;text-align: right;border: 1px solid #ddd;">
                                                                            {{$salesOrderItem['rate']}} </td>
                                                                        <td style="padding: 2px;text-align: right;border: 1px solid #ddd;">{{$salesOrderItem['rate'] * $salesOrderItem['qty']}}</td>
                                                                    </tr>
                                                                    @php($total = $total + ($salesOrderItem['rate'] * $salesOrderItem['qty']))
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    @php($logo = asset('tti-new_email.jpg'))
                                                                    @php($qrLogo = asset('tti-email-qr.png'))
                                                                    <td colspan="4" style="text-align: left;padding-top: 5px">
{{--                                                                         {{ $model->CustomerMsgRefFullName }}--}}
                                                                        <br>
{{--                                                                        <?=$model->Memo?nl2br($model->Memo).'<br>':''?><br><br>--}}
{{--                                                                        @if($model->signature_id != null)--}}
{{--                                                                            @php($signature = \App\Models\Signature::query()->where('id', $model->signature_id)->first())--}}
{{--                                                                            <img class="w-3/4" src="{{ asset('storage/signatures/' . $signature->image) }}" alt="{{ $signature->name }}">--}}
{{--                                                                        @endif--}}
                                                                        <?=$currency=='USD'?'Scan the QR code to go to':'Scan de code om direct naar'?><br>
                                                                        www.ttistore.com <?=$currency=='USD'?'':'te gaan'?>.<br>
                                                                        <img src="<?= $qrLogo; ?>"><br>
                                                                        Fabrikant van voedings- en farmaceutische producten.<br>
                                                                        Manufacturer of Food and Pharmaceutical products.
                                                                    </td>
                                                                    <th style="padding: 2px;text-align: right;vertical-align: top"><?=$currency=='USD'?'Total':'Totaal'?>&nbsp;<?=$currency?></th>
                                                                    <th style="padding: 2px;text-align: right;vertical-align: top">
                                                                        {{number_format($total, 2)}}</th>
                                                                </tr>
                                                                </tfoot>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <span class="text-red-500">Please select atleast one item</span>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>


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
            {{--            @foreach($cartItems as $cartItem)--}}
            {{--            @php($item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->get()->first())--}}
            {{--            @if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)--}}
            {{--            document.getElementById('ordered-{{ $cartItem->id }}').value = '{{ number_format($item->QuantityOnHand - $item->QuantityOnSalesOrder)  }}'--}}
            {{--            document.getElementById('backordered-{{ $cartItem->id }}').value = '{{ $cartItem->qty - ($item->QuantityOnHand - $item->QuantityOnSalesOrder)  }}'--}}
            {{--            @else--}}
            {{--            document.getElementById('ordered-{{ $cartItem->id }}').value = '{{ number_format($cartItem->qty)  }}'--}}
            {{--            document.getElementById('backordered-{{ $cartItem->id }}').value = '0'--}}
            {{--            @endif--}}
            {{--            @endforeach--}}
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
        <script>
            function searchItem5()
            {
                if(document.getElementById('search_input5').value === '')
                {
                    document.getElementById("list_search5").classList.add('hidden');
                }
                else
                {
                    document.getElementById("list_search5").classList.remove('hidden');
                    document.getElementById("item_searchwrap5").classList.add('hidden');
                    document.getElementById("list_search5").classList.add('block');
                    const items = new XMLHttpRequest();
                    document.getElementById("loading_searchwrap5").classList.remove('hidden');
                    document.getElementById("item_searchwrap5").classList.add('hidden');
                    document.getElementById("loading_searchwrap5").classList.add('block');
                    items.onload = function()
                    {
                        document.getElementById("item_searchwrap5").classList.remove('hidden');
                        document.getElementById("loading_searchwrap5").classList.remove('block');
                        document.getElementById("loading_searchwrap5").classList.add('hidden');
                        document.getElementById("item_searchwrap5").innerHTML = this.responseText;
                    }
                    items.open("GET", '{{ route('getItems') }}?search=' + document.getElementById('search_input5').value , true);
                    items.send();
                }

            }
        </script>
    </form>


</div>
