<div style="min-width: 350px;">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 10000,
                values: [ 0, 10000 ],
                slide: function( event, ui ) {
                    // $( "#amount" ).val( "SRD" + ui.values[ 0 ] + " - SRD" + ui.values[ 1 ] );
                    $( "#min" ).val( "SRD" + ui.values[ 0 ]);
                    $( "#max" ).val( "SRD" + ui.values[ 1 ]);
                }
            });
            $( "#min" ).val( "SRD" + $( "#slider-range" ).slider( "values", 0 )  );
            $( "#max" ).val( "SRD" + $( "#slider-range" ).slider( "values", 1 )  );
            // $( "#min" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ));
        } );
    </script>

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
                    <h1 style="font-family: sflight; font-size: 20px">
                        Price range
                    </h1>
                    <br>
                    <p>
                        <input type="text" id="min" readonly style="border:0; font-weight:bold;">
                        <br>
                        <input type="text" id="max" readonly style="border:0; font-weight:bold;">
                    </p>

                    <div id="slider-range"></div>
{{--                    <label for="">From:</label>--}}
{{--                    <input min="0" max="10000" onchange="document.getElementById('rangevaluemin').innerText = 'SRD ' + this.value" type="range" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">--}}
{{--                    <span id="rangevaluemin">SRD 50</span>--}}
{{--                    <br>--}}
{{--                    <label for="">To:</label>--}}
{{--                    <input min="0" max="10000" onchange="document.getElementById('rangevaluemax').innerText = 'SRD ' + this.value" type="range" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">--}}
{{--                    <span id="rangevaluemax">SRD 50</span>--}}
                </div>
                <br>
                <hr>
                <br>
                <div>
                    <h1 style="font-family: sflight; font-size: 20px">
                        Unit
                    </h1>
                    <br>
                    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="" id="">
                        <option value="Tray á 6 stuks">Tray á 6 stuks</option>
                        <option value="Tray á 12 stuks">Tray á 12 stuks</option>
                        <option value="Stuks">Stuks</option>
                        <option value="Pak">Pak</option>
                        <option value="Volume by the Liter">Volume by the Liter</option>
                        <option value="Weight by the kilogram">Weight by the kilogram</option>
                        <option value="Per Rol">Per Rol</option>
                        <option value="Pak @ 3 stuks">Pak @ 3 stuks</option>
                        <option value="Pak @ 20 stuks">Pak @ 20 stuks</option>
                        <option value="Pak @ 80 stuks">Pak @ 80 stuks</option>
                        <option value="Pak @ 60 stuks">Pak @ 60 stuks</option>
                        <option value="Pak @ 100 stuks">Pak @ 100 stuks</option>
                    </select>
                </div>
                <br>
                <hr>
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
