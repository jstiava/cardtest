
function start_fetch() {

    fetch_locations(12);

}




function fetch_locations(id) {
    fetch("https://card.local/wp-json/wp/v2/posts?categories=" + id + "&per_page=100", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => handle_locations(data))
        .catch(error => console.error('Error:', error));
}

async function handle_locations(data) {
    jsonData = JSON.parse(JSON.stringify(data));

    try {
        const pos = await getPosition(false);
        gpsSuccess(pos);
    }
    catch (err) {
        gpsError(err);
    }

    process_locations(jsonData);

    markets_hashmap.forEach(function (value) {
        rendered_elements = rendered_elements.concat(value.children);
    })

    fetch_events();

    console.log(locations_pq);

    render();

}





function fetch_events() {
    fetch("https://card.local/wp-json/wp/v2/calendar_event/", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => handle_events(data))
        .catch(error => console.error('Error:', error));
}

function handle_events(data) {
    jsonData = JSON.parse(JSON.stringify(data));

    process_events(jsonData);

}







function fetch_and_render_image(id, container) {

    fetch("https://card.local/wp-json/wp/v2/media/" + id, {
        method: 'GET',
    })
        .then(response => response.json())
        .then(data => handle_and_render_image(data, container))
        .catch(error => console.error('Error:', error));
}

function handle_and_render_image(data, container) {
    jsonData = JSON.parse(JSON.stringify(data));
    container.src = jsonData.guid.rendered;
}





// Insert today's date into the datetime-local field
// document.getElementById('datetime').value = (new Date(today.getTime() - today.getTimezoneOffset() * 60000).toISOString()).slice(0, -1);





// // Store a locale variable
// // localStorage.test = "This is a test of the local storage system.";
// console.log(localStorage.test);

const currpos = document.getElementById('curr_pos');
let current_latitude = null;
let current_longitude = null;

// // Setup Geolocation API options
const options = { enableHighAccuracy: true, timeout: 6000, maximumAge: 0 };

// Geolocation: Success
function gpsSuccess(pos) {
    // Get the date from Geolocation return (pos)
    const dateObject = new Date(pos.timestamp);
    // Get the lat, long, accuracy from Geolocation return (pos.coords)
    const { latitude, longitude, accuracy } = pos.coords;

    current_latitude = latitude;
    current_longitude = longitude;
    // Add details to page
    currpos.innerHTML = `Date: ${dateObject}
        <br>Lat/Long: ${latitude.toFixed(5)}, ${longitude.toFixed(5)}
        <br>Accuracy: ${accuracy} (m)`;

    return;
}
// Geolocation: Error
function gpsError(err) {
    console.warn(`Error: ${err.code}, ${err.message}`);

    return;
}


// Button onClick, get the the location
function getPosition(override) {

    if (override) {
        current_latitude = 38.656588218856925;
        current_longitude = -90.3015715560746;
        return;
    }

    return new Promise(function (resolve, reject) {
        navigator.geolocation.getCurrentPosition(resolve, reject, options);
    });
}

// document.addEventListener("DOMContentLoaded", getLocation, true)

