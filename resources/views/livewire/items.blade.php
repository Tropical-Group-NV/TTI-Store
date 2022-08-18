@php($brands = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('filter_brand')->get())
<div>
    {{ $search_str }}



    <form id="searchform" action="">
        <br>

            <div>
                <div  style="padding-left: 50px; padding-right: 50px">
                    <div>
                        <select onchange="document.getElementById('searchform').submit()" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full form-control btn-group" name="brand" id="">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                @if($brand_srch != '' or $brand_srch != null)
                                    @if($brand_srch == $brand->name)
                                        <option selected value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @else
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <input id=search_input wire:keydown="sug_search" wire:model="search2" value="{{ $search_str }}" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full form-control btn-group" autocomplete="false" type="search">
                </div>
                <div id="list_search" style="padding-left: 50px; padding-right: 50px;z-index: 100; position: absolute; max-height: 200px" class="collapse @if(strlen($search2) > 0 and $search_sw == 1 and !empty($list)) show @endif">
                    <div class="card card-body">
                        <div style="border-radius: 50px" wire:loading>
                            <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 100px; margin: 0px;">
                        </div>
                        <div style="overflow-y: auto"  wire:loading.remove>
                            @if(strlen($search2) > 0 and $search_sw == 1)
                                @foreach($list as $itm)
                                    @if(is_array($itm))
                                        @if($itm != null)
                                            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm['ListID'])->get()->first())
                                            @if($image != null)
{{--                                                <a href="#" onclick="document.getElementById('searchform').value = '{{ $itm['Description'] }} }}';document.getElementById('searchform').submit()">--}}
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
{{--                                            <a href="#" onclick="document.getElementById('searchform').value = '{{ $itm->Description }}';document.getElementById('searchform').submit()">--}}
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


{{--        @endif--}}


    </form>
    <br><br>

{{--    <div style="border-radius: 50px" wire:loading>--}}
{{--        <img src="{{ asset('TGN_HD.png') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 500px; margin: 5px; animation-name: spin;animation-duration: 5000ms;animation-iteration-count: infinite;">--}}
{{--        <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 500px; margin: 5px;">--}}
{{--    </div>--}}

    @if($search_str != '')
    <div style="padding-left: 100px; padding-right: 100px">
        <span style="padding-left: 10px">
            Search results for: "<b>{{ $search_str }}</b>"
        </span>
    </div>
    <br>
    @endif

    <div style="padding-left: 25px; padding-right: 25px" class="bg-gray-200 bg-opacity-25 grid grid-cols-4 md:grid-cols-3">
{{--        {{ print_r($items) }}--}}
        @foreach($items as $item)
            @if($items == '1')
                {{ 'null' }}
                @endif
{{--            {{ print_r($item) }}--}}
            @php($itemDesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
            @if($image != null)
            <div class="card" style="width: auto; cursor: pointer">
                <a href="{{ route('item', $item->ListID) }}">
                    <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 250px" alt="Card image cap">
                </a>

                <div class="card-body" style="position: relative">
                    <a href="{{ route('item', $item->ListID) }}">
                        <h5 class="card-title">{{ $item->Description }}</h5>
                        @if($itemDesc != null)
                            <span id="item:{{ $item->ListID }}" class="card-text">{{ strip_tags($itemDesc->description)  }}</span>
                        @endif
                    </a>

                    <br>
                    <br>
                    <ul class="border-top flex justify-between" style="bottom: 0; padding: 20px">
                        <li> <span style="padding-top: 10px">Price: SRD <b>{{ substr($item->SalesPrice, 0, -3) }}</b></span>
                            <br>
                            @if($item->QuantityOnHand != '.00000')
                                Quantity: <b>{{  substr($item->QuantityOnHand, 0, -6) }} PCs</b>
                            @else
                                Quantity: <b>0 PCS</b>
                            @endif
                        </li>
                    </ul>

                        {{--                <button class="btn btn-primary" id="add:{{ $item->ListID }}" onclick="added('add:{{ $item->ListID }}')">Add to CartItem</button>--}}
                        <div>
                            @if(\Illuminate\Support\Facades\Auth::user() != null)
                                @if(\App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->exists())
                                    @php($inCart = \App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->first())
                                    <div>
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                        <span class="input-group-btn input-group-prepend">
                                            <button wire:click="addLess('{{$inCart->id}}')" class="btn btn-danger">-</button>
                                        </span>
                                            <input readonly class="Tspin text-center form-control" id="T80000E2A-1545930873" type="text" value="{{ $inCart->qty }}" name="qty">
                                            <span class="input-group-btn input-group-append">
                                            <button wire:click="addMore('{{$inCart->id}}')" class="btn btn-primary">+</button>
                                        </span>
                                        </div>
                                    </div>
                                @else
                                    <button class="btn btn-primary" wire:click="addToCart('{{$item->ListID}}', {{ '1' }})" id="add:{{ $item->ListID }}">
                                        {{--                                    {{$item->ListID}}--}}
                                        <span>Add to Cart</span>
                                    </button>

                                @endif
                                @endif


                            {{--                    <button onclick="added()" class="btn btn-primary"><p>Add to cart</p>--}}
                            {{--                    <div style="display: none" wire:loading.show wire:target="increment">--}}
                            {{--                        <img wire:loading.show style="width: 20px;display: none" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">--}}
                            {{--                    </div>--}}
                            {{--                    </button>--}}
                        </div>


                </div>

            </div>
            @endif
        @endforeach
        <div wire:loading="addToCart('{{$item->ListID}}" id="defaultModal" tabindex="-1" style="position: fixed; left: 30%; top: 15%; z-index: 5">
            <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" alt="">
        </div>

        <script>
            function added(id)
            {
                var addButton = document.getElementById(id);
                if(addButton.innerText === 'Remove from Cart')
                {
                    addButton.innerText = 'Add to Cart';
                }
                else
                {
                    addButton.innerText = 'Remove from Cart';
                }
            }
        </script>
    </div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="text-align: center">
        <div style="left: 50%; right: 50%">
            {{ $items->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
    <script>
        document.body.addEventListener('click', function ()
        {
            document.getElementById('list_search').classList.remove('show');
        });
    </script>

</div>
