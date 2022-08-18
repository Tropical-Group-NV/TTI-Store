<x-app-layout>
{{--    @livewire('counter')--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <ul class="flex">
            <div class="max-w-7xl  w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('items')
                </div>
            </div>
            <div style="height: 300px">
                @if(\Illuminate\Support\Facades\Auth::user() != null)
                @livewire('sidebar')
                    @endif
            </div>

        </ul>


    </div>
</x-app-layout>
