<html>
<table style=>
    <thead>
    <th style="border: solid; border-color: black">
        Date
    </th>
    <th style="border: solid; border-color: black">
        Salesrep
    </th>
    <th style="border: solid; border-color: black">
        Customer
    </th>
    <th style="border: solid; border-color: black">
        Subject
    </th>
    <th style="border: solid; border-color: black">
        Description
    </th>
    <th style="border: solid; border-color: black">
        Reminder
    </th>
    <th style="border: solid; border-color: black">
        Status
    </th>
    </thead>
    <tbody>
    @foreach($crms2 as $crm)
        @php($customer = \App\Models\Customer::query()->where('ListID', $crm->customer_ListID)->first('FullName'))
        @php($rep = \App\Models\User::query()->where('id', $crm->rep_user_id)->first())
        @php($status = \App\Models\CrmInteractionStatus::query()->where('id', $crm->status_id)->first())
        <tr style="border: solid; border-color: black">
            <td style="border: solid; border-color: black">
                {{ $crm->date_time }}
            </td>
            <td style="border: solid; border-color: black">
                {{ $rep->name ?? '' }}
            </td>
            <td style="border: solid; border-color: black">
                {{ $customer->FullName ?? '' }}
            </td>
            <td style="border: solid; border-color: black">
                {{ $crm->subject }}
            </td>
            <td style="border: solid; border-color: black">
                {{ $crm->description }}
            </td>
            <td style="border: solid; border-color: black">
                {{ $crm->reminder }}
            </td>
            <td style="border: solid; border-color: black">
                {{ $status->name ?? '' }}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>
</html>
