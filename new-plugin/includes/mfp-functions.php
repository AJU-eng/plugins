<?php

function adminMenuItem() {
    add_menu_page(
        'Control Posts',// Title of the page
        'Manage Posts',// Text to show on the menu link
        'manage_options',// Capability requirement to see the link
        'mfp-first-acp-page',// The 'slug' - identifier for the menu page
        'mfpFirstAcpPageContent'// Callback function to display the page content
    );
}


function mfpFirstAcpPageContent() {

    $file = plugin_dir_path(__FILE__) . 'mfp-first-acp-page.php';


    if (file_exists($file)) {
        include_once $file;
    } else {
        echo 'File not found: ' . $file;
    }
}

$names;


function pluginForm() {
    $number = $_POST['postCount'];
    $category = $_POST['category'];
    $alignment = $_POST['numberOfColumns'];
    $buttonText = $_POST['buttonText'];
    $excerptCount = $_POST['excerptCount'];
    $thumbnail = $_POST['thumbnail'];
    $thumbnailSize= $_POST['thumbnailSize'];
    update_option('numberOfpages', $number, '', 'yes');
    update_option('categories', $category, '', 'yes');
    update_option('columCount', $alignment, '', 'yes');
    update_option('buttonText', $buttonText, '', 'yes');
    update_option('excerptCount', $excerptCount, '', 'yes');
    update_option('thumbnail', $thumbnail, '', 'yes');
    update_option('thumbnailSize', $thumbnailSize, '', 'yes');


    wp_send_json_success($_POST);
}
function pluginShortCode() {

     include_once plugin_dir_path(__FILE__) .'../template-parts/shortcode.php';
  
    

}

function pluginThumbnail() {
    
    add_theme_support('post-thumbnails');
    $thumbnail_size = get_option('thumbnailSize');
    error_log($thumbnail_size); // Temporarily output the size for debugging
    
    add_image_size('custom-thumbnail-size',150, 150, true);
}


function tPlugin() {
    wp_enqueue_style("t_plugin", plugin_dir_url(__FILE__) . "../index.css");
}

function customExcerptLength() {
  $word = (int) $_POST['excerptCount'];
  return $word;
}

apply_filters('excerpt_length','customExcerptLength');
add_action('after_setup_theme', 'pluginThumbnail');
add_action('admin_enqueue_scripts', 'tPlugin');

add_action('admin_menu', 'adminMenuItem');
add_action('wp_ajax_form', 'pluginForm');
add_action('wp_ajax_nopriv_form', 'pluginForm');

add_shortcode('hel', 'pluginShortCode');

