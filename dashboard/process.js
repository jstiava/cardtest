function PQObject(id, priority, type) {
    this.id = id;
    this.priority = priority;
    this.type = type;
}
function PriorityQueue() {
    this.items = [];
}
PriorityQueue.prototype.enqueue = function(node) {
    if (node.priority == null || node.priority == 0) {
        this.items.push(node);
        return;
    }
    
    for (var i = 0; i < this.items.length; i++) {
        if (this.items[i].priority == null) {
            this.items.splice(i, 0, node);
            return;
        }

        if (node.priority < this.items[i].priority) {
            // Once the correct location is found it is
            // enqueued
            this.items.splice(i, 0, node);
            return;
        }
    }

    this.items.push(node);
    return;
}
PriorityQueue.prototype.dequeue = function(node) {
    if (this.isEmpty()) {
        return null;
    }
    return this.items.shift();
}
PriorityQueue.prototype.isEmpty = function(node) {
    return this.items.length == 0;
}

const locations_pq = new PriorityQueue();


const regions_hashmap = new Map();
const markets_hashmap = new Map();
const locations_hashmap = new Map();
rendered_elements = [];


// Process a day of hours
function preProcessHoursRegex(string) {

    var object = new Hours();

    var keyValues = [4, 11, 18];

    for (var i = 0; i < keyValues.length; i++) {

        // Get all values
        var key = keyValues[i];
        var x = Number(string[key]);

        if (typeof x == "undefined" || isNaN(x)) {
            break;
        }
        var x_min = prepareMinute(string[key + 1]) / 60;
        var x_type = string[key + 2];
        var y = Number(string[key + 3]);
        var y_min = prepareMinute(string[key + 3 + 1]) / 60;
        var y_type = string[key + 3 + 2];

        // Find AM/PM type + 2 from minutes
        x = adjust_hour(hour_to_24(x, x_type)) + x_min;
        y = adjust_hour(hour_to_24(y, y_type)) + y_min;

        object.add(x, y);
    }

    return object;
}

// Process a week full of hours
function processHours(string) {
    // Consider each statement one at a time
    var strings = string.split(/(?:;|\n)+/);

    // Initatiate a new week object
    var closed_object = new Hours();
    var week_arr = new Array(7).fill(closed_object);
    for (var i = 0; i < strings.length; i++) {

        // Open
        if (match = textRegex.exec(strings[i])) {

            // Preprocessing
            var open_arr = new Hours();
            open_arr.openAllDay();
            var range = prepareRange(match[1], match[2]);

            // Apply that to the full range
            for (var j = range[0]; j <= range[1]; j++) {
                week_arr[j] = open_arr;
            }

            continue;
        }

        // We are dealing with specific Hours
        if (match = hourRegex.exec(strings[i])) {

            // Preprocessing
            var day_arr = preProcessHoursRegex(match);
            var range = prepareRange(match[1], match[2]);

            for (var j = range[0]; j <= range[1]; j++) {
                week_arr[j] = day_arr;
            }
        }

    }

    return week_arr;
}




function process_locations(fetch_list) {

    console.log(fetch_list);

    return process_locations_helper(fetch_list, 0);

}

function process_locations_helper(fetch_list, i) {

    if (i >= fetch_list.length) {
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
                target.acf.icon,
                target.acf.icon_type,
                target.acf.latitude,
                target.acf.longitude,
                target.acf.child_elements,
                target.acf.primary_color
            );
            markets_hashmap.set(target.id, new_node);

            var new_pq_object = new PQObject(target.id, new_node.priority, 'market');
            locations_pq.enqueue(new_pq_object);
            break;

        case 'menu':
            break;

        default:
            new_node = new Location(
                target.title.rendered,
                target.acf.description,
                target.acf.icon,
                target.acf.icon_type,
                target.link,
                target.acf.latitude,
                target.acf.longitude,
                target.acf.hours_of_operation,
                target.acf.child_elements,
                target.acf.primary_color
            );
            if (target.acf.ready_special_hours) {
                new_node.load_special_hours(target.acf.special_hours_start_date, target.acf.special_hours_end_date, target.acf.special_hours_of_operation);
            }
            if (target.acf.ready_tertiary_hours) {
                new_node.load_tertiary_hours(target.acf.special_hours_start_date, target.acf.special_hours_end_date, target.acf.special_hours_of_operation);
            }
            locations_hashmap.set(target.id, new_node);

            var new_pq_object = new PQObject(target.id, new_node.priority, 'location');
            locations_pq.enqueue(new_pq_object);
            break;
    }

    return process_locations_helper(fetch_list, i + 1)

}

function process_events(fetch_list) {
    console.log(fetch_list);
}