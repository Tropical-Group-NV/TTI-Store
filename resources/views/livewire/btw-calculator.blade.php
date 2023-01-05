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
                    <div class="p-4 text-sm sm:text-xl" style="font-family: sfsemibold">
                        <div class="py-6">
                            Ik heb <span>SRD</span><input class="rounded border-gray-300" id="retail" style="text-align: center" type="text" value="0">
                            <select name="" id="priceType" class="rounded border-gray-300">
                                <option value="1"> excl. BTW</option>
                                <option value="2"> incl. BTW</option>
                            </select> betaald.
                            <br>
                            <br>
                            voor een tray van
                            <select name="" id="quantity" class="rounded border-gray-300">
                                <option value="1">1</option>
                                <option value="6">6</option>
                                <option value="12">12</option>
                            </select>
                             stuk(s).
                        </div>
                        en heb <input placeholder="" id="discount" class="rounded border-gray-300" style="text-align: center" type="text"><span style="margin-left:-20px;">%</span> <span style="padding-left: 12px"></span>korting.
                        <br>
                        <br>
                        Mijn winstmarge is <input id="profit" placeholder="" class="rounded border-gray-300" style="text-align: center" type="text"><span style="margin-left:-20px;">%</span>
                        <br>
                        <br>
                        De verkoopprijs per stuk is SRD <span class="text-red-500"><b><span id="pricePerUnit">0.00</span></b></span>
                        <br>
                        <br>
                        Ik moet SRD <span class="text-red-500"><b id="totalBtw">0.00</b></span> afdragen aan BTW
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 flex justify-end">
        <button onclick="calculate()" style="background-color: #0069ad; color: white" class="btn">
            Calculeer
        </button>
    </div>

    <br>
    <br>
    <script>
        function calculate()
        {

            let retail = document.getElementById('retail').value;
            let priceType = document.getElementById('priceType').value;
            let quantity = document.getElementById('quantity').value;
            let discount = document.getElementById('discount').value;
            let profitPercent = document.getElementById('profit').value;
            let perUnit = document.getElementById('pricePerUnit');
            let totalBtw = document.getElementById('totalBtw');

                if (priceType == 1)
                {
                    var price = +retail - ((discount/100) * retail);
                    var priceBtw = 0.1 * price
                    var priceFull = 1.1 * price;
                    var profit = ((+profitPercent + 100) / 100) * price;
                    var profitBtw = 0.1 * profit;
                    var profitFull = 1.1 * profit;
                    var pricePerUnit = profitFull / +quantity;
                    var totalBtwToGive = profitBtw - priceBtw;
                    perUnit.innerText = pricePerUnit.toFixed(2);
                    totalBtw.innerText = totalBtwToGive.toFixed(2);
                }
                if (priceType == 2)
                {
                    var priceAndDiscount = (10/11) * retail;
                    var priceDiscount = (discount/100) * priceAndDiscount;
                    var price = +priceAndDiscount - ((discount/100) * priceAndDiscount);
                    var priceBtw = 0.1 * price;
                    var priceFull = +price;
                    var profit = ((+profitPercent + 100) / 100) * priceAndDiscount;
                    var profitBtw = 0.1 * profit;
                    var profitFull = 1.1 * profit;
                    var pricePerUnit = profitFull / +quantity;
                    var totalBtwToGive = profitBtw - priceBtw;
                    perUnit.innerText = pricePerUnit.toFixed(2);
                    totalBtw.innerText = totalBtwToGive.toFixed(2);
                }
        }
    </script>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>

