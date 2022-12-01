<div style="font-family: sfsemibold">
    @auth()
        @php($retail = 0)
        @if(Auth::user()->users_type_id == 3)
            @php($customerAccount = \App\Models\UserCustomer::query()->where('user_id', Auth::user()->id)->first())
            @php($QbCustomer = \App\Models\QbCustomer::query()->where('ListID', $customerAccount->customer_ListID)->first())
            @if($QbCustomer->PriceLevelRefFullName == 'Retail')
                @php($retail = 1)
            @endif
        @endif
    @endauth
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="" class="items-start justify-center sm:py-12 sm:px-4 md:px-6  2xl:px-20">
            <div class="">
                <button class="btn btn-primary" onclick="window.location.href = '{{ route('dashboard') }}'">
                    <i class="fa fa-arrow-left"></i>
                    Go back
                </button>
                <div class="block md:flex">
                    <div style="overflow-x: auto">
                        <div style="overflow-x: auto" class="w-full">
                            <div class="product">
                                <div class="product__images">
                                    <img style="width: 100%"
                                         @if($imagesExists)
                                             src="https://www.ttistore.com/foto/{{ $images->first()->image_id }}.dat"
                                         @else
                                             src="https://www.ttistore.com/foto/tti-noimage.png"
                                         @endif

                                        class=" w-full"
                                        id="main-image"
                                    />
                                    <div class="product__slider-wrap">
                                        <div class="product__slider">
                                            @if($imagesExists)
                                                @foreach($images as $i)

                                                @endforeach
                                            @else
                                                <img
                                                    src="https://www.ttistore.com/foto/tti-noimage.png"
                                                    class="product__image"
                                                />
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            const mainImage = document.getElementById("main-image");
                            const images = document.querySelectorAll(".product__image");

                            images.forEach((image) => {
                                image.addEventListener("mouseover", (event) => {
                                    mainImage.src = event.target.src;

                                    document
                                        .querySelector(".product__image--active")
                                        .classList.remove("product__image--active");

                                    event.target.classList.add("product__image--active");
                                });
                            });
                        </script>
                    </div>
                    <br>
                    <div class="" style="border-radius: 10px; font-family: sfsemibold">
                        <div style="padding-left: 15px">
                            <div class="py-4 border-b border-gray-200">
                                <p class=text-gray-800" style="font-size: 30px; font-family: sfsemibold; white-space: normal">{{ $item->Description }} <b></b></p>
                                <br>
                                <p class="text-base leading-4 text-gray-800"><b>{{ $item->FullName }}</b></p>
                            </div>
                            <div class="py-4 border-b border-gray-200 ">
                                @if(session()->has('currency'))
                                    <p class="text-base leading-4 text-gray-800">{!! $itemdesc->english_description !!}  </p>
                                @else
                                    <p class="text-base leading-4 text-gray-800">{!! $itemdesc->description !!}  </p>
                                @endif
                                <div class="flex items-center justify-center">
                                    <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3"></p>
                                </div>
                            </div>
                            <div class="py-4 border-b border-gray-200 ">
                                @if(\Illuminate\Support\Facades\Auth::user() != null and $retail != 1)

                                    @if(session()->has('currency'))
                                        <span>Sales price: {{ session()->get('currency') }} <b style="color: #0069ad; font-size: 30px">{{ number_format($item->SalesPrice / session()->get('exchangeRate'), 2) }}</b></span>
                                    @else
                                        <span>Sales price: SRD <b style="color: #0069ad; font-size: 30px">{{ substr($item->SalesPrice, 0, -3) }}</b></span>
                                    @endif
                                    <br>

                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user() != null and \Illuminate\Support\Facades\Auth::user()->users_type_id == '3' and $retail == 1 or \Illuminate\Support\Facades\Auth::user() != null and \Illuminate\Support\Facades\Auth::user()->users_type_id != '3' or \Illuminate\Support\Facades\Auth::user() == null)
                                    @if(session()->has('currency'))
                                        <span style="padding-top: 10px">Retail price:  {{ session()->get('currency') }} <b style="color: #0069ad; font-size: 20px">{{ number_format($item->CustomBaliPrice / session()->get('exchangeRate'), 2) }}</b></span>
                                    @else
                                        <span style="padding-top: 10px">Retail price: SRD <b style="color: #0069ad; font-size: 20px">{{ substr($item->CustomBaliPrice, 0, -3) }}</b></span>
                                    @endif
                                    <br>
                                @endif
                            </div>
                            <div class="py-4 border-b border-gray-200">
                                <span style="padding-top: 10px" class="text-base leading-4">Unit: <b>{{ $item->UnitOfMeasureSetRefFullName }}</b></span>
                            </div>
                            @if($item->QuantityOnHand - $item->QuantityOnSalesOrder > 0)
                                <div class="py-4  border-gray-200 items-center justify-between">
                                    <p class="text-base leading-4 text-green-600">In stock @auth
                                            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3 and \Illuminate\Support\Facades\Auth::user()->users_type_id != 7)
                                                {{  $item->QuantityOnHand - $item->QuantityOnSalesOrder }}
                                            @endif
                                        @endauth</p>
                                </div>
                            @else
                                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                                    <p class="text-base leading-4 text-red-600">Out of stock</p>
                                </div>
                            @endif
                        </div>
                        <br>
                        <div class="px-8 leading-4 ">
                            @if(\Illuminate\Support\Facades\Auth::user() != null)
                                @if(\App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->exists())
                                    <button disabled style="background-color: green" class="btn text-base flex items-center justify-center text-white w-full py-4">
                                        <h1>
                                            Added to cart
                                        </h1>
                                    </button>
                                @else
                                    @if($item->QuantityOnHand - $item->QuantityOnSalesOrder > 0)
                                        <h1 style="font-family: sfsemibold">Select quantity:</h1>
                                        <br>
                                        <div class="border-2 border-black" style="border-color: #0069AD; border-radius: 20px">
                                            <input value="1" type="number" style="border-radius: 20px" class=" focus:outline-none focus:ring-2 focus:ring-offset-2 outline-black text-base flex items-center justify-center  w-full" id="input-{{ $item->ListID }}" name="qty"/>
                                        </div>

                                        <br>
                                        <button wire:loading.attr="disabled" wire:click="addToCart( '{{ $item->ListID }}', document.getElementById('input-{{ $item->ListID }}').value)" style="background-color: #0069AD" class="btn text-base flex items-center justify-center text-white w-full py-4">
                                            <img wire:loading style="width: 40px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                            <h1  wire:loading.remove>
                                                Add to Cart
                                            </h1>
                                        </button>
                                    @else
                                        @if(\Illuminate\Support\Facades\Auth::user()->users_type_id != 3)
                                            <h1 style="font-family: sfsemibold">Select customer:</h1>
                                            <input type="hidden" id="customer-id-{{ $item->ListID }}">
                                            <input placeholder="Search Customers" class="form-control block appearance-none  border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" id="customer-search-{{ $item->ListID }}" onkeyup="searchCustomer('{{ $item->ListID }}')">
                                            <div style="position: absolute; z-index: 1000; min-width: 300px; display: none" class="bg-gray-50 border" id="customer-wrap-{{ $item->ListID }}">
                                            </div>
                                            <br>
                                        @else
                                            @php($customerAccount = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_customer')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first())
                                            <input type="hidden" id="customer-id-{{ $item->ListID }}" value="{{ $customerAccount->customer_ListID }}">
                                        @endif
                                        <h1 style="font-family: sfsemibold">Select quantity:</h1>
                                        <div class="border-2 border-black" style="border-color: #0069AD; border-radius: 20px">
                                            <input type="number" style="border-radius: 20px" class="focus:outline-none focus:ring-2 focus:ring-offset-2 outline-black text-base flex items-center justify-center  w-full" id="input-{{ $item->ListID }}" name="qty"/>

                                        </div>

                                        <br>
                                        <button onclick="addBackorder('{{ $item->ListID }}', )" wire:loading.attr="disabled"  style="background-color: #0069AD" class="btn dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  text-base flex items-center justify-center  text-white  w-full py-4 hover:bg-gray-700 ">
                                            <img wire:loading style="width: 40px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                                            <h1  wire:loading.remove>
                                                Add backorder
                                            </h1>
                                        </button>
                                    @endif

                                @endif
                            @endif
                        </div>
                    </div>
                    <br>




                </div>


            </div>
        </div>
    </div>
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
                document.getElementById('customer-search-' + elID).value = '';
            }
        }
    </script>

{{--    <script>--}}
{{--        window.addEventListener('addedcart', (e) => {--}}
{{--            toastr.success("Added to Cart")--}}
{{--        });--}}
{{--        window.addEventListener('removedcart', (e) => {--}}
{{--            toastr.warning("Removed from Cart")--}}
{{--        });--}}
{{--        window.addEventListener('clearcart', (e) => {--}}
{{--            toastr.warning("Cart cleared")--}}
{{--        });--}}
{{--        window.addEventListener('qtyupdate', (e) => {--}}
{{--            toastr.info("Updated Quantity")--}}
{{--        });--}}
{{--        window.addEventListener('addedbo', (e) => {--}}
{{--            toastr.success("Created Backorder")--}}
{{--        });--}}
{{--    </script>--}}


</div>
