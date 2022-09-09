<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div style=" border-radius: 15px;" class="w-full">
                {{--                <h1 style="font-family: sfsemibold; font-size: 50px; color: dodgerblue" class="text-blue-700">www.ttistore.com</h1>--}}
                <img src="{{ asset('Logo-04.png') }}" style="" class="sm:max-w-md mt-6 px-6 py-4" alt="">
            </div>
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="">
            @csrf

            <div>
                <x-jet-label for="naam" value="{{ __('Naam') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            <div>
                <x-jet-label for="firstname" value="{{ __('Voornamen') }}" />
                <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
            </div>
            <br>
            <hr>
            <div class="flex items-center p-2">
                <input onclick="toggleCompany()"  id="company_check" name="company_check" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checked-checkbox" class="ml-2 text-sm font-medium">Check voor een bedrijfsregistratie</label>
            </div>
            <div id="company_fields" class="hidden">
                <div>
                    <x-jet-label for="company_name" value="{{ __('Berdijfsnaam') }}" />
                    <x-jet-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus />
                </div>
                <div>
                    <x-jet-label for="company_type" value="{{ __('Soort Bedrijf') }}" />
                    <x-jet-input id="company_type" class="block mt-1 w-full" type="text" name="company_type" :value="old('company_type')" required autofocus />
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div>
                <x-jet-label for="adress" value="{{ __('Adres') }}" />
                <x-jet-input id="adress" class="block mt-1 w-full" type="text" name="adress" :value="old('adress')" required autofocus />
            </div>
            <div>
                <x-jet-label for="phone" value="{{ __('Telefoonnummer') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('phone')" required autofocus />
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        <script>
            function toggleCompany()
            {
                if(document.getElementById('company_check').checked)
                    {
                        document.getElementById('company_fields').classList.remove('hidden');
                    }
                else
                {
                    document.getElementById('company_fields').classList.add('hidden');
                }

            }
        </script>
    </x-jet-authentication-card>
</x-guest-layout>
