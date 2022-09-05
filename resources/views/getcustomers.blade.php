@php($customers = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('FullName', 'LIKE', '%' . $_REQUEST['search'] . '%')->limit(3)->get())
@foreach($customers as $customer)
    @if(is_array($customer))
        <a href="#" onclick="document.getElementById('customer-search-{{ $_REQUEST['id'] }}').value= '{{ $customer['Name'] }}'; "><br><div class="border-b"><span>{{ $customer['Name'] }}</span></div></a>
    @else
        <a style="cursor:pointer;" onclick='document.getElementById("customer-search-{{ $_REQUEST["id"] }}" ).value= "{{ $customer->Name }}"; document.getElementById("customer-wrap-{{ $_REQUEST['id'] }}").innerHTML ="";document.getElementById("customer-id-{{ $_REQUEST['id'] }}").value= "{{ $customer->ListID }}"'><br><div class="border-b"><span>{{ $customer->Name }}</span></div></a>
    @endif
@endforeach
