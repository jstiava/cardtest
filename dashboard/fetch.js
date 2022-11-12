




function fetch_locations(id) {
    fetch("http://card.local/wp-json/wp/v2/posts?categories=" + id + "&per_page=100", {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => handle_locations(data))
    .catch(error => console.error('Error:', error));
}

function handle_locations(data) {
    jsonData = JSON.parse(JSON.stringify(data));

    process_locations(jsonData);
}







function fetch_and_render_image(id, container) {
    
    fetch("http://card.local/wp-json/wp/v2/media/" + id, {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => handle_and_render_image(data, container))
    .catch(error => console.error('Error:', error));
}

function handle_and_render_image(data, container) {
    jsonData = JSON.parse(JSON.stringify(data));

    console.log(jsonData);
    container.src = jsonData.guid.rendered;
}
















// Insert today's date into the datetime-local field
document.getElementById('datetime').value = (new Date(today.getTime() - today.getTimezoneOffset() * 60000).toISOString()).slice(0, -1);















// // Store a locale variable
// // localStorage.test = "This is a test of the local storage system.";
// console.log(localStorage.test);

// const currpos = document.getElementById('currentposition');

// // Setup Geolocation API options
// const gpsOptions = { enableHighAccuracy: true, timeout: 6000, maximumAge: 0 };
// const gnssDiv = document.getElementById("gnssData");
// // Geolocation: Success
// function gpsSuccess(pos) {
//     // Get the date from Geolocation return (pos)
//     const dateObject = new Date(pos.timestamp);
//     // Get the lat, long, accuracy from Geolocation return (pos.coords)
//     const { latitude, longitude, accuracy } = pos.coords;
//     // Add details to page
//     currpos.innerHTML = `Date: ${dateObject}
//         <br>Lat/Long: ${latitude.toFixed(5)}, ${longitude.toFixed(5)}
//         <br>Accuracy: ${accuracy} (m)`;
// }
// // Geolocation: Error
// function gpsError(err) {
//     console.warn(`Error: ${err.code}, ${err.message}`);
// }
// // Button onClick, get the the location
// function getLocation() {
//     navigator.geolocation.getCurrentPosition(gpsSuccess, gpsError, gpsOptions);
// }

// document.addEventListener("DOMContentLoaded", getLocation, true)

