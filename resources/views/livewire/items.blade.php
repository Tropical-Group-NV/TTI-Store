<div>



    <form action="">


{{--        @if(isset($_REQUEST['search']))--}}
{{--            <input value="{{ $_REQUEST['search'] }}" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="search" autocomplete="false">--}}

{{--        @else--}}
        <br>
            <div>
                <div  style="padding-left: 100px; padding-right: 100px">
                    <input wire:keydown.debounce.250ms="sug_search" wire:model.debounce.250ms="search2" value="{{ $search_str }}" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full form-control btn-group" autocomplete="false" type="search">
{{--                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full form-control btn-group" name="" id=""></select>--}}
                </div>
{{--                <h1>{{ $search }}</h1>--}}
{{--                <h1>{{ $search_sw }}</h1>--}}
{{--                {{ print_r($list) }}--}}
                <div style="padding-left: 100px; padding-right: 100px;z-index: 100; position: center" style="position: absolute; z-index: 100; max-width: 1200px; width: auto" class="collapse @if(strlen($search2) > 0 and $search_sw == 1 and !empty($list)) show @endif">
                    <div class="card card-body">
                        <div style="border-radius: 50px" wire:loading>
                            <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 100px; margin: 0px;">
                        </div>
                        <div  wire:loading.remove>
                            @if(strlen($search2) > 0 and $search_sw == 1)
                                @foreach($list as $itm)
                                    @if(is_array($itm))
                                        @if($itm != null)
                                            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm['ListID'])->get()->first())
                                            @if($image != null)
                                                <a href="/?search={{ $itm['Description'] }}">
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
                                            <a href="/?search={{ $itm->Description }}">
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

    <div style="border-radius: 50px" wire:loading>
{{--        <img src="{{ asset('TGN_HD.png') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 500px; margin: 5px; animation-name: spin;animation-duration: 5000ms;animation-iteration-count: infinite;">--}}
{{--        <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 500px; margin: 5px;">--}}
    </div>

    <div>
        <span style="padding-left: 10px">
            Search results for: "<b>{{ $search_str }}</b>"
        </span>
    </div>
    <br>

    <div style="padding-left: 25px; padding-right: 25px" class="bg-gray-200 bg-opacity-25 grid grid-cols-4 md:grid-cols-3">

        @foreach($items as $item)
            @php($itemDesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
            @if($image != null)
            <div class="card" style="width: auto;">



                    <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 250px" alt="Card image cap">

                <div class="card-body" style="position: relative">
                    <h5 class="card-title">{{ $item->Description }}</h5>
                    @if($itemDesc != null)
                        <span id="item:{{ $item->ListID }}" class="card-text">{{ strip_tags($itemDesc->description)  }}</span>
                    @endif
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

                        {{--                <button class="btn btn-primary" id="add:{{ $item->ListID }}" onclick="added('add:{{ $item->ListID }}')">Add to Cart</button>--}}
                        <div>
                            <button class="btn btn-primary" id="add:{{ $item->ListID }}" onclick="added('add:{{ $item->ListID }}')">Add to Cart</button>
                            {{--                    <button onclick="added()" class="btn btn-primary"><p>Add to cart</p>--}}
                            {{--                    <div style="display: none" wire:loading.show wire:target="increment">--}}
                            {{--                        <img wire:loading.show style="width: 20px;display: none" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">--}}
                            {{--                    </div>--}}
                            {{--                    </button>--}}
                        </div>

                    </ul>
                </div>

            </div>
            @endif
        @endforeach
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

        <div></div>

    </div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="text-align: center">
        <div style="left: 50%; right: 50%">
            {{ $items->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>


</div>
