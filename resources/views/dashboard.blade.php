<x-app-layout>
{{--    @livewire('counter')--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <ul class="flex">
{{--            <nav id="sidebarMenu" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <div class="position-sticky">--}}
{{--                    <div class="list-group list-group-flush mx-3 mt-4">--}}
{{--                        <a--}}
{{--                            href="#"--}}
{{--                            class="list-group-item list-group-item-action py-2 ripple"--}}
{{--                            aria-current="true"--}}
{{--                        >--}}
{{--                            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>--}}
{{--                        </a>--}}
{{--                        --}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </nav>--}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('items')

                </div>
            </div>
        </ul>


    </div>
</x-app-layout>
