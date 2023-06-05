<?php

require 'api/endpoints.php';
require 'api/custom_admin.php';



// Including stylesheets and script files
function load_scripts()
{
     // Scripts loaded in reverse hierarchy

     wp_enqueue_script('accessible_header', get_template_directory_uri() . '/js/accessible_header.js', array(), '1.0', true);
     wp_enqueue_script('washu_blocks', get_template_directory_uri() . '/js/washu_blocks.js', array(), '1.0', true);
     wp_enqueue_script('trigger_scroll_menu', get_template_directory_uri() . '/js/trigger_scroll_menu.js', array(), '1.0', true);
     wp_enqueue_script('mobile', get_template_directory_uri() . '/js/mobile.js', array(), '1.0', true);
     wp_enqueue_style('header', get_template_directory_uri() . '/css/header.css', array(), '1.0', 'all');
     wp_enqueue_style('footer', get_template_directory_uri() . '/css/footer.css', array(), '1.0', 'all');
     wp_enqueue_style('content', get_template_directory_uri() . '/css/content.css', array(), '1.0', 'all');
     wp_enqueue_style('forms', get_template_directory_uri() . '/css/forms.css', array(), '1.0', 'all');
     wp_enqueue_style('events', get_template_directory_uri() . '/css/events.css', array(), '1.0', 'all');
     wp_enqueue_style('mobile', get_template_directory_uri() . '/css/mobile.css', array(), '1.0', 'all');
     wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
     wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap', [], null);

     if (is_page_template('templates/dining_test.php')) {
          wp_enqueue_script('date', get_template_directory_uri() . '/dashboard/_date.js', array(), '1.0', true);
          wp_enqueue_script('objects', get_template_directory_uri() . '/dashboard/_objects.js', array(), '1.0', true);
          wp_enqueue_script('fetch', get_template_directory_uri() . '/dashboard/fetch.js', array(), '1.0', true);
          wp_enqueue_script('process', get_template_directory_uri() . '/dashboard/process.js', array(), '1.0', true);
          wp_enqueue_script('reload', get_template_directory_uri() . '/dashboard/reload.js', array(), '1.0', true);
          wp_enqueue_script('render', get_template_directory_uri() . '/dashboard/render.js', array(), '1.0', true);
          wp_enqueue_style('styles', get_template_directory_uri() . '/dashboard/styles.css', array(), '1.0', 'all');
          return;
     }
}

add_action('wp_enqueue_scripts', 'load_scripts');

// Implementation for an accessible menu experience for screen readers and link tabbing.
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

// Menus setup
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



// Register special metadata for hours of operation
function register_encoded_hours_metadata()
{
     register_post_meta('merchants', 'js_test_value', [
          'show_in_rest' => true,
          'single' => true,
          'type' => 'object',
     ]);
}

add_action('init', 'register_encoded_hours_metadata');



/**
 * Registers an editor stylesheet for the theme.
 */

function stiavacard_add_editor_styles()
{
     add_editor_style('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap', [], null);
     add_editor_style(get_template_directory_uri() . '/style.css');
     add_editor_style(get_template_directory_uri() . '/css/editor-style.css');
     add_editor_style(get_template_directory_uri() . '/css/events.css');
     add_theme_support('editor-styles');
}

add_action('after_setup_theme', 'stiavacard_add_editor_styles', 0);



if (function_exists('register_sidebar')) {
     register_sidebar();
}


// Helpful function for debugging, prints back-end content to the front-end by the console.
function console_log($content)
{
     echo '<script>console.log(' . json_encode($content) . ');</script>';
};



// TODO: Integrate warning post types into standalone.
function get_custom_cat_template($single_template)
{
     global $post;
     if (in_category('warnings')) {
          $single_template = dirname(__FILE__) . '/single-warnings.php';
     }
     return $single_template;
}
add_filter("single_template", "get_custom_cat_template");



// Creates custom post types for merchants, people
// Custom taxonomy for merchants called merchant categories

