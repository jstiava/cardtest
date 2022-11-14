


// Hours & Events Dashboard
// Custom made for Dining Services

// Jeremy Stiava
// Student Marketing & Systems Developer, Dining Services & Business Operations
// B.S. 2024, Computer Science & Political Science, McKelvey School of Engineering
// Washington University in St. Louis


/**
 * Adjust the fetched hour to reflect 4 indeces backwards, since we are beginning days at 4am
 * @param {*} hour 
 * @returns 
 */
 function adjust_hour(hour) {
    hour = hour - 4;
    if (hour < 0) {
        hour = 24 + hour;
    }
    return hour;
}
function unadjust_hour(hour) {
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
function hour_to_12(hour) {
    if (hour > 12) {
        return hour - 12;
    }
    else if (hour == 0) {
        return 12;
    }
    return hour;
}
function hour_to_24(hour, type) {
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
function prepareRange(start, end) {
    if (start == "Daily") {
        return [0, 6];
    }

    start = getDayIndex.get(start);
    if (typeof end !== "undefined") {
        end = getDayIndex.get(end);
        return [start, end];
    }
    return [start, start];
}





function prepareMinute(minute) {
    minute = Number(minute);

    if (isNaN(minute)) {
        return 0;
    }
    return minute;
}





/**
 * Adjust the fetched date to reflect one index backwards, since we are starting our weeks on Monday
 * @param {*} day 
 * @returns 
 */
function adjust_day(day) {
    day = day - 1;
    if (day < 0) {
        day = 6;
    }
    return day;
}






/**
 * Get today's date
 */
let today = new Date();
let day = adjust_day(today.getDay());
let hour = adjust_hour(today.getHours());
let min = today.getMinutes();




/**
 * Takes a day of the week string, converts it to an iterable.
 * 
 * e.g. "Mo" = 0, "T" = 1, "Thurs" = 3, "Friday" = 4
 */
const getDayIndex = new Map();

getDayIndex.set("M", 0);
getDayIndex.set("Mo", 0);
getDayIndex.set("Mon", 0);
getDayIndex.set("Monday", 0);

getDayIndex.set("T", 1);
getDayIndex.set("Tu", 1);
getDayIndex.set("Tue", 1);
getDayIndex.set("Tues", 1);
getDayIndex.set("Tuesday", 1);

getDayIndex.set("W", 2);
getDayIndex.set("We", 2);
getDayIndex.set("Wed", 2);
getDayIndex.set("Wednesday", 2);

getDayIndex.set("Th", 3);
getDayIndex.set("Thu", 3);
getDayIndex.set("Thurs", 3);
getDayIndex.set("Thursday", 3);

getDayIndex.set("F", 4);
getDayIndex.set("Fri", 4);
getDayIndex.set("Friday", 4);

getDayIndex.set("S", 5);
getDayIndex.set("Sa", 5);
getDayIndex.set("Sat", 5);
getDayIndex.set("Saturday", 5);

getDayIndex.set("Su", 6);
getDayIndex.set("Sun", 6);
getDayIndex.set("Sunday", 6);




