<x-app-layout>
    <div class="py-12">
        <div class="flex">
            <div class="w-60 hidemobile"></div>
            <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
                @livewire('item')
            </div>
            <div style="z-index: 100; right: 0" id="shoppingCart" class="hidemobile mobile-float-fixed" >
                @if(\Illuminate\Support\Facades\Auth::user() != null)
                    @livewire('sidebar')
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
</x-app-layout>

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
