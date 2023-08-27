<?php

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
               'footer' => 'Footer'
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

function stiavacard_add_editor_styles()
{
     add_editor_style('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap', [], null);
     add_editor_style(get_template_directory_uri() . '/style.css');
     add_editor_style(get_template_directory_uri() . '/css/editor-style.css');
     add_editor_style(get_template_directory_uri() . '/css/events.css');
     add_theme_support('editor-styles');
}

add_action('after_setup_theme', 'stiavacard_add_editor_styles', 0);



function wp_stiava_card_register_sidebar()
{
     register_sidebar(
          array(
               'name'          => esc_html__('Sidebar', 'theme-name'),
               'id'            => 'sidebar-1',
               'description'   => esc_html__('Add widgets here.', 'theme-name'),
               'before_widget' => '<div id="%1$s" class="widget %2$s">',
               'after_widget'  => '</div>',
               'before_title'  => '<h3 class="widget-title">',
               'after_title'   => '</h3>',
          )
     );
}
add_action('widgets_init', 'wp_stiava_card_register_sidebar');

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
          'people',
          array(
               'labels' => array(
                    'name' => __('People'),
                    'singular_name' => __('Person')
               ),
               'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'author',
                    'thumbnail',
                    'comments',
                    'revisions',
                    'custom-fields',
               ),
               'public' => true,
               'has_archive' => true,
               'menu_icon' => 'dashicons-businessperson',
               'rewrite' => array('slug' => 'person'),
               'show_in_rest' => true,
          )
     );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');





function jsmp1_edit_merchants_metadata($columns)
{
     $columns['hours_of_operation_edit_meta'] = __('Hours of Operation');
     $columns['categories_of_merchant'] = __('Merchant Categories');
     $columns['coordinates'] = __('Coordinates');
     return $columns;
}
add_filter('manage_merchants_posts_columns', 'jsmp1_edit_merchants_metadata');


function jsmp1_edit_merchants_metadata_originals($column_name, $post_id)
{
     switch ($column_name) {
          case 'hours_of_operation_edit_meta':
               echo "<strong>Standard Hours</strong><br>";
               echo get_post_meta($post_id, 'hours_of_operation', true);
               break;

          case 'categories_of_merchant':
               $cats = [];
               $terms = get_the_terms($post_id, 'merchant_categories');

               if (empty($terms)) {
                    echo "";
                    break;
               }

               foreach ($terms as $term) {
                    $cats[] = $term->name;
               }

               echo implode(', ', $cats);
               break;

          case 'coordinates':
               $lat = get_post_meta($post_id, 'latitude', true);
               $long = get_post_meta($post_id, 'longitude', true);

               if (empty($lat) || empty($long)) {
                    echo "<strong style='color: #b32d2e;'>Unset</strong>";
                    break;
               }

               echo $lat . ',<br>' . $long;
               break;

          default:
               break;
     }
}

add_action('manage_merchants_posts_custom_column', 'jsmp1_edit_merchants_metadata_originals', 10, 2);




// WordPress API Extension




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




// //  Add hours of operation edit to quick edit

// // add custom column title for custom meta value
// // 'manage_pages_columns' or 'manage_edit-post_columns' both works
// function ws365150_add_custom_columns_title_pt($columns, $post_type)
// {
//      switch ($post_type) {
//           case 'merchants':
//                $columns['hours_of_operation_edit_meta'] = 'Hours of Operation'; // you may use __() later on for translation support
//                $columns['categories_of_merchant'] = 'Merchant Categories';
//                $columns['coordinates'] = 'Coordinates';
//                break;

//           default:

//                break;
//      }

//      return $columns;
// }
// add_filter('manage_posts_columns', 'ws365150_add_custom_columns_title_pt', 10, 2);







// function ws365150_add_custom_column_data_pt($column_name, $post_id)
// {
//      switch ($column_name) {
//           case 'hours_of_operation_edit_meta': // specified for this column assigned in the column title
//                echo "<strong>Standard Hours</strong><br>";
//                echo get_post_meta($post_id, 'hours_of_operation', true);
//                break;

//           case 'categories_of_merchant':
//                $cats = [];
//                $terms = get_the_terms($post_id, 'merchant_categories');

