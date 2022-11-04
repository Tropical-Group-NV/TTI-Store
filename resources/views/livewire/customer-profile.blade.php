<div>

            <form wire:submit.prevent="saveInfo">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Firstname') }}" />
                    <input wire:model="customerFirstName" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <x-jet-label for="name" value="{{ __('Lastname') }}" />
                    <input wire:model="customerLastName" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <x-jet-label for="name" value="{{ __('Address') }}" />
                    <input wire:model="customerAddress" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <x-jet-label for="name" value="{{ __('Country') }}" />
                    <select wire:model="customerCountry" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        @foreach($countries['data'] as $country)
                            @if($country['country'] == $customer->BillAddressBlockAddr4)
                                <option selected value="{{ $country['country']  }}">{{ $country['country']  }}</option>
                            @else
                                <option value="{{ $country['country']  }}">{{ $country['country']  }}</option>
                            @endif

                        @endforeach
                    </select>
                    <br>
                    <button class="btn " style="background-color: #0069ad; color: white">
                        Save
                    </button>
                </div>
            </form>

</div>
