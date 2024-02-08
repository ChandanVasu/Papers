<?php
// Theme Setup
function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'your-theme-textdomain'),
    ));
    register_nav_menus(array(
        'hearder-menu' => __('Header Menu', 'your-theme-textdomain'),
    ));
}
add_action('after_setup_theme', 'theme_setup');


//-----------------Call Function.php include  File --------------

include_once get_template_directory() . '/includes/other-functionality.php';
include_once get_template_directory() . '/includes/Register-elementor.php';
include_once get_template_directory() . '/includes/headercontrol.php';

// include_once get_template_directory() . '/includes/Vasux.php';




// Register oEmbed Widget
if (!function_exists('register_oembed_widget')) {
    function register_oembed_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/oembed-widget.php');
        $widgets_manager->register(new \Elementor_oEmbed_Widget());
    }
    add_action('elementor/widgets/register', 'register_oembed_widget');
}

// Register Custom Grid Post Widget
if (!function_exists('register_custom_grid_post_widget')) {
    function register_custom_grid_post_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/gridpost.php');
        $widgets_manager->register_widget_type(new \Custom_Grid_Post_Widget());
    }

    add_action('elementor/widgets/register', 'register_custom_grid_post_widget');
}

if (!function_exists('register_treding_view_widget')) {
    function register_treding_view_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/tradingview-widget.php');
        $widgets_manager->register_widget_type(new \Custom_TradingView_Widget());
    }

    add_action('elementor/widgets/register', 'register_treding_view_widget');
}

// Register Custom Grid Post Widget

if (!function_exists('register_custom_list_post_widget')) {
    function register_custom_list_post_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/listpost.php');
        $widgets_manager->register_widget_type(new \Custom_List_Post_Widget());
    }

    add_action('elementor/widgets/register', 'register_custom_list_post_widget');
}

if (!function_exists('register_custom_author_widget')) {
    function register_custom_author_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/author-list.php');
        $widgets_manager->register_widget_type(new \Author_List_Widget());
    }

    add_action('elementor/widgets/register', 'register_custom_author_widget');
}



add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');



// Add custom columns for post reach and views
function add_custom_columns($columns) {
    $columns['post_reach'] = 'Post Reach';
    $columns['post_views'] = 'Post Views';
    return $columns;
}
add_filter('manage_post_posts_columns', 'add_custom_columns');

// Populate custom columns with data
function custom_column_data($column, $post_id) {
    switch ($column) {
        case 'post_reach':
            echo get_post_meta($post_id, 'post_reach', true);
            break;
        case 'post_views':
            $post_views = get_post_meta($post_id, 'post_views', true);
            echo $post_views ? $post_views : 0;
            break;
    }
}
add_action('manage_post_posts_custom_column', 'custom_column_data', 10, 2);

// Increment post views count
function increment_post_views() {
    if (is_single()) {
        $post_id = get_the_ID();
        $views = get_post_meta($post_id, 'post_views', true);
        $views = $views ? $views + 1 : 1;
        update_post_meta($post_id, 'post_views', $views);
    }
}
add_action('wp_head', 'increment_post_views');
?>
