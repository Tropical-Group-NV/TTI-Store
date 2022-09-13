<div style="font-family: sfsemibold">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="" class="items-start justify-center sm:py-12 sm:px-4 md:px-6  2xl:px-20">
            <div class="">
                <div class="">
                    <div style="overflow-x: auto">
                        <div style="overflow-x: auto" class="">
                            <div class="product">
                                <div class="product__images">
                                    <img
                                        src="https://www.ttistore.com/foto/{{ $images->first()->image_id }}.dat"
                                        alt="google pixel 6"
                                        class="product__main-image"
                                        id="main-image"
                                    />
                                    <div class="product__slider-wrap">
                                        <div class="product__slider">
                                            @foreach($images as $i)
                                                <img
                                                    src="https://www.ttistore.com/foto/{{$i->image_id}}.dat"
                                                    class="product__image"
                                                />
                                            @endforeach
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
                    <div class="border" style="border-radius: 10px; font-family: sfsemibold">
                        <div style="padding-left: 15px">
                            <div class="py-4 border-b border-gray-200">
                                <p class=text-gray-800" style="font-size: 30px; font-family: sfsemibold; white-space: normal">{{ $item->Description }} <b></b></p>
                                <br>
                                <p class="text-base leading-4 text-gray-800"><b>{{ $item->BarCodeValue }}</b></p>
                            </div>
                            <div class="py-4 border-b border-gray-200">
                                @if(\Illuminate\Support\Facades\Auth::user() != null or \Illuminate\Support\Facades\Auth::user()->user_type_id != 3)
                                <p class="text-base leading-4 text-gray-800" style="font-size: 25px">Sale price: <span style="color: #0069ad">SRD {{ substr($item->SalesPrice, 0, -3) }}</span></p>
                                <br>
                                @endif
                                <p class="text-base leading-4 text-gray-800 " style="font-size: 25px">Retail price: <span style="color: #0069ad">SRD {{ substr($item->CustomBaliPrice, 0, -3) }}</span></p>
                            </div>
                            <div class="py-4 border-b border-gray-200 ">
                                <p class="text-base leading-4 text-gray-800">{!! $itemdesc->description !!}  </p>
                                <div class="flex items-center justify-center">
                                    <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3"></p>
                                </div>
                            </div>
                            @if($item->QuantityOnHand > 0)
                                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                                    <p class="text-base leading-4 text-green-600">In stock: {{  substr($item->QuantityOnHand, 0, -6) }}</p>
                                </div>
                            @else
                                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                                    <p class="text-base leading-4 text-red-600">Out of stock</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::user() != null)
                            @if(\App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->exists())
                                <button disabled style="background-color: green" class="btn text-base flex items-center justify-center text-white w-full py-4">
                                    <h1>
                                        Added to cart
                                    </h1>
                                </button>
                            @else
                                @if($item->QuantityOnHand > 0)
                                    <h1 style="font-family: sfsemibold">Select quantity:</h1>
                                    <br>
                                    <div class="border-2 border-black" style="border-color: #0069AD; border-radius: 20px">
                                        <select style="border-radius: 20px" class=" btn focus:outline-none focus:ring-2 focus:ring-offset-2 outline-black text-base flex items-center justify-center  w-full" id="input-{{ $item->ListID }}" name="qty">
                                            @php($count=0)
                                            @while($count != 1000)
                                                @php($count++ )
                                                <option value="{{ $count }}">{{ $count }}</option>
                                            @endwhile
                                        </select>
                                    </div>

                                    <br>
                                    <button wire:loading.attr="disabled" wire:click="addToCart( '{{ $item->ListID }}', document.getElementById('input-{{ $item->ListID }}').value)" style="background-color: #0069AD" class="btn dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  text-base flex items-center justify-center  text-white  w-full py-4 hover:bg-gray-700 ">
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
                                        <select style="border-radius: 20px" class=" btn focus:outline-none focus:ring-2 focus:ring-offset-2 outline-black text-base flex items-center justify-center  w-full" id="input-{{ $item->ListID }}" name="qty">
                                            @php($count=0)
                                            @while($count != 1000)
                                                @php($count++ )
                                                <option value="{{ $count }}">{{ $count }}</option>
                                            @endwhile
                                        </select>
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
