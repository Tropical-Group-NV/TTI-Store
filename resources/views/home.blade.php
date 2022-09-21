<x-app-layout>
    <div>
        <h1 style="font-family: sfsemibold; font-size: 35px" class="flex justify-center">
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
        <div class="sm:py-12">
            <div class="flex">
{{--                <div id="app">--}}
{{--                    <example-component></example-component>--}}
{{--                </div>--}}
                <div class="hidden md:hidden lg:hidden xl:hidden 2xl:block" style="z-index: 100">
                    @livewire('filter')
                </div>
                <div style="max-width: 110rem" class="w-full md:w-full 2xl:w-3/4 mx-auto sm:px-6 lg:px-8">
                    @livewire('home')
                </div>
                @if(\Illuminate\Support\Facades\Auth::user() != null)
                    <div  class="2xl:invisible" id="toggleCart" style="position: fixed;right: 0;z-index: 100">
                        <aside class="w-full shadow-xl bg-white rounded outline-8">
                            <div class="overflow-y-auto py-4 px-3 rounded">
                                <button class="ease-in duration-300 active:bg-violet-700"  onclick="toggleCart()" data-modal-toggle="shoppingCart">
                                    <img class="animate-bounce" width="24" height="24" src="https://www.svgrepo.com/show/7898/shopping-cart.svg">
                                </button>
                            </div>
                        </aside>
                    </div>
                    <div style="z-index: 100; right: 0" id="shoppingCart" class="hidden 2xl:block fixed 2xl:relative">
                        @livewire('sidebar')
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function toggleCart()
        {
            if (document.getElementById('shoppingCart').classList.contains('hidden'))
            {
                document.getElementById('shoppingCart').classList.remove('hidden');
                document.getElementById('toggleCart').classList.add('hidden');
            }
            else
            {
                document.getElementById('shoppingCart').classList.add('hidden');
                document.getElementById('toggleCart').classList.remove('hidden');
            }
        }
    </script>
    </div>
</x-app-layout>

