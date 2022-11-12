

/**
 * Merchants Dashboard
 * Custom Made for Bear Bucks specifically
 * 
 * Jeremy Stiava
 * Student Marketing & Systems Developer, Dining Services & Business Operations
 * B.S. 2024, Computer Science & Political Science, McKelvey School of Engineering
 * Washington University in St. Louis
 */


// Get the current date
var today = new Date();
var day = today.getDay();
var hour = hourAdjustment(today.getHours());
var min = today.getMinutes();

const dayOfWeek_hashedTo_index = new Map();

dayOfWeek_hashedTo_index.set("M", 0);
dayOfWeek_hashedTo_index.set("Mo", 0);
dayOfWeek_hashedTo_index.set("Mon", 0);
dayOfWeek_hashedTo_index.set("Monday", 0);

dayOfWeek_hashedTo_index.set("Tu", 1);
dayOfWeek_hashedTo_index.set("Tue", 1);
dayOfWeek_hashedTo_index.set("Tues", 1);
dayOfWeek_hashedTo_index.set("Tuesday", 1);

dayOfWeek_hashedTo_index.set("W", 2);
dayOfWeek_hashedTo_index.set("We", 2);
dayOfWeek_hashedTo_index.set("Wed", 2);
dayOfWeek_hashedTo_index.set("Wednesday", 2);

dayOfWeek_hashedTo_index.set("Th", 3);
dayOfWeek_hashedTo_index.set("Thu", 3);
dayOfWeek_hashedTo_index.set("Thurs", 3);
dayOfWeek_hashedTo_index.set("Thursday", 3);

dayOfWeek_hashedTo_index.set("F", 4);
dayOfWeek_hashedTo_index.set("Fri", 4);
dayOfWeek_hashedTo_index.set("Friday", 4);

dayOfWeek_hashedTo_index.set("Sa", 5);
dayOfWeek_hashedTo_index.set("Sat", 5);
dayOfWeek_hashedTo_index.set("Saturday", 5);

dayOfWeek_hashedTo_index.set("Su", 6);
dayOfWeek_hashedTo_index.set("Sun", 6);
dayOfWeek_hashedTo_index.set("Sunday", 6);

function hourAdjustment(hour) {

    // What is tomorrow? Tomorrow starts at 4am.
    hour = hour - 4;

    if (hour < 0) {
        hour = 24 + hour;
    }

    return hour;
}

function undueHourAdjustment(hour) {

    // What is tomorrow? Tomorrow starts at 4am.
    hour = hour + 4
    type = "am";

    if (hour > 24) {
        hour = hour - 24;
    }

    if (hour > 12) {
        hour = hour - 12;
        type = "pm";
    }

    return [hour, type];
}

function cleanHour(hour) {
    if (hour > 12) {
        return hour - 12;
    }
    else if (hour == 0) {
        return 12;
    }

    return hour;
}

function goTo24HourTime(hour, type) {
    type = type.toUpperCase();

    if (type == "PM" || type == "P") {
        if (hour == 12) {
            return hour;
        }
        return hour + 12;
    }

    if (hour == 12) {
        return 0;
    }
    return hour;
}

function getHourType(hour) {
    if (hour > 12) {
        return "PM";
    }

    return "AM";
}

function getOpenClosed(hours, day, hour) {

    today = hours[day];

    if (today == true || today[hour] == true) {
        return true;
    }

    if (today == false || today[hour] == false) {
        return false;
    }

    if (today[hour][0]) {
        if (min >= today[1]) {
            return true;
        }
        return false;
    }

    if (min >= today[hour][1]) {
        return false;
    }
    return true
}





