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

function render_title(location, block, content, force_text) {
    if (force_text) {
        var title = document.createElement('p');
        title.innerHTML = location.name;
        content.appendChild(title);
        return;
    }

    if (location.icon_type == "circular") {
        var img_icon = document.createElement('img');
        img_icon.classList.add('circular');
        fetch_and_render_image(location.icon, img_icon);
        block.appendChild(img_icon);

        var title = document.createElement('p');
        title.innerHTML = location.name;
        content.appendChild(title);
        return;
    }
    
    if (location.icon_type == "wordmark") {
        var img_icon = document.createElement('img');
        img_icon.classList.add('wordmark');
        fetch_and_render_image(location.icon, img_icon);
        content.appendChild(img_icon);
        return;
    }

    var title = document.createElement('p');
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

        // Build the renderable block
        var block = document.createElement('a');
        block.href = location.link;
        block.classList.add('location');

        var content = document.createElement('div');
        content.classList.add('content');

        if (location.current) {
            block.classList.add('open');
            block.style.order = 1;
            render_title(location, block, content, false);
            render_color_scheme(location, block);

            if (typeof location.description != "undefined") {
                var hours = document.createElement('p');
                hours.innerHTML = location.description;
                content.appendChild(hours);
            }
        }
        else {
            block.classList.add('closed');
            block.style.order = 3;
            render_title(location, block, content, true);
        }

        

        
        // var link = document.createElement('a');
        // link.href = location.link;
        // link.innerHTML = "See More";
        // content.appendChild(link);


        

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