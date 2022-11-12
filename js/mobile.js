var mobile_nav_button = document.getElementById('mobile_menu_trigger_button');
var nav_main = document.querySelector('.nav-menu');
var nav_main_items = document.querySelector('.nav-menu').children;
var nav_submenus = new Map();

let activate_sub = null;

function hide_mobile_submenu() {
    activate_sub.classList.remove('mobile_active');
    activate_sub = null;
}

function activate_mobile_menu() {
    if (mobile_nav_button.classList.contains('active')) {
        mobile_nav_button.classList.remove('active');
        nav_main.classList.remove('active');

        if (activate_sub != null) {
            hide_mobile_submenu();
        }

        return;
    }

    mobile_nav_button.classList.add('active');
    nav_main.classList.add('active');
}

function get_mobile_submenu(item) {
    activate_sub = nav_submenus.get(item.currentTarget.sub_menu_index);
    activate_sub.classList.add('mobile_active');
}

function configure_mobile_menu(x) {
    mobile_nav_button.addEventListener("click", activate_mobile_menu);
    
    if (x.matches) {
        for (var i = 0; i < nav_main_items.length; i++) {
            nav_main_items[i].children[0].href = "#";
            nav_submenus.set(i, nav_main_items[i].children[1]);
            nav_main_items[i].children[0].addEventListener("click", get_mobile_submenu);
            nav_main_items[i].children[0].sub_menu_index = i;
        }
    }
}
  
var x = window.matchMedia("(max-width: 60em)");
configure_mobile_menu(x); // Call listener function at run time
