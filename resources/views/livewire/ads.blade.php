<div>
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Ads
    </h1>
    <div class="bg-white shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" >
            <div class="  py-12 2xl:px-20 md:px-6 px-4">
                <div x-data="{ open: false }">
                    <div class="flex justify-between">
                        <div></div>
                        <div>
                            <button class="btn" style="background-color: #0069ad; color: white" x-show="!open" @click="open = ! open">Upload new ad</button>
                        </div>
                    </div>
                    <span x-show="open" x-transition>
                        <form wire:submit.prevent="uploadAd">
{{--                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Select an option</label>--}}
{{--                            <select wire:model="type" wire:change="loadType" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">--}}
{{--                                <option value="1" selected>Item ad</option>--}}
{{--                                <option value="2">Event ad</option>--}}
{{--                            </select>--}}
{{--                            <br>--}}
                            @if($type == 1)
                                <div wire:loading.remove wire:target="loadType">
                                    <label for="countries" class="block mb-2 border-gray-300 text-sm font-medium text-gray-900">Search item</label>
                                    <input wire:model="searchstr" wire:keyup="searchItem" style="" id="search_input_ad" placeholder="Search item..." name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " autocomplete="false" type="search">
                                    <br>
                                    <div wire:loading.remove wire:target="addItem">
                                @foreach($itemArray as $item)
                                        @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())

                                        <div wire:click="addItem('{{ $item->ListID }}')" class="flex m-auto hover:bg-gray-100 cursor-pointer">
                                        @if($image!=null)
                                                <img style="width:50px" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" alt="">
                                            @else
                                                <img style="width:50px" class="card-img-top grayscale" src="https://www.ttistore.com/foto/tti-noimage.png" alt="NO Image">
                                            @endif
                                            {{ $item->Description }}
                                        </div>
                                        <br>
                                    @endforeach
                                    </div>
                                </div>
                                @if($itemID != null)
                                    @php($item = \App\Models\Item::query()->where('ListID', $itemID)->first())
                                    @php($itemImg = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itemID)->get()->first())
                                    <div class="flex justify-between">
                                        <div class="flex">
                                        @if($itemImg!=null)
                                                <img style="width:200px" src="https://www.ttistore.com/foto/{{$itemImg->image_id}}.dat" alt="">
                                            @else
                                                <img style="width:200px" class="card-img-top grayscale" src="https://www.ttistore.com/foto/tti-noimage.png" alt="NO Image">
                                            @endif
                                            <div class="pt-5">
                                                {{ $item->Description }}
                                            </div>

                                    </div>
                                        <div class="pt-5">
                                            <label class="block mb-2 text-sm font-medium text-gray-900">Upload product ad</label>
                                            <input wire:model="file1" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" accept="image/*" type="file" >
                                        </div>
                                    </div>
                                    <br>
                                @endif

                            @endif
                            @if($type == 2)
                                <div wire:loading.remove wire:target="loadType">

                                </div>
                                hello
                            @endif
                             <div class="flex justify-between">
                                    <div>
                                        <button type="button" @click="open = ! open" class="btn btn-danger bg-red-700">
                                            Cancel
                                        </button>
                                    </div>
                                            @if($file1 != null)
                                     <button class="btn" style="background-color: #0069ad; color: white">
                                        Save
                                    </button>
                                 @endif
                                </div>
                        </form>
                    </span>
                </div>

            </div>
            <div style="overflow-x: auto">
                <div style="overflow-x: auto">
                    <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 whitespace-nowrap " id="dataTable">
                        <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="py-3 px-6">
{{--                                Ad type--}}
                            </th>
                            <th class="py-3 px-6">
                               Name
                            </th>
                            <th class="py-3 px-6">
                                Delete
                            </th>
                            <th class="py-3 px-6">
                                Active
                            </th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($ads as $ad)
                            <tr style="color: black" class="bg-white border-b">
                                <td class="py-4 px-6" >
                                    <img src="{{ asset('storage/ads/' . $ad->fileName) }}" alt="" style="width: 150px">
{{--                                    {{ $ad->typeFullName }}--}}
                                </td>
                                <td class="py-4 px-6">
                                    @if($ad->type == 1)
                                        @php($item = \App\Models\Item::query()->where('ListID', $ad->prodID)->first())
                                    @endif
                                    {{ $item->Description }}
{{--                                    {{ $ad->fileName }}--}}
                                </td>
                                <td class="py-4 px-6">
                                    <button wire:click="deleteAd('{{ $ad->id }}')" class="btn btn-danger">
                                        Delete
                                    </button>
                                </td>
                                <td class="py-4 px-6">
                                    @if($ad->active == 0)
                                        <input wire:click="changeStatus({{$ad->id}})" id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    @else
                                        <input wire:click="changeStatus({{$ad->id}})" checked id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    @endif


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="  2xl:px-20 md:px-6 px-4">
                {{--                {{ $orders->links('vendor.pagination.bootstrap-52') }}--}}
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>
    <br>
    <script>
        function searchItemAd()
        {
            if(document.getElementById('search_input_ad').value === '')
            {
                document.getElementById("list_search_ad").classList.add('hidden');
            }
            else
            {
                document.getElementById("list_search_ad").classList.remove('hidden');
                document.getElementById("item_searchwrap_ad").classList.add('hidden');
                document.getElementById("list_search_ad").classList.add('block');
                const items = new XMLHttpRequest();
                document.getElementById("loading_searchwrap_ad").classList.remove('hidden');
                document.getElementById("item_searchwrap_ad").classList.add('hidden');
                document.getElementById("loading_searchwrap_ad").classList.add('block');
                items.onload = function()
                {
                    document.getElementById("item_searchwrap_ad").classList.remove('hidden');
                    document.getElementById("loading_searchwrap_ad").classList.remove('block');
                    document.getElementById("loading_searchwrap_ad").classList.add('hidden');
                    document.getElementById("item_searchwrap_ad").innerHTML = this.responseText;
                }
                items.open("GET", '{{ route('getItemsAds') }}?search=' + document.getElementById('search_input_ad').value , true);
                items.send();
            }

        }
    </script>
</div>
