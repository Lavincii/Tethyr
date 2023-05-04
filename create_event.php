<?php
include("includes/header.php"); //Header 
?>
<div class = "TMBG">
<h1 class = "Tethyr_me">Create Event</h1>
<div class="container mt-5 mb-5">
  <form>
    <div class="row mt-5">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
          </div>

          <div class="card-body">
            <div class="form-group">
              <label>Name</label>
              <input id="event_name" class="form-control" /><small id="emailHelp" class="form-text text-muted">
                6 characters minimum.
              </small>
            </div>

            <div class="form-row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Category</label>
                  <select id="event_category" class="form-control">
                    <option>Music</option>
                    <option>Food &amp; Drink</option>
                    <option>Entertainment</option>
                    <option>Night Life</option>
                    <option>Theatre</option>
                    <option>Arts</option>
                    <option>Sports</option>
                    <option>Outdoors</option>
                    <option>Conferences</option>
                    <option>Courses</option>
                    <option>Charity</option>
                    <option>Other</option>
                    <option>Attractions</option>
                    <option>Exhibitions</option>
                    <option>Talks</option></select>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tags</label>
                  <input id="event_tags" class="form-control" /><small id="emailHelp" class="form-text text-muted">
                    Separated by comma.
                  </small>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Starts at</label>
                  <input id="event_category" class="form-control" /></div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Ends at</label>
                  <input id="event_tags" class="form-control" /></div>
              </div>
            </div>

            <div class="form-group col-sm-6">
              <label>Description</label>
              <textarea id="event_description" class="form-control" placeholder="Write something about your event"></textarea>
            </div>
                <div class="form-group ">
                <label>Price</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="material-icons">$</i>
                  </span>
                  <input id="ticket_price" class="form-control" /></div>
              </div>
            <div class="form-group">
              <div id="file_target">
                <img src = "https://digital-public-contact.s3.amazonaws.com/production-thamesvalley/static/img/placeholder.png"/></div>
              <input id="event_image" class="form-control" type = 'file' multiple = false accept= ".jpg, .jpeg, .png"/>
              <label>Event Image</label>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label class="col-form-label">Location</label>
              <input id="venue_geocomplete" class="form-control" type = "text" placeholder="Autofill address..."><small id="emailHelp" class="form-text text-muted">
                Data provided by Google.
              </small>
            </div>

            <div class="form-group">
              <label class="col-form-label">Address</label>
              <input id="venue_address" class="form-control" placeholder = "1234 Main St" type = "text" name = "formatted_address"/></div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="col-form-label"> City</label>
                <input id="venue_city" class="form-control" type = "text" name = "locality"/></div>
              <div class="form-group col-md-4">
                <label class="col-form-label"> State</label>
                <input id="venue_state" class="form-control" type = "text" name = "administrative_area_level_1"/></div>
              <div class="form-group col-md-2">
                <label class="col-form-label">Zip</label>
                <input id="venue_zip" class="form-control" type = "text" name = "postal_code"/></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label>Map</label>
                <div id="venue_map"></div>
              </div>
            <div class="form-row" hidden = true>
              <div class="form-group col-md-6">
                <label class="col-form-label">Latitude</label>
                <input id="venue_lat" class="form-control" type = "text" name = "lat"/></div>
              <div class="form-group col-md-6">
                <label class="col-form-label">Longitude</label>
                <input id="venue_lng" class="form-control" type = "text" name = "lng"/></div></div>
          </div>
              <div class="form-group d-flex justify-content-end mt-3">
      <button class="btn d-flex align-items-center mr-3">
        Clear Event
      </button>
      <br></br>
      <button class="btn btn-primary d-flex align-items-center float-right">
        Save Event
      </button>
    </div>
        </div>
      </div>
    </div>
    </div>
  </form>
</div>
</div>


<script>
	if (document.getElementById("venue_map")) {
	var myLatlng = new google.maps.LatLng(55.676098, 12.568337);
	var mapOptions = {
		zoom: 10,
		minZoom: 3,
		maxZoom: 18,
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		},
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: !1,
		scaleControl: false,
		fullscreenControl: false,
		streetViewControl: false,
		mapTypeControl: false,
		scrollwheel: true,
		backgroundColor: '#F2F2F2',
		clickableIcons: false
	};

	// Attach a map to the DOM Element, with the defined settings
	var map = new google.maps.Map(document.getElementById("venue_map"), mapOptions);

	// Map Marker
	map = new google.maps.Map(document.getElementById("venue_map"), mapOptions);

	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(48.856614, 2.3522219),
		// Below is position of marker at the center of the map
		// position: new google.maps.LatLng(48.8566140,2.1000019),
		animation: google.maps.Animation.DROP,
		map: map
	});
}

$(function(){
	$("#venue_geocomplete").geocomplete({
		map: "#venue_map",
		mapOptions: mapOptions,
		details: "form",
		types: ["geocode", "establishment"],
	});
});

$(function() {
  $('#event_image').on('change', function(event) {
    var files = event.target.files;
    var image = files[0]
    // here's the file size
    console.log(image.size);
    var reader = new FileReader();
    reader.onload = function(file) {
      var img = new Image();
      console.log(file);
      img.src = file.target.result;
      $('#file_target').html(img);
    }
    reader.readAsDataURL(image);
    console.log(files);
  });
});

$(function() {
  $('#venue_image').on('change', function(event) {
    var files = event.target.files;
    var image = files[0]
    // here's the file size
    console.log(image.size);
    var reader = new FileReader();
    reader.onload = function(file) {
      var img = new Image();
      console.log(file);
      img.src = file.target.result;
      $('#venue_target').html(img);
    }
    reader.readAsDataURL(image);
    console.log(files);
  });
});
</script>
