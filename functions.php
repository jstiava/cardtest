<?php

// Including stylesheets and script files
function load_scripts()
{
     // Scripts loaded in reverse hierarchy
     wp_enqueue_script('accessible_header', get_template_directory_uri() . '/js/accessible_header.js', array(), '1.0', true);
     wp_enqueue_style('header', get_template_directory_uri() . '/css/header.css', array(), '1.0', 'all');
     wp_enqueue_style('content', get_template_directory_uri() . '/css/content.css', array(), '1.0', 'all');
     wp_enqueue_style('forms', get_template_directory_uri() . '/css/forms.css', array(), '1.0', 'all');
     wp_enqueue_style('events', get_template_directory_uri() . '/css/events.css', array(), '1.0', 'all');
     wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
     wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap', [], null);
}

add_action('wp_enqueue_scripts', 'load_scripts');

class Menu_With_Description extends Walker_Nav_Menu
{
     function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
     {
          global $wp_query;
          $indent = ($depth) ? str_repeat("\t", $depth) : '';

          $class_names = $value = '';

          $classes = empty($item->classes) ? array() : (array) $item->classes;

          $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
          $class_names = ' class="' . esc_attr($class_names) . '"';

          $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

          $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
          $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
          $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
          $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
          $attributes .= 'aria-selected="false"';

          $item_output = $args->before;
          $item_output .= '<a' . $attributes . '>';
          $item_output .= $args->link_before . '<span class="menu_title">' . apply_filters('the_title', $item->title, $item->ID) . '</span>' . $args->link_after;
          $item_output .= '<span class="sub">' . $item->description . '</span>';
          $item_output .= '</a>';
          $item_output .= $args->after;

          $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
     }
}

function learnwp_config()
{
     // Registering menus
     register_nav_menus(
          array(
               'my_main_menu' => 'Main Menu',
               'quick_tools' => 'Quick Tools',
          )
     );

     $args = array(
          'height' => 225,
          'width' => 1920
     );
     add_theme_support('custom-header', $args);
     add_theme_support('post-thumbnails');
     add_theme_support('post-format');
}
add_action('after_setup_theme', 'learnwp_config', 0);

/**
 * Registers an editor stylesheet for the theme.
 */

function stiavacard_add_editor_styles() {
     add_editor_style('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap', [], null);
     add_editor_style(get_template_directory_uri() . '/style.css');
     add_editor_style(get_template_directory_uri() . '/css/editor-style.css');
     add_editor_style(get_template_directory_uri() . '/css/events.css');
     add_theme_support( 'editor-styles' );
}

add_action('after_setup_theme', 'stiavacard_add_editor_styles', 0);

if ( function_exists('register_sidebar')) {
     register_sidebar();
}

?>