<div>
    @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $id)->get()->first())
    @php($itemdesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
    @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $id)->get()->first())
    @php($image2 = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $id)->get())
    <div class="xl:w-2/5 md:w-1/2 lg:ml-8 md:ml-6 md:mt-0 mt-6">
        <div class="md:hidden">
            {{--                                <img class="w-full" style="width: 500px" alt="image of a girl posing" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" />--}}
            <div style="overflow-x: auto" class="flex items-center justify-center mt-3 space-x-4 md:space-x-0">
                @foreach($image2 as $i)
                    <div class="border">
                        <img class="w-full shadow-xl sm:rounded-lg" style="width: 500px" alt="image of a girl posing" src="https://www.ttistore.com/foto/{{$i->image_id}}.dat" />
                    </div>
                    {{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/cYDrVGh/Rectangle-245.png" />--}}
                    {{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/f17NXrW/Rectangle-244.png" />--}}
                    {{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/cYDrVGh/Rectangle-245.png" />--}}
                    {{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/f17NXrW/Rectangle-244.png" />--}}
                @endforeach
            </div>
        </div>
        <br>
        <div class="border" style="border-radius: 10px">
            <div style="padding-left: 15px">
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Name: {{ $item->Description }}</p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300"></p>
                        <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2dark.svg" alt="next">
                    </div>
                </div>
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Barcode: {{ $item->BarCodeValue }}</p>
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
                <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Description: {{ strip_tags($itemdesc->description) }}</p>
                    <div class="flex items-center justify-center">
                        <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3"></p>
                    </div>
                </div>
            </div>
        </div>
        <br>
{{--        <button class="btn-primary btn dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  text-base flex items-center justify-center  text-white  w-full py-4 hover:bg-gray-700 ">--}}
{{--            --}}{{--                                <img class="mr-3 dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">--}}
{{--            --}}{{--                                <img class="mr-3 hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">--}}
{{--            <h1>--}}
{{--                Add to Cart--}}
{{--            </h1>--}}
{{--        </button>--}}

    </div>

</div>
