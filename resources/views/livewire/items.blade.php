@php($brands = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('filter_brand')->get())
{{--@php(\Illuminate\Support\Facades\Mail::to('jamil.kasan@tropicalgroupnv.com')->send(new \App\Mail\OrderNew('77825')))--}}
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

<div>

    <form id="searchform" action="">
        <br>

            <div>
                <div  style="padding-left: 50px; padding-right: 50px">
                    <div>
                        <ul class="flex btn-group">
                            <input style="height:50px" id=search_input wire:keydown="sug_search" wire:model="search2" value="{{ $search_str }}" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block form-control" autocomplete="false" type="search">
                            <button class="btn " style="background-color: #0069AD; height: 50px">
                                <img style="width: 40px; height: 40px" src="{{ asset('search_glass.svg') }}" alt="">
                            </button>
{{--                            <select onchange="document.getElementById('searchform').submit()" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="brand" id="">--}}
{{--                                <option value="">Select Brand</option>--}}
{{--                                @foreach($brands as $brand)--}}
{{--                                    @if($brand_srch != '' or $brand_srch != null)--}}
{{--                                        @if($brand_srch == $brand->name)--}}
{{--                                            <option selected value="{{ $brand->name }}">{{ $brand->name }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>--}}
{{--                                        @endif--}}
{{--                                    @else--}}
{{--                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                        </ul>

                    </div>
                </div>
                <div id="list_search" style="padding-left: 50px; padding-right: 50px;z-index: 100; position: absolute; max-height: 200px" class="collapse @if(strlen($search2) > 0 and $search_sw == 1 and !empty($list)) show @endif">
                    <div class="card card-body">
                        <div style="border-radius: 50px" wire:loading>
                            <img src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 100px; margin: 0px;">
{{--                            <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="height: 100px; margin: 0px;">--}}
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
    @if($search_str != '')
    <div style="padding-left: 100px; padding-right: 100px">
        <span style="padding-left: 10px">
            Search results for: "<b>{{ $search_str }}</b>"
        </span>
    </div>
    <br>
    @endif
    <div style="" class="bg-gray-200 bg-opacity-25 grid grid-cols-4 md:grid-cols-4">
{{--        {{ print_r($items) }}--}}
        @foreach($items as $item)
            @if($items == '1')
                {{ 'null' }}
                @endif
{{--            {{ print_r($item) }}--}}
            @php($itemDesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
            <div class="card" style="width: auto;">
                <div style="height: 20rem; margin: auto">
                    <a href="{{ route('item', $item->ListID) }}">
                        @if($image!=null)
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
{{--                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">--}}
{{--                                        <span wire:click="load2('remove{{ $item->ListID }}')" class="input-group-btn input-group-prepend">--}}
{{--                                            <button wire:loading.attr="disabled"  wire:click="removeFromCart('{{$inCart->id}}')" class="btn btn-danger">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>--}}
{{--                                            </button>--}}
{{--                                        </span>--}}
{{--                                            <input class="" id="input-{{ $item->ListID }}" type="text" value="{{ $inCart->qty }}" name="qty">--}}
{{--                                            <span class="input-group-btn input-group-append">--}}
{{--                                            <button wire:click="changeQuantityCart('{{$inCart->id}}', document.getElementById('input-{{ $item->ListID }}').value)" class="btn btn-primary">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.459-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.21-3.015c-.698-.03-1.367-.171-1.991-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-2v2h-1v-2h-2v-1h2v-2h1v2h2v1z"/></svg>--}}
{{--                                            </button>--}}
{{--                                        </span>--}}
{{--                                        </div>--}}
                                    </div>
                                @else
                                    <div>
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <span class="input-group-btn input-group-prepend w-full">
{{--                                            <button style="cursor: not-allowed;" class="btn btnwire:loading.remove  wire:target="load('{{ $item->ListID }}')"-secondary">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M9 19c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5-17v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712zm-3 4v16h-14v-16h-2v18h18v-18h-2z"/></svg>--}}
{{--                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.46-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-.699-.03-1.368-.171-1.992-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-5v-1h5v1z"/></svg>--}}

{{--                                            </button>--}}
                                        </span>
{{--                                            <input class="" id="input-{{ $item->ListID }}" type="number" value="0" name="qty">--}}
                                            @if($item->QuantityOnHand <= 0)
                                                <input type="hidden" name="customer-id-{{ $item->ListID }}" id="customer-id-{{ $item->ListID }}">
                                                <input placeholder="Search Customer" id="customer-search-{{ $item->ListID }}" onkeydown="searchCustomer('{{ $item->ListID }}')" style="width: 500px" class="ring-2 ring-blue-500 form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
                                                <div id="searchWrap" style="position:relative; width: 400px;overflow-y: auto; max-height: 400px; z-index: 10;" class="block appearance-none  border border-blue-500 text-gray-700 rounded leading-tight focus:outline-none bg-gray-50 focus:border-gray-500">
{{--                                                    <div wire:loading="search" wire:target="search({{ $item->ListID }})" style="border-radius: 50px">--}}
{{--                                                        <img src="{{ asset('ttistore_loading.gif') }}" style="height: 100px; margin: 0px;">--}}
{{--                                                    </div>--}}
                                                    <div id="customer-wrap-{{ $item->ListID }}">
                                                    </div>
                                                </div>
                                                <br>
                                                <select id="input-{{ $item->ListID }}" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="qty">
                                                    @php($count=0)
                                                    @while($count != 1000)
                                                        @php($count++ )
                                                        <option value="{{ $count }}">{{ $count }}</option>
                                                    @endwhile
                                                </select>
                                                <span wire:click="load('add{{ $item->ListID }}')" class="input-group-btn input-group-append">
                                            <button style="background-color: #0069AD; font-family: sfsemibold"  wire:loading.attr="disabled" wire:click="addToCart( '{{ $item->ListID }}', document.getElementById('input-{{ $item->ListID }}').value)" class="btn">
                                                <img wire:loading wire:target="load('add{{ $item->ListID }}')" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                                <span class="text-white" wire:loading.remove  wire:target="load('add{{ $item->ListID }}')">Add Backorder</span>
{{--                                                <svg wire:loading.remove  wire:target="load('add{{ $item->ListID }}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.459-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.21-3.015c-.698-.03-1.367-.171-1.991-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-2v2h-1v-2h-2v-1h2v-2h1v2h2v1z"/></svg>--}}
                                            </button>
                                            @else
                                                <select id="input-{{ $item->ListID }}" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="qty">
                                                    @php($count=0)
                                                    @while($count != 1000)
                                                        @php($count++ )
                                                        <option value="{{ $count }}">{{ $count }}</option>
                                                    @endwhile
                                                </select>
                                                <span wire:click="load('add{{ $item->ListID }}')" class="input-group-btn input-group-append">
                                            <button style="background-color: #0069AD; font-family: sfsemibold" @if($item->QuantityOnHand <= 0) disabled @endif @if($item->QuantityOnHand > 0) wire:loading.attr="disabled" wire:click="addToCart( '{{ $item->ListID }}', document.getElementById('input-{{ $item->ListID }}').value)" @endif   class="btn">
                                                <img wire:loading wire:target="load('add{{ $item->ListID }}')" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                                <span class="text-white" wire:loading.remove  wire:target="load('add{{ $item->ListID }}')">Add to cart</span>
{{--                                                <svg wire:loading.remove  wire:target="load('add{{ $item->ListID }}')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="white" d="M13.299 3.74c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm3.92 14.84l-.571 1.42h-9.296l-3.597-8.961-.016-.039h9.441c.171-.721.459-1.395.848-2h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.21-3.015c-.698-.03-1.367-.171-1.991-.405zm-6.518-14.84c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26zm8.799 4.26c-2.484 0-4.5 2.015-4.5 4.5s2.016 4.5 4.5 4.5c2.482 0 4.5-2.015 4.5-4.5s-2.018-4.5-4.5-4.5zm2.5 5h-2v2h-1v-2h-2v-1h2v-2h1v2h2v1z"/></svg>--}}
                                            </button>
                                            @endif
                                        </span>
                                        </div>
                                    </div>
                                @endif
                                @endif
                        </div>


                </div>

            </div>
        @endforeach
{{--        <div wire:target="addToCart, removeFromCart" wire:loading="addToCart('{{$item->ListID}}" id="defaultModal" tabindex="-1" style="position: fixed; left: 50%; top: 15%; z-index: 5">--}}
{{--            <img src="https://i.pinimg.com/originals/65/ba/48/65ba488626025cff82f091336fbf94bb.gif" alt="">--}}
{{--            <img src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="n3VNCb KAlRDb"  data-noaft="1" style="height: 100%; margin: 0px;">--}}
{{--        </div>--}}


        <script>
            function searchCustomer(elID)
            {
                const customers = new XMLHttpRequest();
                customers.onload = function()
                {
                    document.getElementById("customer-wrap-" + elID).innerHTML = this.responseText;
                }
                customers.open("GET", '{{ route('getCustomers') }}?id=' + elID + '&search=' + document.getElementById('customer-search-' + elID).value , true);
                customers.send();
            }
        </script>

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
</div>
