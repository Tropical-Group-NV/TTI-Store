<div class="">
    <div style="; right: 0;" class=" 2xl:block fixed left-0 2xl:w-80 2xl:left-auto top-5 2xl:top-auto sm:top-45">
        <aside class="shadow-xl sm:rounded-lg">
            <div class="overflow-y-auto py-4 px-3 bg-white rounded w-full" style="">

                <button class="block 2xl:hidden" style="position: absolute; z-index: 1000" onclick="toggleCart()" data-modal-toggle="shoppingCart">
                    <img style="width: 30px" src="https://www.svgrepo.com/show/273966/close.svg">
                </button>
                <span style="font-family: sfsemibold;;" class="p-6 text-center flex justify-center">
                    <div>
                        <span style="font-size: 20px">
                            Shopping Cart
                        </span>
                        <i style="color: #0069ad" class="fa fa-shopping-cart" aria-hidden="true"></i>

                    </div>
                </span>
                <div style="z-index: 5; overflow-y: auto;max-height: 375px; overflow-x: hidden">
                    <hr>
                    <br>
                    <table class="sm:rounded-lg table-auto border border-spacing-2 w-full">
                        <thead>
                        <tr class="border border-slate-600 border-spacing-2">
                            <th class="border-collapse: separate  border border-slate-600">
                                Item
                            </th>
                            <th class="border-collapse: separate border border-slate-600">
                                Price
                            </th>
                        </tr>
                        </thead>
                        <tbody style="overflow-y: auto; height: 300px">
                        @php($subTotal = 0)
                        @if($cartItemExist)
                            @foreach($cartItems as $cartItem)
                                @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $cartItem->prod_id)->get()->first())
                                @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                                @if(session()->has('currency'))
                                    @php($subTotal = ($subTotal + ($cartItem->qty * $item->SalesPrice)) / session()->get('exchangeRate'))
                                @else
                                    @php($subTotal = $subTotal + ($cartItem->qty * $item->SalesPrice))
                                @endif
                                <tr class="border-collapse">
                                    <td class="border-collapse">
                                        <a href="{{ route('item', $cartItem->prod_id) }}">
                                            @if($image != null)
                                                <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 150px" alt="Card image cap">
                                            @else
                                                <img class="card-img-top" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 150px" alt="Card image cap">

                                            @endif
                                        </a>
                                    </td>
                                    <td class="border-collapse: separate border-slate-600">
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td class="border-collapse: separate border-slate-600">
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <span class="input-group-btn input-group-prepend">
                                            <button onclick="Livewire.emit('updateCart')" wire:loading.attr="disabled" wire:click="removeFromCart('{{$cartItem->id}}')" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>
                                            </button>
                                        </span>
                                            <input value="{{ $cartItem->qty }}" type="number" wire:loading.attr="disabled" wire:keyup.debounce.500ms="changeQuantity( '{{ $cartItem->id }}', document.getElementById('{{ $cartItem->id }}').value)" class="rounded w-1/2" id="{{ $cartItem->id }}" name="qty"/>
                                        </div>
                                    </td>
                                    <td class="border-collapse: separate border-slate-600">
                                        @if(session()->has('currency'))
                                            {{session()->get('currency')}} {{ number_format(($cartItem->qty * $item->SalesPrice) / session()->get('exchangeRate'), 2) }}
                                        @else
                                            SRD {{ number_format(($cartItem->qty * $item->SalesPrice), 2) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="">
                                Total
                            </td>
                            <td class="">
                                @if(session()->has('currency'))
                                    {{session()->get('currency')}} {{ number_format($subTotal, 2) }}
                                @else
                                    SRD {{ number_format($subTotal, 2) }}
                                @endif
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <br>
                </div>
                <br>
                <div>
                    @if($cartItemExist)
                        <button style="float: left" wire:loading.attr="disabled" wire:click="clearCart" class="btn btn-danger">
                            Clear cart
                        </button>

                            @if(Auth::user()->users_type_id == 1)
                                @php($userCustomer = DB::connection('qb_sales')->table('view_customer_list')->where('text', 'LIKE', '%' . Auth::user()->name . ' ' . Auth::user()->last_name .'%')->first())
                        @if($userCustomer != null)
                                <a style="float: right" href="{{ route('checkout') }}?customerid={!! $userCustomer->id !!}">
                                    <button style="right: 0; background-color: #0069AD; color: white" class="btn">
                                        Checkout
                                    </button >
                                </a>
                            @else
                                <a style="float: right" href="{{ route('checkout') }}">
                                    <button style="right: 0; background-color: #0069AD; color: white" class="btn">
                                        Checkout
                                    </button >
                                </a>
                            @endif
                            @else
                            <a style="float: right" href="{{ route('checkout') }}">
                                <button style="right: 0; background-color: #0069AD; color: white" class="btn">
                                    Checkout
                                </button >
                            </a>
                            @endif
                    @endif
                </div>
            </div>
        </aside>
    </div>
</div>

