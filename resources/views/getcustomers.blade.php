@if(Auth::user()->users_type_id == 2)
    @php
        $salesRep = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_salesRep')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
        $customers = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $_REQUEST['search'] . '%')->where('SalesRepRefListID' , $salesRep->salesRep_ListID)->orderBy('Name', 'ASC')->limit(3)->get();
    @endphp
@endif
@if(Auth::user()->users_type_id == 1 or Auth::user()->users_type_id == 5)
    @php
        $customers = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $_REQUEST['search'] . '%')->orderBy('Name', 'ASC')->limit(3)->get();
    @endphp
@endif
{{--@php($customers = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('FullName', 'LIKE', '%' . $_REQUEST['search'] . '%')->limit(3)->get())--}}
@foreach($customers as $customer)
    @if(is_array($customer))
        <a href="#" onclick="document.getElementById('customer-search-{{ $_REQUEST['id'] }}').value= '{{ $customer['Name'] }}'; "><br><div class="border-b"><span>{{ $customer['Name'] }}</span></div></a>
    @else
        <a style="cursor:pointer;" onclick='document.getElementById("customer-search-{{ $_REQUEST["id"] }}" ).value= "{{ $customer->Name }}"; document.getElementById("customer-wrap-{{ $_REQUEST['id'] }}").innerHTML ="";document.getElementById("customer-id-{{ $_REQUEST['id'] }}").value= "{{ $customer->ListID }}"'><br><div class="border-b"><span>{{ $customer->Name }}</span></div></a>
    @endif
@endforeach
