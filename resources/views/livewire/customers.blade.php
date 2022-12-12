<div>
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        Customers
    </h1>
    <div class="bg-white shadow-xl sm:rounded-lg">
        <div >
            <div class="  py-12 2xl:px-20 md:px-6 px-4">
                <form action="{{ route('customers.index') }}">
                    <div class="flex">
                        <div class="relative w-full">
                            <input value="{{ $search }}" name="customerSearch" type="search" id="search-dropdown" class="rounded-l-lg block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search customers" required>
                            <button style="background-color: #0069ad" type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 ">
                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <div style="overflow-x: auto">
                    <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 whitespace-nowrap " id="dataTable">
                        <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="py-3 px-6">
                                View
                            </th>
                            <th class="py-3 px-6">
                                Location
                            </th>
                            <th class="py-3 px-6">
                                Type
                            </th>
                            <th  class="py-3 px-6">
                                Name
                            </th>
                            <th class="py-3 px-6">
                                Company Name
                            </th>
                            <th class="py-3 px-6">
                                First Name
                            </th>
                            <th class="py-3 px-6">
                                Last Name
                            </th>
                            <th class="py-3 px-6">
                                Email
                            </th>
                            <th class="py-3 px-6">
                                Visit
                            </th>
                            <th class="py-3 px-6">
                                Last Visit
                            </th>
                            <th class="py-3 px-6">
                                Last Order
                            </th>
                            <th class="py-3 px-6">
                                Flag
                            </th>
                            <th class="py-3 px-6">
                                Total Balance
                            </th>
                            <th class="py-3 px-6">
                                Is Active
                            </th>
                            <th class="py-3 px-6">
                                Comments
                            </th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @if($customers != null)
                            @foreach($customers as $customer)
                                @php($customerVisitFreq = \App\Models\CustomerVisitFrequency::query()->where('customer_id', $customer->ListID)->first())
                                @php($lastOrder = \App\Models\SalesOrder::where('CustomerRefListID', $customer->ListID)->orderBy('id', 'DESC')->first())
                                @php($customerLocation = \App\Models\CustomerLocation::query()->where('customer_id', $customer->ListID)->first())
                                @php($customerflag = \App\Models\ViewQBCustomer::query()->where('ListID', $customer->ListID)->first(['flag', 'last_visit']))
                                @php($crm = \App\Models\CrmInteraction::query()->where('customer_ListID', $customer->ListID)->get())
                                <tr style="color: black" class="bg-white border-b">
                                    <td class="py-4 px-6" >
                                        <a href="{{ route('customers.show', $customer->ListID) }}"><button class="btn" style="color: white; background-color: #0069ad">View</button></a>
                                    </td>
                                    <td class="py-4 px-6" >
                                        @if(\App\Models\CustomerLocation::query()->where('customer_id', $customer->ListID)->exists())
                                            SET
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-red-500" >
                                        <b>
                                            {{ $customer->CustomFieldKlanttype }}
                                        </b>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $customer->Name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $customer->CompanyName}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $customer->FirstName}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $customer->LastName}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $customer->Email}}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                                            <!-- Trigger for Modal -->
                                            <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">
                                                {{ $customerVisitFreq->days ?? ''}}
                                            </button>

                                            <div  style="z-index: 99999999" x-show="showModal"
                                                  class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                                  x-transition.opacity x-transition:leave.duration.500ms >
                                                <!-- Modal inner -->
                                                <div x-show="showModal"
                                                     class="px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg scale-50 sm:scale-100"
                                                     @click.away="showModal = false"
                                                >
                                                    <!-- Title / Close-->
                                                    <div class="flex items-center justify-between">
                                                        <button type="button" class="z-50 cursor-pointer float-right" @click="showModal = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                                <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!-- content -->
                                                    <div class="h-3/4">
                                                            <label for="">
                                                                Visit frequency
                                                                <br>
                                                                <input id="freq-{{ $customer->ListID }}" value="{{ $customerVisitFreq->days ?? ''}}" type="number" class="w-full rounded ">
                                                            </label>
                                                            <div>
                                                                <button wire:click="changeVisitFreq('{{ $customer->ListID }}', document.getElementById('freq-{{ $customer->ListID }}').value)" @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn float-right">
                                                                    Save
                                                                </button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ strtoupper($customerflag->last_visit) }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if(\App\Models\SalesOrder::where('CustomerRefListID', $customer->ListID)->orderBy('id', 'DESC')->exists())
                                            {{ date('Y-m-d', strtotime($lastOrder->datetime_to_quickbook)) ?? ''}}
                                        @endif
                                        {{--                                    @if( $lastOrder->datetime_to_quickbook != null)--}}
                                        {{--                                    @endif--}}
                                    </td>
                                    <td class="py-4 px-6">
                                        <img src="http://maps.google.com/mapfiles/ms/icons/{{  $customerflag->flag }}-dot.png" alt="">

                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $customer->TotalBalance}}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($customer->IsActive == 1)
                                            <span class="text-green-500">Yes</span>
                                        @else
                                            <span class="text-red-500">No</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ count($crm) }}
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="  2xl:px-20 md:px-6 px-4">
                {{ $customers->links('vendor.pagination.bootstrap-52') }}
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>
    <br>
</div>


