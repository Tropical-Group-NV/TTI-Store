<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <div>

        <div>
            <div class="block md:block lg:block xl:block 2xl:hidden" style=" padding-top: 10px; padding-bottom: 10px">
                <button type="button" id="toggleFilters" onclick="this.style.display = 'none'; document.getElementById('filters').style.display = 'block'" class="btn w-full" style="background-color: #0069AD; height: 50px; right: 0; color: white">
                    Filters
                </button>
                <div style="padding-top: 10px; display: none" class="w-full " id="filters">
                    @livewire('filter')
                </div>
            </div>
        </div>
        {{--        @endif--}}
        @if($search_str != '')
            <br>
            <div style="padding-left: 100px; padding-right: 100px">
        <span style="padding-left: 10px">
            Search results for: "<b>{{ $search_str }}</b>"
        </span>
            </div>
            <br>
        @endif
        <div id="itemWrap" style="" class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
            {{--        {{ print_r($items) }}--}}
            @foreach($items as $item)
                @if($items == '1')
                    {{ 'null' }}
                @endif
                {{--            {{ print_r($item) }}--}}
                @php($itemDesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
                @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
                <div class="card" style="width: auto;">
                    <div  style="height: 20rem; margin: auto">
                        <a href="{{ route('item', $item->ListID) }}">
                            @if($image!=null)
                                <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="width: 350px;" alt="Card image cap">
                            @else
                                <img class="card-img-top grayscale" src="https://www.ttistore.com/foto/tti-noimage.png" style="width: 350px" alt="Card image cap">
                            @endif

                        </a>
                    </div>
                    <div class="card-body" style="position: relative">
                        <div class="hover:bg-gray-50 hover:text-gray-400" >
                            <a style="text-decoration: none" href="{{ route('item', $item->ListID) }}">
                                <div style="height: 100px" class="">
                                    <h5  style="font-family: sfsemibold; font-size: 20px" class="card-title">{{ $item->Description }}</h5>
                                    <h5><b>{{$item->FullName}}</b></h5>
                                    <br>
                                </div>
                                @if($itemDesc != null)
                                    {{--                            <span id="item:{{ $item->ListID }}" class="card-text">{{ strip_tags($itemDesc->descriptio  n)  }}</span>--}}
                                @endif
                            </a>
                        </div>
                        <ul class="border-top flex justify-between" style="bottom: 0; padding: 20px">
                            <li>
                                @if(\Illuminate\Support\Facades\Auth::user() != null)
                                    <span style="padding-top: 10px">Sales price: SRD <b class="font-extrabold" style="color: #0069ad; font-size: 20px">{{ substr($item->SalesPrice, 0, -3) }}</b></span>
                                    <br>
                                @endif
                                <span style="padding-top: 10px">Retail price: SRD <b class="font-extrabold" style="color: #0069ad; font-size: 20px">{{ substr($item->CustomBaliPrice, 0, -3) }}</b></span>
                                <br>
                                <span style="padding-top: 10px">Unit: <b>{{ $item->UnitOfMeasureSetRefFullName }}</b></span>
                                <br>
                                @if($item->QuantityOnHand > 0)
                                        @if(\Illuminate\Support\Facades\Auth::user() != null )
                                            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)
                                                <span style="color: green">In stock: <b>{{  substr($item->QuantityOnHand, 0, -6) }}</b></span>
                                            @else
                                                <span style="color: green">In stock</span>

                                            @endif

                                        @else
                                            <span style="color: green">In stock</span>

                                        @endif
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
                                            <button style="font-family: sfsemibold; background-color: green; color: white" disabled class="btn w-full items-center">
                                                Added to cart
                                            </button>
                                        </span>
                                    </div>
                                @else
                                    <div>
                                        @if($item->QuantityOnHand <= 0)
                                            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)
                                                <input type="hidden" id="customer-id-{{ $item->ListID }}">
                                                <input placeholder="Search Customers" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" id="customer-search-{{ $item->ListID }}" onkeyup="searchCustomer('{{ $item->ListID }}')">
                                                <div style="position: absolute; z-index: 1000; min-width: 300px; display: none" class="bg-gray-50 border" id="customer-wrap-{{ $item->ListID }}">

                                                </div>
                                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                    <select id="input-{{ $item->ListID }}" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="qty">
                                                        @php($count=0)
                                                        @while($count != 1000)
                                                            @php($count++ )
                                                            <option value="{{ $count }}">{{ $count }}</option>
                                                        @endwhile
                                                    </select>
                                                    <span class="input-group-btn input-group-append">
                                                    <button style="background-color: #0069AD; font-family: sfsemibold" wire:loading.attr="disabled" onclick="addBackorder('{{ $item->ListID }}', )"  class="btn">
                                                        <img wire:loading wire:target="load('add{{ $item->ListID }}')" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                                        <span class="text-white" wire:loading.remove  wire:target="load('add{{ $item->ListID }}')">Add backorder</span>
                                                    </button>
                                                </span>
                                                </div>
                                            @else
                                                @php($customerAccount = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_customer')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first())
                                                <input type="hidden" id="customer-id-{{ $item->ListID }}" value="{{ $customerAccount->customer_ListID }}">
                                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                    <select id="input-{{ $item->ListID }}" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="qty">
                                                        @php($count=0)
                                                        @while($count != 1000)
                                                            @php($count++ )
                                                            <option value="{{ $count }}">{{ $count }}</option>
                                                        @endwhile
                                                    </select>
                                                    <span class="input-group-btn input-group-append">
                                                    <button style="background-color: #0069AD; font-family: sfsemibold" wire:loading.attr="disabled" onclick="addBackorder('{{ $item->ListID }}')"  class="btn">
                                                        <img wire:loading wire:target="load('add{{ $item->ListID }}')" style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                                        <span class="text-white" wire:loading.remove  wire:target="load('add{{ $item->ListID }}')">Add backorder</span>
                                                    </button>
                                                </span>
                                                </div>
                                            @endif
                                        @else
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">

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
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endif
                        </div>


                    </div>

                </div>
            @endforeach


            <script>
                function searchCustomer(elID)
                {
                    if(document.getElementById('customer-search-' + elID).value === '')
                    {
                        document.getElementById("customer-wrap-" + elID).style.display = 'none';
                        document.getElementById("customer-wrap-" + elID).innerHTML = '';
                    }
                    else
                    {
                        document.getElementById("customer-wrap-" + elID).style.display = 'block';
                        const customers = new XMLHttpRequest();
                        customers.onload = function()
                        {
                            document.getElementById("customer-wrap-" + elID).innerHTML = this.responseText;
                        }
                        customers.open("GET", '{{ route('getCustomers') }}?id=' + elID + '&search=' + document.getElementById('customer-search-' + elID).value , true);
                        customers.send();
                    }

                }
            </script>
            <script>
                function searchItem()
                {
                    if(document.getElementById('search_input').value === '')
                    {
                        document.getElementById("list_search").classList.add('hidden');
                    }
                    else
                    {
                        document.getElementById("list_search").classList.remove('hidden');
                        document.getElementById("item_searchwrap").classList.add('hidden');
                        document.getElementById("list_search").classList.add('block');
                        const items = new XMLHttpRequest();
                        document.getElementById("loading_searchwrap").classList.remove('hidden');
                        document.getElementById("item_searchwrap").classList.add('hidden');
                        document.getElementById("loading_searchwrap").classList.add('block');
                        items.onload = function()
                        {
                            document.getElementById("item_searchwrap").classList.remove('hidden');
                            document.getElementById("loading_searchwrap").classList.remove('block');
                            document.getElementById("loading_searchwrap").classList.add('hidden');
                            document.getElementById("item_searchwrap").innerHTML = this.responseText;
                        }
                        items.open("GET", '{{ route('getItems') }}?search=' + document.getElementById('search_input').value , true);
                        items.send();
                    }

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
            <div style="left: 50%; right: 50%; text-align: center">
                {{ $items->links('vendor.pagination.bootstrap-52') }}
            </div>

        </div>
        <script>
            document.body.addEventListener('click', function ()
            {
                document.getElementById('list_search').classList.remove('show');
            });
        </script>
        <script>
            function addBackorder(elID)
            {
                // toastr.success('Please select customer')
                if (document.getElementById('customer-id-' + elID ).value === '')
                {
                    toastr.info('Please select customer')
                }
                if (document.getElementById('customer-id-' + elID ).value !== '')
                {
                @this.addBackorder(elID, document.getElementById('input-' + elID).value, document.getElementById('customer-id-' + elID).value);
                @this.load('add' + elID);
                    document.getElementById('customer-search-' + elID).value = '';

                }
            }
        </script>
        <script>
            document.body.addEventListener("click", function (evt) {
                document.getElementById("list_search").classList.add('hidden');

            });
        </script>



    </div>
</div>

