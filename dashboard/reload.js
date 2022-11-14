let datetime = document.getElementById('datetime');
let update_button = document.getElementById('update_dashboard');

function update_hours() {
    
    today = new Date(datetime.value);
    let day = adjust_day(today.getDay());
    let hour = adjust_hour(today.getHours());
    let min = today.getMinutes();

    clear();

    for (let location of locations_hashmap.values()) {
        location.update(day, hour, min);
    }

    render();

}

function clear() {
    while (root_block.firstChild) {
        root_block.removeChild(root_block.lastChild);
    }
}

update_button.addEventListener("click", update_hours)