function getNextAction(hours, status, day, hour) {

    today = hours[day];

    if (today == true) {
        return "Open All Day";
    }

    if (today == false) {
        return "Closed All Day";
    }

    // Searching within the hour
    if (typeof today[hour][0] !== 'undefined') {
        if (today[hour][0] == !status) {
            value = Math.abs(today[hour][0] - min);
            if (status) {
                return "Closes in " + value + "min";
            }
            return "Opens in " + value + "min";
        }
    }

    // Go to future hours in the same day
    for (var i = hour; i < 24; i++) {

        var save = getOpenClosed(hours, day, i);

        if (save == !status) {
            next = undueHourAdjustment(i);
            if (status) {
                return "Open until " + next[0] + next[1];
            }
            return "Reopens at " + next[0] + next[1];

        }
    }

    // Search the rest of the week
    // for (var i = day + 1; i < 7; i++) {
    //     for (var j = 0; j < 24; j++) {
    //         var save = getOpenClosed(hours, i, j);

    //         if (save == !status) {
    //             nextDay = convertIndexToDay(i);
    //             if (i == day + 1) {
    //                 nextDay = "tomorrow";
    //             }
    //             nextHour = undueHourAdjustment(j);
    //             if (!status) {
    //                 return "Reopens " + nextDay + " at " + nextHour[0] + nextHour[1];
    //             }
    //         }
    //     }
    // }

    return "Closed for the Day";

}





var hourRegex = /([\w]{2,8})[\s]*[-]?[\s]*([\w]{2,8})?[\s]*:[\s]*(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)?(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)?/;
var textRegex = /([\w]{2,3})[\s]*[-]?[\s]*([\w]{2,3})?:[\s]*([O][\S]*)/;

function prepareMinute(minute) {
    minute = Number(minute);

    if (isNaN(minute)) {
        return 0;
    }
    return minute;
}
function prepareRange(start, end) {

    if (start == "Dai") {
        return [0, 6];
    }

    start = dayOfWeek_hashedTo_index.get(start);

    if (typeof end !== "undefined") {
        end = dayOfWeek_hashedTo_index.get(end);
        return [start, end];
    }
    return [start, start];
}


function preProcessHoursRegex(match) {
    var day_arr = new Array(24).fill(false);

    var keyValues = [4, 11, 18];

    for (var i = 0; i < keyValues.length; i++) {

        // Get all values
        var key = keyValues[i];
        var x = Number(match[key]);

        if (typeof x == "undefined" || isNaN(x)) {
            break;
        }
        var x_min = prepareMinute(match[key + 1]);
        var x_type = match[key + 2];
        var y = Number(match[key + 3]);
        var y_min = prepareMinute(match[key + 3 + 1]);
        var y_type = match[key + 3 + 2];

        // Find AM/PM type + 2 from minutes
        x = hourAdjustment(goTo24HourTime(x, x_type));
        y = hourAdjustment(goTo24HourTime(y, y_type));

        day_arr[x] = [true, x_min];
        for (var j = x + 1; j < y; j++) {
            day_arr[j] = true;
        }
        day_arr[y] = [false, y_min];
    }

    return day_arr;
}

function processHours(string) {
    var strings = string.split(';');

    var week_arr = new Array(7).fill(false);
    for (var i = 0; i < strings.length; i++) {

        // Open
        if (match = textRegex.exec(strings[i])) {

            // Preprocessing
            var open_arr = true;
            var range = prepareRange(match[1], match[2]);

            for (var j = range[0]; j <= range[1]; j++) {
                week_arr[j] = open_arr;
            }

        }
        // Specific Hours
        else if (match = hourRegex.exec(strings[i])) {

            // Preprocessing
            day_arr = preProcessHoursRegex(match);
            if (match[1] == "Sat" && match[2] == "Sun") {
                week_arr[6] = day_arr;
                week_arr[0] = day_arr;
            }
            else {
                var range = prepareRange(match[1], match[2]);

                for (var j = range[0]; j <= range[1]; j++) {
                    week_arr[j] = day_arr;
                }
            }
        }
    }

    return week_arr;
}

function get_contrast_color(hex) {

    if (hex == null || hex == "") {
        return "#000000";
    }

    var red = parseInt(hex.slice(1, 3), 16);
    var blue = parseInt(hex.slice(3, 5), 16);
    var green = parseInt(hex.slice(5, 7), 16);

    if ((red*0.299 + green*0.587 + blue*0.114) > 186) {
        return "#000000";
    } 
    return "#ffffff";
}



function Region(name, locations) {
    this.name = name;
    this.children = locations;
}

function Market(name, description, locations) {
    this.name = name;
    this.description = description;
    this.children = locations;
    this.takeover = null;
}

