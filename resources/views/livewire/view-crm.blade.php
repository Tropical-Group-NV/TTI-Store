<div>
    <div>
        <div>
            <div class="py-8 px-8">
                <div class="float-right">
                    <div class="btn-group">
                        {{--                        <button class="btn" style="color: white; background-color: #0069ad">--}}
                        {{--                            --}}
                        {{--                        </button>--}}
                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                            <!-- Trigger for Modal -->
                            <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">
                                <b>
                                    +
                                </b>
                            </button>

                            <div  style="z-index: 99999999" x-show="showModal"
                                  class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                  x-transition.opacity x-transition:leave.duration.500ms >
                                <!-- Modal inner -->
                                <div x-show="showModal"
                                     class="px-6 py-4 text-left bg-white border rounded-lg shadow-lg"
                                     @click.away="showModal = false">
                                    <!-- Title / Close-->
                                    <div class="flex items-center justify-between">
                                        <div class="px-8">
                                            <h1 style="font-family: sfsemibold">
                                                Create a ticket
                                            </h1>

                                        </div>
                                        <button id="closeTicketModal" type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- content -->
                                    <form wire:submit.prevent="createTicket">
                                        <div class="py-8 px-8">
                                            <div class="flex">
                                                <div class="px-4">
                                                    <label for="">
                                                        Created DateTime
                                                        <input wire:model="dateTime" datepicker type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                    </label>
                                                </div>
                                                <div class="px-4">
                                                    <div x-data="{ open: false }">
                                                        <div @click.away="open = false">
                                                            <label>
                                                                Customer
                                                            </label>
                                                            <input wire:model="customerSearch" wire:keyup="searchCustomers" @click="open = true" style="width: 300px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select customer">
                                                            @error('customerID') <span class="text-red-500">Please select a customer</span> @enderror

                                                            {{--                                                                <input wire:keyup="searchUsers" wire:model="userSearchString" @click="open = true" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="search" type="search">--}}
                                                            <span  x-show="open" x-transition>
                                                                    <div id="users" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                                                        @foreach($customers as $customer1)
                                                                            <a wire:click="setCustomerID('{{$customer1->ListID}}')" class="list-none text-apple-blue-bold cursor-pointer">{{ $customer1->FullName }}</a>
                                                                            <br>
                                                                        @endforeach
                                                                    </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-4">
                                                <label for="">
                                                    Subject
                                                    <input wire:model="subject" style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                    @error('subject') <span class="text-red-500">{{ $message }}</span> @enderror
                                                </label>
                                            </div>
                                            <div class="px-4">
                                                <label for="">
                                                    Default description
                                                    <select style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="px-4">
                                                <label for="">
                                                    Description
                                                    <textarea wire:model="description" style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date"></textarea>
                                                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                                                </label>
                                            </div>
                                            <div class="flex">
                                                <div class="px-4">
                                                    <label for="">
                                                        Reminder
                                                        <input wire:model="reminder" datepicker type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                    </label>
                                                </div>
                                                <div class="px-4">
                                                    <label for="">
                                                        Status
                                                        <select wire:model="statusID" style="width: 300px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select customer">
                                                            <option value="">Select status</option>
                                                            @foreach($statuses as $status)
                                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('statusID') <span class="text-red-500">{{ 'Please select a status' }}</span> @enderror
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="px-4">
                                                <label for="">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                                                    Send email to client? <i>Subject and description are send to email.</i>
                                                </label>
                                            </div>
                                            <br>
                                            <div class="float-right">
                                                <button class="btn" style="color: white; background-color: #0069ad">Create</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button class="btn" style="color: white; background-color: #0069ad">
                            <b>
                                <i class="fa fa-refresh" wire:click="$refresh"></i>
                            </b>
                        </button>
                        <div
                            x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
                            x-on:keydown.escape.prevent.stop="close($refs.button)"
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['dropdown-button']"
                            class="relative"
                        >
                            <!-- Button -->
                            <button style="color: white; background-color: #0069ad"
                                    x-ref="button"
                                    x-on:click="toggle()"
                                    :aria-expanded="open"
                                    :aria-controls="$id('dropdown-button')"
                                    type="button"
                                    class="btn"
                            >
                                Export

                                <!-- Heroicon: chevron-down -->
                            </button>

                            <!-- Panel -->
                            <div
                                x-ref="panel"
                                x-show="open"
                                x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)"
                                :id="$id('dropdown-button')"
                                style="display: none; z-index: 10000"
                                class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md"
                            >
                                <a wire:click="exportJson" href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                    Json
                                </a>
                                <a wire:click="exportTxt" href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                    Text
                                </a>
                                <a wire:click="exportPDF" href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                    PDF
                                </a>
                                <a wire:click="exportCsv" href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                    CSV
                                </a>

