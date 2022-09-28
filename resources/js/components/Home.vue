<template>
    <div>
        @php($brands = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('filter_brand')->get())
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg block 2xl:hidden">
            <div>
                <div class="block md:block lg:block xl:block 2xl:hidden" style=" padding-top: 10px; padding-bottom: 10px">
                    <button type="button" id="toggleFilters" class="btn w-full" style="background-color: #0069AD; height: 50px; right: 0; color: white">
                        Filters
                    </button>
                    <div style="padding-top: 10px; display: none" class="w-full " id="filters">
                        @livewire('filter')
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg hidden sm:block">
            <div id="itemWrap"  class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/spierbalsem.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/TP_Kola.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/TP_Essence.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/vaporub.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex">
                <h1 style="font-family: sfsemibold; font-size: 35px; color: #0069AD" class="p-6">
                    On sale
                </h1>
                <img src="{{ asset('onsale2.svg') }}" style=" opacity: 0.7; width: 80px;" alt="">
            </div>

            <div>
                <div id="itemWrap" style="overflow-x: auto" class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

                </div>
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="text-align: center">


                </div>

            </div>

        </div>
        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex">
                <h1 style="font-family: sfsemibold; font-size: 35px; color: #0069AD" class="p-6">
                    New Stock
                </h1>
            </div>
            <div>
                <div  style="overflow-x: auto" class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

                </div>
            </div>
        </div>
        <br>
        <div  class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex">
                <h1 style="font-family: sfsemibold; font-size: 35px; color: #0069AD" class="p-6">
                    Our most popular items
                </h1>
            </div>
            <div>
                <div  style="overflow-x: auto" class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

                </div>
            </div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="text-align: center">
                <button class="btn" style="background-color: #0069AD; color: white">
                        <span>
                            Show more
                        </span>
                    <img  style="width: 20px" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                </button>
            </div>
        </div>
        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex">
                <h1 style="font-family: sfsemibold; font-size: 35px; color: #0069AD" class="p-6">
                    We also have
                </h1>
            </div>
            <div>
                <div  style="overflow-x: auto" class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

                </div>
            </div>

        </div>
        <br>
        <div class=" overflow-hidden sm:rounded-lg" style="text-align: center">
            <a href="{{ route('dashboard') }}">
                <button style="background-color: #0069ad; color: white" class="w-3/4 rounded-lg">
                    <h1 style="font-family: sfsemibold; font-size: 35px;" class="p-6">
                        View all items
                    </h1>
                </button>
            </a>
        </div>

        <br>



        <br>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg sm:hidden">
            <div id="itemWrap"  class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/spierbalsem.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/TP_Kola.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/TP_Essence.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="card" style="width: auto;">
                    <div style="margin: auto">
                        <div class="card-body" style="position: relative">
                            <img src="{{ asset('ads/vaporub.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="overflow-hidden sm:rounded-lg sm:hidden" style="text-align: center">
            <a href="{{ route('dashboard') }}">
                <button style="background-color: #0069ad; color: white" class="w-3/4 rounded-lg">
                    <h1 style="font-family: sfsemibold; font-size: 35px;" class="p-6">
                        View all items
                    </h1>
                </button>
            </a>
        </div>

    </div>
</template>
<script>

</script>
