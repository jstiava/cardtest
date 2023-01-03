




/**
 * Regex phrase that looks for a valid hours statement
 * 
 * e.g. "Mon: 5am-8pm", considers a single day, with open time from 5am to 8pm.
 * 
 * "Tues-Thursday: 4am-6pm", considers an inclusive range of days, with open time from 4am-6pm
 * 
 * "W-F: 8am-2am", considers an inclusive range of days, with open time from 8am until 2am the next day.
 * 
 * "Sat: 8am-9am, 10am-5pm, 6pm-11pm", supports a maximum of 3 different phrases within each ours group
 */
var hourRegex = /([\w]{2,8})[\s]*[-]?[\s]*([\w]{2,8})?[\s]*:[\s]*(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)?(([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*-[\s]*([\d]{1,2})[:]?([\d]{1,2})?([\w]{1,2})[\s]*[,]?[\s]*)?/;





/**
 * Regex phrase that looks for an "Open" statement
 * 
 * e.g. "Mon-Thu: Open 24 Hours"
 */
var textRegex = /([\w]{2,3})[\s]*[-]?[\s]*([\w]{2,3})?:[\s]*([O][\S]*)/;




/**
 * 
 */
function Hours() {
    this.min = null;
    this.breaks = [];
    this.max = null;
}
/**
 * 
 * @param {Number} start adjusted hour + (min / 60)
 * @param {Number} end adjusted hour + (min / 60)
 * @returns places the new hour set within the Hours object
 */
Hours.prototype.add = function (start, end) {
    if (this.min == null) {
        this.min = start;
        this.breaks = [];
        this.max = end;
        return;
    }

    this.breaks.push(this.max);
    this.breaks.push(start);
    this.max = end;
    return;

}
/**
 * Given the time, is the location open on the day?
 * @param {Number} hour adjusted hour + (min / 60)
 * @returns true or false
 */
Hours.prototype.isOpen = function (hour) {
    if (this.min == null) {
        return false;
    }

    if (hour < this.min) {
        return false;
    }

    var status = true;
    for (var i = 0; i < this.breaks.length; i++) {

        if (hour < this.breaks[i]) {
            return status;
        }

        status = !status;

    }

    if (hour < this.max) {
        return true;
    }

    return false;
}

Hours.prototype.next = function (hour) {
    if (this.min == null) {
        return ["Closed", null];
    }

    var diff = hour - this.min;
    var isClosed = diff <= 0;
    var diff = Math.abs(diff);

    if (isClosed) {
        if (diff < 1) {
            return ["Closed", "Opens at " + unadjust_hour(this.min)];
        }
        return ["Closed", null];
    }

    var status = true;
    for (var i = 0; i < this.breaks.length; i++) {

        if (hour < this.breaks[i]) {

            if (status) {
                return ["Open", "Taking a break at " + unadjust_hour(this.breaks[i])];
            }

            return ["Closed", "Back open at " + unadjust_hour(this.breaks[i])];
        }
        status = !status;
    }

    diff = hour - this.max;
    isClosed = diff >= 0;
    diff = Math.abs(diff);

    if (!isClosed) {
        if (diff < 1) {
            return ["Open", "Closing at " + unadjust_hour(this.max)];
        }
        return ["Open", null];
    }

    return ["Closed", null];
}


Date.prototype.equals = function(date) {
    if (date == false) {
        return false;
    }

    if (this.getDate == date.getDate) {
        if (this.getMonth == date.getMonth) {
            if (this.getFullYear == date.getFullYear) {
                return true;
            }
        }
    }

    return false;
}

Date.prototype.after = function(date) {
    if (date == false) {
        return false;
    }

    if (this.getTime() >= date.getTime()) {
        return true;
    }

    return false;
}

Date.prototype.before = function(date) {
    if (this.getTime() < date.getTime()) {
        return true;
    }

    return false;
}


/**
 * 
 */
function Schedule() {
    this.unset = true;
    this.breaks = [];
    this.hours = [];
}
/**
 * 
 * @param {Number} hours an Hours() object that will be added to the location
 * @param {Number} end value 0:6 indicating the last day the hours should be considered for
 * @returns places an Hours() object for consideration among multiple days in a schedule
 */
Schedule.prototype.add = function (hours, end) {
    this.unset = false;
    this.breaks.push(end);
    this.hours.push(hours);
    return;
}
/**
 * 
 * @param {Number} day 0:6 integer, 0 = Monday
 * @param {Number} hour 0:24 integer value, 0 = 4:00am
 * @param {Number} min 0:59 minute value, no adjustment
 * @returns true, if open 24/7, if not, it will pass on the hours to an Hours() object
 */
Schedule.prototype.isOpen = function(day, hour, min) {
    if (this.unset) {
        return true;
    }

    for (var i = 0; i < this.breaks.length; i++) {
        if (day <= this.breaks[i]) {
            return this.hours[i].isOpen(hour + (min / 60));
        }
    }
}




function Region(name, locations) {

    this.rendered = false;
    this.name = name;
    this.children = locations;
}
Region.prototype.hasChildren = function() {
    if (typeof this.children == "undefined" || this.children == null || this.children == "" || this.children == []) {
        return false;
    }
    return true;
}

function Market(name, description, icon, icon_type, latitude, longitude, locations, primary_color) {

    this.rendered = false;
    this.name = name;
    this.description = description;

    this.icon = icon;
    this.icon_type = icon_type;
    this.coords = [latitude, longitude];
    this.proximity = this.getProximity();
    
    this.primary_color = primary_color;
    this.secondary_color = get_contrast_color(primary_color);
    
    this.children = locations;

    this.priority = this.getPriority();
}
Market.prototype.hasChildren = function() {
    if (typeof this.children == "undefined" || this.children == null || this.children == "" || this.children == []) {
        return false;
    }
    return true;
}
Market.prototype.getProximity = function() {
    if (this.coords[0] == null) {
        return null;
    }
    if (this.coords[1] == null) {
        return null;
    }
    return Math.sqrt( Math.pow(current_latitude - this.coords[0], 2) + Math.pow(current_longitude - this.coords[1], 2) );
}
Market.prototype.getPriority = function() {
    value = 0;

    value = value + this.proximity;

    return value;
}

function Location(name, description, icon, icon_type, link, latitude, longitude, hours, menus, primary_color) {

    this.rendered = false;
    this.name = name;
    this.description = description;
    this.icon = icon;
    this.icon_type = icon_type;
    this.link = link;

    this.hoursToString = hours.replaceAll(';', '<br>');
    this.hours = processHours(hours);
    this.next = this.hours[day].next(hour + (min / 60));
    this.current = this.hours[day].isOpen(hour + (min / 60));

    this.special = false;
    this.special_start = false;
    this.special_end = false;
    this.special_hoursToString = null;
    this.special_hours = null;
    this.special_current = null;
    this.special_next = null;

    this.tertiary = false;
    this.tertiary_start = false;
    this.tertiary_end = false;
    this.tertiary_hoursToString = null;
    this.tertiary_hours = null;
    this.tertiary_current = null;
    this.tertiary_next = null;

    this.primary_color = primary_color;
    this.secondary_color = get_contrast_color(primary_color);
    this.children = menus;

    
    this.coords = [latitude, longitude];
    this.proximity = this.getProximity();

    this.priority = this.getPriority();
}
Location.prototype.getProximity = function() {
    if (this.coords[0] == null || this.coords[0] == "") {
        return null;
    }
    if (this.coords[1] == null || this.coords[1] == "") {
        return null;
    }

    return Math.sqrt( Math.pow(current_latitude - this.coords[0], 2) + Math.pow(current_longitude - this.coords[1], 2) );
}
Location.prototype.getPriority = function() {
    value = 0;

    value = value + this.proximity;

    if (!this.current) {
        value = value + 10000;
    }

    return value;
}





Location.prototype.load_special_hours = function(start, end, hours) {
    this.special = true;
    this.special_start = new Date(start.slice(0, 4) + "-" + start.slice(4, 6) + "-" + (Number(start.slice(6, 8)) + 1));
    this.special_start.setHours(0, 0, 0, 0);
    this.special_end = new Date(end.slice(0, 4) + "-" + end.slice(4, 6) + "-" + (Number(end.slice(6, 8)) + 1));
    this.special_end.setHours(0, 0, 0, 0);
    this.special_hoursToString = hours.replaceAll(';', '<br>');
    this.special_hours = processHours(hours);
    this.special_next = this.special_hours[day].next(hour + (min / 60));
    this.special_current = this.special_hours[day].isOpen(hour + (min / 60));
}
Location.prototype.load_tertiary_hours = function(start, end, hours) {
    this.tertiary = true;
    this.tertiary_start = new Date(start.slice(0, 4) + "-" + start.slice(4, 6) + "-" + (Number(start.slice(6, 8)) + 1));
    this.tertiary_start.setHours(0, 0, 0, 0);
    this.tertiary_end = new Date(end.slice(0, 4) + "-" + end.slice(4, 6) + "-" + (Number(end.slice(6, 8)) + 1));
    this.tertiary_end.setHours(0, 0, 0, 0);
    this.tertiary_hoursToString = hours.replaceAll(';', '<br>');
    this.tertiary_hours = processHours(hours);
    this.tertiary_next = this.tertiary_hours[day].next(hour + (min / 60));
    this.tertiary_current = this.tertiary_hours[day].isOpen(hour + (min / 60));
}
Location.prototype.update = function(day, hour, min) {
    this.current = this.hours[day].isOpen(hour + (min / 60));
    this.next = this.hours[day].next(hour + (min / 60));

    this.special_current = this.hours[day].isOpen(hour + (min / 60));
    // this.special_next = this.special_hours[day].next(hour + (min / 60));

    this.tertiary_current = this.hours[day].isOpen(hour + (min / 60));
    // this.tertiary_next = this.tertiary_hours[day].next(hour + (min / 60));
}



function Menu(name, hours) {

    this.rendered = false;
    this.name = name;

    this.hoursToString = hours.replaceAll(';', '<br>');
    this.hours = processHours(hours);
    this.current = this.hours[day].isOpen(hour);
    this.next = null;

    this.special = [];
    this.tertiary = [];
    this.foodpro_url = "";
    this.children = [];
}
