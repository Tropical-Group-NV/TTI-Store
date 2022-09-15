<nav x-data="{ open: false }" class="border-b border-gray-100" style="background-color: #0069AD; z-index: 1000">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @if(\Illuminate\Support\Facades\Auth::user() != null)
        @php($usertypes = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_type')->where('id', \Illuminate\Support\Facades\Auth::user()->users_type_id)->first())
    @endif

    <!-- Primary Navigation Menu -->
    <div class="px-3 hidden md:block">
        <div class="flex justify-between h-20 items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('Logo-05.png') }}" alt="" class="block lg:block" style="height: 50px">
                {{--                <img src="{{ asset('Logo-05-2.png') }}" alt="" class="block lg:hidden" style="height: 50px">--}}
            </a>
            <div class="hidden 2xl:block">
                <form class="flex-shrink-0" id="searchform" action="{{ route('dashboard') }}">
                    <ul class="flex">
                        <input onkeyup="searchItem2()" style="height:50px; width: 1000px" id="search_input2" placeholder="Search..." name="search" class="w-96 rounded-md flex-shrink-0" autocomplete="false" type="search">
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
                        <x-jet-dropdown align="right" width="48" style="">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        <span class=""> {{ Auth::user()->name }}({{ $usertypes->name }}) </span> <i class="fa fa-user" style="color: #0069ad" aria-hidden="true"></i>

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                </span>
                                @endif
                            </x-slot>


                            <x-slot name="content" style="z-index: 10">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400" style="z-index:100">
                                    {{ \Illuminate\Support\Facades\Auth::user()->name . ' ' .  \Illuminate\Support\Facades\Auth::user()->last_name . '(' . $usertypes->name . ')'}}
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
                                    <x-jet-dropdown-link href="{{ route('orders') }}">
                                        {{ __('Orders') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('backorders') }}">
                                        {{ __('Backorders') }}
                                    </x-jet-dropdown-link>
                                    @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 2)
                                        <x-jet-dropdown-link target="_blank" href="https://www.ttistore.com/index.php?r=viewqbcustomer%2Fcustomer-near-me">
                                            {{ __('Customer Near Me') }}
                                        </x-jet-dropdown-link>
                                    @endif
                                @endauth
                                <x-jet-dropdown-link href="https://www.ttistore.com">
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
                            <div @click="open = ! open">
                                <a class="text-white" href="{{ route('login') }}"><p>Log in</p></a>
                            </div>
                        </div>
                        <h1 style="font-size: 20px; color: white; padding-left: 10px; padding-right: 10px">
                            |
                        </h1>
                        <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                            <div @click="open = ! open">
                                <a class="text-white" href="{{ route('customer-registration.index') }}"><p>Register</p></a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="px-3 hidden sm:block 2xl:hidden">
        <div class=" justify-center h-20 items-center">
            <div>
                <form class="" id="searchform" action="{{ route('dashboard') }}">
                    <ul class="flex">
                        <input onkeyup="searchItem4()" style="height:50px; width: 100%" id="search_input4" placeholder="Search..." name="search" class="w-96 rounded-md" autocomplete="false" type="search">
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

                <x-jet-responsive-nav-link href="{{ route('orders') }}" :active="request()->routeIs('orders')">
                    {{ __('Orders') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('backorders') }}" :active="request()->routeIs('backorders')">
                    {{ __('Backorders') }}
                </x-jet-responsive-nav-link>
            @if(\Illuminate\Support\Facades\Auth::user()->users_type_id == 2)
                <x-jet-responsive-nav-link href="https://www.ttistore.com/index.php?r=viewqbcustomer%2Fcustomer-near-me">
                    {{ __('Customers Near Me') }}
                </x-jet-responsive-nav-link>
                @endif
                <x-jet-responsive-nav-link href="https://www.ttistore.com">
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

