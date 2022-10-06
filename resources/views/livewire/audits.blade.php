<div>
    <div>
        <div>
            <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
                Audit trail
            </h1>
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div style="overflow-x: auto" class="pb-12">
                    <div style="overflow-x: auto">
                        <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 whitespace-nowrap" id="dataTable">
                            <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="py-3 px-6">
                                    Date
                                </th>
                                <th class="py-3 px-6">
                                    User
                                </th>
                                <th class="py-3 px-6">
                                    Event
                                </th>
                                <th class="py-3 px-6">
                                    Type
                                </th>
                                <th class="py-3 px-6">
                                    ID
                                </th>
                                <th class="py-3 px-6">
                                    Old Values
                                </th>
                                <th class="py-3 px-6">
                                    New Values
                                </th>
                                <th class="py-3 px-6">
                                    Url
                                </th>
                                <th class="py-3 px-6">
                                    IP
                                </th>
                            </tr>
                            </thead>
                            <tbody class="">
{{--                            @php($audits = \App\Models\Audit::query()->orderBy('id', 'DESC')->paginate(5))--}}
                            @foreach($audits as $audit)
                                @php($user = \App\Models\User::query()->where('id', $audit->user_id)->first( ))
                                @php($old_value_array = json_decode($audit->old_values, true))
                                @php($new_value_array = json_decode($audit->new_values, true))
                                @if(!empty($old_value_array))
                                    @foreach($old_value_array as $col => $old)
                                        <tr style="color: black" class="bg-white border-b ">
                                            <td class="py-4 px-6">
                                                {{ $audit->created_at }}
                                            </td>
                                            <td cclass="py-4 px-6">
                                                {{ $user->username }}
                                            </td>
                                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $audit->event}}
                                            </th>
                                            <td class="py-4 px-6">
                                                @if($audit->auditable_type == 'App\Models\CartItem')
                                                    CartItem
                                                @endif
                                                @if($audit->auditable_type == 'App\Models\Item')
                                                    Item
                                                @endif
                                                @if($audit->auditable_type == 'App\Models\BackOrders')
                                                    Backorder
                                                @endif
                                                    @if($audit->auditable_type == 'App\Models\SalesOrder')
                                                        SalesOrder
                                                    @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $audit->auditable_id }}
                                            </td>
                                            <td class="py-4 px-6">
                                                 <b>{{ $col  }}:</b><i>{{ $old }}</i>
                                            </td>
                                            <td class="py-4 px-6">
                                                @isset($new_value_array[$col])
                                                    <b>{{ $col  }}:</b> <i>{{ $new_value_array[$col]  }}</i>
                                                @else
                                                    <i>
                                                        Null
                                                    </i>
                                                @endisset
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $audit->url }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $audit->ip_address }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(!empty($new_value_array) and empty($old_value_array))
                                    @foreach($new_value_array as $col => $new)
                                        <tr style="color: black" class="bg-white border-b">
                                            <td class="py-4 px-6">
                                                {{ $audit->created_at }}
                                            </td>
                                            <td class="">
                                                {{ $user->username }}
                                            </td>
                                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $audit->event}}
                                            </th>
                                            <td class="py-4 px-6">
                                                @if($audit->auditable_type == 'App\Models\CartItem')
                                                    CartItem
                                                @endif
                                                @if($audit->auditable_type == 'App\Models\Item')
                                                    Item
                                                @endif
                                                @if($audit->auditable_type == 'App\Models\BackOrders')
                                                    Backorder
                                                @endif
                                                    @if($audit->auditable_type == 'App\Models\SalesOrder')
                                                    SalesOrder
                                                @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $audit->auditable_id }}
                                            </td>
                                            <td class="py-4 px-6">
                                                @isset($old_value_array[$col])
                                                    <b>{{ $col  }}:</b> <i>{{ $old_value_array[$col]  }}</i>
                                                @else
                                                    <i>
                                                        Null
                                                    </i>
                                                @endisset
                                            </td>
                                            <td class="py-4 px-6">
                                                <b>{{ $col  }}:</b><i>{{ $new }}</i>
                                            </td>
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                {{ $audit->url }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $audit->ip_address }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="2xl:px-20 md:px-6 px-4">
                            {{ $audits->links('vendor.pagination.bootstrap-52') }}
                        </div>


                    </div>
                </div>
            </div>



        </div>
    </div>

</div>
