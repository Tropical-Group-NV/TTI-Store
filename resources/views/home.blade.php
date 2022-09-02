<x-app-layout>
    <h1 style="font-family: sfsemibold; font-size: 35px" class="flex justify-center">
        <img style="width: 60%" src="{{ asset('Logo-03.png') }}" alt="">    </h1>
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
            <div class="w-60 hidemobile">
                <div  class="" >
                    <aside class="w-full shadow-xl sm:rounded-lg outline-amber-300 outline-8">
                        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">
                            <img style="width: 400px; padding-bottom: 30px" src="{{ asset('ex1.jpg') }}" alt="">
                            <img src="{{ asset('ex2.jpg') }}" alt="">
                        </div>
                    </aside>
                </div>
            </div>
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
                <div style="z-index: 100; right: 0" id="shoppingCart" class="hidemobile mobile-float-fixed">

                    @livewire('sidebar')
                </div>
            @endif
        </div>
        <div  id="toggleCart" style="position: fixed;right: 0;z-index: 10000">
            <aside class="w-full shadow-xl sm:rounded-lg outline-amber-300 outline-8">
                <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">
                    <button  onclick="toggleCart()" data-modal-toggle="shoppingCart">
                        <img width="24" height="24" src="https://www.svgrepo.com/show/7898/shopping-cart.svg">
                    </button>
                </div>
            </aside>
        </div>
    </div>
    </div>
    <script>
        function toggleCart()
        {
            if (document.getElementById('shoppingCart').classList.contains('hidemobile'))
            {
                document.getElementById('shoppingCart').classList.remove('hidemobile');
                document.getElementById('toggleCart').classList.add('hidden');
            }
            else
            {
                document.getElementById('shoppingCart').classList.add('hidemobile');
                document.getElementById('toggleCart').classList.remove('hidden');
            }
        }
    </script>

</x-app-layout>

