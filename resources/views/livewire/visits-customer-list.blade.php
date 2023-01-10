<div>
    <div class="flex">
        <div class="relative w-full">
            <form action="{{ route('visits.index') }}">
                <input value="{{ $search }}" name="search" type="search" id="search-dropdown" class="rounded-l-lg block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search customers" required>
                <button style="background-color: #0069ad" type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 ">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search customers...</span>
                </button>
            </form>
        </div>
    </div>
    <br>
    <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 whitespace-nowrap border" id="dataTable">
        <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="text-xs text-gray-700 uppercase bg-gray-50">
        <th class="py-3 px-6">
            Customer
        </th>
        <th class="py-3 px-6">
            Last visit
        </th>
        <th class="py-3 px-6">
            Next visit
        </th>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            @php($date = (strtotime($customer->last_visit) + ($customer->visits_frequency * 86400)))
            <tr style="color: black" class="bg-white border-b">
                <td class="py-4 px-6" >
                    {{$customer->FullName}}
                </td>
                <td class="py-4 px-6" >
                    {{ $customer->last_visit  }}
                </td>
                <td class="py-4 px-6" >
                    @if($customer->last_visit != null)
                        {{ date('Y-m-d', $date ) }}


                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <div class="  2xl:px-20 md:px-6 px-4">
        {{ $customers->links('vendor.pagination.bootstrap-unscroll') }}
    </div>
</div>
