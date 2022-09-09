<x-app-layout>
    <div>
        <div class="py-12">
            <div class="flex">
                <div class="w-60 hidemobile"></div>
                <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
                    @livewire('item')
                </div>
                <div style="z-index: 100; right: 0" id="shoppingCart" class="hidden 2xl:block fixed 2xl:relative" >
                    @if(\Illuminate\Support\Facades\Auth::user() != null)
                        @livewire('sidebar')
                    @endif
                </div>
                <div  class="2xl:invisible" id="toggleCart" style="position: fixed;right: 0;z-index: 100">
                    <aside class="w-full shadow-xl sm:rounded-lg outline-amber-300 outline-8 border border-4 border-black">
                        <div class="overflow-y-auto py-4 px-3 w-full bg-white sm:rounded outline-8 border-black">
                            <button  onclick="toggleCart()" data-modal-toggle="shoppingCart">
                                <img width="24" height="24" src="https://www.svgrepo.com/show/7898/shopping-cart.svg">
                            </button>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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
