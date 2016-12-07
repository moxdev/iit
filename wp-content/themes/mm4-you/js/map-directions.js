// SOME VARIABLES WE WILL NEED
var directionDisplay;
var directionsService = new google.maps.DirectionsService();

function initialize() {
	
	/*var locations = [
		["Millennium Marketing Solutions", 39.130103, -76.792478," 10900 Pump House Road","Annapolis Junction, MD 20701"]
	]*/
	
	var center = new google.maps.LatLng(39.130103, -76.792478);
	// WE'LL NEED THIS IN A BIT
	var markers = [];
	
	directionsDisplay = new google.maps.DirectionsRenderer();
	
	// SET OUR MAP OPTIONS
	var myOptions = {
		
		/********** ADD AND REMOVE SOME DEFAULT MAP CONTROLS **********/
		//zoomControl: false,
		//mapTypeControl: false,
		//panControl:false,
		//rotateControl:false,
		scrollwheel:false,
		streetViewControl:false,
		maxZoom:18,
		center:center,
		
	// ADD ALL OF THE MAP TYPES THAT WE WANT TO USE IN OUR MAP
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.SATELLITE]
		}, mapTypeId: google.maps.MapTypeId.ROADMAP	
	};
	
	// LOAD THE MAP
	var map = new google.maps.Map(document.getElementById('side-map-canvas'), myOptions);
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById('directions-panel'));
	
	var bounds = new google.maps.LatLngBounds();
	
	// LOOP THROUGH OUR LOCATIONS ARRAY AND ADD EACH MARKER TO THE "MARKERS" ARRAY CREATED ABOVE
	var marker, i;
	var image = ''

	// ADD ALL THE MARKERS IN OUR LOCATIONS ARRAY
	for (i=0; i<locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			//icon: image,
			title: locations[i][0]
		});
		markers.push(marker);
		
		bounds.extend(marker.getPosition());
    }

    map.fitBounds(bounds);
	
}

// FUNCTION TO CALCULATE DIRECTIONS
function calcRoute() {
	var start = document.getElementById("start").value;
	var end = document.getElementById("end").value;
	var request = {
		origin:start,
		destination:end,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};	
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
        		directionsDisplay.setDirections(response);
				jQuery('#map-error').hide();
				jQuery('#directions-panel').fadeIn(1000);
		} else {
			html = 'Starting address not found. Please check that you have entered it correctly.';
			jQuery('#map-error').append(html);
			jQuery('#map-error').fadeIn(1000);
		}
    });
	
	return false;
}

google.maps.event.addDomListener(window, 'load', initialize);