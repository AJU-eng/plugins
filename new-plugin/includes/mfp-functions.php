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
    $number = $_POST['number'];
    $category = $_POST['category'];
    update_option('numberOfpages', $number, '', 'yes');
    update_option('categories', $category, '', 'yes');

    wp_send_json_success($number);
}
function pluginShortCode() {

    $category = get_option('categories');
    $number = (int) get_option('numberOfpages');



    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $number,
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category,
            ),
        ),

    );
    // if (!$category && !$number) {
    //     $args = array(
    //         'post_type' => 'post',
    //         'posts_per_page' => -1,
    //     );
    //     $theQuery = new WP_Query($args);
    //     if ($theQuery->have_posts()) {
    //         while ($theQuery->have_posts()) {
    //             $theQuery->the_post();
    //             echo get_the_title();
    //             echo "<br/>";
    //             echo get_the_excerpt();
    //             echo "<br/>";
    //             echo "Read more...";
    //             echo '<br/> <br/>';
                

    //         }
    //     }
    // } else {
    //     $theQuery = new WP_Query($args);


    //     if ($theQuery->have_posts()) {
    //         while ($theQuery->have_posts()) {
    //             $theQuery->the_post();
    //             echo get_the_title();
    //             echo "<br/>";
    //             echo get_the_excerpt();
    //             echo "<br/>";
    //             echo "Read more...";
    //             echo '<br/> <br/>';
                

    //         }
    //     }
    // }
    
     include_once plugin_dir_path(__FILE__) .'../template-parts/shortcode.php';
  
    

}

function tPlugin() {
    wp_enqueue_style("t_plugin", plugin_dir_url(__FILE__) . "../index.css");
}

add_action('admin_enqueue_scripts', 'tPlugin');


add_action('admin_menu', 'adminMenuItem');
add_action('wp_ajax_form', 'pluginForm');
add_action('wp_ajax_nopriv_form', 'pluginForm');

add_shortcode('hel', 'pluginShortCode');

