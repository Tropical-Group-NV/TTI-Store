<x-app-layout>
    <h1 style="font-family: sfsemibold; font-size: 35px">
{{--        <img style="opacity: 1; padding-left: 20%; padd" src="{{ asset('Logo-05.png') }}" alt="">--}}
    </h1>
    @if(isset($_REQUEST['order']))
        <x-slot name="header">
        <span  style="font-family: sfsemibold; font-size: 40px">
            <span class="text-green-600">
                Your order has been submitted✅ <a style="color: #0069AD; font-size: 20px" href="{{ route('order', $_REQUEST['order']) }}">Go to Order.</a>
            </span>
        </span>
        </x-slot>
    @endif

    <div class="py-12">
        <div class="flex">
            <div style="max-width: 110rem" class="w-full mx-auto sm:px-6 lg:px-8">
                @livewire('home')
            </div>
            @if(\Illuminate\Support\Facades\Auth::user() != null)
                <div  class="" id="toggleCart" style="position: fixed;right: 0;z-index: 100">
                    <aside class="w-full shadow-xl sm:rounded-lg outline-amber-300 outline-8">
                        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">
                            <button  onclick="toggleCart()" data-modal-toggle="shoppingCart">
                                <img width="24" height="24" src="https://www.svgrepo.com/show/7898/shopping-cart.svg">
                            </button>
                        </div>
                    </aside>
                </div>
                <div style="z-index: 100" id="shoppingCart" class="sidebar">

                    @livewire('sidebar')
                </div>
            @endif
        </div>
    </div>
    </div>
</x-app-layout>

