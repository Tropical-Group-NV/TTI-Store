<nav x-data="{ open: false }" class="border-b border-gray-100" style="background-color: #0069AD; z-index: 1000">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @php($retail = 0)
    @auth()
        @if(Auth::user()->users_type_id == 3)
            @php($customerAccount = \App\Models\UserCustomer::query()->where('user_id', Auth::user()->id)->first())
            @php($QbCustomer = \App\Models\QbCustomer::query()->where('ListID', $customerAccount->customer_ListID)->first())
            @if($QbCustomer->PriceLevelRefFullName == 'Retail')
                @php($retail = 1)
            @endif
        @endif
    @endauth
    @if(\Illuminate\Support\Facades\Auth::user() != null)
        @php($usertypes = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_type')->where('id', \Illuminate\Support\Facades\Auth::user()->users_type_id)->first())
    @endif

    <!-- Primary Navigation Menu -->
    <div class="px-3 hidden md:block ">

        <div class="flex justify-between h-20 items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('Logo-05-min.png') }}" alt="" class="block lg:block" style="height: 50px">
                {{--                <img src="{{ asset('Logo-05-2.png') }}" alt="" class="block lg:hidden" style="height: 50px">--}}
            </a>
            <div class="hidden 2xl:block">
                <form class="flex-shrink-0" id="searchform" action="{{ route('dashboard') }}">
                    <ul class="flex">
                        <input onkeyup="searchItem2()" style="height:50px; width: 1000px" id="search_input2" placeholder="Search..." name="search" class="w-96 rounded-md flex-shrink-0" @isset($_REQUEST['search']) value="{{ $_REQUEST['search'] }}" @endisset autocomplete="false" type="search">
                        <button class="btn " style="background-color: #0069AD; height: 50px">
                            <img style="width: 40px; height: 40px" src="{{ asset('search_glass.svg') }}" alt="">
                        </button>
                    </ul>
                </form>
                <div id="list_search2" style="z-index: 100000; position: absolute; max-height: 200px; width: 1000px"  class="hidden">
                    <div id="searchwrap2" class="card card-body">
                        <div class="hidden" id="loading_searchwrap2" style="border-radius: 50px">
                            <img  src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="w-72 md:w-3/4 2xl:w-1/2" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="max-width: 350px">
                        </div>
                        <div id="item_searchwrap2" style="overflow-y: auto">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @if(\Illuminate\Support\Facades\Auth::user() != null)
                    <div class="ml-3 relative" style="z-index: 10000">
                        <x-jet-dropdown align="right" width="48" style="z-index: 10000">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        @if(Auth::user()->users_type_id == 3)
                                            @php($customerAccount = \App\Models\UserCustomer::query()->where('user_id', Auth::user()->id)->first())
                                            @php($QbCustomer = \App\Models\QbCustomer::query()->where('ListID', $customerAccount->customer_ListID)->first())
                                            @if($QbCustomer->CompanyName != '')
                                                {{$QbCustomer->CompanyName}}
                                            @else
                                                {{ $QbCustomer->Name }}
                                            @endif
                                        @else
                                            <span class=""> {{ Auth::user()->name }}({{ $usertypes->name }}) </span> <i class="fa fa-user" style="color: #0069ad" aria-hidden="true"></i>
                                        @endif
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>


                            <x-slot name="content" style="z-index: 100000">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400" style="z-index:100">
                                    @if(Auth::user()->users_type_id == 3)
                                        @php($customerAccount = \App\Models\UserCustomer::query()->where('user_id', Auth::user()->id)->first())
                                        @php($QbCustomer = \App\Models\QbCustomer::query()->where('ListID', $customerAccount->customer_ListID)->first())

                                            {{$QbCustomer->Name}}
                                    @endif
{{--                                    {{ \Illuminate\Support\Facades\Auth::user()->name . ' ' .  \Illuminate\Support\Facades\Auth::user()->last_name . '(' . $usertypes->name . ')'}}--}}
                                </div>

                                {{--                            <x-jet-dropdown-link href="{{ route('profile.show') }}">--}}
                                {{--                                {{ __('Profile') }}--}}
                                {{--                            </x-jet-dropdown-link>--}}

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif
                                <div class="border-t border-gray-100"></div>
                                @auth()
                                    <x-jet-dropdown-link href="{{ route('dashboard') }}">
                                        {{ __('All items') }}
                                    </x-jet-dropdown-link>
                                @if(Auth::user()->users_type_id == 3)
                                        <x-jet-dropdown-link href="{{ route('customer-profile.index') }}">
                                            {{ __('Profile') }}
                                        </x-jet-dropdown-link>
                                @endif
                                    <x-jet-dropdown-link href="{{ route('orders') }}">
                                        {{ __('Orders') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('backorders') }}">
                                        {{ __('Backorders') }}
                                    </x-jet-dropdown-link>

                                    @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 2)
                                        <x-jet-dropdown-link target="_blank" href="https://v1.ttistore.com:463/index.php?r=viewqbcustomer%2Fcustomer-near-me">
                                            {{ __('Customer Near Me') }}
                                        </x-jet-dropdown-link>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 1)
                                        <x-jet-dropdown-link href="{{ route('audits') }}">
                                            {{ __('Audit trail') }}
                                        </x-jet-dropdown-link>
                                        <x-jet-dropdown-link href="{{ URL::to('upload/ads')}}">
                                            {{ __('Ads') }}
                                        </x-jet-dropdown-link>
                                    @endif
                                @endauth
                                <x-jet-dropdown-link target="_blank" href="https://v1.ttistore.com:463">
                                    {{ __('Go to TTISTORE 1.0') }}
                                </x-jet-dropdown-link>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>

                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @else
                    <div class="flex">
                        <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                                <a class="text-white" href="{{ route('login') }}"><p>Log in</p></a>
                        </div>
                        <h1 style="font-size: 20px; color: white; padding-left: 10px; padding-right: 10px">
                            |
                        </h1>
                        <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                                <a class="text-white" href="{{ route('customer-registration.index') }}"><p>Register</p></a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="px-3  hidden sm:block 2xl:hidden">
        <div class=" justify-center h-20 items-center">
            <div>
                <form class="" id="searchform" action="{{ route('dashboard') }}">
                    <ul class="flex">
                        <input onkeyup="searchItem4()" style="height:50px; width: 100%" id="search_input4" placeholder="Search..." name="search" @isset($_REQUEST['search']) value="{{ $_REQUEST['search'] }}" @endisset class="w-96 rounded-md" autocomplete="false" type="search">
                        <button class="btn " style="background-color: #0069AD; height: 50px">
                            <img style="width: 40px; height: 40px" src="{{ asset('search_glass.svg') }}" alt="">
                        </button>
                    </ul>
                </form>
                <div id="list_search4" style="z-index: 100000; position: absolute; max-height: 300px;"  class="hidden left-0 right-0">
                    <div id="searchwrap4" class="card card-body">
                        <div class="hidden" id="loading_searchwrap4" style="border-radius: 50px">
                            <img  src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="w-72 md:w-3/4 2xl:w-1/2" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="max-width: 450px">
                        </div>
                        <div id="item_searchwrap4" style="overflow-y: auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="place-items-center px-3 hidden sm:block">
        <div class="flex justify-between">
            <div
                x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
                x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                x-id="['dropdown-button']"
                class="relative"
            >
                <!-- Button -->
                <button
                    x-ref="button"
                    x-on:click="toggle()"
                    :aria-expanded="open"
                    :aria-controls="$id('dropdown-button')"
                    type="button"
                    class="flex items-center gap-2 bg-white px-5 py-2.5 rounded-md shadow"
                >
                    @if(session()->has('currency'))
                        @if(session()->get('currency') == 'EUR')
                            EUR🇪🇺
                        @endif
                            @if(session()->get('currency') == 'USD')
                            USD🇺🇸
                        @endif
                    @else
                        SRD🇸🇷
                    @endif


                    <!-- Heroicon: chevron-down -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Panel -->
                <div
                    x-ref="panel"
                    x-show="open"
                    x-transition.origin.top.left
                    x-on:click.outside="close($refs.button)"
                    :id="$id('dropdown-button')"
                    style="display: none; z-index: 999999"
                    class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md"
                >
                    <form action="{{ route('setCurrency') }}" method="post">
                        @csrf
                        <input name="currency" type="hidden" value="USD">
                        <button class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            USD🇺🇸
                        </button>
                    </form>
                    <form action="{{ route('setCurrency') }}" method="post">
                        @csrf
                        <input name="currency" type="hidden" value="EUR">
                        <button class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            EUR🇪🇺
                        </button>
                    </form>
                    <form action="{{ route('setCurrency') }}" method="post">
                        @csrf
                        <input name="currency" type="hidden" value="SRD">
                        <button class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            SRD🇸🇷
                        </button>
                    </form>
                </div>
            </div>
            <div class="hidden 2xl:block">
{{--                <a class="flex items-center gap-2 px-5 py-2.5 rounded-md shadow btn-primary" style="font-family: sfsemibold; text-decoration: none" href="{{ route('dashboard') }}">All Items--}}
{{--                </a>--}}
{{--                <a class="text-white" href="{{ route('dashboard') }}"><p>All Items</p></a>--}}
            </div>
{{--            <div x-cloak x-data="sidebar()" class="relative flex items-start hidden sm:block">--}}
{{--                <div style="bottom: 100px; z-index: 10000" class=" top-0 z-40 transition-all duration-300">--}}
{{--                    <div class="flex justify-end">--}}
{{--                        <button style="z-index: 10000" @click="sidebarOpen = !sidebarOpen" :class="{'hover:bg-gray-300': !sidebarOpen, 'hover:bg-gray-700': sidebarOpen}" class="transition-all duration-300 w-8 p-1 mx-3 my-2 rounded-full focus:outline-none">--}}
{{--                            <svg viewBox="0 0 20 20" class="w-6 h-6 fill-current" :class="{'text-gray-600': !sidebarOpen, 'text-gray-300': sidebarOpen}">--}}
{{--                                <path x-show="!sidebarOpen" fill="white" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>--}}
{{--                                <path x-show="sidebarOpen" fill="white" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div style="z-index: 1000" x-cloak wire:ignore :class="{'w-56': sidebarOpen, 'w-0': !sidebarOpen}" class="fixed top-44 bottom-0 right-0 z-30 block w-56 h-full min-h-screen overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out bg-gray-900 shadow-lg overflow-x-hidden">--}}

