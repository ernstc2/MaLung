var loadAmt = 0;
var CurrentAmt = 0;
JSONapi = null;

// Made with ChatGPT
//Street View API Call
function initializeStreetView(coords, i) {
  var panorama = new google.maps.StreetViewPanorama( //creates a street view panorama in #street-view-container-i with the options below
    document.getElementById('street-view-container-' + i),
    {
      position: { lat: coords.latitude, lng: coords.longitude },
      pov: { heading: 165, pitch: 0 }, // Set the initial view angle
      zoom: 1
    }
  );
}

//Show/hide street view
function toggleStreetView(lat, lng, ind) {
  if (document.getElementById("businessButton-" + ind).innerHTML == "Show Street View") {
    document.getElementById("businessButton-" + ind).innerHTML = "Hide Street View";
    document.getElementById("outerContainer-" + ind).innerHTML = "<div id = 'street-view-container-" + ind + "' class = 'streetView'>"; //street-view-container-ind
    let coords = {
      latitude: lat,
      longitude: lng
    };
    console.log(coords);
    initializeStreetView(coords, ind);
  } else {
    document.getElementById("businessButton-" + ind).innerHTML = "Show Street View";
    document.getElementById("outerContainer-" + ind).innerHTML = "";
  }
  return;
}

//Do an API call to Yelp Fusion and then use the data given to fill out info that is being shown
function yelpAPICall(country, type) {
  console.log(country, type);
  let url = "https://api.yelp.com/v3/businesses/search";

  $.ajax({ // Yelp Fusion API call (doing it through PHP because doing it in the frontend runs into CORS error)
    url: "./yelpFetch.php",
    method: "GET",
    data: {
      apiUrl: url,
      country: country.replace(/\s/g, "%20"),
      type: type
    },
    dataType: "json",
    success: function(data) {
      let response = JSON.parse(data);

      document.getElementById("content").innerHTML = "";

      console.log(response);
      JSONapi = response;
      
      // response.businesses.forEach(function(business, ind) {
      for (let ind = 0; ind < response.businesses.length && ind < 3; ind++) {
        loadAmt++;
        const business = response.businesses[ind];
        let output = "";
        output = "<section class = 'InformationBox'>";
          output += "<h3 id = 'heading-" + ind + "'>" + business.name + "<a id = 'url-" + ind + "' class = 'yelpUrl' target = '_blank' href = '" + business.url + "'></a></h3>";
          output += "<p>"
            for (let i = 0; i < business.location.display_address.length; i++) {
              output += business.location.display_address[i];
              if (i+1 != business.location.display_address.length) {
                output += ", ";
              }
            }
          output += "</p>";
          output += "<img class = 'businessImg' src = '" + business.image_url + "' alt = '" + business.name + "'><br>";
          output += "<button id = 'businessButton-" + ind + "' onclick = 'toggleStreetView(" + response.businesses[ind].coordinates.latitude + ", " + response.businesses[ind].coordinates.longitude + ", " + ind + ")'>Show Street View</button><br>"
          output += "<div id = 'outerContainer-" + ind + "'></div>";
        output += "</section>";
        console.log(output);
        document.getElementById("content").innerHTML += output;

        //image height based on the height of the text so need to insert + resize image after text is put on page
        document.getElementById("url-" + ind).innerHTML = "<img id = 'logo-" + ind + "' class = 'yelpLogo' src = '../Resources/Images/yelp_logo.png' alt = 'Business page on Yelp'></img>";
        $("#logo-" + ind).css("height", $("#heading-" + ind).css("height"));
      // });
      }
    },
    error: function(xhr, status, error) {
      let message = xhr.responseJSON.error;
      console.log('Error: ' + message);
    }
  });
}

function LoadMore() {
  if (JSONapi == null) return;
  inital = loadAmt;
  response = JSONapi;

  for (let ind = loadAmt; ind < response.businesses.length && ind < inital +  3; ind++) {
    loadAmt++;
    const business = response.businesses[ind];
    let output = "";
    output = "<section class = 'InformationBox'>";
      output += "<h3 id = 'heading-" + ind + "'>" + business.name + "<a id = 'url-" + ind + "' class = 'yelpUrl' target = '_blank' href = '" + business.url + "'></a></h3>";
      output += "<p>"
        for (let i = 0; i < business.location.display_address.length; i++) {
          output += business.location.display_address[i];
          if (i+1 != business.location.display_address.length) {
            output += ", ";
          }
          loadAmt++;
        }
      output += "</p>";
      output += "<img class = 'businessImg' src = '" + business.image_url + "' alt = '" + business.name + "'><br>";
      output += "<button id = 'businessButton-" + ind + "' onclick = 'toggleStreetView(" + JSONapi.businesses[ind].coordinates.latitude + ", " + JSONapi.businesses[ind].coordinates.longitude + ", " + ind + ")'>Show Street View</button><br>"
      output += "<div id = 'outerContainer-" + ind + "'></div>";
    output += "</section>";
    document.getElementById("content").innerHTML += output;

    //image height based on the height of the text so need to insert + resize image after text is put on page
    document.getElementById("url-" + ind).innerHTML = "<img id = 'logo-" + ind + "' class = 'yelpLogo' src = '../Resources/Images/yelp_logo.png' alt = 'Business page on Yelp'></img>";
    $("#logo-" + ind).css("height", $("#heading-" + ind).css("height"));
  }
}