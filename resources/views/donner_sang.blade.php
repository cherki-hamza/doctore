@extends('layouts.master')

@section('title' , 'Donner Song')

@section('styles')
<style>
    body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}

#map {
    height: 90vh;
    margin-left: 15px;
    margin-right: 15px;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}

</style>
@stop

@section("content")
    <section id="doctors" class="doctors">
      <div class="container my-5">

        <div class="section-title">
          <h2>Donner Song</h2>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session()->get('success') }}</strong>
            </div>
        @endif


         <div class="col-md-12">
            <div class="row d-flex justify-content-center">

            <div class="">

                  <div style="" class="row">
                <div class="member">
                    <div class="d-flex justify-content-center">
                     <div class="form-value">
                  <form method="POST" action="{{ route('save_donneur_du_sang') }}">
                    @csrf

                    <div class="row">

                    <div style="width: 200px" class="form-group mx-5">
                        <label for="">Le Nom du donneur</label>
                       <input name="name"  class="form-control" type="text">
                       @error('name')
                          <div class="alert alert-danger">
                            <span class="alert alert-danger">{{ $message }}</span>
                          </div>
                        @enderror
                    </div>

                    <div style="width: 200px" class="form-group mx-5">
                        <label for="">Telephone du donneur</label>
                       <input name="mobile" class="form-control" type="text">
                       @error('mobile')
                          <div class="alert alert-danger">
                            <span class="alert alert-danger">{{ $message }}</span>
                          </div>
                        @enderror
                    </div>

                    <div style="width: 200px" class="form-group mx-5">
                        <label for="">Date du don de sang</label>
                       <input {{-- step="7" --}} name="date" class="form-control" type="date">
                       @error('date')
                          <div class="alert alert-danger">
                            <span class="alert alert-danger">{{ $message }}</span>
                          </div>
                        @enderror
                    </div>

                    <div style="width: 200px" class="form-group">
                        <label for=""></label>
                      <button class="btn btn-primary">Prendre un rendez-vous</button>
                    </div>

                    </div>



              </div>
                    </div>
                </div>
             </div>

                 <div  class="form-group mx-5">
                        <label for=""><h4>sélectionner le center de donne sang dans la map</h4></label>
                        @error('url')
                          <div class="alert alert-danger">
                            <span class="alert alert-danger">{{ $message }}</span>
                          </div>
                        @enderror
                       <input id="url" readonly   name="url" class="form-control my-3" type="text">
                       <input hidden id="lat" readonly value="the lat"  name="lat" class="form-control my-3" type="text">
                       <input hidden id="lng" readonly value="the lng"  name="lng" class="form-control my-3" type="text">
                    </div>

                <h6 id="info"></h6>
                <input
                    id="pac-input"
                    class="controls"
                    type="text"
                    placeholder="Search Box"
               />

                 <div id="map"></div>
            </div>

                  </form>


          </div>


        </div>



      </div>
    </section>
@endsection

