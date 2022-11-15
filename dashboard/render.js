




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

    if (location.icon_type == "circular" &! force_text) {
        var img_icon = document.createElement('img');
        img_icon.classList.add('circular');
        fetch_and_render_image(location.icon, img_icon);
        block.appendChild(img_icon);
    }
    
    if (location.icon_type == "wordmark"  &! force_text) {
        var img_icon = document.createElement('img');
        img_icon.classList.add('wordmark');
        fetch_and_render_image(location.icon, img_icon);
        content.appendChild(img_icon);
        return;
    }

    var title = document.createElement('p');
    title.classList.add('title');
    title.innerHTML = location.name;
    content.appendChild(title);
    return;

}

function render_color_scheme(location, block) {
    console.log(location);
    if (location.primary_color != null && location.primary_color != "") {
        block.classList.add('stylized');
        block.style.background = location.primary_color;
        block.style.color = location.secondary_color;
    }
}


function render_locations(parent, children) {

    for (var i = 0; i < children.length; i++) {

        if (!(locations_hashmap.has(children[i]))) {
            continue;
        }

        // Get the location
        var location = locations_hashmap.get(children[i]);

        // Build the renderable "the_object"
        var the_object = document.createElement('a');
        the_object.href = location.link;
        the_object.classList.add('location');

        let the_status = document.createElement('p');

        if (location.current) {
            
            the_object.classList.add('open');
            the_object.style.order = 1;
            render_color_scheme(location, the_object);

            // The content
            var the_content = document.createElement('div');
            the_content.classList.add('content');

            // The header

            var the_header = document.createElement('div');
            the_header.classList.add('header');
            render_title(location, the_header, the_content, false);
            

            // The content

            if (typeof location.description != "undefined") {
                var the_description = document.createElement('p');
                the_description.innerHTML = location.description;
                the_content.appendChild(the_description);
            }

            the_header.appendChild(the_content);
            the_object.appendChild(the_header);

            // The controls

            var the_controls = document.createElement('div');
            the_controls.classList.add('controls');

            var the_buttons = document.createElement('div');
            the_buttons.classList.add('buttons');
            
            var the_navigation = document.createElement('a');
            the_navigation.href = location.maps_link;
            the_navigation.classList.add("navigation");
            the_buttons.appendChild(the_navigation);

            var the_grubhub = document.createElement('a');
            the_grubhub.href = "https://www.grubhub.com/";
            the_grubhub.classList.add("grubhub");
            the_buttons.appendChild(the_grubhub);
            the_controls.appendChild(the_buttons);

            the_status.innerHTML = "OPEN";
            the_controls.appendChild(the_status);

            the_object.appendChild(the_controls);

        }
        else {
            the_object.classList.add('closed');
            the_object.style.order = 3;
            render_title(location, the_object, the_object, true);

            the_status.innerHTML = "CLOSED";
            the_object.appendChild(the_status);
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
            render_locations(content, market.children);

            var isAllClosed = content.querySelector('.open') == null;
            if (isAllClosed) {
                block.style.order = 3;
            } else {
                block.style.order = 2;
            }

            block.appendChild(content);
            region.appendChild(block);
        }

    }

}


function render_region(region) {

    // Start region block
    var new_region_block = document.createElement('div');
    new_region_block.classList.add('region');

    var content = document.createElement('div');
    content.classList.add('content');

    if (region.hasChildren) {
        var container = document.createElement('div');
        container.classList.add('region');

        render_markets(container, region.children);

        render_locations(container, region.children);

        root_block.appendChild(container);

    }

}


function render() {

    for (let region of regions_hashmap.values()) {

        render_region(region);

    }

}


fetch_locations(12);