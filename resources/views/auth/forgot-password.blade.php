<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('Logo-04.png') }}" style="" class="sm:max-w-md mt-6 px-6 py-4" alt="">
        </x-slot>



        @if (session()->has('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session()->get('status') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 font-medium text-sm text-red-500">
                {{ session()->get('error') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4 font-medium text-sm text-green-600" />
        @if(session()->has('success'))
            <span style="color: green">We have sent you a reset email.</span>
            <br>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('dashboard') }}">
                    <x-jet-button>
                        {{ __('Go to Home Page') }}
                    </x-jet-button>
                </a>
            </div>
        @else
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password?') }}
            </div>
            <form method="POST" action="{{ route('password-reset.store') }}">
                @csrf

                <div class="block">
                    <x-jet-label for="creds" value="{{ __('Username') }}" />
                    <x-jet-input id="creds" class="block mt-1 w-full" type="text" name="creds" :value="old('creds')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button>
                        {{ __('Send Password Reset Link') }}
                    </x-jet-button>
                </div>
            </form>
        @endif


    </x-jet-authentication-card>
</x-guest-layout>