//                if ($terms == false) {
//                     echo "";
//                     break;
//                }

//                foreach ($terms as $term) {
//                     array_push($cats, $term->name);
//                }
//                ;

//                echo implode(', ', $cats);
//                break;

//           case 'coordinates':
//                $cats = [];
//                $lat = get_post_meta($post_id, 'latitude', true);
//                $long = get_post_meta($post_id, 'longitude', true);

//                if ($lat == "" || $long == "") {
//                     echo "<strong style='color: #b32d2e;'>Unset</strong>";
//                     break;
//                }

//                echo $lat . ',<br>' . $long;
//                break;

//           default:
//                break;
//      }
// }

// // add custom column data with custom meta value for custom post types
// add_action('manage_posts_custom_column', 'ws365150_add_custom_column_data_pt', 10, 2);



function log_memory_usage()
{
     // Get the current memory usage
     $memory_usage = round(memory_get_usage() / 1024 / 1024, 2); // Convert to megabytes

     // Log the memory usage to a file
     error_log('Memory usage: ' . $memory_usage . ' MB');
}
add_action('init', 'log_memory_usage');


function consume_memory()
{
     $memory_limit = ini_get('memory_limit');
     $memory_limit_bytes = wp_convert_hr_to_bytes($memory_limit);

     // Allocate memory until the memory limit is reached
     $buffer = str_repeat('a', $memory_limit_bytes + 1);
}



function display_server_cache()
{
     global $wp;
     // Get the current page's URL
     $current_url = home_url(add_query_arg(array(), $wp->request));

     // Check if the page is cached
     if (function_exists('wp_cache_get')) {
          $cache_key = 'my_custom_cache_' . md5($current_url); // Create a unique cache key
          $cached_content = wp_cache_get($cache_key); // Retrieve the cached content

          if ($cached_content !== false) {
               // Display the cached content
               console_log($cached_content);
          } else {
               // Content not found in the cache
               console_log('The page is not currently cached.');
          }
     } else {
          // Caching is not enabled
          console_log('Caching is not enabled on this site.');
     }
}

//  add_action('init', 'display_server_cache');




// Merchant Icon
// 









/*Deleting content when an ACF field is deleted is easy, relatively. Please note that the use of this function cannot be undone and it will erase all traces of content for any ACF field that is deleted. 

Please be sure that this is something that you want to do before implementing this and I would strongly suggest that this is only enabled during development and not on a live site. Should a client go into ACF for some reason and delete a field, there is nothing that you’d be able to do to recover form it. */

// this action is run by ACF whenever a field is deleted
// and is called for every field in a field group when a field group is deleted
add_action('acf/delete_field', 'delete_acf_content_on_delete_field');


// https://gist.github.com/ivo-ivanov/8eba67712dd3ab14343c56c42e097a86
function delete_acf_content_on_delete_field($field)
{
     // runs when acf deletes a field
     // find all occurences of the field key in all tables and delete them
     // and the custom field associated with them
     global $wpdb;
     // remove any tables from this array that you don't want to check
     $tables = array('options', 'postmeta', 'termmeta', 'usermeta', 'commentmeta');
     foreach ($tables as $table) {
          $key_field = 'meta_key';
          $value_field = 'meta_value';
          if ($table == 'options') {
               $key_field = 'option_name';
               $value_field = 'option_value';
          }
          $table = $wpdb->{$table};
          // this query gets all key fields matching the acf key reference field
          $query = 'SELECT DISTINCT(' . $key_field . ')
              FROM ' . $table . '
              WHERE ' . $value_field . ' = "' . $field['key'] . '"';
          $results = $wpdb->get_col($query);
          if (!count($results)) {
               // no content found in this table
               continue;
          }
          // loop through keys and construct list of meta_key/option_names to delete
          $keys = array();
          foreach ($results as $key) {
               $keys[] = $key; // delete acf field key reference
               $keys[] = substr($key, 1); // delete acf field value
          }
          // do escping of all values.... just in case
          $keys = $wpdb->_escape($keys);
          // delete all of the content
          $query = 'DELETE FROM ' . $table . '
              WHERE ' . $key_field . ' IN ("' . implode('","', $keys) . '")';
          $wpdb->query($query);
     } // end foreach table
}
