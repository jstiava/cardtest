




let root_block = document.getElementById('dining_locations');


function get_contrast_color(hex) {

    if (hex == null || hex == "") {
        return "#000000";
    }

    const red = parseInt(hex.slice(1, 3), 16);
    const blue = parseInt(hex.slice(3, 5), 16);
    const green = parseInt(hex.slice(5, 7), 16);

    if ((red * 0.299 + green * 0.587 + blue * 0.114) > 186) {
        return "#000000";
    }
    return "#ffffff";

}

function render_title(location, block, content, force_text) {

    if (location.icon_type == "circular" && !force_text) {
        var img_icon = document.createElement('img');
        img_icon.classList.add('circular');
        fetch_and_render_image(location.icon, img_icon);

        var the_wrapper = document.createElement('div');
        the_wrapper.classList.add('loc_wrapper');
        the_wrapper.appendChild(img_icon);

        var title = document.createElement('p');
        title.classList.add('title');
        title.innerHTML = location.name;

        content.appendChild(title);

        // The content
        if (typeof location.description != "undefined") {
            var the_description = document.createElement('p');
            the_description.innerHTML = location.description;
            content.appendChild(the_description);
        }

        the_wrapper.appendChild(content);
        block.appendChild(the_wrapper);

        return;
    }

    if (location.icon_type == "wordmark" && !force_text) {
        var img_icon = document.createElement('img');
        img_icon.classList.add('wordmark');
        fetch_and_render_image(location.icon, img_icon);
        content.appendChild(img_icon);

        // The content
        if (typeof location.description != "undefined") {
            var the_description = document.createElement('p');
            the_description.innerHTML = location.description;
            content.appendChild(the_description);
        }

        block.appendChild(content);
        return;
    }

    var title = document.createElement('p');
    title.classList.add('title');
    title.innerHTML = location.name;
    content.appendChild(title);

    // The content
    if (typeof location.description != "undefined") {
        var the_description = document.createElement('p');
        the_description.innerHTML = location.description;
        content.appendChild(the_description);
    }

    block.appendChild(content);
    return;

}

function render_color_scheme(location, block) {

    if (location.primary_color != null && location.primary_color != "") {
        block.classList.add('stylized');
        block.style.background = location.primary_color;
        block.style.color = location.secondary_color;
    }
}

function render_header(location, object) {

    
    // The header
    var the_header = document.createElement('div');
    the_header.classList.add('header');

    // The content
    var the_content = document.createElement('div');
    the_content.classList.add('content');

    render_title(location, the_header, the_content, false);

    object.appendChild(the_header);
}





function render_hours(location, object) {
    let the_status = document.createElement('p');

    if (type == "special") {
        the_status.innerHTML = location.special_next;
    }
    else if (type == "tertiary") {
        the_status.innerHTML = location.tertiary_next;
    }
    else {
        if (location.next[1] == null) {
            the_status.innerHTML = location.next[0];
        }
        else {
            the_status.innerHTML = location.next[0] + ", " + location.next[1];
        }
        
    }

    object.appendChild(the_status);
}


function render_controls(location, object, type) {

    var the_hours = document.createElement('a');
    the_hours.classList.add('hours');

    // The controls
    var the_controls = document.createElement('div');
    the_controls.classList.add('controls');

    var the_buttons = document.createElement('div');
    the_buttons.classList.add('buttons');

        // Add navigation button
        var the_navigation = document.createElement('a');
        the_navigation.href = location.maps_link;
        the_navigation.classList.add("navigation");
        the_buttons.appendChild(the_navigation);

        // Add grubhub button
        var the_grubhub = document.createElement('a');
        the_grubhub.href = "https://www.grubhub.com/";
        the_grubhub.classList.add("grubhub");
        the_buttons.appendChild(the_grubhub);

        // Add feedback button
        var the_feedback = document.createElement('a');
        the_feedback.href = "";
        the_feedback.classList.add("feedback");
        the_buttons.appendChild(the_feedback);

    the_controls.appendChild(the_buttons);

    the_current = document.createElement('p');
    the_current.innerHTML = location.next[0];
    the_hours.appendChild(the_current);
    
    the_current_sub = document.createElement('p');
    the_current_sub.innerHTML = location.next[1];
    the_hours.appendChild(the_current_sub);

    the_controls.appendChild(the_hours);

    object.appendChild(the_controls);
}