function Location(name, description, icon, icon_type, link, hours, menus, primary_color) {
    this.name = name;
    this.description = description;
    this.icon = icon;
    this.icon_type = icon_type;
    this.link = link;
    this.hoursToString = hours.replaceAll(';', '<br>');
    this.hours = processHours(hours);
    this.current = getOpenClosed(this.hours, day, hour);
    this.next = getNextAction(this.hours, this.current, day, hour);
    this.special = [];
    this.tertiary = [];
    this.tertiary = [];
    this.primary_color = primary_color;
    this.secondary_color = get_contrast_color(primary_color);
    this.children = menus;
}

function Menu(name, hours) {
    this.name = name;
    this.hoursToString = hours.replaceAll(';', '<br>');
    this.hours = processHours(hours);
    this.current = getOpenClosed(this.hours, day, hour);
    this.next = getNextAction(this.hours, this.current, day, hour);
    this.special = [];
    this.tertiary = [];
    this.foodpro_url = "";
    this.children = [];
}

// Insert today's date into the datetime-local field
document.getElementById('datetime').value = (new Date(today.getTime() - today.getTimezoneOffset() * 60000).toISOString()).slice(0, -1);


function fetch_locations(id) {
    fetch("http://card.local/wp-json/wp/v2/posts?categories=" + id + "&per_page=100", {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => handle_locations(data))
    .catch(error => console.error('Error:', error));
}

function handle_locations(data) {
    jsonData = JSON.parse(JSON.stringify(data));

    process_locations(jsonData);
}


let root_block = document.getElementById('locationsList');
const regions_hashmap = new Map();
const locations_hashmap = new Map();

function process_locations(fetch_list) {

    process_locations_helper(fetch_list, 0);

}

function process_locations_helper(fetch_list, i) {

    if (i >= fetch_list.length) {
        render_locations();
        return;
    }

    var target = fetch_list[i];

    var new_node = null;

    switch (target.acf.location_type) {

        case 'region':
            new_node = new Region(
                target.title.rendered,
                target.acf.child_elements
            );
            regions_hashmap.set(target.id, new_node);
            break;

        case 'market':
            new_node = new Market(
                target.title.rendered,
                target.acf.description,
                target.acf.child_elements
            );
            locations_hashmap.set(target.id, new_node);
            break;

        case 'menu':
            new_node = new Menu(
                target.title.rendered,
                target.acf.hours_of_operation
            );
            locations_hashmap.set(target.id, new_node);
            break;

        default:
            new_node = new Location(
                target.title.rendered,
                target.acf.description,
                target.acf.icon,
                target.acf.icon_type,
                target.link,
                target.acf.hours_of_operation,
                target.acf.child_elements,
                target.acf.primary_color
            );
            locations_hashmap.set(target.id, new_node);
            break;
    }

    return process_locations_helper(fetch_list, i + 1)

}

function fetch_image(id, container) {
    
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


function render_locations() {

    for (let target of locations_hashmap.values()) {

        if (target.constructor.name == "Market" || target.constructor.name == "Menu") {
            continue;
        }

        var new_location_block = document.createElement('div');
        new_location_block.classList.add('location');
    
        if (target.icon != null) {
            var img_icon = document.createElement('img');
            fetch_image(target.icon, img_icon);
            new_location_block.appendChild(img_icon);
        }
        
        var content = document.createElement('div');
        content.classList.add('content');

        var p_title = document.createElement('p');
        p_title.innerHTML = target.name;
        content.appendChild(p_title);

        var p_hours = document.createElement('p');
        p_hours.innerHTML = target.hoursToString;
        content.appendChild(p_hours);
        
        var a_link = document.createElement('a');
        a_link.href = target.link;
        a_link.innerHTML = "See More";
        content.appendChild(a_link);

        new_location_block.appendChild(content);

        if (target.primary_color != null && target.primary_color != "") {
            new_location_block.style.background = target.primary_color;
            new_location_block.style.color = target.secondary_color;
        }


        if (target.current) {
            new_location_block.classList.add('open');
        }
        else {
            new_location_block.classList.add('closed');
        }

        root_block.appendChild(new_location_block);
    }

}


fetch_locations(12);





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

