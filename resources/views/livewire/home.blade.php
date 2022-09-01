<div>
    @php($brands = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('filter_brand')->get())
    <div style="height: 100px" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div>
            <form id="searchform" action="{{ route('dashboard') }}">
                <br>
                <div>
                    <div  style="padding-left: 50px; padding-right: 50px">
                        <div>
                            <ul class="flex btn-group">
                                <input style="height:50px" id=search_input wire:keydown="sug_search" wire:model="search2" value="{{ $search_str }}" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block form-control" autocomplete="false" type="search">
                                <button class="btn " style="background-color: #0069AD; height: 50px">
                                    <img style="width: 40px; height: 40px" src="{{ asset('search_glass.svg') }}" alt="">
                                </button>
                            </ul>

                        </div>
                    </div>
                    <div id="list_search" style="padding-left: 50px; padding-right: 50px;z-index: 100; position: absolute; max-height: 200px" class="collapse @if(strlen($search2) > 0 and $search_sw == 1 and !empty($list)) show @endif">
                        <div class="card card-body">
                            <div style="border-radius: 50px" wire:loading>
                                <img src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 100px; margin: 0px;">
                            </div>
                            <div style="overflow-y: auto"  wire:loading.remove>
                                @if(strlen($search2) > 0 and $search_sw == 1)
                                    @foreach($list as $itm)
                                        @if(is_array($itm))
                                            @if($itm != null)
                                                @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm['ListID'])->get()->first())
                                                @if($image != null)
                                                    <a href="{{ route('item', $itm['ListID']) }}" >
                                                        <ul class="flex hover:bg-gray-50 cursor-pointer">
                                                            <img src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px" alt="">
                                                            <h1>{{ $itm['Description'] }}</h1>
                                                        </ul>
                                                    </a>
                                                    <hr>
                                                    <br>
                                                @endif
                                            @endif
                                        @else
                                            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm->ListID)->get()->first())
                                            @if($image != null)
                                                <a href="{{ route('item', $itm->ListID) }}">
                                                    <ul class="flex hover:bg-gray-50 cursor-pointer">
                                                        <img src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px" alt="">

                                                        <h1>{{ $itm->Description }}</h1>
                                                    </ul>
                                                </a>

                                                <hr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="flex">
            <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
                On sale
            </h1>
            <img src="{{ asset('onsale2.svg') }}" style=" opacity: 0.7; width: 80px;" alt="">
        </div>

        <div>
            <div style="" class="bg-gray-200 bg-opacity-25 grid grid-cols-4 md:grid-cols-4 md:grid-rows-1">
                @foreach($onSale as $sale_item)
                    @if(!is_array($sale_item))
                    @if($sale_item->onsale == 1)
                    @php($item = \App\Models\Item::query()->where('ListID', $sale_item->ListID)->get()->first())
                    @php($itemDesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
                    @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                    <div class="card" style="width: auto;">
                        <div style="height: 20rem; margin: auto">
                            <a href="{{ route('item', $item->ListID) }}">
                                @if($image!=null)
                                    <img src="{{ asset('onsale.svg') }}" style="position: absolute; opacity: 0.5; width: 120px; padding-top: 20px" alt="">
                                    <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 350px;" alt="Card image cap">
                                @else
                                    <img class="card-img-top" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 350px" alt="Card image cap">
                                @endif

                            </a>
                        </div>
                        <div class="card-body" style="position: relative">
                            <a href="{{ route('item', $item->ListID) }}">
                                <div style="height: 100px" class="">
                                    <h5  style="font-family: sfsemibold; font-size: 20px" class="card-title">{{ $item->Description }}</h5>
                                    <h5><b>{{$item->FullName}}</b></h5>
                                    <br>
                                </div>
                                @if($itemDesc != null)
                                    {{--                            <span id="item:{{ $item->ListID }}" class="card-text">{{ strip_tags($itemDesc->descriptio  n)  }}</span>--}}
                                @endif
                            </a>
                            <ul class="border-top flex justify-between" style="bottom: 0; padding: 20px">
                                <li>
                                    @if(\Illuminate\Support\Facades\Auth::user() != null)
                                        <span style="padding-top: 10px">Sales price: SRD <b>{{ substr($item->SalesPrice, 0, -3) }}</b></span>
                                        <br>
                                    @endif
                                    <span style="padding-top: 10px">Retail price: SRD <b>{{ substr($item->CustomBaliPrice, 0, -3) }}</b></span>
                                    <br>
                                    <span style="padding-top: 10px">Unit: <b>{{ $item->UnitOfMeasureSetRefFullName }}</b></span>
                                    <br>
                                    @if($item->QuantityOnHand > 0)
                                        In stock: <b>{{  substr($item->QuantityOnHand, 0, -6) }}</b>
                                    @else
                                        <span style="color: red">Out of stock</span>
                                    @endif


                                </li>
                            </ul>
                            {{--                <button class="btn btn-primary" id="add:{{ $item->ListID }}" onclick="added('add:{{ $item->ListID }}')">Add to CartItem</button>--}}
                            <div>
                                @if(\Illuminate\Support\Facades\Auth::user() != null)
                                    @if(\App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->exists())
                                        @php($inCart = \App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->first())
                                        <div>
                                        <span wire:click="load2('remove{{ $item->ListID }}')" class="input-group-btn input-group-prepend">
{{--                                            <button wire:loading.attr="disabled"  wire:click="removeFromCart('{{$inCart->id}}')" class="btn btn-danger  w-full items-center">--}}
                                            {{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>--}}
                                            {{--                                            </button>--}}
                                            <button style="font-family: sfsemibold; background-color: #0069AD; color: white" disabled class="btn w-full items-center">
                                                Added to cart
                                            </button>
                                        </span>
                                        </div>
                                    @else
                                        <div>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <span class="input-group-btn input-group-prepend w-full"></span>
                                                <select @if($item->QuantityOnHand <= 0) disabled @endif id="input-{{ $item->ListID }}" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="qty">
                                                    @php($count=0)
                                                    @if($item->QuantityOnHand > 0)
                                                        @while($count != $item->QuantityOnHand)
                                                            @php($count++ )
                                                            <option value="{{ $count }}">{{ $count }}</option>
                                                        @endwhile
                                                    @else
                                                        <option value="0">0</option>
                                                    @endif
                                                </select>
                                                <span wire:click="load('add{{ $item->ListID }}')" class="input-group-btn input-group-append">
                                            <button style="background-color: #0069AD; font-family: sfsemibold" @if($item->QuantityOnHand <= 0) disabled @endif @if($item->QuantityOnHand > 0) wire:loading.attr="disabled" wire:click="addToCart( '{{ $item->ListID }}', document.getElementById('input-{{ $item->ListID }}').value)" @endif   class="btn">
                                                <img wire:loading wire:target="load('add{{ $item->ListID }}')" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                                <span class="text-white" wire:loading.remove  wire:target="load('add{{ $item->ListID }}')">Add to cart</span>
{{--                                                <svg wire:loading.remove  wire:target="load('add{{ $item->ListID }}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.459-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.21-3.015c-.698-.03-1.367-.171-1.991-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-2v2h-1v-2h-2v-1h2v-2h1v2h2v1z"/></svg>--}}
                                            </button>
                                        </span>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                @endforeach
            </div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="text-align: center">

            </div>
            <script>
                document.body.addEventListener('click', function ()
                {
                    document.getElementById('list_search').classList.remove('show');
                });
            </script>

        </div>
    </div>

</div>
