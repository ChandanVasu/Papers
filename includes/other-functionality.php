<?php 


// Enqueue Styles and Scripts
function enqueue_styles_and_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style-grid-post', get_template_directory_uri() . '/Style/Elementor/gridpost.css');
    wp_enqueue_style('single-post', get_template_directory_uri() . '/Style/single-post.css');
    wp_enqueue_style('custom-style-list-post', get_template_directory_uri() . '/Style/Elementor/listpost.css');
    wp_enqueue_style('custom-styles-gridpost', get_template_directory_uri() . '/Style/Gridpost.css');
    wp_enqueue_style('custom-styles-comment', get_template_directory_uri() . '/Style/comment_box.css');
    wp_enqueue_style('header-css', get_template_directory_uri() . '/Style/header-css.css');
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');


function enqueue_theme_control_panel_styles() {
    wp_enqueue_style('theme-control-panel-styles', get_template_directory_uri() . '/Style/theme-control-panel-style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_theme_control_panel_styles');



// Logo Call Function

function theme_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}

add_action('after_setup_theme', 'theme_custom_logo_setup');