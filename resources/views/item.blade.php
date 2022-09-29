<x-app-layout>
    <div>
        <div class="py-12">
            <div class="flex">
                <div class=" w-full mx-auto sm:px-6 lg:px-8">
                    @livewire('item')
                </div>
                <div style="z-index: 100; right: 0; position: -webkit-sticky;position: sticky;" id="shoppingCart" class="hidden 2xl:block sticky">
                    <div class="">
                        <div style="; right: 0;" class=" 2xl:block left-0 2xl:w-80 2xl:left-auto top-5 2xl:top-auto sm:top-45">
                        </div>
                    </div>
                    @livewire('sidebar')
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