{{--                    <div class="flex flex-col items-stretch justify-between h-full" style="padding-top: 100px; z-index: 10000; background-color: #0069ad; color: white">--}}
{{--                        <div class="flex flex-col flex-shrink-0 w-full">--}}
{{--                            <div class="flex items-center justify-center px-8 py-3 text-center">--}}
{{--                                <a href="#" class="text-lg leading-normal text-gray-200 focus:outline-none focus:ring">My App</a>--}}
{{--                            </div>--}}

{{--                            <nav>--}}
{{--                                <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden" :class="{'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen}">--}}
{{--                                    <a class="flex justify-start items-center px-4 py-3 hover:bg-gray-800 hover:text-gray-400 focus:bg-gray-800 focus:outline-none focus:ring" href="#">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="w-5 h-5 fill-current" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1200 1200">--}}
{{--                                            <path d="M600 195.373c-331.371 0-600 268.629-600 600c0 73.594 13.256 144.104 37.5 209.253h164.062C168.665 942.111 150 870.923 150 795.373c0-248.528 201.471-450 450-450s450 201.472 450 450c0 75.55-18.665 146.738-51.562 209.253H1162.5c24.244-65.148 37.5-135.659 37.5-209.253c0-331.371-268.629-600-600-600zm0 235.62c-41.421 0-75 33.579-75 75c0 41.422 33.579 75 75 75s75-33.578 75-75c0-41.421-33.579-75-75-75zm-224.927 73.462c-41.421 0-75 33.579-75 75c0 41.422 33.579 75 75 75s75-33.578 75-75c0-41.421-33.579-75-75-75zm449.854 0c-41.422 0-75 33.579-75 75c0 41.422 33.578 75 75 75c41.421 0 75-33.578 75-75c0-41.421-33.579-75-75-75zM600 651.672l-58.813 294.141v58.814h117.627v-58.814L600 651.672z" fill="currentColor"></path>--}}
{{--                                        </svg>--}}
{{--                                        <span class="mx-4">Dashboard</span>--}}
{{--                                    </a>--}}

{{--                                    <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" href="">--}}
{{--                                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">--}}
{{--                                            <path d="M14,18a1,1,0,0,0,1-1V15a1,1,0,0,0-2,0v2A1,1,0,0,0,14,18Zm-4,0a1,1,0,0,0,1-1V15a1,1,0,0,0-2,0v2A1,1,0,0,0,10,18ZM19,6H17.62L15.89,2.55a1,1,0,1,0-1.78.9L15.38,6H8.62L9.89,3.45a1,1,0,0,0-1.78-.9L6.38,6H5a3,3,0,0,0-.92,5.84l.74,7.46a3,3,0,0,0,3,2.7h8.38a3,3,0,0,0,3-2.7l.74-7.46A3,3,0,0,0,19,6ZM17.19,19.1a1,1,0,0,1-1,.9H7.81a1,1,0,0,1-1-.9L6.1,12H17.9ZM19,10H5A1,1,0,0,1,5,8H19a1,1,0,0,1,0,2Z" />--}}
{{--                                        </svg>--}}
{{--                                        <span class="mx-4">Orders</span>--}}
{{--                                    </a>--}}

{{--                                    <a class="flex items-center px-4 py-3 hover:bg-gray-800 focus:bg-gray-800 hover:text-gray-400 focus:outline-none focus:ring" href="#">--}}
{{--                                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">--}}
{{--                                            <path d="M9,10h1a1,1,0,0,0,0-2H9a1,1,0,0,0,0,2Zm0,2a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2ZM20,8.94a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.32.32,0,0,0-.09,0A.88.88,0,0,0,13.05,2H7A3,3,0,0,0,4,5V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V9S20,9,20,8.94ZM14,5.41,16.59,8H15a1,1,0,0,1-1-1ZM18,19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V5A1,1,0,0,1,7,4h5V7a3,3,0,0,0,3,3h3Zm-3-3H9a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2Z" />--}}
{{--                                        </svg>--}}
{{--                                        <span class="mx-4">Pages</span>--}}

{{--                                    </a>--}}

{{--                                </div>--}}

{{--                            </nav>--}}

{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <a title="Logout" href="{{ route('logout') }}" class="block px-4 py-3" onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
{{--                                <svg class="text-gray-400 fill-current w-7 h-7" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-label="door-leave" viewBox="0 0 32 32" title="door-leave">--}}
{{--                                    <g>--}}
{{--                                        <path d="M27.708,15.293c0.39,0.39 0.39,1.024 0,1.414l-4,4c-0.391,0.391 -1.024,0.391 -1.415,0c-0.39,-0.39 -0.39,-1.024 0,-1.414l2.293,-2.293l-11.586,0c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1l11.586,0l-2.293,-2.293c-0.39,-0.39 -0.39,-1.024 0,-1.414c0.391,-0.391 1.024,-0.391 1.415,0l4,4Z">--}}
{{--                                        </path>--}}
{{--                                        <path d="M11.999,8c0.001,0 0.001,0 0.002,0c1.699,-0.001 2.859,0.045 3.77,0.25c0.005,0.001 0.01,0.002 0.015,0.003c0.789,0.173 1.103,0.409 1.291,0.638c0,0 0,0.001 0,0.001c0.231,0.282 0.498,0.834 0.679,2.043c0,0.001 0,0.002 0.001,0.003c0.007,0.048 0.014,0.097 0.021,0.147c0.072,0.516 0.501,0.915 1.022,0.915c0.584,0 1.049,-0.501 0.973,-1.08c-0.566,-4.332 -2.405,-4.92 -7.773,-4.92c-7,0 -8,1 -8,10c0,9 1,10 8,10c5.368,0 7.207,-0.588 7.773,-4.92c0.076,-0.579 -0.389,-1.08 -0.973,-1.08c-0.521,0 -0.95,0.399 -1.022,0.915c-0.007,0.05 -0.014,0.099 -0.021,0.147c-0.001,0.001 -0.001,0.002 -0.001,0.003c-0.181,1.209 -0.448,1.762 -0.679,2.044l0,0c-0.188,0.229 -0.502,0.465 -1.291,0.638c-0.005,0.001 -0.01,0.002 -0.015,0.003c-0.911,0.204 -2.071,0.25 -3.77,0.25c-0.001,0 -0.001,0 -0.002,0c-1.699,0 -2.859,-0.046 -3.77,-0.25c-0.005,-0.001 -0.01,-0.002 -0.015,-0.003c-0.789,-0.173 -1.103,-0.409 -1.291,-0.638l0,0c-0.231,-0.282 -0.498,-0.835 -0.679,-2.043c0,-0.001 0,-0.003 -0.001,-0.005c-0.189,-1.247 -0.243,-2.848 -0.243,-5.061c0,0 0,0 0,0c0,-2.213 0.054,-3.814 0.243,-5.061c0.001,-0.002 0.001,-0.004 0.001,-0.005c0.181,-1.208 0.448,-1.76 0.679,-2.042c0,0 0,-0.001 0,-0.001c0.188,-0.229 0.502,-0.465 1.291,-0.638c0.005,-0.001 0.01,-0.002 0.015,-0.003c0.911,-0.205 2.071,-0.251 3.77,-0.25Z">--}}
{{--                                        </path>--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <script>--}}
{{--                        function sidebar() {--}}
{{--                            return {--}}
{{--                                sidebarOpen: true,--}}
{{--                                sidebarProductMenuOpen: false,--}}
{{--                                openSidebar() {--}}
{{--                                    this.sidebarOpen = true--}}
{{--                                },--}}
{{--                                closeSidebar() {--}}
{{--                                    this.sidebarOpen = false--}}
{{--                                },--}}
{{--                                sidebarProductMenu() {--}}
{{--                                    if (this.sidebarProductMenuOpen === true) {--}}
{{--                                        this.sidebarProductMenuOpen = false--}}
{{--                                        window.localStorage.setItem('sidebarProductMenuOpen', 'close');--}}
{{--                                    } else {--}}
{{--                                        this.sidebarProductMenuOpen = true--}}
{{--                                        window.localStorage.setItem('sidebarProductMenuOpen', 'open');--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                checkSidebarProductMenu() {--}}
{{--                                    if (window.localStorage.getItem('sidebarProductMenuOpen')) {--}}
{{--                                        if (window.localStorage.getItem('sidebarProductMenuOpen') === 'open') {--}}
{{--                                            this.sidebarProductMenuOpen = true--}}
{{--                                        } else {--}}
{{--                                            this.sidebarProductMenuOpen = false--}}
{{--                                            window.localStorage.setItem('sidebarProductMenuOpen', 'close');--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                },--}}
{{--                            }--}}
{{--                        }--}}
{{--                    </script>--}}
{{--                </div>--}}

{{--            </div>--}}
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20  sm:h-10">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a class="block md:hidden" href="{{ route('home') }}">
                        <x-jet-application-mark class="block h-9 w-auto" style="height: auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex pl-10">
                    <div class="pt-3">
                    </div>
                    <div class="pt-3"></div>
                    <div class="pt-3"></div>
                    {{--                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">--}}
                    {{--                        {{ __('Items') }}--}}
                    {{--                    </x-jet-nav-link>--}}
                    {{--                    @if(\Illuminate\Support\Facades\Auth::user() != null)--}}
                    {{--                        <x-jet-nav-link  href="{{ route('orders') }}" :active="request()->routeIs('orders')">--}}
                    {{--                            {{ __('Orders') }}--}}
                    {{--                        </x-jet-nav-link>--}}
                    {{--                        <x-jet-nav-link  href="{{ route('backorders') }}" :active="request()->routeIs('backorders')">--}}
                    {{--                            {{ __('Backorders') }}--}}
                    {{--                        </x-jet-nav-link>--}}
                    {{--                    @endif--}}
                </div>
            </div>
            <div class="hidden sm:block">
                <div>
                    <div class="w-full" style="padding-left: 50px; padding-right: 50px">
                        <div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif
            </div>



            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="white" viewBox="0 0 24 24">
                        <path fill="white" :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path fill="white" :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                {{--                @else--}}
                {{--                    <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">--}}
                {{--                        <a class="text-white" href="{{ route('login') }}"><p>Log in</p></a>--}}
                {{--                    </button>--}}
                {{--                @endif--}}
            </div>
        </div>
    </div>
    <div class="px-3 sm:hidden">
        <div class="justify-center h-20 items-center">
            <div>
                <form class="" id="searchform" action="{{ route('dashboard') }}">
                    <ul class="flex">
                        <input onkeyup="searchItem3()" style="height:50px; width: 100%" id="search_input3" placeholder="Search..." name="search" class="w-96 rounded-md" autocomplete="false" type="search">
                        <button class="btn " style="background-color: #0069AD; height: 50px">
                            <img style="width: 40px; height: 40px" src="{{ asset('search_glass.svg') }}" alt="">
                        </button>
                    </ul>
                </form>
                <div id="list_search3" style="z-index: 100000; position: absolute; max-height: 300px;"  class="hidden left-0 right-0">
                    <div id="searchwrap3" class="card card-body">
                        <div class="hidden" id="loading_searchwrap3" style="border-radius: 50px">
                            <img  src="{{ asset('ttistore_loading.gif') }}" jsaction="load:XAeZkd;" jsname="HiaYvf" class="w-72 md:w-3/4 2xl:w-1/2" alt="Color Fill Loading Image Gif | Webpage design, Gif, Animation" data-noaft="1" style="max-width: 450px">
                        </div>
                        <div id="item_searchwrap3" style="overflow-y: auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open , 'hidden': ! open}" style="background-color: #0069ad; z-index: 1000;" class="hidden absolute w-full">
        <div class="pt-2 pb-3 space-y-1">
{{--            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">--}}
{{--                {{ __('Items') }}--}}
{{--            </x-jet-responsive-nav-link>--}}
            @if(\Illuminate\Support\Facades\Auth::user() != null)

                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('All items') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('orders') }}" :active="request()->routeIs('orders')">
                    {{ __('Orders') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('backorders') }}" :active="request()->routeIs('backorders')">
                    {{ __('Backorders') }}
                </x-jet-responsive-nav-link>
            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 2)
                <x-jet-responsive-nav-link target="_blank" href="https://v1.ttistore.com:463/index.php?r=viewqbcustomer%2Fcustomer-near-me">
                    {{ __('Customers Near Me') }}
                </x-jet-responsive-nav-link>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 1)
                <x-jet-responsive-nav-link href="{{ route('audits') }}">
                    {{ __('Audit trail') }}
                </x-jet-responsive-nav-link>
                @endif
                <x-jet-responsive-nav-link target="_blank" href="https://v1.ttistore.com:463">
                    {{ __('Go to TTISTORE 1.0') }}
                </x-jet-responsive-nav-link>
            @else
                <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('customer-registration.index') }}" :active="request()->routeIs('customer-registration.index')">
                    {{ __('Register') }}
                </x-jet-responsive-nav-link>
            @endif
            <x-jet-responsive-nav-link x-data="{ expanded: false }">
                <button @click="expanded = ! expanded">
                    @if(session()->has('currency'))
                        @if(session()->get('currency') == 'EUR')
                            EUR🇪🇺
                        @endif
                        @if(session()->get('currency') == 'USD')
                            USD🇺🇸
                        @endif
                    @else
                        SRD🇸🇷
                    @endif
                </button>

                <div @click.away="expanded= false" class="px-8" x-show="expanded" x-collapse>
                    <form action="{{ route('setCurrency') }}" method="post">
                        @csrf
                        <input name="currency" type="hidden" value="USD">
                        <button class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            USD🇺🇸
                        </button>
                    </form>
                    <form action="{{ route('setCurrency') }}" method="post">
                        @csrf
                        <input name="currency" type="hidden" value="EUR">
                        <button class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            EUR🇪🇺
                        </button>
                    </form>
                    <form action="{{ route('setCurrency') }}" method="post">
                        @csrf
                        <input name="currency" type="hidden" value="SRD">
                        <button class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            SRD🇸🇷
                        </button>
                    </form>
                </div>
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @if(\Illuminate\Support\Facades\Auth::user() != null)
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-300">{{ Auth::user()->name }}({{ $usertypes->name }})</div>
                        <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    {{--                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">--}}
                    {{--                    {{ __('Profile') }}--}}
                    {{--                </x-jet-responsive-nav-link>--}}

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-jet-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                   @click.prevent="$root.submit();">
                            {{ __('Log Out') }}<i style="padding-left: 10px; padding-top: 10px" class="fa fa-sign-out" aria-hidden="true"></i>
                        </x-jet-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>
                        <!-- Team Settings -->
                        <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-jet-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-jet-responsive-nav-link>
                        @endcan

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    </div>
    <script>
        function searchItem2()
        {
            if(document.getElementById('search_input2').value === '')
            {
                document.getElementById("list_search2").classList.add('hidden');
            }
            else
            {
                document.getElementById("list_search2").classList.remove('hidden');
                document.getElementById("item_searchwrap2").classList.add('hidden');
                document.getElementById("list_search2").classList.add('block');
                const items = new XMLHttpRequest();
                document.getElementById("loading_searchwrap2").classList.remove('hidden');
                document.getElementById("item_searchwrap2").classList.add('hidden');
                document.getElementById("loading_searchwrap2").classList.add('block');
                items.onload = function()
                {
                    document.getElementById("item_searchwrap2").classList.remove('hidden');
                    document.getElementById("loading_searchwrap2").classList.remove('block');
                    document.getElementById("loading_searchwrap2").classList.add('hidden');
                    document.getElementById("item_searchwrap2").innerHTML = this.responseText;
                }
                items.open("GET", '{{ route('getItems') }}?search=' + document.getElementById('search_input2').value , true);
                items.send();
            }

        }
    </script>
    <script>
        function searchItem3()
        {
            if(document.getElementById('search_input3').value === '')
            {
                document.getElementById("list_search3").classList.add('hidden');
            }
            else
            {
                document.getElementById("list_search3").classList.remove('hidden');
                document.getElementById("item_searchwrap3").classList.add('hidden');
                document.getElementById("list_search3").classList.add('block');
                const items = new XMLHttpRequest();
                document.getElementById("loading_searchwrap3").classList.remove('hidden');
                document.getElementById("item_searchwrap3").classList.add('hidden');
                document.getElementById("loading_searchwrap3").classList.add('block');
                items.onload = function()
                {
                    document.getElementById("item_searchwrap3").classList.remove('hidden');
                    document.getElementById("loading_searchwrap3").classList.remove('block');
                    document.getElementById("loading_searchwrap3").classList.add('hidden');
                    document.getElementById("item_searchwrap3").innerHTML = this.responseText;
                }
                items.open("GET", '{{ route('getItems') }}?search=' + document.getElementById('search_input3').value , true);
                items.send();
            }

        }
    </script>
    <script>
        function searchItem4()
        {
            if(document.getElementById('search_input4').value === '')
            {
                document.getElementById("list_search4").classList.add('hidden');
            }
            else
            {
                document.getElementById("list_search4").classList.remove('hidden');
                document.getElementById("item_searchwrap4").classList.add('hidden');
                document.getElementById("list_search4").classList.add('block');
                const items = new XMLHttpRequest();
                document.getElementById("loading_searchwrap4").classList.remove('hidden');
                document.getElementById("item_searchwrap4").classList.add('hidden');
                document.getElementById("loading_searchwrap4").classList.add('block');
                items.onload = function()
                {
                    document.getElementById("item_searchwrap4").classList.remove('hidden');
                    document.getElementById("loading_searchwrap4").classList.remove('block');
                    document.getElementById("loading_searchwrap4").classList.add('hidden');
                    document.getElementById("item_searchwrap4").innerHTML = this.responseText;
                }
                items.open("GET", '{{ route('getItems') }}?search=' + document.getElementById('search_input4').value , true);
                items.send();
            }

        }
    </script>
    <script>
        document.body.addEventListener("click", function (evt) {
            document.getElementById("list_search2").classList.add('hidden');

        });
    </script>
    <script>
        document.body.addEventListener("click", function (evt) {
            document.getElementById("list_search3").classList.add('hidden');

        });
    </script>
    <script>
        window.addEventListener('addedcart', (e) => {
            toastr.success("Added to Cart")
        });
        window.addEventListener('Invalid', (e) => {
            toastr.warning("Not a valid value")
        });
        window.addEventListener('removedcart', (e) => {
            toastr.warning("Removed from Cart")
        });
        window.addEventListener('clearcart', (e) => {
            toastr.warning("Cart cleared")
        });
        window.addEventListener('qtyupdate', (e) => {
            toastr.info("Updated Quantity")
        });
        window.addEventListener('addedbo', (e) => {
            toastr.success("Created Backorder")
        });
    </script>
</nav>

