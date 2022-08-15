<br><br>

<form action="">
    @if(isset($_REQUEST['search']))
        <input value="{{ $_REQUEST['search'] }}" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text">

    @else
        <input value="" placeholder="Search..." name="search" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text">

    @endif
</form>
{{--{{ print_r($_REQUEST) }}--}}
<br><br>


<div class="bg-gray-200 bg-opacity-25 grid grid-cols-4 md:grid-cols-3">

    @foreach($items as $item)
        @php($itemDesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $item->ListID)->get()->first())
        @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $item->ListID)->get()->first())
        <div class="card" style="width: auto;">
            <ul class="border-top flex justify-between" style="bottom: 0; padding: 20px">
                    <li> <span style="padding-top: 10px">Price: SRD <b>{{ substr($item->SalesPrice, 0, -3) }}</b></span>
                        <br>
                        @if($item->QuantityOnHand != '.00000')
                        Quantity: <b>{{  substr($item->QuantityOnHand, 0, -6) }} PCs</b>
                        @else
                            Quantity: <b>0 PCS</b>
                        @endif
                    </li>
{{--                <button class="btn btn-primary" id="add:{{ $item->ListID }}" onclick="added('add:{{ $item->ListID }}')">Add to Cart</button>--}}
{{--                <button class="btn btn-primary" id="add:{{ $item->ListID }}" onclick="added('add:{{ $item->ListID }}')">Add to Cart</button>--}}
                <div>
                    <button wire:click="increment" class="btn btn-primary"><p wire:loading.remove>Add to cart</p>
                        {{--                    <div style="display: none" wire:loading.show wire:target="increment">--}}
                        <img wire:loading.show style="width: 20px;display: none" src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif">
                        {{--                    </div>--}}
                    </button>
                </div>

            </ul>

            @if($image != null)
            <img class="card-img-top" src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" alt="Card image cap">
            @endif
            <div class="card-body" style="position: relative">
                <h5 class="card-title">{{ $item->Description }}</h5>
                @if($itemDesc != null)
                <span id="item:{{ $item->ListID }}" class="card-text">{{ strip_tags($itemDesc->description)  }}</span>
                @endif
            </div>
        </div>
    @endforeach
        <script>
            function added(id)
            {
                var addButton = document.getElementById(id);
                if(addButton.innerText === 'Remove from Cart')
                {
                    addButton.innerText = 'Add to Cart';
                }
                else
                {
                    addButton.innerText = 'Remove from Cart';
                }
            }
        </script>

</div>

<div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="text-align: center">
    <div style="left: 50%; right: 50%">
        {{ $items->links('vendor.pagination.bootstrap-4') }}
    </div>

</div>