function render_special(location, object) {
    let the_special_hours = document.createElement('p');
    the_special_hours.classList.add('special');
    the_special_hours.innerHTML = location.special_hoursToString;

    object.appendChild(the_special_hours);
}

function render_closed(location, object, type) {
    
    let the_status = document.createElement('p');

    object.classList.add('closed');

    var the_content = document.createElement('div');
    the_content.classList.add('content');
    
    var title = document.createElement('p');
    title.classList.add('title');
    title.innerHTML = location.name;
    the_content.appendChild(title);

    if (type == "special") {
        the_status.innerHTML = location.special_next;
    }
    else if (type == "tertiary") {
        the_status.innerHTML = location.tertiary_next;
    }
    else {
        if (location.next[1] == null) {
            the_status.innerHTML = location.next[0];
        }
        else {
            the_status.innerHTML = location.next[0] + ", " + location.next[1];
        }
    }
    the_content.appendChild(the_status);

    object.appendChild(the_content);
}


function render_locations(parent, children, market) {
    

    for (var i = 0; i < children.length; i++) {

        if (!market && rendered_elements.includes(children[i])) {
            continue;
        }

        if (!(locations_hashmap.has(children[i]))) {
            continue;
        }

        // Get the location
        var location = locations_hashmap.get(children[i]);

        // Build the renderable "the_object"
        var the_object = document.createElement('a');
        the_object.href = location.link;
        the_object.classList.add('location');


        if (location.tertiary && (today.after(location.tertiary_start) && today.before(location.tertiary_end))) {
            if (location.tertiary_current) {
                the_object.classList.add('open');
                render_color_scheme(location, the_object);
                render_header(location, the_object);
                // render_events();
                render_controls(location, the_object, "tertiary");
            }
            else {
                render_closed(location, the_object, "tertiary");
            }
        }
        else if (location.special && (today.after(location.special_start) && today.before(location.special_end))) {
            if (location.special_current) {
                the_object.classList.add('open');
                render_color_scheme(location, the_object);
                render_header(location, the_object);
                // render_events();
                render_special(location, the_object, location.special_hoursToString);
                render_controls(location, the_object, "special");
            }
            else {
                render_closed(location, the_object, "special");
                render_special(location, the_object, location.special_hoursToString);
            }
        }
        else {
            if (location.current) {
                the_object.classList.add('open');
                render_color_scheme(location, the_object);
                render_header(location, the_object);
                render_controls(location, the_object, "regular");
            }
            else {
                render_closed(location, the_object, "regular");
            }
        }

        // Attach and submit to parent
        parent.appendChild(the_object);

    }

}


function render_markets(region, children) {

    for (var i = 0; i < children.length; i++) {

        if (!(markets_hashmap.has(children[i]))) {
            continue;
        }

        var market = markets_hashmap.get(children[i]);

        if (market.hasChildren) {

            var block = document.createElement('div');
            block.classList.add('market');

            var content = document.createElement('div');
            content.classList.add('content');

            render_title(market, block, content);
            render_color_scheme(market, block);

            // Render locations
            render_locations(content, market.children, true);

            var isAllClosed = content.querySelector('.open') == null;
            if (isAllClosed) {
                // console.log(content);
            } else {
            }

            block.appendChild(content);

            region.appendChild(block);
        }

    }

}


function render_item(item) {

    // console.log(item);

    switch (item.type) {
        case 'market':
            render_markets(root_block, [item.id]);
            break;

        case 'location':
            render_locations(root_block, [item.id], false);
            break;
    }

}


function render() {

    if (locations_pq.isEmpty()) {
        return;
    }

    var save = locations_pq.dequeue();
    render_item(save);
    render();
}

start_fetch();