function create_posttype()
{

     register_post_type(
          'merchants',
          array(
               'labels' => array(
                    'name' => __('Merchants'),
                    'singular_name' => __('Merchant')
               ),
               'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
               'public' => true,
               'has_archive' => true,
               'menu_icon' => get_template_directory_uri() . '/icons/bear_bucks_icon.svg',
               'rewrite' => array('slug' => 'merchant'),
               'show_in_rest' => true,
          )
     );
     

     register_post_type(
          'people',
          array(
               'labels' => array(
                    'name' => __('People'),
                    'singular_name' => __('Person')
               ),
               'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
               'public' => true,
               'has_archive' => true,
               'menu_icon' => 'dashicons-businessperson',
               'rewrite' => array('slug' => 'person'),
               'show_in_rest' => true,
          )
     );

     register_taxonomy(
          'merchant_categories', //taxonomy 
          'merchants', //post-type
          array(
               'hierarchical'  => true,
               'label'         => __('Merchant Categories'),
               'singular_name' => __('Merchant Category'),
               'rewrite'       => true,
               'show_in_rest' => true,
               'query_var'     => true,
          )
     );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');




// WordPress API Extension

add_action('rest_api_init', function () {
     register_rest_route('js/v1', '/merchants', [
          'methods' => 'GET',
          'callback' => 'washu_dining_get_merchants',
          'args' => [
               'day' => [
                    'required' => true,
                    'type' => 'integer',
               ],
               'hour' => [
                    'required' => false,
                    'type' => 'integer',
               ],
               'minute' => [
                    'required' => false,
                    'type' => 'integer',
               ],
          ],
     ]);
});


// Returns best text color for background, white or black
function get_contrast_color($hex)
{
     if ($hex == null || $hex == "") {
          return "#000000";
     }

     $red = hexdec(substr($hex, 1, 2));
     $green = hexdec(substr($hex, 3, 2));
     $blue = hexdec(substr($hex, 5, 2));

     if (($red * 0.299 + $green * 0.587 + $blue * 0.114) > 186) {
          return "#000000";
     }
     return "#ffffff";
}




/* Display the post meta box. */
function smashing_post_class_meta_box($post)
{ ?>

     <?php wp_nonce_field(basename(__FILE__), 'smashing_post_class_nonce'); ?>

     <p>
          <textarea name="hours_of_operation_metabox" id="hours_of_operation_metabox" cols="30" rows="5"><?php echo esc_attr(get_post_meta($post->ID, 'hours_of_operation', true)); ?></textarea>
     </p>
<?php };




// Remove comments

add_action('admin_init', function () {
     // Redirect any user trying to access comments page
     global $pagenow;

     if ($pagenow === 'edit-comments.php') {
          wp_redirect(admin_url());
          exit;
     }

     // Remove comments metabox from dashboard
     remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

     // Disable support for comments and trackbacks in post types
     foreach (get_post_types() as $post_type) {
          if (post_type_supports($post_type, 'comments')) {
               remove_post_type_support($post_type, 'comments');
               remove_post_type_support($post_type, 'trackbacks');
          }
     }
});




// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);




// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);




// Remove comments page in menu
add_action('admin_menu', function () {
     remove_menu_page('edit-comments.php');
});




// Remove comments links from admin bar
add_action('init', function () {
     if (is_admin_bar_showing()) {
          remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
     }
});




//  Add hours of operation edit to quick edit

// add custom column title for custom meta value
// 'manage_pages_columns' or 'manage_edit-post_columns' both works
function ws365150_add_custom_columns_title_pt($columns, $post_type)
{
     switch ($post_type) {
          case 'merchants':
               $columns['hours_of_operation_edit_meta'] = 'Hours of Operation'; // you may use __() later on for translation support
               $columns['categories_of_merchant'] = 'Merchant Categories';
               $columns['coordinates'] = 'Coordinates';
               break;

          default:

               break;
     }

     return $columns;
}
add_filter('manage_posts_columns', 'ws365150_add_custom_columns_title_pt', 10, 2);







function ws365150_add_custom_column_data_pt($column_name, $post_id)
{
     switch ($column_name) {
          case 'hours_of_operation_edit_meta': // specified for this column assigned in the column title
               echo get_post_meta($post_id, 'hours_of_operation', true);
               break;
          
          case 'categories_of_merchant':
               $cats = [];
               $terms = get_the_terms($post_id, 'merchant_categories');

               if ($terms == false) {
                    echo "";
                    break;
               }

               foreach ($terms as $term) {
                    array_push($cats, $term->name);
               };
               
               echo implode(', ', $cats);
               break;
               
          case 'coordinates':
               $cats = [];
               $lat = get_post_meta($post_id, 'latitude', true);
               $long = get_post_meta($post_id, 'longitude', true);

               echo $lat . ', ' . $long;
               break;

               default:
               break;
          }
     }
     
// add custom column data with custom meta value for custom post types
add_action('manage_posts_custom_column', 'ws365150_add_custom_column_data_pt', 10, 2);

