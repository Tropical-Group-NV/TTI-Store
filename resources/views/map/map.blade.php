<div id="gmap" style="height: 400px"></div>
{{--                <div id="googleMap" style="width:100%;height:1000px;"></div>--}}

<script>
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:2,
        };
        var map = new google.maps.Map(document.getElementById("gmap"),mapProp);
    }
    infowindow = new google.maps.InfoWindow();
</script>

{{--                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkoN03H7_AhO26uAnkBiwO88zjd6mufEc&callback=myMap&v=3"></script>--}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkoN03H7_AhO26uAnkBiwO88zjd6mufEc&callback=myMap&v=3" async defer></script>
