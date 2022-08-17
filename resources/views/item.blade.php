<x-app-layout>
    {{--    @livewire('counter')--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>
    @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $id)->get()->first())
    @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $id)->get()->first())

    <div class="py-12">
        <ul class="flex">
            {{--            <nav id="sidebarMenu" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
            {{--                <div class="position-sticky">--}}
            {{--                    <div class="list-group list-group-flush mx-3 mt-4">--}}
            {{--                        <a--}}
            {{--                            href="#"--}}
            {{--                            class="list-group-item list-group-item-action py-2 ripple"--}}
            {{--                            aria-current="true"--}}
            {{--                        >--}}
            {{--                            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>--}}
            {{--                        </a>--}}
            {{--                        --}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </nav>--}}
            <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                        <div class="xl:w-2/5 md:w-1/2 lg:ml-8 md:ml-6 md:mt-0 mt-6">
                            <div class="md:hidden">
                                <img class="w-full" style="width: 500px" alt="image of a girl posing" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" />
                                <div class="flex items-center justify-between mt-3 space-x-4 md:space-x-0">
{{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/cYDrVGh/Rectangle-245.png" />--}}
{{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/f17NXrW/Rectangle-244.png" />--}}
{{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/cYDrVGh/Rectangle-245.png" />--}}
{{--                                    <img alt="image-tag-one" class="md:w-48 md:h-48 w-full" src="https://i.ibb.co/f17NXrW/Rectangle-244.png" />--}}
                                </div>
                            </div>
                            <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                                <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Price</p>
                                <div class="flex items-center justify-center">
                                    <p class="text-sm leading-none text-gray-600 dark:text-gray-300">SRD {{ substr($item->SalesPrice, 0, -3) }}</p>
                                    <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/productDetail3-svg2dark.svg" alt="next">
                                </div>
                            </div>
                            <div class="py-4 border-b border-gray-200 flex items-center justify-between">
                                <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Quantity</p>
                                <div class="flex items-center justify-center">
                                    <p class="text-sm leading-none text-gray-600 dark:text-gray-300 mr-3">{{  substr($item->QuantityOnHand, 0, -6) }} PCs</p>
                                </div>
                            </div>
                            <button class="btn-primary btn dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  text-base flex items-center justify-center  text-white  w-full py-4 hover:bg-gray-700 ">
{{--                                <img class="mr-3 dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1.svg" alt="location">--}}
{{--                                <img class="mr-3 hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/svg1dark.svg" alt="location">--}}
                                <h1>
                                    Add to Cart
                                </h1>
                            </button>
                            <br>
                            <div>
                                <ul>
                                    <li>
                                        <p class="xl:pr-48 text-base lg:leading-tight leading-normal text-gray-600 dark:text-gray-300 mt-7">Description: {{ $item->Description }}</p>
                                    </li>
                                    <br>
                                    <li>
                                        <p class="text-base leading-4 mt-7 text-gray-600 dark:text-gray-300">Barcode: {{ $item->BarCodeValue }}</p>
                                    </li>
                                </ul>

{{--                                <p class="text-base leading-4 mt-4 text-gray-600 dark:text-gray-300">Length: 13.2 inches</p>--}}
{{--                                <p class="text-base leading-4 mt-4 text-gray-600 dark:text-gray-300">Height: 10 inches</p>--}}
{{--                                <p class="text-base leading-4 mt-4 text-gray-600 dark:text-gray-300">Depth: 5.1 inches</p>--}}
{{--                                <p class="md:w-96 text-base leading-normal text-gray-600 dark:text-gray-300 mt-4">Composition: 100% calf leather, inside: 100% lamb leather</p>--}}
                            </div>

                    </div>



                    {{--                    @livewire('items')--}}

                </div>
            </div>
        </ul>


    </div>
</x-app-layout>
