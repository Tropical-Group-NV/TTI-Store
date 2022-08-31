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
        <div class="flex ">
{{--            <div>--}}
{{--                <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">--}}
{{--                    Locations--}}
{{--                </h1>--}}
{{--                <div style="min-width: 350px;">--}}

{{--                        <aside class="w-full shadow-xl sm:rounded-lg">--}}
{{--                            <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">--}}
{{--                                <div style="z-index: 5; overflow-y: auto;max-height: 700px;">--}}
{{--                                    <div>--}}
{{--                                        @if(isset($_REQUEST['search']))--}}
{{--                                            {{ $_REQUEST['search'] }}--}}
{{--                                            <input name="search" style="display: none" type="text" value="{{ $_REQUEST['search'] }}">--}}
{{--                                        @endif--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </aside>--}}

{{--                    </form>--}}
{{--                </div>--}}

{{--            </div>--}}
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
                    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
                        Shopping Cart
                    </h1>
                    @livewire('sidebar')
                </div>
            @endif
        </div>
    </div>
    </div>
</x-app-layout>

