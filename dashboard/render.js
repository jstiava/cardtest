let root_block = document.getElementById('locationsList');


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

function render_locations(parent, children) {

    for (var i = 0; i < children.length; i++) {

        if (!(locations_hashmap.has(children[i]))) {
            continue;
        }

        // Get the location
        var location = locations_hashmap.get(children[i]);

        // Build the renderable block
        var block = document.createElement('div');
        block.classList.add('location');

        var content = document.createElement('div');
        content.classList.add('content');

        if (location.icon_type == "circular") {
            var img_icon = document.createElement('img');
            img_icon.classList.add('circular');
            fetch_and_render_image(location.icon, img_icon);
            block.appendChild(img_icon);

            var title = document.createElement('p');
            title.innerHTML = location.name;
            content.appendChild(title);
        }
        else if (location.icon_type == "wordmark") {
            var img_icon = document.createElement('img');
            img_icon.classList.add('wordmark');
            fetch_and_render_image(location.icon, img_icon);
            content.appendChild(img_icon);
        }
        else {
            var title = document.createElement('p');
            title.innerHTML = location.name;
            content.appendChild(title);
        }

        var link = document.createElement('a');
        link.href = location.link;
        link.innerHTML = "See More";
        content.appendChild(link);

        if (location.primary_color != null && location.primary_color != "") {
            block.style.background = location.primary_color;
            block.style.color = location.secondary_color;
        }

        if (location.current) {
            block.classList.add('open');
        }
        else {
            block.classList.add('closed');
        }

        // Attach and submit to parent
        block.appendChild(content);
        parent.appendChild(block);

    }

}


function render_markets(region, children) {

    for (var i = 0; i < children.length; i++) {

        if (!(markets_hashmap.has(children[i]))) {
            continue;
        }

        var market = markets_hashmap.get(children[i]);

        if (market.hasChildren) {
            var container = document.createElement('div');
            container.classList.add('market');

            render_locations(container, market.children);

            region.appendChild(container);
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

    // for (let target of locations_hashmap.values()) {

    //     if (target.constructor.name == "Market") {

    //     }

    //     var new_location_block = document.createElement('div');
    //     new_location_block.classList.add('location');

    //     var content = document.createElement('div');
    //     content.classList.add('content');

    //     if (target.icon_type == "circular") {
    //         var img_icon = document.createElement('img');
    //         img_icon.classList.add('circular');
    //         fetch_and_render_image(target.icon, img_icon);
    //         new_location_block.appendChild(img_icon);

    //         var p_title = document.createElement('p');
    //         p_title.innerHTML = target.name;
    //         content.appendChild(p_title);
    //     }
    //     else if (target.icon_type == "wordmark") {
    //         var img_icon = document.createElement('img');
    //         img_icon.classList.add('wordmark');
    //         fetch_and_render_image(target.icon, img_icon);
    //         content.appendChild(img_icon);
    //     }
    //     else {
    //         var p_title = document.createElement('p');
    //         p_title.innerHTML = target.name;
    //         content.appendChild(p_title);
    //     }

    //     var p_hours = document.createElement('p');
    //     p_hours.innerHTML = target.hoursToString;
    //     content.appendChild(p_hours);

    //     if (target.special) {
    //         var p_special_hours = document.createElement('p');
    //         p_special_hours.innerHTML = target.special_hoursToString;
    //         content.appendChild(p_special_hours);
    //     }

    //     var a_link = document.createElement('a');
    //     a_link.href = target.link;
    //     a_link.innerHTML = "See More";
    //     content.appendChild(a_link);

    //     new_location_block.appendChild(content);

    //     if (target.primary_color != null && target.primary_color != "") {
    //         new_location_block.style.background = target.primary_color;
    //         new_location_block.style.color = target.secondary_color;
    //     }


    //     if (target.current) {
    //         new_location_block.classList.add('open');
    //     }
    //     else {
    //         new_location_block.classList.add('closed');
    //     }

    //     root_block.appendChild(new_location_block);
    // }

}





fetch_locations(12);