@section('scripts')
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo2b3VBQeicpUuxXvRPTzhOlH3zjMtQ7k&libraries=places"></script> --}}
<script>
        function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 35.7781767509014, lng: - 5.787027104129631 },
        zoom: 13,
        mapTypeId: "roadmap",
    });


    /* start add new marker */
    map.addListener('click', function(e) {
      placeMarker(e.latLng, map);
      console.log(map.mapUrl);
      console.log(e.latLng.lat());
      console.log(e.latLng.lng());
      let url_input = document.getElementById("url");
          url_input.setAttribute('value', map.mapUrl);

          let url_input_lat = document.getElementById("lat");
          url_input_lat.setAttribute('value', e.latLng.lat());

          let url_input_lng = document.getElementById("lng");
          url_input_lng.setAttribute('value', e.latLng.lng());

           console.log(url_input.value);
           console.log(url_input_lat.value);
           console.log(url_input_lng.value);
    });

    function placeMarker(position, map) {
        var marker = new google.maps.Marker({
            position: position,
            map: map
        });
        map.panTo(position);
    }
    /* end add new marker */


    /* start map 1 */
    let markerOptions1 = {
        position: new google.maps.LatLng(35.7781767509014, - 5.787027104129631),
        title: 'donation center One 1',
        animation: google.maps.Animation.BOUNCE,
        draggable: true,
        //icon: 'images/doctor2.png',
    };
    let marker1 = new google.maps.Marker(markerOptions1);
    marker1.setMap(map);


    let content = `<div id="content">

                 <div id="bodyContent">'
                    <h1 class="text-success" style="text-align: center;">Marjan</h1>
                 <div style="float:left; width:20%;margin-top: 10px;">
                    <img src="https://lh5.googleusercontent.com/p/AF1QipPTNMPL3OZe-4LZ7-4vDNREUbqchhF-x85OXpfn=w408-h306-k-no" width="120" height="80"/>
                  </div>
                 <div style="float:right; width:80%;margin-top: 10px;">

                    <p>
                        The <b>Googleplex</b> is the corporate headquarters complex of <b>Google, Inc.</b>, located at <b>Googleplex, 1600 Amphitheatre Pkwy, Mountain View, CA 94043, United States</b>.
                       <br/>The original complex with 2 million square feet of office space is the company\'s second largest square footage assemblage of Google buildings
                       (The largest Google building is the 2.9 million square foot building in New York City which Google bought in 2010)
                    <p>
                      Attribution: Googleplex, <a href="http://en.wikipedia.org/wiki/Googleplex">http://en.wikipedia.org/wiki/Googleplex</a>.
                    </p>

                 </div>
                 </div>
                 </div>`;

    let infoWindow = new google.maps.InfoWindow({
        content: content
    })

    marker1.addListener('click', (googleMapsEvent) => {
        //document.getElementById('info').innerHTML = `latitude: ` + googleMapsEvent.latLng.lat() + ` AND langtitude: ` + googleMapsEvent.latLng.lng();
        infoWindow.open(map, marker1);

         let url_input = document.getElementById("url");
          url_input.setAttribute('value', map.mapUrl);

          let url_input_lat = document.getElementById("lat");
          url_input_lat.setAttribute('value', googleMapsEvent.latLng.lat());

          let url_input_lng = document.getElementById("lng");
          url_input_lng.setAttribute('value', googleMapsEvent.latLng.lng());

           console.log(url_input.value);
           console.log(url_input_lat.value);
           console.log(url_input_lng.value);
    });


    /* /end map 1 */

    /* start map 2 */
    let markerOptions2 = {
        position: new google.maps.LatLng(35.792114613693165, - 5.8126492169828925),
        title: 'donation center Twho 2',
        animation: google.maps.Animation.BOUNCE,
    };
    let marker2 = new google.maps.Marker(markerOptions2);
    marker2.setMap(map);

    let content2 = `<div id="content">
                 <div id="bodyContent">'
                    <h1 class="text-success" style="text-align: center;">Aswak Assalam</h1>
                 <div style="float:left; width:20%;margin-top: 10px;">
                    <img src="https://lh5.googleusercontent.com/p/AF1QipPCFy6W8oIOg_NweXkmNnt6Bj7B3EW18dj_UEP2=w408-h306-k-no" width="120" height="80"/>
                  </div>
                 <div style="float:right; width:80%;margin-top: 10px;">

                    <p>
                        The <b>Googleplex</b> is the corporate headquarters complex of <b>Google, Inc.</b>, located at <b>Googleplex, 1600 Amphitheatre Pkwy, Mountain View, CA 94043, United States</b>.
                       <br/>The original complex with 2 million square feet of office space is the company\'s second largest square footage assemblage of Google buildings
                       (The largest Google building is the 2.9 million square foot building in New York City which Google bought in 2010)
                    <p>
                      Attribution: Googleplex, <a href="http://en.wikipedia.org/wiki/Googleplex">http://en.wikipedia.org/wiki/Googleplex</a>.
                    </p>

                 </div>
                 </div>
                 </div>`;

    let infoWindow2 = new google.maps.InfoWindow({
        content: content2
    })

    marker2.addListener('click', (googleMapsEvent) => {
        // document.getElementById('info').innerHTML = `latitude: ` + googleMapsEvent.latLng.lat() + ` AND langtitude: ` + googleMapsEvent.latLng.lng();
        infoWindow2.open(map, marker2);

         let url_input = document.getElementById("url");
          url_input.setAttribute('value', map.mapUrl);

          let url_input_lat = document.getElementById("lat");
          url_input_lat.setAttribute('value', googleMapsEvent.latLng.lat());

          let url_input_lng = document.getElementById("lng");
          url_input_lng.setAttribute('value', googleMapsEvent.latLng.lng());

           console.log(url_input.value);
           console.log(url_input_lat.value);
           console.log(url_input_lng.value);

    });
    /* /end map 2 */

    /* start map 3 */
    let markerOptions3 = {
        position: new google.maps.LatLng(35.73238598846993, - 5.759258570094354),
        title: 'donation center Three 3',
        animation: google.maps.Animation.BOUNCE,
    };
    let marker3 = new google.maps.Marker(markerOptions3);
    marker3.setMap(map);

    let content3 = `<div id="content">
                 <div id="bodyContent">'
                    <h1 class="text-success" style="text-align: center;">Tangier Ibn Battouta Airport</h1>
                 <div style="float:left; width:20%;margin-top: 10px;">
                    <img src="https://lh5.googleusercontent.com/p/AF1QipPTNMPL3OZe-4LZ7-4vDNREUbqchhF-x85OXpfn=w408-h306-k-no" width="120" height="80"/>
                  </div>
                 <div style="float:right; width:80%;margin-top: 10px;">

                    <p>
                        The <b>Googleplex</b> is the corporate headquarters complex of <b>Google, Inc.</b>, located at <b>Googleplex, 1600 Amphitheatre Pkwy, Mountain View, CA 94043, United States</b>.
                       <br/>The original complex with 2 million square feet of office space is the company\'s second largest square footage assemblage of Google buildings
                       (The largest Google building is the 2.9 million square foot building in New York City which Google bought in 2010)
                    <p>
                      Attribution: Googleplex, <a href="http://en.wikipedia.org/wiki/Googleplex">http://en.wikipedia.org/wiki/Googleplex</a>.
                    </p>

                 </div>
                 </div>
                 </div>`;

    let infoWindow3 = new google.maps.InfoWindow({
        content: content3
    })

    marker3.addListener('click', (googleMapsEvent) => {
        //document.getElementById('info').innerHTML = `latitude: ` + googleMapsEvent.latLng.lat() + ` AND langtitude: ` + googleMapsEvent.latLng.lng();
        infoWindow3.open(map, marker3);
         let url_input = document.getElementById("url");
          url_input.setAttribute('value', map.mapUrl);

          let url_input_lat = document.getElementById("lat");
          url_input_lat.setAttribute('value', googleMapsEvent.latLng.lat());

          let url_input_lng = document.getElementById("lng");
          url_input_lng.setAttribute('value', googleMapsEvent.latLng.lng());

           console.log(url_input.value);
           console.log(url_input_lat.value);
           console.log(url_input_lng.value);
    });
    /* /end map 3 */

    // Create the search box and link it to the UI element.
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            // Create a marker for each place.
            markers.push(
                new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                })
            );
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

window.initAutocomplete = initAutocomplete;
    </script>

    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo2b3VBQeicpUuxXvRPTzhOlH3zjMtQ7k&callback=initMap"></script> --}}

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDo2b3VBQeicpUuxXvRPTzhOlH3zjMtQ7k&callback=initAutocomplete&libraries=places&v=weekly"
        defer></script>


@stop
