<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <style>
        [x-cloak] { display: none }

        /*#myBtn {*/
        /*    display: none;*/
        /*    position: fixed;*/
        /*    bottom: 20px;*/
        /*    right: 30px;*/
        /*    z-index: 99;*/
        /*    font-size: 18px;*/
        /*    border: none;*/
        /*    outline: none;*/
        /*    background-color: red;*/
        /*    color: white;*/
        /*    cursor: pointer;*/
        /*    padding: 15px;*/
        /*    border-radius: 4px;*/
        /*}*/

        /*#myBtn:hover {*/
        /*    background-color: #555;*/
        /*}*/
    </style>
    <style>
        body #toast-container > div {
            opacity: 1;
        }
        .icon{
            /*position:fixed;*/
            width:40px;
            height:40px;
            font-size: 20px;
            /*bottom:15px;*/
            /*right:25px;*/
            background-color:#0069ad;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            /*font-size:30px;*/
            box-shadow: 2px 2px 3px #999;
            z-index:0;
        }
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:15px;
            right:25px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }
        .float-info{
            position:fixed;
            /*width:60px;*/
            /*height:60px;*/
            bottom:15px;
            right:90px;
            background-color:#0069ad;
            color:#FFF;
            border-radius:10px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }
        .float2{
            position:fixed;
            width:60px;
            height:60px;
            bottom:15px;
            right:90px;
            background-color:#0069ad;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }
        .float2-info{
            position:fixed;
            /*width:60px;*/
            /*height:60px;*/
            bottom:90px;
            right:90px;
            background-color:#0069ad;
            color:#FFF;
            border-radius:10px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }

        .my-float{
            margin-top:16px;
        }

        .my-float2{
            margin-top:10px;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('Logo-04.ico') }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
{{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('FontAwesome/css/font-awesome.css?v=').time() }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css?v=').time() }}">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    {{--        <link rel="stylesheet" href="{{asset('bootstrap4.2.1/css/bootstrap-grid.css')}}">--}}
    {{--        <link rel="stylesheet" href="{{asset('bootstrap4.2.1/css/bootstrap-reboot.css')}}">--}}
    {{--        <script src="{{ asset('bootstrap4.2.1/js/bootstrap.js') }}"></script>--}}


    <!-- Latest compiled and minified CSS -->
    <!-- CSS only -->
    {{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">--}}
    <!-- Optional theme -->
    {{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}

    <!-- Latest compiled and minified JavaScript -->
    <!-- JavaScript Bundle with Popper -->
    {{--        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
    {{--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>--}}
    @vite(['app.css', 'app.js'])
{{--    @vite('app.css2')--}}

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased" x-cloak x-data="{openModal: false}"
      :class="openModal ? 'overflow-hidden' : 'overflow-visible'">
<x-jet-banner />

<div class="min-h-screen bg-gray-100">
{{--    @if ($_SERVER['REQUEST_URI'] != '/home')--}}
    @livewire('navigation-menu')
{{--    @endif--}}


    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

{{--<div id="godaddy-security-badge" class="fixed bottom-0 left-0 btn" style="background-image: none" target="_blank">--}}
{{--    <a href="https://seal.godaddy.com/verifySeal?sealID=pIwHVyKG5cIEV9uGI0frERDzgcGFdBuY9WZYHYapnu4r0VKc2hLUukQbyKO9">--}}
{{--        <span id="siteseal">--}}
{{--        <script async="" type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=pIwHVyKG5cIEV9uGI0frERDzgcGFdBuY9WZYHYapnu4r0VKc2hLUukQbyKO9">--}}
{{--        </script>--}}
{{--        <img style="cursor:pointer;cursor:hand" src="https://seal.godaddy.com/images/3/en/siteseal_gd_3_h_l_m.gif" onclick="verifySeal();" alt="SSL site seal - click to verify">--}}
{{--    </span>--}}
{{--    </a>--}}
{{--</div>--}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
{{--<div x-data="{ open: false }" class="ml-4" @mouseleave="open = false">--}}
{{--    <a href="{{route('contact-page')}}" @mouseover="open = true" class="float2 hover:text-white items-center pb-2">--}}
{{--        <i style="color: white" class="fa fa-envelope active:text-white my-float"></i>--}}
{{--    </a>--}}
{{--    <div x-show="open" x-transition:enter.duration.500ms x-transition:leave.duration.500ms>--}}
{{--        <div class="float2-info">--}}
{{--        <span style="font-size: 20px; padding-bottom: 20px; margin: auto; padding-left: 10px; padding-right: 10px">--}}
{{--             Contact us--}}
{{--        </span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<a href="{{route('contact-page')}}" class="float2 hover:text-white items-center pb-2">
    <i style="color: white" class="fa fa-envelope active:text-white my-float"></i>
</a>
{{--<div class="group">--}}
{{--    <div class="float2-info">--}}
{{--        <span class="my-float">--}}
{{--             Hello World--}}
{{--        </span>--}}
{{--    </div>--}}
{{--    <button  @click="showModal =  ! showModal" class="float2 hover:text-white items-center pb-2">--}}
{{--        <i class="fa fa-envelope active:text-white my-float"></i>--}}
{{--    </button>--}}
{{--</div>--}}
{{--<button  @click="showModal =  ! showModal" class="float2 hover:text-white items-center pb-2">--}}
{{--    <i class="fa fa-envelope active:text-white my-float"></i>--}}
{{--</button>--}}
<div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" @close.stop="showModal = false">
    <!-- Trigger for Modal -->
    <button  @click="showModal =  ! showModal" class="float hover:text-white items-center pb-2">
        <i class="fa fa-whatsapp active:text-white my-float"></i>
    </button>

    <!-- Whatsapp Modal -->
    <div x-show="showModal"
        class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
         x-transition.opacity x-transition:leave.duration.500ms >
        <!-- Modal inner -->
        <div x-show="showModal" x-transition:enter.duration.500ms
             x-transition:leave.duration.400ms
            class="max-w-3xl px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg"
            @click.away="showModal = false"
            >
            <div class="flex items-center justify-between">
                <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">
                        <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div>
                <div class="flex justify-center">
                    <img class="w-3/4" style="width: 300px" src="{{ asset('TTI-Whatsapp-svg.svg') }}" alt="">
                </div>
                <br>
                <div class="flex justify-center">
                    <a href="https://wa.me/5978691600" class="btn text-white" style="background-color: #0069ad" target="_blank"><b>Contact us on Whatsapp</b></a>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div x-data="{ 'showModal': true }" @keydown.escape="showModal = false" @close.stop="showModal = false">--}}
{{--    <!-- Trigger for Modal -->--}}
{{--    <button  @click="showModal =  ! showModal" class="float hover:text-white items-center pb-2">--}}
{{--        <i class="fa fa-whatsapp active:text-white my-float"></i>--}}
{{--    </button>--}}

{{--    <!-- Whatsapp Modal -->--}}
{{--    <div x-show="showModal"--}}
{{--        class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"--}}
{{--         x-transition.opacity x-transition:leave.duration.500ms >--}}
{{--        <!-- Modal inner -->--}}
{{--        <div x-show="showModal" x-transition:enter.duration.500ms--}}
{{--             x-transition:leave.duration.400ms--}}
{{--            class="max-w-3xl px-6 py-4 mx-auto text-left bg-white border rounded shadow-lg"--}}
{{--            @click.away="showModal = false"--}}
{{--            >--}}
{{--            <div class="flex items-center justify-between">--}}
{{--                <button type="button" class="z-50 cursor-pointer" @click="showModal = false">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#25D366" stroke="currentColor">--}}
{{--                        <path fill="#25D366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="flex justify-center">--}}
{{--                    Welcome to our new and improved ttistore????--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <div class="flex justify-center">--}}
{{--                    <a href="https://wa.me/5978691600" class="btn text-white" style="background-color: #0069ad" target="_blank"><b>TEST</b></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<a href="https://wa.me/5978691600" class="float active:text-white hover:text-white" target="_blank">--}}
{{--    <i class="fa fa-whatsapp active:text-white my-float"></i>--}}
{{--</a>--}}

{{--<div x-data="{ visible: false }" x-intersect="visible = true">--}}
{{--    <p class="duration-1000 transition-all transform" :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-full'">Hello, World!</p>--}}
{{--</div>--}}

{{--<div--}}
{{--    x-data--}}
{{--    x-init="window.scrollTo({top: 0, behavior: 'smooth'})"--}}
{{--    class="fixed bottom-10 left-10"></div>--}}
<button
    x-data
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    class="fixed bottom-10 left-10 btn btn-primary border border-yellow-400 border-5" style=" z-index: 1000; color: white; font-family: sfsemibold"><i class="fa fa-arrow-up"></i></button>

{{--<div x-data="{ open: false }">--}}
{{--    <button @click="open = ! open">Toggle</button>--}}

{{--</div>--}}
{{--<a href="#" @click.prevent="$refs.root.scrollTo({ top: $refs.root.scrollHeight, behavior: 'smooth' })">Scroll Down ????</a>--}}

{{--<div class="fixed bottom-10 left-10 btn " x-data="{ shown: false }" x-intersect="shown = true">--}}
{{--    <div x-show="shown" x-transition>--}}
{{--        I'm in the viewport!--}}
{{--    </div>--}}
{{--</div>--}}
{{--<button onclick="topFunction()" id="myBtn" class="fixed bottom-10 left-10 btn " style="background-color: #0069AD; z-index: 1000; color: white; font-family: sfsemibold" title="Go to top">???</button>--}}


{{--<script>--}}
{{--    // Get the button--}}
{{--    let mybutton = document.getElementById("myBtn");--}}

{{--    // When the user scrolls down 20px from the top of the document, show the button--}}
{{--    window.onscroll = function() {scrollFunction()};--}}

{{--    function scrollFunction() {--}}
{{--        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {--}}
{{--            mybutton.style.display = "block";--}}
{{--        } else {--}}
{{--            mybutton.style.display = "none";--}}
{{--        }--}}
{{--    }--}}

{{--    // When the user clicks on the button, scroll to the top of the document--}}
{{--    function topFunction() {--}}
{{--        document.body.scrollTop = 0;--}}
{{--        document.documentElement.scrollTop = 0;--}}
{{--    }--}}
{{--</script>--}}

@stack('modals')

@livewireScripts
</body>
</html>
