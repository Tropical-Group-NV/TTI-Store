<x-app-layout>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <div class="px-8 py-8">
        <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
            {{ $customer->Name }}
{{--            {{file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($customer->BillAddressBlockAddr1 . $customer->BillAddressBlockAddr2 .  $customer->BillAddressBlockAddr3 . $customer->BillAddressBlockAddr4 . $customer->BillAddressBlockAddr5 ) . '&key=AIzaSyBqAc0YQtjj9qX0CqTz78pRyUk5oy2puus')}}--}}
        </h1>
        <div class="bg-white shadow-xl sm:rounded-lg px-8 py-8">
            <div style="overflow-x: auto" class="px-8 py-8">
                <div style="overflow-x: auto">
                    <div style="overflow-x: auto">
                        <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
                            Information
                        </h1>
                        {{--                    {!! print_r($orders) !!}--}}
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="px-8 py-8">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <input name="name" value="{{$customer->Name}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="companyname" value="{{ __('Company Name') }}" />
                                <input name="companyname" value="{{$customer->CompanyName}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="firstname" value="{{ __('First Name') }}" />
                                <input name="firstname" value="{{$customer->FirstName}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="lastname" value="{{ __('Last Name') }}" />
                                <input name="lastname" value="{{$customer->LastName}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="address" value="{{ __('Address') }}" />
                                <input name="address" value="{{$customer->BillAddressBlockAddr2}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="city" value="{{ __('City') }}" />
                                <input name="city" value="{{$customer->BillAddressBlockAddr3}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="city" value="{{ __('Country') }}" />
                                <input name="country" value="{{$customer->BillAddressBlockAddr4}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="city" value="{{ __('Last Order') }}" />
                                <input name="country" value="{{$viewQbCustomer->last_order}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="city" value="{{ __('Last Visit') }}" />
                                <input name="country" value="{{ date('Y-m-d', strtotime($viewQbCustomer->last_visit) )}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <x-jet-label for="city" value="{{ __('Next Visit') }}" />
                                <input name="country" value="{{date('Y-m-d',($viewQbCustomer->visits_frequency * 86400) + strtotime($viewQbCustomer->last_visit))}}" disabled readonly type="text" class="border-gray-300 bg-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed" style="cursor: not-allowed">
                            </div>
                            <div class="px-8 py-8">
                                <a href="{{ route('quotations.create') }}?customer={{$customer->ListID}}" class="btn btn-success">Create Quotation</a>
                            </div>
                        </div>

                    </div>
                    <br>
                    <hr>
                    <br>
                    <div>
                        @livewire('customer')
                    </div>
                    <div class="px-8">
                        <div id="gmap" style="height: 50px; width: 100%"></div>
                        <div class="float-left">
                            <button id="setLocation" onclick="addCurrentLocationToCustomer()" class="btn" style="color: white; background-color: #0069ad">Set current location as customer</button>

                        </div>
                        <div class="float-right">
                            <button onclick="saveCustomerLocation()" class="btn" style="color: white; background-color: #0069ad">Save</button>

                        </div>
                    </div>
                    <script>
                        // import insertTextAtCursor from 'insert-text-at-cursor';
                        // insertTextAtCursor(document.getElementById('gmap'), 'foobar');
                        var customerLocation
                        var markersArray = [];
                        function clearOverlays() {
                            for (var i = 0; i < markersArray.length; i++ ) {
                                markersArray[i].setMap(null);
                            }
                            markersArray.length = 0;
                        }
                        function myMap() {
                            var locationButton = document.getElementById('setLocation')
                            var mapProp= {
                                @if($customerLocation != null)
                                center:new google.maps.LatLng({{ $customerLocation }}),
                                @endif
                                zoom:10,
                            };
                            var map = new google.maps.Map(document.getElementById("gmap"),mapProp);
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng({{ $customerLocation }}),
                                map,
                                label: {text:"{{ $customer->FullName}}", color:'gray'},
                                color: '#0069ad'
                            });
                            marker.setTitle('{{ $customer->FullName }}')
                                marker.setDraggable(true)
                                marker.setShape(1)
                            markersArray.push(marker);
                            console.log(marker)
                            customerLocation = {{ $customerLocation }};
                            locationButton.addEventListener("click", (e) => {
                                addCurrentLocationToCustomer(map);
                            });
                            map.addListener("click", (e) => {
                                placeMarkerAndPanTo(e.latLng, map);
                            });
                            const success = (position) =>
                            {
                                var userMarker = new google.maps.Marker({
                                    position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                                    map,
                                    title: "You",
                                    label: {text:'You', color:'white'},
                                    icon: { url: '{{ asset('Maps/symbols/pointer.png') }}'}

                                });
                                userMarker.setTitle("You");
                            }
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(success);

                            }
                            else
                            {
                                console.log("Geolocation is not supported by this browser.");
                            }


                        }
                        function placeMarkerAndPanTo(latLng, map)
                        {
                            clearOverlays()
                            var marker = new google.maps.Marker({
                                position: latLng,
                                map: map,
                                label: {text:"{{ $customer->FullName}}", color:'white'},
                            });
                            markersArray.push(marker);
                            customerLocation = latLng;
                            map.panTo(latLng);
                        }
                        function addCurrentLocationToCustomer(map)
                        {

                            clearOverlays()
                            const success = (position) =>
                            {
                                var userMarker = new google.maps.Marker({
                                    position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                                    map: map,
                                    label: '{{ $customer->FullName }}'
                                });
                                markersArray.push(userMarker);

                                customerLocation = position.coords.latitude + ', ' + position.coords.longitude;

                                map.panTo((position.coords.latitude + ', ' + position.coords.longitude));
                            }
                            if (navigator.geolocation)
                            {
                                navigator.geolocation.getCurrentPosition(success);
                            }
                            else
                            {
                                console.log("Geolocation is not supported by this browser.");
                            }
                        }
                        infowindow = new google.maps.InfoWindow();
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkoN03H7_AhO26uAnkBiwO88zjd6mufEc&callback=myMap&v=3" async defer></script>
                    <script>
                        function saveCustomerLocation()
                        {
                            var http = new XMLHttpRequest();
                            var url = '{{ route('saveCustomerLocation') }}';
                            var params = '_token={{ csrf_token() }}&customer={{ $customer->ListID }}&location=' + customerLocation;
                            http.open('POST', url, true);

                            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                            http.onreadystatechange = function() {
                                if (http.response === 1)
                                {
                                    toastr.success('Saves Customer Location')
                                }
                                console.log(http.response)
                                toastr.success('Saved Customer Location')
                                // alert(http.response)
                            }
                            http.send(params);
                        }

                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
