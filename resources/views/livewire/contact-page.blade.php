<div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact us') }}
        </h2>
    </x-slot>

    <div>

        <div class="max-w-7xl mx-auto px-8 py-10 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2">
            <div>
                <div>
                    <div style="z-index:0" class="pl-2">
                        <div class="flex py-4">
                            <div class="icon">
                                <i class="fa fa-phone my-float2"></i>
                            </div>
                            <span class="my-float2 px-4"><b><a style="color: #0069ad" href="tel:+597458666">(+597) 458-666</a></b></span>
                        </div>
                        <div class="flex py-4">
                            <div style="background-color: #25d366" class="icon">
                                <i class="fa fa-whatsapp my-float2"></i>
                            </div>
                            <span class="my-float2 px-4"><b><a target="_blank" style="color: #0069ad" href="https://wa.me/5978691600">(+597) 869-1600</a></b></span>
                        </div>
                        <div class="flex py-4">
                            <div class="icon">
                                <i class="fa fa-envelope my-float2 "></i>
                            </div>
                            <span class="my-float2 pl-4"><b><a style="color: #0069ad" href="mailto:verkoop@tropicalgroupnv.com">verkoop@tropicalgroupnv.com</a></b></span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <form wire:submit.prevent="sendMessage">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <input wire:model="name" value="" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        @error('name') <span class="text-red-500">{{ $message }}</span><br> @enderror
                        <br>
                        <x-jet-label for="phone" value="{{ __('Phone') }}" />
                        <input wire:model="phone" value="" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        <input wire:model="last_name" name="last_name" value="" type="text" class="hidden">
                        <span class="text-red-500">{{ $contactError }}</span><br>
                        <br>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <input wire:model="email" value="" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        <span class="text-red-500">{{ $contactError }}</span><br>
                        <br>
                        <x-jet-label for="subject" value="{{ __('Subject') }}" />
                        <input wire:model="subject" value="" type="text" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        <br>
                        <x-jet-label for="message" value="{{ __('Message') }}" />
                        <textarea wire:model="message" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" name="message" id="message" cols="30" rows="10"></textarea>
                        @error('message') <span class="text-red-500">{{ $message }}</span><br> @enderror
                        <br>
                        <div class="float-right px-8 py-8">
                            <button type="submit" class="btn " style="background-color: #0069ad; color: white">
                                Send message
                            </button>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                    <br>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </form>
            </div>


            {{--            @livewire('customer-profile')--}}
            {{--            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))--}}
            {{--                <div class="mt-10 sm:mt-0">--}}
            {{--                    @livewire('profile.update-password-form')--}}
            {{--                </div>--}}

            {{--                <x-jet-section-border />--}}
            {{--            @endif--}}
        </div>
    </div>
    <script>
        window.addEventListener('messageSent', (e) => {
            toastr.success("Message sent")
        });
    </script>
</div>
