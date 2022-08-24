<x-app-layout>




    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">

                @livewire('checkout')

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
