<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto px-8 py-10 sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('customer-profile.store') }}">
                @csrf
                <div class="col-span-6 sm:col-span-4">
                    <input type="hidden" value="{{$userCustomer->customer_ListID}}" name="listid">
                    @if($customer->CompanyName != '')
                        <x-jet-label for="name" value="{{ __('Company Name') }}" />
                        <input name="companyname" value="{{$customer->CompanyName}}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        <br>
                    @endif
                    <x-jet-label for="username" value="{{ __('Username') }}" />
                    <input name="username" value="{{Auth::user()->username}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                    <br>
                    <x-jet-label for="name" value="{{ __('Firstname') }}" />
                    <input name="firstname" value="{{$customer->FirstName}}" type="text" class="border-gray-300 focus:border-indigo-300  focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <x-jet-label for="name" value="{{ __('Lastname') }}" />
                    <input name="lastname" value="{{$customer->LastName}}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <x-jet-label for="name" value="{{ __('Address') }}" />
                    <input name="address" value="{{$customer->BillAddressBlockAddr2}}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <x-jet-label for="name" value="{{ __('Country') }}" />
                    <select name="country" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        @foreach($countries['data'] as $country)
                            @if($country['country'] == $customer->BillAddressBlockAddr4)
                                <option selected value="{{ $country['country']  }}">{{ $country['country']  }}</option>
                            @else
                                <option value="{{ $country['country']  }}">{{ $country['country']  }}</option>
                            @endif

                        @endforeach
                    </select>
                    <br>
                    <x-jet-label for="name" value="{{ __('Phone') }}" />
                    <input name="phone" value="{{ $customer->Phone }}" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                    <br>
                    <button class="btn " style="background-color: #0069ad; color: white">
                        Save
                    </button>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
            </form>

{{--            @livewire('customer-profile')--}}
{{--            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))--}}
{{--                <div class="mt-10 sm:mt-0">--}}
{{--                    @livewire('profile.update-password-form')--}}
{{--                </div>--}}

{{--                <x-jet-section-border />--}}
{{--            @endif--}}
        </div>
    </div>
</x-app-layout>
