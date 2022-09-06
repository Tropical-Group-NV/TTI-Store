<div>
    @php($backorders = \App\Models\BackOrders::query()->where('uid', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10))
    <div>
        <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
            Your Backorders
        </h1>
        <div class="bg-white shadow-xl sm:rounded-lg">
            <div style="overflow-x: auto" class="  py-12 2xl:px-20 md:px-6 px-4">
                <div style="overflow-x: auto">
                    <table style="font-family: sflight" class="border-separate border border-slate-500 w-full table" id="dataTable">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-slate-600">
                                Date
                            </th>
                            <th class="border border-slate-600">
                                Customer
                            </th>
                            <th class="border border-slate-600">
                                Item
                            </th>
                            <th class="border border-slate-600">
                                Username
                            </th>
                            <th class="border border-slate-600">
                                Email
                            </th>
                            <th class="border border-slate-600">
                                Backorder quantity
                            </th>
                            <th class="border border-slate-600">
                                In stock
                            </th>
                            <th class="border border-slate-600">
                                Create order
                            </th>
                            <th class="border border-slate-600">
                                Notified
                            </th>
                            <th class="border border-slate-600">
                                Delete
                            </th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($backorders as $order)
                            @php($customer = \Illuminate\Support\Facades\DB::connection('epas')->table('QB_Customer')->where('ListID', $order->CustomerRefListID)->first())
                            @php($item = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('view_item')->where('ListID', $order->ListID)->get()->first())
                            <tr class="bg-gray-50">
                                <td class="border border-slate-700">
                                    {{ $order->date_time_created }}
                                </td>
                                <td class="border border-slate-700">
                                    {{ $customer->Name }}
                                </td>
                                <td class="border border-slate-700">
                                    {{ $item->Description}}
                                </td>
                                <td class="border border-slate-700">
                                    {{ \Illuminate\Support\Facades\Auth::user()->username }}
                                </td>
                                <td class="border border-slate-700">
                                    {{ $order->email }}
                                </td>
                                <td class="border border-slate-700">
                                    {{ round( $order->BackOrderQuantity, 2) }}
                                </td>
                                <td class="border border-indigo-400">
                                    {{ round($item->QuantityOnHand, 2)  }}
                                </td>
                                <td style="margin: auto" class="border border-indigo-400">
                                    @if($item->QuantityOnHand > 0)
                                        <button wire:loading.attr="disabled" wire:click="createOrder('{{ $item->ListID }}', '{{ round( $order->BackOrderQuantity, 2) }}', '{{ $customer->ListID }}')" class="btn btn-primary" style="background-color: #0069AD; color: white; font-family: sfsemibold">Create Order</button>
                                    @endif
                                </td>
                                <td class="border border-indigo-400">
                                    @if($order->mail_is_send == 1)
                                        Yes
                                    @else
                                        No
                                    @endif

                                </td>
                                <td class="border border-indigo-400">
                                    <button wire:loading.attr="disabled" wire:click="delete('{{ $order->id }}')" class="btn btn-danger" style="font-family: sfsemibold">Delete</button>
                                </td>
                            </tr>
                        @endforeach



                        </tbody>
                    </table>

                    {{ $backorders->links() }}

                </div>
            </div>
        </div>



    </div>
</div>
