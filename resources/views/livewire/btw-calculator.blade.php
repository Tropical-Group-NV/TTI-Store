<div class="scale-100">
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        BTW Calculator
    </h1>
    @php
        if (session()->has('currency'))
        {
            $currency = session()->get('currency');
            $rate = session()->get('exchangeRate');
        }
        else
        {
            $currency = 'SRD';
            $rate = 1;
        }
    @endphp
    <div class="bg-white shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" >
            <div style="overflow-x: auto">
                <div style="overflow-x: auto">
                    <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 whitespace-nowrap " id="dataTable">
                        <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="py-3 px-6" colspan="5">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="py-4 px-6" >
                                Retailprijs zonder BTW
                            </td>
                            <td colspan="2" class="py-4 border-l">
                                <input class="rounded justify-content-end border border-gray-100 pl-3" id="retail-input" wire:model="retail" type="text">
                            </td>
                        </tr>
                        <tr class="">
                            <td class="py-4 px-6 " >
                                BTW 10%
                            </td>
                            <td class="py-4 px-6 border-b border-l">
                                {{ $retailBtw }}
                            </td>
                            <td class="border-b"><b class="text-2xl">+</b></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 px-6" >
                                Factuurprijs
                            </td>
                            <td colspan="2" class="py-4 px-6 border-l" style="border-bottom-width: medium; border-bottom-color: black">
                                {{ $invoicePrice }}
                            </td>

                        </tr>
                        <tr class="border-t">
                            <td class="pt-16 px-6" >
                                Prijs Winkelier Retailprijs
                            </td>
                            <td class="pt-16 px-6 border-l" >
                                {{ $priceRet }}
                            </td>
                            <td colspan="2" class="pt-16 px-6" >
                                <input placeholder="%" id="perc-input" class="rounded border-gray-300" style="text-align: center" type="text" wire:model="percentageRet"><span style="margin-left:-20px;">%</span>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 px-6" >
                                BTW 10%
                            </td>
                            <td class="py-4 px-6 border-l">
                                {{ $btwRet }}
                            </td>
                            <td>
                                <b class="text-2xl">
                                    +
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6" >
                                Consumentenprijs per Tray
                            </td>
                            <td colspan="2" style="border-bottom-width: medium; border-bottom-color: black" class="py-4 px-6 border-l border-b b">
                                {{ $pricePerTray }}
                            </td>
                        </tr><tr>
                            <td class="py-4 px-6" >
                                Consumentenprijs per fles
                            </td>
                            <td colspan="2" class="py-4 px-6 border-l">
                                {{ $pricePerBottle }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6" >
                                Winkelier af te dragen BTW
                            </td>
                            <td class="py-4 px-6 border-l">
                                <b>
                                    {{ $btwRet }} - {{ $retailBtw }} = {{ number_format($btwRet - $retailBtw , 2) }}
                                </b>
                            </td>
                            <td class="py-4 px-6 ">
{{--                                <button wire:click="calculate(document.getElementById('retail-input').value,document.getElementById('perc-input').value)" class="btn btn-primary">--}}
{{--                                    Calculate--}}
{{--                                </button>--}}
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>

                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 flex justify-end">
        <button wire:click="calculate(document.getElementById('retail-input').value,document.getElementById('perc-input').value)" style="background-color: #0069ad; color: white" class="btn">
            Calculate
        </button>
    </div>

    <br>
    <br>
    <script>
        document.getElementById().value
    </script>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>

