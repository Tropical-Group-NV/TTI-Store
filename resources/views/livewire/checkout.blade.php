<div>
    <table class="sm:rounded-lg w-full">
        <thead>
        <tr class="">
{{--            <th class=" ">--}}
{{--                Qty--}}
{{--            </th>--}}
            <th class="">
                Item
            </th>
            <th class="">
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
                @php($subTotal = $subTotal + ($cartItem->qty * $item->SalesPrice))
                <tr class="border-b">
{{--                    <td class="border border-slate-600 sfsb">--}}
{{--                                <span style="font-family: sflight" class="sfl">--}}
{{--                                    <select wire:loading.attr="disabled" wire:change="changeQuantity( '{{ $cartItem->id }}', document.getElementById('{{ $cartItem->id }}').value)" class="form-control" id="{{ $cartItem->id }}" name="qty">--}}
{{--                                @php($count=0)--}}
{{--                                        @while($count != $item->QuantityOnHand + 1)--}}
{{--                                            @php($count++ )--}}
{{--                                            <option @if($count ==  $cartItem->qty ) selected @endif value="{{ $count }}">{{ $count }}</option>--}}
{{--                                        @endwhile--}}
{{--                            </select>--}}
{{--                                    {{ $cartItem->qty }}--}}
{{--                                </span>--}}

{{--                    </td>--}}
                    <td class="">
                        <a href="{{ route('item', $cartItem->prod_id) }}">
                            <div class="flex">
                                @if($image != null)
                                    <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 150px" alt="Card image cap">
                                <div style="margin: auto; text-align: left" class="">
                                    <h1 style="top: 50%" class="">
                                        <b>
                                            {{ $item->Description }}
                                        </b>
                                    </h1>
                                </div>
                                @else
                                    <img class="card-img-top" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 150px" alt="Card image cap">

                                @endif
                            </div>

                        </a>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <span class="input-group-btn input-group-prepend">
                                            <button onclick="Livewire.emit('updateCart')" wire:loading.attr="disabled" wire:click="removeFromCart('{{$cartItem->id}}')" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>
                                            </button>
                                        </span>
                            <select wire:loading.attr="disabled" wire:change="changeQuantity( '{{ $cartItem->id }}', document.getElementById('{{ $cartItem->id }}').value)" class="block appearance-none  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="{{ $cartItem->id }}" name="qty">
                                @php($count=0)
                                @while($count != $item->QuantityOnHand + 1)
                                    @php($count++ )
                                    <option @if($count ==  $cartItem->qty ) selected @endif value="{{ $count }}">{{ $count }}</option>
                                @endwhile
                            </select>
                        </div>
                    </td>
                    <td class="">
                        <div style="margin: auto">
                            SRD {{ $cartItem->qty * $item->SalesPrice }}
                        </div>

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
{{--            <td>--}}

{{--            </td>--}}
            <td class="">
                SRD {{ $subTotal }}
            </td>
        </tr>
        </tfoot>
    </table>
</div>
