<x-app-layout>
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
        <ul class="flex">
            <div  class="max-w-7xl  w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @livewire('items')
                </div>
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
            <div style="z-index: 100" id="shoppingCart" class="">
                @livewire('sidebar')
            </div>
                    @endif
            </div>
        </ul>
    </div>
</x-app-layout>
<script>
    function toggleCart()
    {
        if (window.screen.width < 600)
        {
            document.getElementById('shoppingCart').classList.add('hidden');
            document.getElementById('toggleCart').classList.remove('hidden');
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
