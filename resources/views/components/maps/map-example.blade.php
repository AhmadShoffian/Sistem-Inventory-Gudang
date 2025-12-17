<div class="relative w-full rounded h-[600px]">
  <div id="map-example" class="rounded h-full w-full"></div>
</div>

@push('scripts')
  <script>
    function initMapExample() {
      let lat = 40.748817;
      let lng = -73.985428;
      let myLatlng = new google.maps.LatLng(lat, lng);

      let map = new google.maps.Map(document.getElementById("map-example"), {
        zoom: 12,
        center: myLatlng,
        scrollwheel: false,
        zoomControl: true,
        styles: [
          { featureType: "administrative", elementType: "labels.text.fill", stylers: [{ color: "#444444" }] },
          { featureType: "landscape", elementType: "all", stylers: [{ color: "#f2f2f2" }] },
          { featureType: "poi", elementType: "all", stylers: [{ visibility: "off" }] },
          { featureType: "road", elementType: "all", stylers: [{ saturation: -100 }, { lightness: 45 }] },
          { featureType: "road.highway", elementType: "all", stylers: [{ visibility: "simplified" }] },
          { featureType: "road.arterial", elementType: "labels.icon", stylers: [{ visibility: "off" }] },
          { featureType: "transit", elementType: "all", stylers: [{ visibility: "off" }] },
          { featureType: "water", elementType: "all", stylers: [{ color: "#4299e1" }, { visibility: "on" }] }
        ],
      });

      let marker = new google.maps.Marker({
        position: myLatlng,
        map,
        animation: google.maps.Animation.DROP,
        title: "Notus React!",
      });

      let infowindow = new google.maps.InfoWindow({
        content: '<div class="info-window-content"><h2>Notus React</h2><p>A free Admin for Tailwind CSS, React, and React Hooks.</p></div>',
      });

      marker.addListener("click", function () {
        infowindow.open(map, marker);
      });
    }

    window.initMapExample = initMapExample;
  </script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMapExample"></script>
@endpush
