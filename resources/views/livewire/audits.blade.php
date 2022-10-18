<div>
    <div>
        <div>
            <div class="p-6 flex justify-between">
                <h1 style="font-family: sfsemibold; font-size: 35px" class="">
                    @if($auditType == 1)
                        Data audit
                    @else
                        Mail audit
                    @endif
                </h1>
                <div class="btn-group">
                    <button class="btn @if($auditType == 1) btn-secondary disabled @else btn-primary @endif" wire:click="dataAudit">
                        Data Audit
                    </button>
                    <button class="btn  border-l @if($auditType == 2) btn-secondary disabled @else btn-primary @endif" wire:click="mailAudit">
                        Mail Audit
                    </button>
                </div>
            </div>
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div style="overflow-x: auto" class="pb-12">
                    <div style="overflow-x: auto">
                        @if($auditType == 1)
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
                        @else
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
                                        Email to
                                    </th>
                                    <th class="py-3 px-6">
                                        Message
                                    </th>
                                    <th class="py-3 px-6">
                                        Success
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="">
                                {{--                            @php($audits = \App\Models\Audit::query()->orderBy('id', 'DESC')->paginate(5))--}}
                                @foreach($auditMails as $audit)
                                    @php($user = \App\Models\User::query()->where('id', $audit->uid)->first( ))
                                    <tr style="color: black" class="bg-white border-b">
                                        <td class="py-4 px-6">
                                            {{ $audit->updated_at }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $user->username }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $audit->emailTo }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $audit->message }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($audit->status == 1)
                                                <p style="color: green">Yes</p>
                                            @else
                                                <p style="color: red">No</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        <br>
                        <div class="2xl:px-20 md:px-6 px-4">
                            @if($auditType == 1)
                                {{ $audits->links('vendor.pagination.bootstrap-52') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
