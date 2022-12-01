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
        @if (session()->has('accountInactive'))
            <div class="mb-4 font-medium text-sm text-red-500">
                {{ session()->get('accountInactive') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password-reset.index'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password-reset.index') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
