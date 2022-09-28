<x-app-layout>
    <!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
    <div class="bg-gray-50">
        <!--
          Mobile menu

          Off-canvas menu for mobile, show/hide based on off-canvas menu state.
        -->
        <div class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">
            <!--
              Off-canvas menu overlay, show/hide based on off-canvas menu state.

              Entering: "transition-opacity ease-linear duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "transition-opacity ease-linear duration-300"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>

            <!--
              Off-canvas menu, show/hide based on off-canvas menu state.

              Entering: "transition ease-in-out duration-300 transform"
                From: "-translate-x-full"
                To: "translate-x-0"
              Leaving: "transition ease-in-out duration-300 transform"
                From: "translate-x-0"
                To: "-translate-x-full"
            -->
            <div class="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto hidden">
                <div class="px-4 pt-5 pb-2 flex">
                    <button type="button" class="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400">
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Links -->
                <div class="mt-2">
                    <div class="border-b border-gray-200">
                        <div class="-mb-px flex px-4 space-x-8" aria-orientation="horizontal" role="tablist">
                            <!-- Selected: "text-indigo-600 border-indigo-600", Not Selected: "text-gray-900 border-transparent" -->
                            <button id="tabs-1-tab-1" class="text-gray-900 border-transparent flex-1 whitespace-nowrap py-4 px-1 border-b-2 text-base font-medium" aria-controls="tabs-1-panel-1" role="tab" type="button">Women</button>

                            <!-- Selected: "text-indigo-600 border-indigo-600", Not Selected: "text-gray-900 border-transparent" -->
                            <button id="tabs-1-tab-2" class="text-gray-900 border-transparent flex-1 whitespace-nowrap py-4 px-1 border-b-2 text-base font-medium" aria-controls="tabs-1-panel-2" role="tab" type="button">Men</button>
                        </div>
                    </div>

                    <!-- 'Women' tab panel, show/hide based on tab state. -->
                    <div id="tabs-1-panel-1" class="pt-10 pb-8 px-4 space-y-10" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="group relative text-sm">
                                <div class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden group-hover:opacity-75">
                                    <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-center object-cover">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                    <span class="absolute z-10 inset-0" aria-hidden="true"></span>
                                    New Arrivals
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>

                            <div class="group relative text-sm">
                                <div class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden group-hover:opacity-75">
                                    <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg" alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees." class="object-center object-cover">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                    <span class="absolute z-10 inset-0" aria-hidden="true"></span>
                                    Basic Tees
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>
                        </div>

                        <div>
                            <p id="women-clothing-heading-mobile" class="font-medium text-gray-900">Clothing</p>
                            <ul role="list" aria-labelledby="women-clothing-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Tops </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Dresses </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Pants </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Denim </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Sweaters </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> T-Shirts </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Jackets </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Activewear </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Browse All </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <p id="women-accessories-heading-mobile" class="font-medium text-gray-900">Accessories</p>
                            <ul role="list" aria-labelledby="women-accessories-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Watches </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Wallets </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Bags </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Sunglasses </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Hats </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Belts </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <p id="women-brands-heading-mobile" class="font-medium text-gray-900">Brands</p>
                            <ul role="list" aria-labelledby="women-brands-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Full Nelson </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> My Way </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Re-Arranged </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Counterfeit </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Significant Other </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- 'Men' tab panel, show/hide based on tab state. -->
                    <div id="tabs-1-panel-2" class="pt-10 pb-8 px-4 space-y-10" aria-labelledby="tabs-1-tab-2" role="tabpanel" tabindex="0">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="group relative text-sm">
                                <div class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden group-hover:opacity-75">
                                    <img src="https://tailwindui.com/img/ecommerce-images/product-page-04-detail-product-shot-01.jpg" alt="Drawstring top with elastic loop closure and textured interior padding." class="object-center object-cover">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                    <span class="absolute z-10 inset-0" aria-hidden="true"></span>
                                    New Arrivals
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>

                            <div class="group relative text-sm">
                                <div class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden group-hover:opacity-75">
                                    <img src="https://tailwindui.com/img/ecommerce-images/category-page-02-image-card-06.jpg" alt="Three shirts in gray, white, and blue arranged on table with same line drawing of hands and shapes overlapping on front of shirt." class="object-center object-cover">
                                </div>
                                <a href="#" class="mt-6 block font-medium text-gray-900">
                                    <span class="absolute z-10 inset-0" aria-hidden="true"></span>
                                    Artwork Tees
                                </a>
                                <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>
                        </div>

                        <div>
                            <p id="men-clothing-heading-mobile" class="font-medium text-gray-900">Clothing</p>
                            <ul role="list" aria-labelledby="men-clothing-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Tops </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Pants </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Sweaters </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> T-Shirts </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Jackets </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Activewear </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Browse All </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <p id="men-accessories-heading-mobile" class="font-medium text-gray-900">Accessories</p>
                            <ul role="list" aria-labelledby="men-accessories-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Watches </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Wallets </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Bags </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Sunglasses </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Hats </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Belts </a>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <p id="men-brands-heading-mobile" class="font-medium text-gray-900">Brands</p>
                            <ul role="list" aria-labelledby="men-brands-heading-mobile" class="mt-6 flex flex-col space-y-6">
                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Re-Arranged </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Counterfeit </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> Full Nelson </a>
                                </li>

                                <li class="flow-root">
                                    <a href="#" class="-m-2 p-2 block text-gray-500"> My Way </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 py-6 px-4 space-y-6">
                    <div class="flow-root">
                        <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Company</a>
                    </div>

                    <div class="flow-root">
                        <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Stores</a>
                    </div>
                </div>

                <div class="border-t border-gray-200 py-6 px-4 space-y-6">
                    <div class="flow-root">
                        <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Sign in</a>
                    </div>
                    <div class="flow-root">
                        <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Create account</a>
                    </div>
                </div>

                <div class="border-t border-gray-200 py-6 px-4">
                    <a href="#" class="-m-2 p-2 flex items-center">
                        <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt="" class="w-5 h-auto block flex-shrink-0">
                        <span class="ml-3 block text-base font-medium text-gray-900"> CAD </span>
                        <span class="sr-only">, change currency</span>
                    </a>
                </div>
            </div>
        </div>

        <header class="relative bg-white">
            <p class="bg-indigo-600 h-10 flex items-center justify-center text-sm font-medium text-white px-4 sm:px-6 lg:px-8">Get free delivery on orders over $100</p>

            <nav aria-label="Top" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="border-b border-gray-200">
                    <div class="h-16 flex items-center">
                        <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                        <button type="button" class="bg-white p-2 rounded-md text-gray-400 lg:hidden">
                            <span class="sr-only">Open menu</span>
                            <!-- Heroicon name: outline/menu -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Logo -->
                        <div class="ml-4 flex lg:ml-0">
                            <a href="#">
                                <span class="sr-only">Workflow</span>
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="">
                            </a>
                        </div>

                        <!-- Flyout menus -->


                        <div class="ml-auto flex items-center">
                            <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                                <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</a>
                            </div>

                            <div class="hidden lg:ml-8 lg:flex">
                                <a href="#" class="text-gray-700 hover:text-gray-800 flex items-center">
                                    <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt="" class="w-5 h-auto block flex-shrink-0">
                                    <span class="ml-3 block text-sm font-medium"> CAD </span>
                                    <span class="sr-only">, change currency</span>
                                </a>
                            </div>

                            <!-- Search -->
                            <div class="flex lg:ml-6">
                                <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Search</span>
                                    <!-- Heroicon name: outline/search -->
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </a>
                            </div>

                            <!-- Cart -->
                            <div class="ml-4 flow-root lg:ml-6">
                                <a href="#" class="group -m-2 p-2 flex items-center">
                                    <!-- Heroicon name: outline/shopping-bag -->
                                    <svg class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                                    <span class="sr-only">items in cart, view bag</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <!-- Product -->
            <div class="bg-white">
                <div class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:pt-24 sm:pb-32 sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
                    <!-- Product details -->
                    <div class="lg:max-w-lg lg:self-end">
                        <nav aria-label="Breadcrumb">
                            <ol role="list" class="flex items-center space-x-2">
                                <li>
                                    <div class="flex items-center text-sm">
                                        <a href="#" class="font-medium text-gray-500 hover:text-gray-900"> Travel </a>

                                        <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" class="ml-2 flex-shrink-0 h-5 w-5 text-gray-300">
                                            <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                        </svg>
                                    </div>
                                </li>

                                <li>
                                    <div class="flex items-center text-sm">
                                        <a href="#" class="font-medium text-gray-500 hover:text-gray-900"> Bags </a>
                                    </div>
                                </li>
                            </ol>
                        </nav>

                        <div class="mt-4">
                            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Everyday Ruck Snack</h1>
                        </div>

                        <section aria-labelledby="information-heading" class="mt-4">
                            <h2 id="information-heading" class="sr-only">Product information</h2>

                            <div class="flex items-center">
                                <p class="text-lg text-gray-900 sm:text-xl">$220</p>

                                <div class="ml-4 pl-4 border-l border-gray-300">
                                    <h2 class="sr-only">Reviews</h2>
                                    <div class="flex items-center">
                                        <div>
                                            <div class="flex items-center">
                                                <!--
                                                  Heroicon name: solid/star

                                                  Active: "text-yellow-400", Default: "text-gray-300"
                                                -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-gray-300 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </div>
                                            <p class="sr-only">4 out of 5 stars</p>
                                        </div>
                                        <p class="ml-2 text-sm text-gray-500">1624 reviews</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 space-y-6">
                                <p class="text-base text-gray-500">Don&#039;t compromise on snack-carrying capacity with this lightweight and spacious bag. The drawstring top keeps all your favorite chips, crisps, fries, biscuits, crackers, and cookies secure.</p>
                            </div>

                            <div class="mt-6 flex items-center">
                                <!-- Heroicon name: solid/check -->
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-gray-500">In stock and ready to ship</p>
                            </div>
                        </section>
                    </div>

                    <!-- Product image -->
                    <div class="mt-10 lg:mt-0 lg:col-start-2 lg:row-span-2 lg:self-center">
                        <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-04-featured-product-shot.jpg" alt="Light green canvas bag with black straps, handle, front zipper pouch, and drawstring top." class="w-full h-full object-center object-cover">
                        </div>
                    </div>

                    <!-- Product form -->
                    <div class="mt-10 lg:max-w-lg lg:col-start-1 lg:row-start-2 lg:self-start">
                        <section aria-labelledby="options-heading">
                            <h2 id="options-heading" class="sr-only">Product options</h2>

                            <form>
                                <div class="sm:flex sm:justify-between">
                                    <!-- Size selector -->
                                    <fieldset>
                                        <legend class="block text-sm font-medium text-gray-700">Size</legend>
                                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <!-- Active: "ring-2 ring-indigo-500" -->
                                            <label class="relative block border border-gray-300 rounded-lg p-4 cursor-pointer focus:outline-none">
                                                <input type="radio" name="size-choice" value="18L" class="sr-only" aria-labelledby="size-choice-0-label" aria-describedby="size-choice-0-description">
                                                <p id="size-choice-0-label" class="text-base font-medium text-gray-900">18L</p>
                                                <p id="size-choice-0-description" class="mt-1 text-sm text-gray-500">Perfect for a reasonable amount of snacks.</p>
                                                <!--
                                                  Active: "border", Not Active: "border-2"
                                                  Checked: "border-indigo-500", Not Checked: "border-transparent"
                                                -->
                                                <div class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
                                            </label>

                                            <!-- Active: "ring-2 ring-indigo-500" -->
                                            <label class="relative block border border-gray-300 rounded-lg p-4 cursor-pointer focus:outline-none">
                                                <input type="radio" name="size-choice" value="20L" class="sr-only" aria-labelledby="size-choice-1-label" aria-describedby="size-choice-1-description">
                                                <p id="size-choice-1-label" class="text-base font-medium text-gray-900">20L</p>
                                                <p id="size-choice-1-description" class="mt-1 text-sm text-gray-500">Enough room for a serious amount of snacks.</p>
                                                <!--
                                                  Active: "border", Not Active: "border-2"
                                                  Checked: "border-indigo-500", Not Checked: "border-transparent"
                                                -->
                                                <div class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="group inline-flex text-sm text-gray-500 hover:text-gray-700">
                                        <span>What size should I buy?</span>
                                        <!-- Heroicon name: solid/question-mark-circle -->
                                        <svg class="flex-shrink-0 ml-2 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-10">
                                    <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Add to bag</button>
                                </div>
                                <div class="mt-6 text-center">
                                    <a href="#" class="group inline-flex text-base font-medium">
                                        <!-- Heroicon name: outline/shield-check -->
                                        <svg class="flex-shrink-0 mr-2 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <span class="text-gray-500 hover:text-gray-700">Lifetime Guarantee</span>
                                    </a>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>

            <div class="max-w-2xl mx-auto px-4 py-24 sm:px-6 sm:py-32 lg:max-w-7xl lg:px-8">
                <!-- Details section -->
                <section aria-labelledby="details-heading">
                    <div class="flex flex-col items-center text-center">
                        <h2 id="details-heading" class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">The Fine Details</h2>
                        <p class="mt-3 max-w-3xl text-lg text-gray-600">Our patented padded snack sleeve construction protects your favorite treats from getting smooshed during all-day adventures, long shifts at work, and tough travel schedules.</p>
                    </div>

                    <div class="mt-16 grid grid-cols-1 gap-y-16 lg:grid-cols-2 lg:gap-x-8">
                        <div>
                            <div class="w-full aspect-w-3 aspect-h-2 rounded-lg overflow-hidden">
                                <img src="https://tailwindui.com/img/ecommerce-images/product-page-04-detail-product-shot-01.jpg" alt="Drawstring top with elastic loop closure and textured interior padding." class="w-full h-full object-center object-cover">
                            </div>
                            <p class="mt-8 text-base text-gray-500">The 20L model has enough space for 370 candy bars, 6 cylinders of chips, 1,220 standard gumballs, or any combination of on-the-go treats that your heart desires. Yes, we did the math.</p>
                        </div>
                        <div>
                            <div class="w-full aspect-w-3 aspect-h-2 rounded-lg overflow-hidden">
                                <img src="https://tailwindui.com/img/ecommerce-images/product-page-04-detail-product-shot-02.jpg" alt="Front zipper pouch with included key ring." class="w-full h-full object-center object-cover">
                            </div>
                            <p class="mt-8 text-base text-gray-500">Up your snack organization game with multiple compartment options. The quick-access stash pouch is ready for even the most unexpected snack attacks and sharing needs.</p>
                        </div>
                    </div>
                </section>

                <!-- Policies section -->
                <section aria-labelledby="policy-heading" class="mt-16 lg:mt-24">
                    <h2 id="policy-heading" class="sr-only">Our policies</h2>
                    <div class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8">
                        <div>
                            <img src="https://tailwindui.com/img/ecommerce/icons/icon-delivery-light.svg" alt="" class="h-24 w-auto">
                            <h3 class="mt-6 text-base font-medium text-gray-900">Free delivery all year long</h3>
                            <p class="mt-3 text-base text-gray-500">Name another place that offers year long free delivery? We’ll be waiting. Order now and you’ll get delivery absolutely free.</p>
                        </div>

                        <div>
                            <img src="https://tailwindui.com/img/ecommerce/icons/icon-chat-light.svg" alt="" class="h-24 w-auto">
                            <h3 class="mt-6 text-base font-medium text-gray-900">24/7 Customer Support</h3>
                            <p class="mt-3 text-base text-gray-500">Or so we want you to believe. In reality our chat widget is powered by a naive series of if/else statements that churn out canned responses. Guaranteed to irritate.</p>
                        </div>

                        <div>
                            <img src="https://tailwindui.com/img/ecommerce/icons/icon-fast-checkout-light.svg" alt="" class="h-24 w-auto">
                            <h3 class="mt-6 text-base font-medium text-gray-900">Fast Shopping Cart</h3>
                            <p class="mt-3 text-base text-gray-500">Look at the cart in that icon, there&#039;s never been a faster cart. What does this mean for the actual checkout experience? I don&#039;t know.</p>
                        </div>

                        <div>
                            <img src="https://tailwindui.com/img/ecommerce/icons/icon-gift-card-light.svg" alt="" class="h-24 w-auto">
                            <h3 class="mt-6 text-base font-medium text-gray-900">Gift Cards</h3>
                            <p class="mt-3 text-base text-gray-500">We sell these hoping that you will buy them for your friends and they will never actually use it. Free money for us, it&#039;s great.</p>
                        </div>
                    </div>
                </section>
            </div>

            <section aria-labelledby="reviews-heading" class="bg-white">
                <div class="max-w-2xl mx-auto py-24 px-4 sm:px-6 lg:max-w-7xl lg:py-32 lg:px-8 lg:grid lg:grid-cols-12 lg:gap-x-8">
                    <div class="lg:col-span-4">
                        <h2 id="reviews-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Customer Reviews</h2>

                        <div class="mt-3 flex items-center">
                            <div>
                                <div class="flex items-center">
                                    <!--
                                      Heroicon name: solid/star

                                      Active: "text-yellow-400", Default: "text-gray-300"
                                    -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>

                                    <!-- Heroicon name: solid/star -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>

                                    <!-- Heroicon name: solid/star -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>

                                    <!-- Heroicon name: solid/star -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>

                                    <!-- Heroicon name: solid/star -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <p class="sr-only">4 out of 5 stars</p>
                            </div>
                            <p class="ml-2 text-sm text-gray-900">Based on 1624 reviews</p>
                        </div>

                        <div class="mt-6">
                            <h3 class="sr-only">Review data</h3>

                            <dl class="space-y-3">
                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">5<span class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc(1019 / 1624 * 100%)" class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">63%</dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">4<span class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc(162 / 1624 * 100%)" class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">10%</dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">3<span class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc(97 / 1624 * 100%)" class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">6%</dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">2<span class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc(199 / 1624 * 100%)" class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">12%</dd>
                                </div>

                                <div class="flex items-center text-sm">
                                    <dt class="flex-1 flex items-center">
                                        <p class="w-3 font-medium text-gray-900">1<span class="sr-only"> star reviews</span></p>
                                        <div aria-hidden="true" class="ml-1 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/star -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>

                                            <div class="ml-3 relative flex-1">
                                                <div class="h-3 bg-gray-100 border border-gray-200 rounded-full"></div>

                                                <div style="width: calc(147 / 1624 * 100%)" class="absolute inset-y-0 bg-yellow-400 border border-yellow-400 rounded-full"></div>
                                            </div>
                                        </div>
                                    </dt>
                                    <dd class="ml-3 w-10 text-right tabular-nums text-sm text-gray-900">9%</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-lg font-medium text-gray-900">Share your thoughts</h3>
                            <p class="mt-1 text-sm text-gray-600">If you’ve used this product, share your thoughts with other customers</p>

                            <a href="#" class="mt-6 inline-flex w-full bg-white border border-gray-300 rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-50 sm:w-auto lg:w-full">Write a review</a>
                        </div>
                    </div>

                    <div class="mt-16 lg:mt-0 lg:col-start-6 lg:col-span-7">
                        <h3 class="sr-only">Recent reviews</h3>

                        <div class="flow-root">
                            <div class="-my-12 divide-y divide-gray-200">
                                <div class="py-12">
                                    <div class="flex items-center">
                                        <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="Emily Selman." class="h-12 w-12 rounded-full">
                                        <div class="ml-4">
                                            <h4 class="text-sm font-bold text-gray-900">Emily Selman</h4>
                                            <div class="mt-1 flex items-center">
                                                <!--
                                                  Heroicon name: solid/star

                                                  Active: "text-yellow-400", Default: "text-gray-300"
                                                -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>

                                                <!-- Heroicon name: solid/star -->
                                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </div>
                                            <p class="sr-only">5 out of 5 stars</p>
                                        </div>
                                    </div>

                                    <div class="mt-4 space-y-6 text-base italic text-gray-600">
                                        <p>This is the bag of my dreams. I took it on my last vacation and was able to fit an absurd amount of snacks for the many long and hungry flights.</p>
                                    </div>
                                </div>

                                <!-- More reviews... -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer aria-labelledby="footer-heading" class="bg-white">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="border-t border-gray-200 py-20">
                    <div class="grid grid-cols-1 md:grid-cols-12 md:grid-flow-col md:gap-x-8 md:gap-y-16 md:auto-rows-min">
                        <!-- Image section -->
                        <div class="col-span-1 md:col-span-2 lg:row-start-1 lg:col-start-1">
                            <img src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="" class="h-8 w-auto">
                        </div>

                        <!-- Sitemap sections -->
                        <div class="mt-10 col-span-6 grid grid-cols-2 gap-8 sm:grid-cols-3 md:mt-0 md:row-start-1 md:col-start-3 md:col-span-8 lg:col-start-2 lg:col-span-6">
                            <div class="grid grid-cols-1 gap-y-12 sm:col-span-2 sm:grid-cols-2 sm:gap-x-8">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Products</h3>
                                    <ul role="list" class="mt-6 space-y-6">
                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Bags </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Tees </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Objects </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Home Goods </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Accessories </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Company</h3>
                                    <ul role="list" class="mt-6 space-y-6">
                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Who we are </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Sustainability </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Press </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Careers </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Terms &amp; Conditions </a>
                                        </li>

                                        <li class="text-sm">
                                            <a href="#" class="text-gray-500 hover:text-gray-600"> Privacy </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Customer Service</h3>
                                <ul role="list" class="mt-6 space-y-6">
                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Contact </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Shipping </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Returns </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Warranty </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Secure Payments </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> FAQ </a>
                                    </li>

                                    <li class="text-sm">
                                        <a href="#" class="text-gray-500 hover:text-gray-600"> Find a store </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Newsletter section -->
                        <div class="mt-12 md:mt-0 md:row-start-2 md:col-start-3 md:col-span-8 lg:row-start-1 lg:col-start-9 lg:col-span-4">
                            <h3 class="text-sm font-medium text-gray-900">Sign up for our newsletter</h3>
                            <p class="mt-6 text-sm text-gray-500">The latest deals and savings, sent to your inbox weekly.</p>
                            <form class="mt-2 flex sm:max-w-md">
                                <label for="email-address" class="sr-only">Email address</label>
                                <input id="email-address" type="text" autocomplete="email" required class="appearance-none min-w-0 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                <div class="ml-4 flex-shrink-0">
                                    <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 py-10 text-center">
                    <p class="text-sm text-gray-500">&copy; 2021 Workflow, Inc. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

</x-app-layout>
