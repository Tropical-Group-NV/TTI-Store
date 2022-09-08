@php($list =  \Illuminate\Support\Facades\DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $search . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $search . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get())
@foreach($list as $itm)
    @if(is_array($itm))
        @if($itm != null)
            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm['ListID'])->get()->first())
            @if($image != null)
                {{--                                                <a href="#" onclick="document.getElementById('searchform').value = '{{ $itm['Description'] }} }}';document.getElementById('searchform').submit()">--}}
                <a href="{{ route('item', $itm['ListID']) }}" >
                    <ul class="flex hover:bg-gray-50 cursor-pointer">
                        <img src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px" alt="">
                        <h1>{{ $itm['Description'] }}</h1>
                    </ul>
                </a>
                <hr>
                <br>
            @endif
        @endif

    @else

        @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm->ListID)->get()->first())
        @if($image != null)
            {{--                                            <a href="#" onclick="document.getElementById('searchform').value = '{{ $itm->Description }}';document.getElementById('searchform').submit()">--}}
            <a href="{{ route('item', $itm->ListID) }}">
                <ul class="flex hover:bg-gray-50 cursor-pointer">
                    <img src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px" alt="">

                    <h1>{{ $itm->Description }}</h1>
                </ul>
            </a>
            <hr>
        @endif
    @endif
@endforeach
