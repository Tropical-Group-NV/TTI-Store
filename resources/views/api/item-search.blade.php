@php($list =  \Illuminate\Support\Facades\DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $search . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $search . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get())
@foreach($list as $itm)
    @if(is_array($itm))
        @if($itm != null)
            @php($put = 1)
            @php($currentPrivateBranch = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('settings_branch_view_item_on_user')->where('branch', $itm['CustomFieldBranch'])->get())
            @foreach($currentPrivateBranch as $pb)
                @php($put = 0)
                @if(\Illuminate\Support\Facades\Auth::user() != null)
                    @if(\Illuminate\Support\Facades\Auth::user()->id == $pb->user_id)
                        @php($put = 1)
                        @break(1)
                    @endif
                @endif
            @endforeach
            @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm['ListID'])->get()->first())
            @if($image != null)
                {{--                                                <a href="#" onclick="document.getElementById('searchform').value = '{{ $itm['Description'] }} }}';document.getElementById('searchform').submit()">--}}
                @if($put == 1)
                    <a href="{{ route('item', $itm['ListID']) }}" >
                        <ul class="flex hover:bg-gray-50 cursor-pointer">
                            <img src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px" alt="">
                            <h1 style="font-size: 12px">{{ $itm['Description'] }}</h1>
                        </ul>
                    </a>
                    <hr>
                    <br>
                @endif
            @endif
        @endif
    @else
        @php($put = 1)
        @php($currentPrivateBranch = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('settings_branch_view_item_on_user')->where('branch', $itm->CustomFieldBranch)->get())
        @foreach($currentPrivateBranch as $pb)
            @php($put = 0)
            @if(\Illuminate\Support\Facades\Auth::user() != null)
                @if(\Illuminate\Support\Facades\Auth::user()->id == $pb->user_id)
                    @php($put = 1)
                    @break(1)
                @endif
            @endif
        @endforeach
        @php($image = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $itm->ListID)->get()->first())
        @if($image != null)
            @if($put == 1)
                <a href="{{ route('item', $itm->ListID) }}">
                    <ul class="flex hover:bg-gray-50 cursor-pointer">
                        <img src="https://www.ttistore.com/foto/{{$image->image_id}}.dat" style="height: 40px" alt="">
                        <h1 style="font-size: 12px">{{ $itm->Description }}</h1>
                    </ul>
                </a>
                <hr>
            @endif
        @endif
    @endif
@endforeach