{{--                                <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">--}}
{{--                                    Edit Task--}}
{{--                                </a>--}}

{{--                                <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">--}}
{{--                                    <span class="text-red-600">Delete Task</span>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>

                    {{--                    <button wire:click="exportJson" class="btn" style="color: white; background-color: #0069ad">--}}
                    {{--                        <b>--}}
                    {{--                            <i class="fa fa-adjust"></i>--}}
                    {{--                        </b>--}}
                    {{--                    </button>--}}
                    {{--                        <button class="btn" style="color: white; background-color: #0069ad">--}}
                    {{--                            <b>--}}
                    {{--                                Export--}}
                    {{--                            </b>--}}
                    {{--                        </button>--}}
                </div>
            </div>
        </div>
        <br>
        <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 border rounded" id="dataTable">
            <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="rounded text-xs text-gray-700 uppercase bg-gray-50">
            <th class="py-3 px-6">
                Date Time
            </th>
            <th class="py-3 px-6">
                Salesrep
            </th>
            <th class="py-3 px-6">
                Customer
            </th>
            <th class="py-3 px-6">
                Subject
            </th>
            <th class="py-3 px-6">
                Description
            </th>
            <th class="py-3 px-6">
                Reminder
            </th>
            <th class="py-3 px-6">
                Status
            </th>
            <th class="py-3 px-6">
                Comments
            </th>
            <th class="py-3 px-6">
                Actions
            </th>
            </thead>
            <tbody>
            @foreach($crms as $crm)
                @php($user = \App\Models\User::query()->where('id', $crm->rep_user_id)->first())
                @php($customer = \App\Models\Customer::query()->where('ListID', $crm->customer_ListID)->first('FullName'))
                @php($status = \App\Models\CrmInteractionStatus::query()->where('id', $crm->status_id)->first())
                @php($comments = \App\Models\CrmInteractionDetail::query()->where('crm_interactions_id', $crm->id)->get())
                <tr style="color: black" class="bg-white border-b">
                    <td class="py-4 px-6" >
                        {{$crm->date_time}}
                    </td>
                    <td class="py-4 px-6" >
                        @if($user!=null)
                            {{$user->name}}
                        @endif
                    </td>
                    <td class="py-4 px-6" >
                        {{$customer->FullName ?? ''}}
                    </td>
                    <td class="py-4 px-6" >
                        {{$crm->subject}}
                    </td>
                    <td class="py-4 px-6" >
                        {{$crm->description}}
                    </td>
                    <td class="py-4 px-6" >
                        {{$crm->reminder}}
                    </td>
                    <td class="py-4 px-6" >
                        @if($status != null)
                            {{$status->name}}
                        @endif
                    </td>
                    <td class="py-4 px-6" >
                        {{ count($comments) }}
                    </td>
                    <td class="py-4 px-6 btn-group" >
                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                            <!-- Trigger for Modal -->
                            <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">
                                <b>
                                    <i class="fa fa-eye"></i>
                                </b>
                            </button>
                            <div  style="z-index: 99999999" x-show="showModal"
                                  class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                  x-transition.opacity x-transition:leave.duration.500ms >
                                <!-- Modal inner -->
                                <div x-show="showModal"
                                     class="px-6 py-4 text-left bg-white border rounded-lg shadow-lg"
                                     @click.away="showModal = false">
                                    <!-- Title / Close-->
                                    <div class="flex items-center justify-between">
                                        <div class="px-8">
                                            <h1 style="font-family: sfsemibold">
                                                View ticket
                                            </h1>

                                        </div>
                                        <button id="closeTicketModal" type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- content -->
                                    <div class="py-8 px-8">
                                        <div class="flex">
                                            <div class="px-4">
                                                <label for="">
                                                    Created DateTime
                                                    <input readonly disabled value="{{$crm->date_time}}" datepicker type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                </label>
                                            </div>
                                            <div class="px-4">
                                                <label>
                                                    Customer

                                                    <input readonly disabled value="{{$customer->FullName ?? ''}}" @click="open = true" style="width: 300px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select customer">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="px-4">
                                            <label for="">
                                                Subject
                                                <input value="{{ $crm->subject }}" style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                            </label>
                                        </div>
                                        <div class="px-4">
                                            <label for="">
                                                Description
                                                <textarea style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">{{ $crm->description }}</textarea>
                                            </label>
                                        </div>
                                        <div class="flex">
                                            <div class="px-4">
                                                <label for="">
                                                    Reminder
                                                    <input disabled readonly value="{{ $crm->reminder }}" datepicker type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                </label>
                                            </div>
                                            <div class="px-4">
                                                <label for="">
                                                    Status
                                                    <select disabled readonly style="width: 300px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select customer">
                                                        <option selected value="">{{ $status->name ?? '' }}</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="float-right">
                                            <button @click="showModal = false" class="btn" style="color: white; background-color: #0069ad">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                            <!-- Trigger for Modal -->
                            <button @click="showModal =  ! showModal" style="background-color: #0069AD; color: white" class="btn ">
                                <b>
                                    <i class="fa fa-pencil"></i>
                                </b>
                            </button>
                            <div  style="z-index: 99999999" x-show="showModal"
                                  class="fixed  inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                  x-transition.opacity x-transition:leave.duration.500ms >
                                <!-- Modal inner -->
                                <div x-show="showModal"
                                     class="px-6 py-4 text-left bg-white border rounded-lg shadow-lg"
                                     @click.away="showModal = false">
                                    <!-- Title / Close-->
                                    <div class="flex items-center justify-between">
                                        <div class="px-8">
                                            <h1 style="font-family: sfsemibold">
                                                Edit ticket
                                            </h1>

                                        </div>
                                        <button id="closeTicketModal" type="button" class="z-50 cursor-pointer" @click="showModal = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                                                <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- content -->
                                    <div class="py-8 px-8">
                                        <div class="flex">
                                            <div class="px-4">
                                                <label for="">
                                                    Created DateTime
                                                    <input id="datetime-{{ $crm->id }}" value="{{$crm->date_time}}" datepicker type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                </label>
                                            </div>
                                            <div class="px-4">
                                                <label>
                                                    Customer

                                                    <input readonly disabled value="{{$customer->FullName ?? ''}}" @click="open = true" style="width: 300px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select customer">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="px-4">
                                            <label for="">
                                                Subject
                                                <input id="subject-{{ $crm->id }}" value="{{ $crm->subject }}" style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                            </label>
                                        </div>
                                        <div class="px-4">
                                            <label for="">
                                                Description
                                                <textarea  id="desc-{{ $crm->id }}" style="width: 400px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">{{ $crm->description }}</textarea>
                                            </label>
                                        </div>
                                        <div class="flex">
                                            <div class="px-4">
                                                <label for="">
                                                    Reminder
                                                    <input  id="reminder-{{ $crm->id }}" value="{{ $crm->reminder }}" datepicker type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date">
                                                </label>
                                            </div>
                                            <div class="px-4">
                                                <label for="">
                                                    Status
                                                    <select  id="status-{{ $crm->id }}" style="width: 300px" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select customer">
                                                        @foreach($statuses as $status1)
                                                            @if($crm->status_id == $status1->id)
                                                                <option selected value="{{ $status->id }}">{{ $status->name }}</option>
                                                            @else
                                                                <option value="{{ $status1->id }}">{{ $status1->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="px-4">
                                            <label for="">

                                                <input id="sendMail-{{ $crm->info }}" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                                                Send email to client? <i>Subject and description are send to email.</i>
                                            </label>
                                        </div>
                                        <br>
                                        <div class="float-right">
                                            <button wire:click="updateCrm('{{ $crm->id }}', document.getElementById('datetime-{{ $crm->id }}').value,document.getElementById('subject-{{ $crm->id }}').value,document.getElementById('desc-{{ $crm->id }}').value,document.getElementById('reminder-{{ $crm->id }}').value,document.getElementById('status-{{ $crm->id }}').value)" @click="showModal = false" class="btn" style="color: white; background-color: #0069ad">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <div class="  2xl:px-20 md:px-6 px-4">
            {{ $crms->links('vendor.pagination.bootstrap-unscroll') }}
        </div>
        <script>
            window.addEventListener('createdTicket', (e) => {
                document.getElementById('closeTicketModal').click();
            });
        </script>
        <br>
        <br>
    </div>
</div>

