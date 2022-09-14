<x-app-layout>
    <div class="" >
        @if(isset($_REQUEST['order']))
            <div class="flex justify-center pt-5">
                <span  style="font-family: sfsemibold; font-size: 40px; padding-left: 50px; padding-right: 50px">
            <span class="text-green-600">
                Your order has been submitted✅ <a style="color: #0069AD; font-size: 20px" href="{{ route('order', $_REQUEST['order']) }}">Go to Order.</a>
            </span>
            </span>
            </div>
        @endif
        <div class="sm:py-12">
            <div class="flex ">
                <div class="hidden md:hidden lg:hidden xl:hidden 2xl:block" style="z-index: 100">
                    @livewire('filter')
                </div>

                <div class="w-full md:w-full 2xl:w-3/4 mx-auto sm:px-6 lg:px-8">
                    @livewire('items')
                </div>
                @if(\Illuminate\Support\Facades\Auth::user() != null)
                    <div  class="2xl:invisible bottom-96 round-lg border border-black border-4" id="toggleCart" style="position: fixed;right: 0;z-index: 100">
                        <aside class="w-full shadow-xl rounded-lg outline-amber-300 outline-8 border-black">
                            <div class="overflow-y-auto py-4 px-3 w-full bg-white sm:rounded outline-8 border-black">
                                <button  onclick="toggleCart()" data-modal-toggle="shoppingCart">
                                    <img width="24" height="24" src="https://www.svgrepo.com/show/7898/shopping-cart.svg">
                                </button>
                            </div>
                        </aside>
                    </div>
                    <div style="z-index: 100; right: 0" id="shoppingCart" class="hidden 2xl:block ">
                        @livewire('sidebar')
                    </div>
                @endif
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
