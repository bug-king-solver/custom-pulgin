<?php
/*
Plugin Name: Custom Highlighter
Description: Highlight specified text in content.
Version: 1.0
Author: Your Name
*/

// Include necessary scripts and styles
function custom_highlighter_enqueue_scripts()
{
    wp_enqueue_style('custom-highlighter-style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script('custom-highlighter-script', plugins_url('js/script.js', __FILE__), array('jquery'), '', true);
}

add_action('admin_enqueue_scripts', 'custom_highlighter_enqueue_scripts');

// Create the plugin page
function custom_highlighter_page()
{
    ?>
    <div class="wrap">
        <h1>Custom Highlighter</h1>
        <input type="text" id="custom-highlighter-text"
            value="<?php echo esc_attr(get_option('custom_highlighter_text', '')); ?>">
        <button id="custom-highlighter-save">Save</button>
    </div>
    <?php
}

function custom_highlighter_menu()
{
    add_menu_page('Custom Highlighter', 'Custom Highlighter', 'manage_options', 'custom-highlighter', 'custom_highlighter_page');
}

add_action('admin_menu', 'custom_highlighter_menu');

// Save the entered text
function custom_highlighter_save()
{
    if (isset($_POST['text'])) {
        update_option('custom_highlighter_text', sanitize_text_field($_POST['text']));
        wp_send_json_success(); // Send a JSON success response
    } else {
        wp_send_json_error(); // Send a JSON error response
    }
    die();
}

add_action('wp_ajax_custom_highlighter_save', 'custom_highlighter_save');
