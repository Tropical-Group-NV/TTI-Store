<div style="min-width: 300px; z-index: 1200">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <form method="GET" action="{{ route('dashboard') }}">
        @isset($_REQUEST['search'])
            <input type="hidden" name="search" value="{{$_REQUEST['search']}}">
        @endisset
        <aside class="w-full border border-black shadow-xl sm:rounded-lg">
            <div class="overflow-y-auto py-4 px-3 bg-gray-50">
                <button type="button" class="block 2xl:hidden" style="position: relative; z-index: 1000" onclick="document.getElementById('filters').style.display = 'none'; document.getElementById('toggleFilters').style.display = 'block'" data-modal-toggle="shoppingCart">
                    <img style="width: 30px" src="https://www.svgrepo.com/show/273966/close.svg">
                </button>
                <div style="z-index: 5;max-height: 700px;">
                <span style="font-family: sfsemibold; font-size: 20px" class="p-6 hidden md:hidden lg:block">
                   Filters
                    <i style="color: #0069ad" class="fa fa-filter" aria-hidden="true"></i>
                </span>
                    <br class="hidden md:hidden">
                    <hr class="hidden md:hidden lg:block">
                    <br class="hidden md:hidden lg:block">
                    <div>
                        <h1  style="font-family: sflight; font-size: 20px">
                            Total Items per Page
                        </h1>
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="totalpage" id="totalpage">
                            <option value="24">24</option>
                            <option value="48">48</option>
                            <option value="96">96</option>
                            <option value="120">120</option>
                        </select>
                    </div>
                    <br>
                    <hr>
                    <br>
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
                                @php($put = 1)
                                @php($currentPrivateBranch = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('settings_branch_view_item_on_user')->where('branch', $branch->CustomFieldBranch)->get())
                                @foreach($currentPrivateBranch as $pb)
                                    @php($put = 0)
                                @if(\Illuminate\Support\Facades\Auth::user() != null)
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $pb->user_id)
                                        @php($put = 1)
                                        @break(1)
                                    @endif
                                    @endif
                                @endforeach
                                @if($put == 1)
                                <option value="{{ $branch->CustomFieldBranch }}">{{ $branch->CustomFieldBranch }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <hr>
{{--                    <br>--}}
{{--                    <div class="">--}}
{{--                        <h1 style="font-family: sflight; font-size: 20px">--}}
{{--                            Price range--}}
{{--                        </h1>--}}
{{--                        <br>--}}
{{--                        <p>--}}

{{--                        </p>--}}
{{--                        <div style="padding-left: 20px; padding-right: 20px">--}}
{{--                            <div id="slider-range"></div>--}}
{{--                        </div>--}}
{{--                        <div style="padding-left: 20px; padding-right: 20px" class="flex">--}}
{{--                            <span id="min" style="border:0; font-weight:bold; padding-right: 20px; width: 120px"></span>--}}
{{--                            <input type="hidden" id="min-value" name="min">--}}
{{--                            <span style="border:0; font-weight:bold; padding-right: 20px; width: 50px">-</span>--}}
{{--                            <span  id="max" style="border:0; font-weight:bold; padding-right: 20px; width: 120px"></span>--}}
{{--                            <input type="hidden" id="max-value" name="max">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <hr>--}}
                    <br>
                    <div>
                        <h1 style="font-family: sflight; font-size: 20px">
                            Unit
                        </h1>
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 form-control btn-group" name="unit" id="unit">
                            <option value="">Select Unit</option>
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
                    @if(isset($_REQUEST['totalpage']) or isset($_REQUEST['brand']) or isset($_REQUEST['branch']) or isset($_REQUEST['unit']))
                        <div class="block 2xl:block" style="float: left;">
                            <a href="{{ route('dashboard') }}" class="btn btn-danger">
                                Clear filters
                            </a>
                        </div>
                    @endif
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
        document.getElementById('branch').value = '{{ $_REQUEST['branch'] }}';
        @endif
        @isset($_REQUEST['totalpage'])
        document.getElementById('totalpage').value = '{{ $_REQUEST['totalpage'] }}';
        @endisset
    </script>
</div>
