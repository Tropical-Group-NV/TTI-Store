<div class="scale-100">
    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
        {{ $chinese == 0? 'BTW Calculator' : '增值税计算器'}}
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
    <div class="btn-group px-6">
        <button wire:click="chineseOff" class="btn {{ $chinese != 0? 'btn-primary' : 'btn-secondary '}} ">
{{--            Nederlands--}}
            <img
                src="https://flagcdn.com/nl.svg"
                srcset="https://flagcdn.com/32x24/nl.png 2x,
    https://flagcdn.com/48x36/nl.png 3x"
                width="50"
                height="12"
                alt="Nederlands">
        </button>
        <button wire:click="chineseOn" class="btn {{ $chinese == 0? 'btn-primary' : 'btn-secondary '}}">
            <img
                src="https://flagcdn.com/cn.svg"
                srcset="https://flagcdn.com/32x24/cn.png 2x,
    https://flagcdn.com/48x36/cn.png 3x"
                width="50"
                height="12"
                alt="中国人">
{{--            中国人--}}
        </button>
    </div>
    <br>
    <br>
    <div class="bg-white shadow-xl sm:rounded-lg">
        <div style="overflow-x: auto" >
            <div style="overflow-x: auto">
                <div style="overflow-x: auto">
                    <div class="p-4 text-sm sm:text-xl" style="font-family: sfsemibold">
                        <div class="py-6">
                            {{ $chinese == 0? 'Ik heb' : '我付了'}} SRD <input class="rounded border-gray-300" id="retail" style="text-align: center" type="text" value="0">
                            <select name="" id="priceType" class="rounded border-gray-300">
                                <option value="1">{{ $chinese == 0? ' excl. BTW' : '不含增值税'}}</option>
                                <option value="2">{{ $chinese == 0? ' incl. BTW' : '包括增值税'}}</option>
                            </select>
                            <br>
                            <div id="priceExclBtwDiv" class="hidden">
                                <br>
                                {{ $chinese == 0? 'Groothandelsprijs excl. BTW is' : '批发价不含增值税'}} SRD <span id="priceExclBtw" class="text-red-500">0.00</span>
                            </div>
                            <br>
                            {{ $chinese == 0? 'voor een tray van' : '一盘'}}
                            <select name="" id="quantity" class="rounded border-gray-300">
                                <option value="1">1</option>
                                <option value="6">6</option>
                                <option value="12">12</option>
                            </select>


                        </div>
                        {{ $chinese == 0? 'en heb ' : '我有'}} <input placeholder="" id="discount" class="rounded border-gray-300" style="text-align: center" type="text"><span style="margin-left:-20px;">%</span> <span style="padding-left: 12px"></span>{{ $chinese == 0? 'korting' : '的折扣'}}
                        <br>
                        <br>
                        {{ $chinese == 0? 'Mijn winstmarge is' : '我的利润率是'}}  <input id="profit" placeholder="" class="rounded border-gray-300" style="text-align: center" type="text"><span style="margin-left:-20px;">%</span>
                        <br>
                        <br>
                        {{ $chinese == 0? 'De verkoopprijs per stuk is' : '每件售价为'}} SRD <span class="text-red-500"><b><span id="pricePerUnit">0.00</span></b></span>
                        <br>
                        <br>
                        {{ $chinese == 0? 'Ik moet' : '我必须在增值税中支付'}}  SRD <span class="text-red-500"><b id="totalBtw">0.00</b></span> {{ $chinese == 0? 'Ik moet' : 'afdragen aan BTW'}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 flex justify-end">
        <button onclick="calculate()" style="background-color: #0069ad; color: white" class="btn">
            {{ $chinese == 0? 'Calculeer' : '计算'}}
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
            const priceExlcBtwDiv = document.getElementById('priceExclBtwDiv');
            const priceExlcBtw = document.getElementById('priceExclBtw');

                if (priceType == 1)
                {
                    priceExlcBtwDiv.classList.add('hidden');
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
                    var profit = ((+profitPercent + 100) / 100) * price;
                    var profitBtw = 0.1 * profit;
                    var profitFull = 1.1 * profit;
                    var pricePerUnit = profitFull / +quantity;
                    var totalBtwToGive = profitBtw - priceBtw;
                    perUnit.innerText = pricePerUnit.toFixed(2);
                    totalBtw.innerText = totalBtwToGive.toFixed(2);
                    priceExlcBtwDiv.classList.remove('hidden');
                    priceExlcBtw.innerText = priceAndDiscount.toFixed(2);

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

