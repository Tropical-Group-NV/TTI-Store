<div style="min-width: 350px;">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{--    <link rel="stylesheet" href="{{ asset('css/jquery_ui/custom.css') }}">--}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 10000,
                @if(isset($_REQUEST['brand']))
                values: [ '{{ $_REQUEST['min'] }}', '{{ $_REQUEST['max'] }}' ],
                @else
                values: [ 0, 10000 ],
                @endif
                slide: function( event, ui ) {
                    // $( "#amount" ).val( "SRD" + ui.values[ 0 ] + " - SRD" + ui.values[ 1 ] );
                    $( "#min" ).text( "SRD " + ui.values[ 0 ]);
                    $( "#min-value" ).val(ui.values[ 0 ]);
                    $( "#max" ).text( "SRD " + ui.values[ 1 ]);
                    $( "#max-value" ).val( ui.values[ 1 ]);
                    {{--                    @if(isset($_REQUEST['brand']))--}}
                    {{--                    $( "#min" ).text( "SRD " + '{{ $_REQUEST['min'] }}');--}}
                    {{--                    $( "#min-value" ).val('{{ $_REQUEST['min'] }}');--}}
                    {{--                    $( "#max" ).text( "SRD " + '{{ $_REQUEST['max'] }}');--}}
                    {{--                    $( "#max-value" ).val( '{{ $_REQUEST['max'] }}');--}}
                    {{--                    @else--}}
                    {{--                    $( "#min" ).text( "SRD " + ui.values[ 0 ]);--}}
                    {{--                    $( "#min-value" ).val(ui.values[ 0 ]);--}}
                    {{--                    $( "#max" ).text( "SRD " + ui.values[ 1 ]);--}}
                    {{--                    $( "#max-value" ).val( ui.values[ 1 ]);--}}
                    {{--                    @endif--}}

                }
            });
            // $( "#min" ).text( "SRD " + $( "#slider-range" ).slider( "values", 0 )  );
            // $( "#min-value" ).val( $( "#slider-range" ).slider( "values", 0 )  );
            // $( "#max" ).text( "SRD " + $( "#slider-range" ).slider( "values", 1 )  );
            // $( "#max-value" ).val( $( "#slider-range" ).slider( "values", 1 )  );
            @if(isset($_REQUEST['brand']))
            $( "#min" ).text( "SRD " + '{{ $_REQUEST['min'] }}'  );
            $( "#min-value" ).val( '{{ $_REQUEST['min'] }} ' );
            $( "#max" ).text( "SRD " + '{{ $_REQUEST['max'] }}'   );
            $( "#max-value" ).val( '{{ $_REQUEST['max'] }}'  );
            @else
            $( "#min" ).text( "SRD " + $( "#slider-range" ).slider( "values", 0 )  );
            $( "#min-value" ).val( $( "#slider-range" ).slider( "values", 0 )  );
            $( "#max" ).text( "SRD " + $( "#slider-range" ).slider( "values", 1 )  );
            $( "#max-value" ).val( $( "#slider-range" ).slider( "values", 1 )  );
            @endif

            // $( "#min" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ));
        } );
    </script>

    <form method="GET" action="">
        <aside class="w-full border border-black shadow-xl sm:rounded-lg">
            <div class="overflow-y-auto py-4 px-3 bg-gray-50">
                <div style="z-index: 5;max-height: 700px;">
                <span style="font-family: sfsemibold; font-size: 35px" class="p-6 hidden md:hidden lg:block">
                   Filters
                </span>
                    <br class="hidden md:hidden lg:block">
                    <hr class="hidden md:hidden lg:block">
                    <br class="hidden md:hidden lg:block">
                    <div>
                        <h1  style="font-family: sflight; font-size: 20px">
                            Brand
                        </h1>
                        <select @if(isset($_REQUEST['brand'])) @endif class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="brand" id="brand">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                @if(isset($_REQUEST['brand']) == $brand->name)
                                    <option selected value="{{ $brand->name }}">{{ $brand->name }}</option>
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
                            Branch
                        </h1>
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="branch" id="branch">
                            <option name="branch" value="">Select Branch</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->CustomFieldBranch }}">{{ $branch->CustomFieldBranch }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="">
                        <h1 style="font-family: sflight; font-size: 20px">
                            Price range
                        </h1>
                        <br>
                        <p>

                        </p>
                        <div style="padding-left: 20px; padding-right: 20px">
                            <div id="slider-range"></div>
                        </div>
                        <div style="padding-left: 20px; padding-right: 20px" class="flex">
                            <span id="min" style="border:0; font-weight:bold; padding-right: 20px; width: 120px"></span>
                            <input type="hidden" id="min-value" name="min">
                            <span style="border:0; font-weight:bold; padding-right: 20px; width: 50px">-</span>
                            <span  id="max" style="border:0; font-weight:bold; padding-right: 20px; width: 120px"></span>
                            <input type="hidden" id="max-value" name="max">
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div>
                        <h1 style="font-family: sflight; font-size: 20px">
                            Unit
                        </h1>
                        <br>
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="unit" id="unit">
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
                    <div style="float: left;">
                        <button class="btn" style="background-color: #0069AD; color: white">
                            Apply filters
                        </button>
                    </div>
                    <div style="float: right;">
                        <button type="button" onclick="document.getElementById('filters').style.display = 'none'; document.getElementById('toggleFilters').style.display = 'block'" class="btn" style="background-color: #0069AD; color: white">
                            Close
                        </button>
                    </div>
                </div>
                <br>
            </div>
        </aside>
    </form>
    <script>
        @if(isset($_REQUEST['unit']))
        document.getElementById('unit').value = '{{ $_REQUEST['unit'] }}';
        @endif
        @if(isset($_REQUEST['brand']))
        document.getElementById('brand').value = '{{ $_REQUEST['brand'] }}';
        @endif
        @if(isset($_REQUEST['branch']))
        document.getElementById('brand').value = '{{ $_REQUEST['branch'] }}';
        @endif
        @if(isset($_REQUEST['search']))
        document.getElementById('search').value = '{{ $_REQUEST['search'] }}';
        @endif
    </script>
</div>
