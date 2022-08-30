<div style="min-width: 400px; max-width: 800px">
    @php($brands = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('filter_brand')->get())
    @php($brand_srch= 1)
    <aside class="w-full shadow-xl sm:rounded-lg">
        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">
            <div style="z-index: 5; overflow-y: auto;max-height: 700px;">
                <span style="font-family: sfsemibold; font-size: 35px" class="p-6">
                   Filters
                </span>
                <hr>
                <br>
                <div>
                    <h1 style="font-family: sflight; font-size: 20px">
                        Brand
                    </h1>
                    <select onchange="document.getElementById('searchform').submit()" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="brand" id="">
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
                <br>
                <hr>
                <br>
                <div>
                    Price range
                    <br>
                    <label for="">From:</label>
                    <input min="0" max="10000" onchange="document.getElementById('rangevaluemin').innerText = 'SRD ' + this.value" id="default-range" type="range" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    <span id="rangevaluemin">SRD 50</span>
                    <br>
                    <label for="">To:</label>
                    <input min="0" max="10000" onchange="document.getElementById('rangevaluemax').innerText = 'SRD ' + this.value" id="default-range" type="range" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    <span id="rangevaluemax">SRD 50</span>
                </div>
                <br>
                <div style="float: right;">
                    <button class="btn" style="background-color: #0069AD; color: white">
                        Apply filters
                    </button>
                </div>
            </div>
            <br>
{{--            @if($cartItemExist)--}}
{{--                <a href="{{ route('checkout') }}">--}}
{{--                    <button style="right: 0; background-color: #0069AD; color: white" class="btn">--}}
{{--                        Checkout--}}
{{--                    </button >--}}
{{--                </a>--}}
{{--                <button wire:loading.attr="disabled" wire:click="clearCart" class="btn btn-danger">--}}
{{--                    Clear cart--}}
{{--                </button>--}}
{{--            @endif--}}


        </div>
    </aside>
</div>
