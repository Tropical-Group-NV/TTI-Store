<div>}
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
                        image.addEventListener("click", (event) => {
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
        <div class="border" style="border-radius: 10px">
            <div style="padding-left: 15px">
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300"> <b>{{ $item->Description }}</b></p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300"></p>
                        <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2dark.svg" alt="next">
                    </div>
                </div>
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300"><b>{{ $item->BarCodeValue }}</b></p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300"></p>
                        <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2dark.svg" alt="next">
                    </div>
                </div>
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Price: SRD {{ substr($item->SalesPrice, 0, -3) }}</p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300"></p>
                        <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2dark.svg" alt="next">
                    </div>
                </div>
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Quantity: {{  substr($item->QuantityOnHand, 0, -6) }} PCs</p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3"></p>
                    </div>
                </div>
                <div class="py-4 border-b border-gray-200 ">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300">{!! $itemdesc->description !!}  </p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3"></p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div>
            @if(\Illuminate\Support\Facades\Auth::user() != null)
            @if(\App\Models\CartItem::query()->where('prod_id', $item->ListID)->where('uid', \Illuminate\Support\Facades\Auth::user()->id)->exists())
                <button disabled style="background-color: #0069AD" class="btn-primary btn dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  text-base flex items-center justify-center  text-white  w-full py-4 hover:bg-gray-700 ">
                    {{--                <img class="mr-3 dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">--}}
                    {{--                <img class="mr-3 hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">--}}
                    <h1>
                        Added to cart
                    </h1>
                </button>
            @else
                <h1 style="font-family: sfsemibold">Select quantity:</h1>
                <br>
                <div class="border-2 border-black" style="border-color: #0069AD; border-radius: 20px">
                    <select style="border-radius: 20px" class=" btn focus:outline-none focus:ring-2 focus:ring-offset-2 outline-black text-base flex items-center justify-center  w-full" @if($item->QuantityOnHand <= 0) disabled @endif id="input-{{ $item->ListID }}" name="qty">
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
                </div>

                <br>
                <button wire:loading.attr="disabled" wire:click="addToCart( '{{ $item->ListID }}', document.getElementById('input-{{ $item->ListID }}').value)" style="background-color: #0069AD" class="btn-primary btn dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  text-base flex items-center justify-center  text-white  w-full py-4 hover:bg-gray-700 ">
                    <img wire:loading style="width: 40px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">

                    {{--                                            <img class="mr-3 dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">--}}
                    {{--                                            <img class="mr-3 hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">--}}
                    <h1  wire:loading.remove>
                        Add to Cart
                    </h1>
                </button>

            @endif
            @endif
        </div>



    </div>

</div>
