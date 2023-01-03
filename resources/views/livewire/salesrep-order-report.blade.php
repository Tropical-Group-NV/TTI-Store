<div>
    <div class="flex justify-between">
        <div>
            <div class="">
                <h1>
                    <h1 style="font-family: sfsemibold; font-size: 35px" class="p-4">
                        Orders per salesman
                    </h1>
                </h1>
            </div>
        </div>
    </div>
    <div style="overflow-x: auto">
        <div class="btn-group">
            @foreach($reps as $rep)
                <button class="btn btn-primary">{{ $rep->SalesRepEntityRefFullName }}</button>
            @endforeach
        </div>
        <table style="font-family: sflight" class="w-full text-sm text-left text-gray-500 border rounded whitespace-nowrap" id="dataTable">
            <thead style="background-color: #0069ad; color: white; opacity: 0.8" class="rounded text-xs text-gray-700 uppercase bg-gray-50">
            <th class="py-3 px-6">
                Salesman
            </th>
            <th class="py-3 px-6">
                Txn date
            </th>
            <th class="py-3 px-6">
                Aantal orders
            </th>
            <th class="py-3 px-6">
                Aantal winkels
            </th>
            <th class="py-3 px-6">
                Aantal items
            </th>
            <th class="py-3 px-6">
                Aantal items ordered
            </th>
            </thead>
        </table>
    </div>
</div>

