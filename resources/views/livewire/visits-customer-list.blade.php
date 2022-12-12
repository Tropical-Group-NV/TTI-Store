<div>
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
                    {{ date('Y-m-d', $date ) }}
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
