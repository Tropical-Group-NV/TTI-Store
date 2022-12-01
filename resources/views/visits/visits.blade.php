<x-app-layout>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <div class="px-8 py-8">
        <h1 style="font-family: sfsemibold; font-size: 35px" class="p-6">
            {{--            {{file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($customer->BillAddressBlockAddr1 . $customer->BillAddressBlockAddr2 .  $customer->BillAddressBlockAddr3 . $customer->BillAddressBlockAddr4 . $customer->BillAddressBlockAddr5 ) . '&key=AIzaSyBqAc0YQtjj9qX0CqTz78pRyUk5oy2puus')}}--}}
        </h1>
        <div class="bg-white shadow-xl sm:rounded-lg px-8 py-8">
            <div style="overflow-x: auto" class="px-8 py-8">
                <div style="overflow-x: auto">
                    <div style="overflow-x: auto">

                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div>
                    </div>
                    <div class="px-8" style="">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div>
                                @livewire('visits-customer-list')
                            </div>
                            <div id="gmap" style="height:800px" class="w-full"></div>
                        </div>
                    </div>
                    <script>
                        var infoWindow;
                        // import insertTextAtCursor from 'insert-text-at-cursor';
                        // insertTextAtCursor(document.getElementById('gmap'), 'foobar');
                        // var markersArray = [];
                        function clearOverlays() {
                            for (var i = 0; i < markersArray.length; i++ ) {
                                markersArray[i].setMap(null);
                            }
                            markersArray.length = 0;
                        }
                        function myMap() {
                            var locationButton = document.getElementById('setLocation')
                            var mapProp= {
                                center:new google.maps.LatLng(5.82320100, -55.16788000),
                                zoom:9,
                            };
                            var map = new google.maps.Map(document.getElementById("gmap"),mapProp);
                            @php($pos = 0)

                            @foreach($customers as $customer)
                            @php($pos++)
                            var marker{{ $pos }} = new google.maps.Marker({
                                position: new google.maps.LatLng({{ $customer->location }}),
                                @php($freqSubtr = (strtotime(date('Y-m-d')) - strtotime($customer->last_visit)) / 86400)
                                icon: { url: 'http://maps.google.com/mapfiles/ms/icons/{{ $customer->flag }}-dot.png'},
                                map,
                                label: "",
                                color: '#0069ad',
                                title: '{{ $customer->FullName }}'
                            });
                            @if($freqSubtr - $customer->visits_frequency > -1 and $customer->flag != 'red')
                            marker{{$pos}}.setAnimation(google.maps.Animation.BOUNCE);
                            google.maps.event.addListener(marker{{$pos}}, 'click', function () {
                                infoWindow.open(map, this);
                            });
                            @else
                            @endif
                            @endforeach

                        }
                        {{--function placeMarkerAndPanTo(latLng, map)--}}
                        {{--{--}}
                        {{--    clearOverlays()--}}
                        {{--    var marker = new google.maps.Marker({--}}
                        {{--        position: latLng,--}}
                        {{--        map: map,--}}
                        {{--        label: "{{ $customer->FullName}}",--}}
                        {{--    });--}}
                        {{--    markersArray.push(marker);--}}
                        {{--    customerLocation = latLng;--}}
                        {{--    map.panTo(latLng);--}}
                        {{--}--}}
                        {{--function addCurrentLocationToCustomer(map)--}}
                        {{--{--}}

                        {{--    clearOverlays()--}}
                        {{--    const success = (position) =>--}}
                        {{--    {--}}
                        {{--        var userMarker = new google.maps.Marker({--}}
                        {{--            position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),--}}
                        {{--            map: map,--}}
                        {{--            label: '{{ $customer->FullName }}'--}}
                        {{--        });--}}
                        {{--        markersArray.push(userMarker);--}}

                        {{--        customerLocation = position.coords.latitude + ', ' + position.coords.longitude;--}}

                        {{--        map.panTo((position.coords.latitude + ', ' + position.coords.longitude));--}}
                        {{--    }--}}
                        {{--    if (navigator.geolocation)--}}
                        {{--    {--}}
                        {{--        navigator.geolocation.getCurrentPosition(success);--}}
                        {{--    }--}}
                        {{--    else--}}
                        {{--    {--}}
                        {{--        console.log("Geolocation is not supported by this browser.");--}}
                        {{--    }--}}
                        {{--}--}}
                        infowindow = new google.maps.InfoWindow();
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkoN03H7_AhO26uAnkBiwO88zjd6mufEc&callback=myMap&v=3" async defer></script>
                    <script>
                        {{--function saveCustomerLocation()--}}
                        {{--{--}}
                        {{--    var http = new XMLHttpRequest();--}}
                        {{--    var url = '{{ route('saveCustomerLocation') }}';--}}
                        {{--    var params = '_token={{ csrf_token() }}&customer={{ $customer->ListID }}&location=' + customerLocation;--}}
                        {{--    http.open('POST', url, true);--}}

                        {{--    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');--}}

                        {{--    http.onreadystatechange = function() {--}}
                        {{--        if (http.response === 1)--}}
                        {{--        {--}}
                        {{--            toastr.success('Saves Customer Location')--}}
                        {{--        }--}}
                        {{--        console.log(http.response)--}}
                        {{--        toastr.success('Saved Customer Location')--}}
                        {{--        // alert(http.response)--}}
                        {{--    }--}}
                        {{--    http.send(params);--}}
                        {{--}--}}

                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
