<?php

// Create a custom plugin
// Create a new folder in wp-content/plugins and place this code in a PHP file within that folder

// Add a menu page for the settings panel

// Callback function to render the submenu page content

function add_custom_link_to_merchants_actions($actions, $post)
{
    // Check if the post type is 'merchants'
    if ($post->post_type === 'merchants') {
        // Add your custom link action
        $custom_link = '<a href="' . get_home_url() . '/wp-admin/admin.php?page=merchants-settings&post=' . $post->ID . '">Manage Hours</a>';

        // Insert the custom link at the beginning of the actions array
        $actions = array_merge(array($custom_link), $actions);
    }

    return $actions;
}
add_filter('post_row_actions', 'add_custom_link_to_merchants_actions', 10, 2);

function add_merchants_submenu_page()
{
    add_submenu_page(
        'edit.php?post_type=merchants', // Parent menu slug (edit.php?post_type=merchants)
        'Manage Merchant Hours', // Page title
        '', // Menu title
        'manage_options', // Capability required to access the page
        'merchants-settings', // Menu slug
        'render_merchants_settings_page' // Callback function to render the page content
    );
}
add_action('admin_menu', 'add_merchants_submenu_page');


function render_merchants_settings_page()
{
    console_log("Render function");
    console_log(isset($_POST['my_radio_field']));
    if (isset($_POST['my_radio_field'])) {
        console_log("save");
        // Run your custom function to handle the saving of settings
        my_custom_save_function($_POST['my_radio_field']);

        // Display a success message
        echo '<div class="notice notice-success"><p>Settings saved successfully.</p></div>';
    }
    // Get all merchant posts
    $merchant_posts = get_posts(array(
        'post_type' => 'merchants',
        'numberposts' => -1,
    ));

    $ID = 0;

    if (isset($_GET['post'])) {
        $id_param = sanitize_text_field($_GET['post']);
        $ID = $id_param;
    }

?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Managing <b><?php echo get_the_title($ID); ?></b></h1>
        <hr class="wp-header-end">

        <div id="col-container" class="wp-clearfix">

            <!-- Sidebar -->
            <div id="col-left">
                <div class="col-wrap">
                    <div class="form-wrap">
                        <h2 class="screen-reader-text">Submit a Special Hours Work Order</h2>
                        <form method="post" action="">
                            <?php
                            settings_fields('my-settings-group');
                            do_settings_sections('my-settings-panel');
                            ?>
                            <p class="submit">
                                <input type="submit" class="button button-primary save_settings" value="Save Settings">
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div id="col-right">
                <div class="col-wrap">
                    <h2>All Merchant Posts</h2>
                    <ul class="merchant-posts-list">
                        <?php foreach ($merchant_posts as $merchant_post) { ?>
                            <li><?php echo $merchant_post->post_title; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
<?php
}


// Register and define the settings fields
function my_register_settings()
{
    // Register a settings group
    register_setting('my-settings-group', 'my_text_field');
    register_setting('my-settings-group', 'my_hours_field');
    register_setting('my-settings-group', 'my_date_field');
    register_setting('my-settings-group', 'my_checkbox_field');

    // Add a section for general settings
    add_settings_section(
        'submit_hours_cron_job',
        'Special Hours Work Order',
        'my_general_section_callback',
        'my-settings-panel'
    );

    // Add fields to the general settings section
    add_settings_field(
        'my-text-field',
        '',
        'my_text_field_callback',
        'my-settings-panel',
        'submit_hours_cron_job'
    );

    // Add fields to the general settings section
    add_settings_field(
        'my-hours-field',
        '',
        'my_hours_field_callback',
        'my-settings-panel',
        'submit_hours_cron_job'
    );

    // Add fields to the general settings section
    add_settings_field(
        'my-date-field',
        '',
        'my_date_time_field_callback',
        'my-settings-panel',
        'submit_hours_cron_job'
    );
}
add_action('admin_init', 'my_register_settings');


// Text field callback function
function my_text_field_callback()
{
    $value = esc_attr(get_option('my_text_field'));
?>
    <div class="form-field form-required term-name-wrap">
        <label for="tag-name">Name</label>
        <input type="text" name="my_text_field" value="<?php echo $value; ?>" class="regular-text">
        <p id="name-description">e.g. Summer Hours, Christmas, Thanksgiving, Spring Break</p>
    </div>
<?php
}

// Text field callback function
function my_hours_field_callback()
{
    $value = esc_attr(get_option('my_hours_field'));
?>
    <div class="form-field form-required term-name-wrap">
        <label for="tag-name">Hours of Operation</label>
        <input type="text" name="my_text_field" value="<?php echo $value; ?>" class="regular-text">
        <p id="name-description">Sun: 4am-8am, 9am-2pm, 3pm-8pm; Mon-Thu: 6:45am-1am; Fri: Closed; Sat: Open 24 Hours;"</p>
    </div>
<?php
}

// Date and time field callback function
function my_date_time_field_callback()
{

    // Timeline
    $timeline_value = get_option('my_dropdown_field');
    $timeline_options = array(
        'now' => 'Change Right Now',
        'schedule' => 'Scheduled'
    );
?>
    <label for="my_dropdown_field">Select a job timeline...</label>
    <?php
    echo '<select name="my_timeline_dropdown_field">';
    foreach ($timeline_options as $option_value => $option_label) {
        echo '<option value="' . $option_value . '" ' . selected($timeline_value, $option_value, false) . '>' . $option_label . '</option>';
    }
    echo '</select>';


    // Configuration
    $config_value = get_option('my_dropdown_field');
    $config_options = array(
        'overwrite' => 'Overwrite Normal',
        'special' => 'Special'
    );
    ?>
    <label for="my_dropdown_field">Select a job configuration...</label>
    <?php
    echo '<select name="my_config_dropdown_field">';
    foreach ($config_options as $option_value => $option_label) {
        echo '<option value="' . $option_value . '" ' . selected($config_value, $option_value, false) . '>' . $option_label . '</option>';
    }
    echo '</select>';


    $start_value = get_option('my_start_date_time_field');
    $end_value = get_option('my_end_date_time_field');
    ?>
    <div class="form-field">
        <label for="my_start_date_time_field">Start Date</label>
        <input type="text" id="start_date_field" name="my_start_date_time_field" value="<?php echo esc_attr($start_value); ?>" class="regular-text" />
        <p id="name-description">mm/dd/yyyy</p>
    </div>

    <div class="form-field">
        <label for="my_end_date_time_field">End Date</label>
        <input type="text" id="end_date_field" name="my_end_date_time_field" value="<?php echo esc_attr($end_value); ?>" class="regular-text" />
        <p id="name-description">mm/dd/yyyy</p>
    </div>
<?php
}


// Custom function to handle saving of settings
function my_custom_save_function($value)
{
    // Perform your desired actions with the submitted value
    // This function will be called when the "Save Settings" button is clicked
    echo "save successful!";
}



// Section callback function
function my_general_section_callback()
{
    echo 'Immidiately change or schedule an alteration to the merchant\'s current hours of operation.';
}


// Callback function to enqueue the CSS file for the settings page
function enqueue_merchants_settings_styles()
{
    $screen = get_current_screen();
    if ($screen && $screen->id === 'merchants_page_merchants-settings') {
        wp_enqueue_style('merchants-settings-styles', get_template_directory_uri() . '/css/editor-style-merchants.css');
        wp_enqueue_script('merchants-settings-styles', get_template_directory_uri() . '/js/custom-manage-merchants.js');
    }
}
add_action('admin_enqueue_scripts', 'enqueue_merchants_settings_styles');
