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
        @if(session()->has('welcome'))
            <div x-data="{ 'showModal': true }" @keydown.escape="showModal = false" @close.stop="showModal = false">
                <!-- Trigger for Modal -->
                {{--                <button  @click="showModal =  ! showModal" class="float hover:text-white items-center pb-2">--}}
                {{--                    <i class="fa fa-whatsapp active:text-white my-float"></i>--}}
                {{--                </button>--}}

                <!-- Whatsapp Modal -->
                <div x-show="showModal"
                     class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50 px-8"
                     x-transition.opacity x-transition:leave.duration.500ms >
                    <!-- Modal inner -->
                    <div style="z-index: 1000000" x-show="showModal" x-transition:enter.duration.500ms
                         x-transition:leave.duration.400ms
                         class="max-w-3xl px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg"
                         @click.away="showModal = false"
                    >
                        <div class="flex items-center justify-between">
{{--                            <button type="button" class="z-50 cursor-pointer" @click="showModal = false">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">--}}
{{--                                    <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                                </svg>--}}
{{--                            </button>--}}
                        </div>
                        <div>
                            <div class="flex justify-center">
                                {{ session()->get('welcome') }} <i class="fa fa-check" style="color: green"></i>
{{--                                <img class="w-3/4" style="width: 300px" src="{{ asset('TTI-Whatsapp-svg.svg') }}" alt="">--}}
                            </div>
                            <br>
                            <div class="flex justify-center">
                                <button class="btn text-white" @click="showModal =  ! showModal" style="background-color: #0069ad">
                                    Start shopping <i class="fa fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <div style="z-index: 100; right: 0; position: -webkit-sticky;position: sticky;" id="shoppingCart" class="hidden 2xl:block sticky">
                        <div class="">
                            <div style="; right: 0;" class=" 2xl:block left-0 2xl:w-80 2xl:left-auto top-5 2xl:top-auto sm:top-45">
                            </div>
                        </div>
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

