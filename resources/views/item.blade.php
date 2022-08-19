<x-app-layout>




    <div class="py-12">
            <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div  id="toggleCart" class="hidden" style="position: fixed;right: 0;z-index: 100">
                        <aside class="w-full shadow-xl sm:rounded-lg outline-amber-300 outline-8">
                            <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">
                                <button  onclick="toggleCart()" data-modal-toggle="shoppingCart">
                                    <img width="24" height="24" src="https://www.svgrepo.com/show/7898/shopping-cart.svg">
                                </button>
                            </div>
                        </aside>
                    </div>
                    <div style="z-index: 100" id="shoppingCart">

                        @livewire('sidebar')
                    </div>
                    <div class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
                        @livewire('item')
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
