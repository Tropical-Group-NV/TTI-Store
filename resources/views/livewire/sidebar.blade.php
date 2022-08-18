<div style="height: 300px; right: 0; position: fixed">
    <aside class="w-full shadow-xl sm:rounded-lg">
        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-500">
            <button onclick="toggleCart()" data-modal-toggle="shoppingCart">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z"/></svg>
            </button>
            <script>
                function toggleCart()
                {
                    if (document.getElementById('shoppingCart').classList.contains('hidden'))
                    {
                        document.getElementById('shoppingCart').classList.remove('hidden');
                    }
                    else
                    {
                        document.getElementById('shoppingCart').classList.add('hidden');
                    }
                }
            </script>
            <div style="z-index: 5" id="shoppingCart">
                <table class="table-auto border border-spacing-2">
                    <thead>
                    <tr class="border border-slate-600 border-spacing-2">
                        <th class=" border-collapse: separate border border-slate-600">
                            Qty
                        </th>
                        <th class="border-collapse: separate  border border-slate-600">
                            Name
                        </th>
                        <th class="border-collapse: separate border border-slate-600">
                            Price
                        </th>
                    </tr>
                    </thead>
                    <tbody wire:poll.100ms>
                    @php($subTotal = 0)
                    @foreach($cartItems as $cartItem)
                        @php($item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $cartItem->prod_id)->get()->first())
                        @php($subTotal = $subTotal + ($cartItem->qty * $item->SalesPrice))
                        <tr class="border-collapse: separate border border-slate-600">
                            <td class="border border-slate-600">
                                {{ $cartItem->qty }}
                            </td>
                            <td class="border-collapse: separate border border-slate-600">
                                {{ $item->Description }}
                            </td>
                            <td class="border-collapse: separate border border-slate-600">
                                SRD {{ $cartItem->qty * $item->SalesPrice }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            Total
                        </td>
                        <td>

                        </td>
                        <td class="border-collapse: separate border border-slate-600">
                            Srd {{ $subTotal }}
                        </td>
                    </tr>

                    </tbody>
                </table>
                <br>
                <button style="right: 0" class="btn btn-primary">
                    Submit order
                </button>
            </div>


        </div>
    </aside>
</div>
